@if ($peserta_list->hasPages() || $peserta_list->total() == 0)
    @php
        // Ambil variabel pagination dari object Laravel
        $currentPage = $peserta_list->currentPage();
        $lastPage = $peserta_list->lastPage();
        // Jika data 0, lastPage tetap set 1 agar tampilan tidak rusak (opsional)
        $lastPage = ($lastPage < 1) ? 1 : $lastPage;
        
        // Link prev/next
        $prevUrl = $peserta_list->previousPageUrl();
        $nextUrl = $peserta_list->nextPageUrl();
    @endphp

    <nav aria-label="Page navigation" style="display:flex;">
        <ul class="pagination-custom">
            
            {{-- Tombol Back --}}
            <li class="{{ $peserta_list->onFirstPage() ? 'disabled' : '' }}">
                <a class="nav-link page-link" href="{{ $prevUrl ?? '#' }}">&lt; Back</a>
            </li>

            {{-- Info Halaman (Contoh: 1 / 5) --}}
            <li class="active"><a class="page-link">{{ $currentPage }}</a></li>
            <li style="padding: 0 5px; display:flex; align-items:center;"><span>/</span></li>
            <li class="active"><a class="page-link">{{ $lastPage }}</a></li>

            {{-- Tombol Next --}}
            <li class="{{ !$peserta_list->hasMorePages() ? 'disabled' : '' }}">
                <a class="nav-link page-link" href="{{ $nextUrl ?? '#' }}">Next &gt;</a>
            </li>
        </ul>

        {{-- Form Go To Page --}}
        <form method="GET" action="{{ route('admin.dashboard') }}" class="goto-page-form" style="display: flex; align-items: center; margin-left: 15px; gap: 8px;">
            {{-- Pertahankan keyword pencarian jika ada --}}
            @if(request('search') || request('keyword'))
                <input type="hidden" name="search" value="{{ request('search') ?? request('keyword') }}">
            @endif

            <label for="page-input">Ke</label>
            <input type="number" id="page-input" name="page" min="1" max="{{ $lastPage }}" value="{{ $currentPage }}" class="form-control form-control-sm goto-input" style="width: 72px;">
            <button type="submit" class="btn btn-sm btn-primary" style="margin-left:12px">Go</button>
        </form>
    </nav>
@endif