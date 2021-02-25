@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
    {{ trans('sections.sections') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('sections.sections_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}" class="default-color">{{{ trans('main_sidebar.main_dashboard') }}}</a></li>
                <li class="breadcrumb-item active">{{ trans('sections.sections') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <!-- Start col-xl-12 mb-30 -->
    <div class="col-xl-12 mb-30">
        <!-- Start card -->
        <div class="card card-statistics h-100">
            <!-- Start card-body -->
            <div class="card-body">
                <!-- Error Messages List -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><span><i class="fa fa-exclamation" aria-hidden="true"> </i>  {{ $error }} </span></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- End Error Messages List -->
                <button type="button" class="button x-small" data-toggle="modal" data-target="#add">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        {{ trans('sections.add_section') }}
                </button>
                <br><br>
                <!-- Start Accordion -->
                <div class="accordion gray plus-icon round">
                    <!-- Start acd-group -->
                    <div class="acd-group">
                        <a href="#" class="acd-heading">{{-- $Grade->Name --}}GradeName</a>
                        <!-- Start acd-des -->
                        <div class="acd-des">
                            <!-- Start row -->
                            <div class="row">
                                <!-- start col-xl-12 mb-30 -->
                                <div class="col-xl-12 mb-30">
                                    <!-- Start card card-statistics h-100 -->
                                    <div class="card card-statistics h-100">

                                    </div>
                                    <!-- End card card-statistics h-100 -->
                                </div>
                                <!-- End col-xl-12 mb-30 -->
                            </div>
                            <!-- End row -->
                        </div>
                        <!-- End acd-des -->
                    </div>
                    <!-- End acd-group -->
                </div>
                <!-- End Accordion -->
            </div>
            <!-- End card-body -->
        </div>
        <!-- End Card -->
    </div>
    <!-- End col-xl-12 mb-30 -->
</div>
<!-- End row -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection