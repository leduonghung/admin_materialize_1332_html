@extends('backend.layout.main')

@section('title') {{ $data['index']['title'] }} @endsection

@section('styles')
    
@endsection

@section('content')
    @include('backend.component.breadCrumb',['title'=>$data['index']['title']])
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
   
    
@endsection

@section('adminJs')
    @parent
@endsection
@if(Session::has('code'))
<script>
    $.toast({
        heading: '{{ Session::get("title") }}',
        text: '{{ Session::get("content") }}',
        position: 'top-right',
        loaderBg:'#'+'{ Session::get(\'color\') }',
        icon: '{{ Session::get("code") ?? "error" }}',
        hideAfter: 4500,
        stack: 6
    });
    
    </script>
@endif
