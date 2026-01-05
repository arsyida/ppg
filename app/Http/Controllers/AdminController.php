<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Admin; // Panggil Model 
use App\Models\Peserta;
use Illuminate\Support\Facades\Storage; // Untuk upload file
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Exception;


class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $keyword = $request->input('keyword') ?? $request->input('search');
        $limit = 50;

        // 1. Query Data
        $query = Peserta::query();

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('nama_peserta', 'like', '%' . $keyword . '%')
                  ->orWhere('no_ukg', 'like', '%' . $keyword . '%')
                  ->orWhere('nim', 'like', '%' . $keyword . '%')
                  ->orWhere('nik', 'like', '%' . $keyword . '%');
            });
        }

        // 2. Pagination (Otomatis handle offset/limit)
        $peserta_list = $query->orderBy('nama_peserta', 'asc')
                              ->paginate($limit)
                              ->withQueryString(); // Agar parameter search tetap ada saat klik page

        // 3. LOGIKA AJAX (Jika request dari fetch JS)
        if ($request->has('ajax_search')) {
            // Render partial view menjadi string HTML
            $table_html = view('admin.partials.table_rows', compact('peserta_list'))->render();
            $pagination_html = view('admin.partials.pagination_custom', compact('peserta_list'))->render();

            return response()->json([
                'table_html' => $table_html,
                'pagination_html' => $pagination_html
            ]);
        }

        // 4. LOGIKA NORMAL (Load Halaman Penuh)
        return view('admin.dashboard-admin', compact('peserta_list', 'keyword'));
    }

    public function exportExcel()
    {
        // 1. Ambil data menggunakan Eloquent
        $peserta_list = Peserta::orderBy('nama_peserta', 'ASC')->get();

        // 2. Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Peserta Lulus');

        // 3. Buat Judul (Header)
        $headers = [
            'A1' => 'No UKG',
            'B1' => 'Nama Peserta',
            'C1' => 'NIK',
            'D1' => 'NIM',
            'E1' => 'Tempat Lahir',
            'F1' => 'Tanggal Lahir',
            'G1' => 'Bidang Studi',
            'H1' => 'Jenis PPG',
            'I1' => 'No HP',
            'J1' => 'Alamat Lengkap',
            'K1' => 'Link Pas Foto'
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
            // Optional: Bold Header
            $sheet->getStyle($cell)->getFont()->setBold(true);
        }

        // 4. Isi Data
        $row = 2;
        // Base URL untuk foto (sesuaikan dengan config app Anda)
        // Jika file ada di public/uploads, gunakan asset()
        $baseUrl = asset('uploads') . '/'; 

        foreach ($peserta_list as $peserta) {
            // Kolom A: No UKG (Paksa String)
            $sheet->setCellValueExplicit('A' . $row, $peserta->no_ukg, DataType::TYPE_STRING);

            // Kolom B: Nama
            $sheet->setCellValue('B' . $row, $peserta->nama_peserta);

            // Kolom C: NIK (Paksa String)
            $sheet->setCellValueExplicit('C' . $row, $peserta->nik, DataType::TYPE_STRING);

            // Kolom D: NIM (Paksa String)
            $sheet->setCellValueExplicit('D' . $row, $peserta->nim, DataType::TYPE_STRING);

            $sheet->setCellValue('E' . $row, $peserta->tempat_lahir);
            $sheet->setCellValue('F' . $row, $peserta->tanggal_lahir);
            $sheet->setCellValue('G' . $row, $peserta->nama_bidang_studi);
            $sheet->setCellValue('H' . $row, $peserta->jenis_ppg);

            // Kolom I: No HP (Paksa String agar 0 di depan tidak hilang)
            $sheet->setCellValueExplicit('I' . $row, $peserta->no_hp, DataType::TYPE_STRING);

            $sheet->setCellValue('J' . $row, $peserta->alamat_lengkap);

            // Kolom K: Link Foto
            if (!empty($peserta->pas_foto)) {
                $fullUrl = asset('storage/' . $peserta->pas_foto);
                $sheet->setCellValue('K' . $row, $fullUrl);
                $sheet->getCell('K' . $row)->getHyperlink()->setUrl($fullUrl);
                // Ubah warna jadi biru agar terlihat seperti link
                $sheet->getStyle('K' . $row)->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE));
            } else {
                $sheet->setCellValue('K' . $row, 'Tidak ada foto');
            }

            $row++;
        }

        // 5. Auto Size Columns
        foreach (range('A', 'K') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // 6. Generate File dan Download via Laravel Stream
        $writer = new Xlsx($spreadsheet);
        $filename = "data_peserta_ppg_lulus_" . date('Y-m-d') . ".xlsx";

        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $filename);
    }

    public function editPeserta($no_ukg)
    {
        // Cari data berdasarkan no_ukg
        $peserta = Peserta::where('no_ukg', $no_ukg)->first();

        // Jika tidak ditemukan, kembalikan ke dashboard dengan pesan error
        if (!$peserta) {
            return redirect()->route('admin.dashboard')->with('error', 'Data peserta tidak ditemukan.');
        }

        return view('admin.edit-peserta', compact('peserta'));
    }

    // 2. Memproses Update Data
    public function updatePeserta(Request $request, $no_ukg)
    {
        // 1. Tambahkan Validasi Max Length
        $request->validate([
            'nama_peserta' => 'required',
            'no_ukg'       => 'required|numeric',
            'no_hp'        => 'nullable|max:20', // <-- MAX 20 KARAKTER
        ], [
            // Custom pesan error (opsional)
            'nama_peserta.required' => 'Nama peserta wajib diisi',
            'no_ukg.required'       => 'No UKG wajib diisi berupa angka',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 20 karakter.',
        ]);

        $peserta = Peserta::where('no_ukg', $no_ukg)->first();

        if ($peserta) {
            $peserta->update([
                'nama_peserta'      => $request->nama_peserta,
                'tempat_lahir'      => $request->tempat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'no_ukg'            => $request->no_ukg,
                'nim'               => $request->nim,
                'nik'               => $request->nik,
                'nama_bidang_studi' => $request->nama_bidang_studi,
                'jenis_ppg'         => $request->jenis_ppg,

                // Laravel otomatis memotong jika validasi lolos tapi data kepanjangan (opsional, tapi lebih baik validasi di atas)
                'no_hp'             => $request->no_hp, 

                'alamat_lengkap'    => $request->alamat_lengkap,
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Data berhasil diperbarui!');
        }

        return back()->with('error', 'Gagal memperbarui data.');
    }

    public function importPage(){
        return view('admin.import');
    }

    public function processImport(Request $request)
    {
        // 1. Validasi File menggunakan Laravel Validator
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls|max:5120', // Maks 5MB
        ]);

        try {
            $file = $request->file('file_excel');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow();
            
            $dataToUpsert = [];
            $processedCount = 0;

            // 2. Loop Baris (Mulai dari baris ke-2)
            for ($row = 2; $row <= $highestRow; $row++) {
                $no_ukg = $sheet->getCell('A' . $row)->getValue();

                // Skip jika baris kosong
                if (empty($no_ukg)) continue;

                // Masukkan ke array koleksi
                $dataToUpsert[] = [
                    'no_ukg'            => trim($no_ukg),
                    'nama_peserta'      => $sheet->getCell('B' . $row)->getValue(),
                    'nik'               => $sheet->getCell('C' . $row)->getValue(),
                    'nim'               => $sheet->getCell('D' . $row)->getValue(),
                    'tempat_lahir'      => $sheet->getCell('E' . $row)->getValue(),
                    'tanggal_lahir'     => $sheet->getCell('F' . $row)->getValue(),
                    'nama_bidang_studi' => $sheet->getCell('G' . $row)->getValue(),
                    'jenis_ppg'         => $sheet->getCell('H' . $row)->getValue(),
                    'no_hp'             => $sheet->getCell('I' . $row)->getValue(),
                    'alamat_lengkap'    => $sheet->getCell('J' . $row)->getValue(),
                    'pas_foto'          => $sheet->getCell('K' . $row)->getValue(),
                ];

                $processedCount++;
            }

            // 3. Eksekusi UPSERT (Massive Insert or Update)
            if (!empty($dataToUpsert)) {
                DB::transaction(function () use ($dataToUpsert) {
                    // Argumen 1: Data yang akan diproses
                    // Argumen 2: Kolom kunci unik (no_ukg)
                    // Argumen 3: Kolom yang diupdate jika no_ukg sudah ada
                    Peserta::upsert($dataToUpsert, ['no_ukg'], [
                        'nama_peserta', 'nik', 'nim', 'tempat_lahir', 
                        'tanggal_lahir', 'nama_bidang_studi', 'jenis_ppg', 
                        'no_hp', 'alamat_lengkap', 'pas_foto'
                    ]);
                });
            }

            return redirect()->back()->with('message', "Sukses: Berhasil mengimpor/memperbarui $processedCount data peserta.");
        } catch (Exception $e) {
            return redirect()->back()->with('error', "Error: Gagal mengimpor data. " . $e->getMessage());
        }
    }
}

