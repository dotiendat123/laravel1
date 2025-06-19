@extends('layout.main')

@section('title', 'Danh sách bài viết')

@section('content')
    <div class="container mt-5">
        {{-- Trạng thái tài khoản --}}
        <p><strong>Trạng thái tài khoản:</strong> {{ Auth::user()->status->label() }}</p>

        {{-- Header: Tạo mới + Đăng xuất --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="mb-0">Danh sách bài viết</h3>

            <div class="d-flex gap-2">
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Tạo mới</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Đăng xuất</button>
                </form>
            </div>
        </div>

        {{-- Danh sách bài viết mẫu --}}
        <ul class="list-group">
            <li class="list-group-item">Bài viết mẫu 1</li>
            <li class="list-group-item">Bài viết mẫu 2</li>
        </ul>
    </div>

    {{-- Thông báo thành công sau đăng nhập --}}
    @if(session('success'))
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                alert('{{ session('success') }}');
            });
        </script>
    @endif
@endsection