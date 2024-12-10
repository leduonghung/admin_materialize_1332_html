@extends('backend.layout.main')

@section('title') {{ $data['index']['title'] }} @endsection

@section('styles')
    @parent
@endsection

@section('content')
   
    
    
@endsection

@section('adminJs')
    @parent
@endsection
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
