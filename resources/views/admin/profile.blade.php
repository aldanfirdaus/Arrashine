@extends('admin.app')

@section('content')

    <div class="container">

        <h3>Profil Admin</h3>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Email</label>

                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">

                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Nomor Telepon Whatsapp</label>

                <input type="number" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">

                @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Password Lama</label>

                <input type="password" name="current_password" class="form-control">

                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Password Baru</label>

                <input type="password" name="password" class="form-control">

                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password Baru</label>

                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <button class="btn btn-primary">
                Simpan Perubahan
            </button>

        </form>

    </div>

@endsection