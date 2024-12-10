@extends('backend.layout.main')
@php $segment = request()->segment(3); $create = $segment=='create' ? true: false; @endphp
@section('title') {{ $create ? $data['create'] : $data['update'] }} @endsection


@section('styles')
    <link href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugins/select2-bootstrap4-theme-master/dist/select2-bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugins/switchery/dist/switchery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugins/bootstrap-switch/bootstrap-switch.min.css') }}" rel="stylesheet">
    @parent
    <style>
        .select2-container--bootstrap4 .select2-selection__clear {
            width: 1em;
            height: 1em;
            padding-left: 0.19em;
            line-height: 0.95em;
        }
        .select2-selection.select2-selection--single.select2-selection.loading{
            border-color: #ff8080;
            -webkit-box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
            box-shadow: 0 0 0 0.2rem rgb(255 0 0 / 25%);
        }
    </style>
@endsection
{{-- @prepend('styles')
    <link href="{{ asset('backend/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endprepend --}}
@section('content')
    
    @include('backend.component.breadCrumb',['title'=> $create ? $data['create'] : $data['update']])
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="createUser" class="userCreate" novalidate method="POST" action="{{ $data['action'] }}">
            @csrf
            @include('backend.user.components.genaral')
            @include('backend.user.components.contact')
        </form>
    </div>
@endsection

@section('adminJs')
    <script src="{{ asset('backend/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/icheck/icheck.min.js') }}"></script>
    <script src="{{ asset('backend/js/validation.js') }}"></script>
    {{-- <script src="{{ asset('tinymce/tinymce.min.js') }}"></script> --}}
    <script src="{{ asset('backend/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
    
    
    <script>
        
        // (function( $ ) {
        //     $( function(){
        //         $( document ).trigger( "enhance.tablesaw" );
        //     });
            
        // })( jQuery );
        
        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(), $(".skin-square input").iCheck({
                checkboxClass: "icheckbox_square-green",
                radioClass: "iradio_square-green"
            }), $(".touchspin").TouchSpin(), $(".switchBootstrap").bootstrapSwitch();
        }(window, document, jQuery);
        var province_id =  `{{ isset($data['user']->province_id) ? $data['user']->province_id : old('province_id') }}`
        var district_id =  `{{ isset($data['user']->district_id) ? $data['user']->district_id : old('district_id') }}`
        var ward_id =  `{{ isset($data['user']->ward_id) ? $data['user']->ward_id : old('ward_id') }}`;
        $(document).ready(function() {
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
        });
        
        // var province_id =  `${{ isset($data['user']->province_id) ? $data['user']->province_id : old('province_id') }}`
        // var district_id =  `${ isset($data['user']->district_id) ? $data['user']->district_id : old('district_id') }`
        // var ward_id =  `${ isset($data['user']->ward_id) ? $data['user']->ward_id : old('ward_id') }`
    </script>
    <script src="{{ asset('backend/library/library.js') }}"></script>
    <script src="{{ asset('backend/library/location.js') }}"></script>
    <script src="{{ asset('backend/plugins/ckfinder_2/ckfinder.js') }}"></script>
    <script src="{{ asset('backend/library/finder.js') }}"></script>
    
    <!-- This is data table -->
    
    @endsection