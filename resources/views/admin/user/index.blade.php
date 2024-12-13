@extends('admin.layouts.main')

@section('title') {{ $data['index'] }} @endsection

@section('styles')
    @parent
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @include('admin.user.components.list',['users'=>$data['users']])
</div>
<div class="bottom-fix">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#onboardImageModal"> Thêm mới </button>
</div>
{{-- @include('admin.user.components.domain-extension') --}}
    
    
@endsection

@section('adminJs')
    @parent
@if(Session::has('code'))
<script>
    $.toast({
        heading: '{{ Session::get("title") ?? 'Thanh cong' }}',
        text: '{{ Session::get("content") ?? 'Thanh cong' }}',
        position: 'top-right',
        loaderBg:'#26dad2',
        icon: '{{ Session::get("code") ?? "error" }}',
        hideAfter: 4500,
        stack: 6
    });
    
    </script>
@endif

@endsection