@extends('layouts.app') {{-- 1. Menggunakan Layout Utama --}}

@section('title', 'Login Admin')

@section('content')

<div class="login-wrapper">
    <div class="card login-card shadow-lg" style="max-width: 450px;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <h1 class="h3 fw-bold mt-3">Admin Panel Login</h1>
                <p class="text-muted">PPG FKIP Universitas Lampung</p>
            </div>

            {{-- Alert Error --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('login.admin.process') }}">
                @csrf 

                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" 
                           id="username" name="username" value="{{ old('username') }}" required autofocus>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection