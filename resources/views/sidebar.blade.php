<!-- Sidebar for Admin -->
@if (Request::is('admin*'))
<div class="bg-white border-end" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4">
        <img src="{{ asset('assets/images/Logo-PPG-FKIP.png') }}" alt="Logo PPG" style="width: 50px;">
        <div class="ms-2 fs-5 fw-bold mt-2">PPG FKIP UNILA</div>
    </div>
    
    <div class="list-group list-group-flush my-3">
        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ Route::is('admin.dashboard') ? 'active' : '' }}" 
           href="{{ route('admin.dashboard') }}">
           <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ Route::is('admin.import') ? 'active' : '' }}" 
           href="{{ route('admin.import') }}">
           <i class="bi bi-upload me-2"></i> Import Data
        </a>

        <a class="list-group-item list-group-item-action list-group-item-light p-3 text-danger mt-3" 
           href="{{ route('logout') }}">
           <i class="bi bi-box-arrow-left me-2"></i> Logout
        </a>
    </div>
</div>

@else

<!-- Sidebar for Peserta -->
<div class="bg-white border-end" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4">
        <img src="{{ asset('assets/images/Logo-PPG-FKIP.png') }}" alt="Logo PPG" style="width: 50px;">
        <div class="ms-2 fs-5 fw-bold mt-2">PPG FKIP UNILA</div>
    </div>
    
    <div class="list-group list-group-flush my-3">
        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ Route::is('peserta.dashboard') ? 'active' : '' }}" 
           href="{{ route('peserta.dashboard') }}">
           <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ Route::is('peserta.edit') ? 'active' : '' }}" 
           href="{{ route('peserta.edit') }}">
           <i class="bi bi-pencil-square me-2"></i> Perbaikan Data
        </a>
        
        <a class="list-group-item list-group-item-action list-group-item-light p-3 {{ Route::is('peserta.tracking') ? 'active' : '' }}" 
            href="{{ route('peserta.tracking') }}">
            <i class="bi bi-truck me-2"></i> Info Pengiriman
        </a>

        <a class="list-group-item list-group-item-action list-group-item-light p-3 text-danger mt-3" 
           href="{{ route('logout') }}">
           <i class="bi bi-box-arrow-left me-2"></i> Logout
        </a>
    </div>
</div>

@endif