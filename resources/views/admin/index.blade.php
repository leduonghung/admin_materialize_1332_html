@extends('admin.layouts.main')
 
@section('title', 'Page Title')
@section('styles')
    @parent
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-4 mb-6">Page 1</h4>
    <p>
      Sample page.<br />For more layout options, refer
      <a
        href="https://demos.pixinvent.com/materialize-html-admin-template/documentation//layouts.html"
        target="_blank"
        class="fw-medium"
        >Layout docs</a
      >.
    </p>
  </div>
@endsection

@section('scripts')
    @parent
@endsection