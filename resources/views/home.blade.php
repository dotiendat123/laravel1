{{-- @extends('layout.main')

@section('title', 'Trang chủ')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Dashboard Laravel + AdminLTE</h3>
    </div>
    <div class="card-body">
        Chào mừng bạn đến với giao diện AdminLTE 😎
    </div>
</div>
@endsection --}}


@extends('layout.main')

@section('title', 'Home')

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 70vh; background-color: white;">
        <h2 class="text-warning">Đỗ Tiến Đạt</h2>
        {{-- <h1>Xin chào, {{ $user->name }}</h1> --}}
        <h1>
            Xin chào, {{ $user ? $user->name : 'Khách' }}
        </h1>
    </div>
@endsection