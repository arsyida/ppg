@if ($peserta_list->isEmpty())
    <tr>
        <td colspan="13" class="text-center text-muted p-4">Data tidak ditemukan.</td>
    </tr>
@else
    @foreach ($peserta_list as $index => $peserta)
    <tr>
        {{-- Hitung nomor urut: (Page Saat Ini - 1) * Per Page + Index Loop + 1 --}}
        <td>{{ ($peserta_list->currentPage() - 1) * $peserta_list->perPage() + $loop->iteration }}</td>
        <td>{{ $peserta->nama_peserta }}</td>
        <td>{{ $peserta->tempat_lahir }}</td>
        <td>{{ $peserta->tanggal_lahir }}</td>
        <td>{{ $peserta->no_ukg }}</td>
        <td>{{ $peserta->nim }}</td>
        <td>{{ $peserta->nik }}</td>
        <td>{{ $peserta->nama_bidang_studi }}</td>
        <td>{{ $peserta->jenis_ppg }}</td>
        <td>{{ $peserta->no_hp ?? '-' }}</td>
        <td>{{ $peserta->alamat_lengkap ?? '-' }}</td>
        <td>{{ $peserta->pas_foto ?? '-' }}</td>
        <td>
            <a href="{{ route('admin.peserta.edit', $peserta->no_ukg) }}" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil-fill"></i> Edit
            </a>
        </td>
    </tr>
    @endforeach
@endif