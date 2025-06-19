@extends('layout.main')

@section('title', 'Home')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 70vh; background-color: white;">
        <div class="text-center">
            <h2 class="text-warning">Đỗ Tiến Đạt</h2>
            <h1>
                Xin chào, {{ $user ? $user->name : 'Khách' }}
            </h1>
        </div>
    </div>

    {{-- Thông báo alert sau khi load trang --}}
    @if(session('success'))
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                alert('{{ session('success') }}');
            });
        </script>
    @endif
@endsection