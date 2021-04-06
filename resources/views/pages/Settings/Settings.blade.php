@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('general.technoSoft') }} | {{ trans('settings.application_setting') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('settings.application_setting') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}" class="default-color">{{{ trans('main_sidebar.main_dashboard') }}}</a></li>
                    <li class="breadcrumb-item active">{{ trans('settings.application_setting') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    <!-- Start row -->
    <div class="row">
        <!-- Start col-xl-12 mb-30 -->
        <div class="col-xl-12 mb-30">
            <!-- Start card card-statistics h-100 -->
            <div class="card card-statistics h-100">
                <!-- Start card-body -->
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- End card-body -->
            </div>
            <!-- End card card-statistics h-100 -->
        </div>
        <!-- End col-xl-12 mb-30 -->
    </div>
    <!-- End row -->

@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
