@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
    {{ trans('general.technoSoft') }} | {{ trans('main_sidebar.school_grade') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_sidebar.school_grade_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}" class="default-color">{{{ trans('main_sidebar.main_dashboard') }}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_sidebar.school_grade') }}</li>
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
                    <div class="alert alert-danger">
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
                        {{ trans('grades.add_grade') }}
                </button>
                <!-- Start table-responsive -->
                <div class="table-responsive">
                    <!-- Start Table -->
                    <table id="datatable" class="table table-striped table-hover table-responsive-lg table-bordered p-0">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>{{ trans('grades.grade_name')}}</th>
                            <th>{{ trans('general.Notes')}}</th>
                            <th>{{ trans('general.Processes')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach($Grades as $Grade)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $Grade->id}}</td>
                                    <td>{{ $Grade->Name}}</td>
                                    <td>{{ $Grade->Notes}}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $Grade->id }}" title="{{ trans('general.Edit') }}">
                                                <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $Grade->id }}" title="{{ trans('general.Delete') }}">
                                                <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Start Edit Grade Modal -->
                                <div class="modal fade" id="edit{{ $Grade->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <!-- Start modal-dialog -->
                                    <div class="modal-dialog" role="document">
                                        <!-- Start modal-content -->
                                        <div class="modal-content">
                                            <!-- Start Modal Header -->
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    <i class="fa fa-edit" aria-hidden="true"> </i>
                                                    {{ trans('grades.edit_grade_info') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- End Modal Header -->
                                            <!-- Start Modal Body -->
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('Grades.update', 'test') }}" method="POST">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name" class="mr-sm-2">{{ trans('grades.stage_name_ar') }} :</label>
                                                            <input id="Name" type="text" name="Name" class="form-control" value="{{ $Grade->getTranslation('Name', 'ar') }}" required>
                                                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $Grade->id }}">
                                                        </div>
                                                        @error('Name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        <div class="col">
                                                            <label for="Name_en" class="mr-sm-2">{{ trans('grades.stage_name_en') }} :</label>
                                                            <input type="text" class="form-control" name="Name_en" value="{{ $Grade->getTranslation('Name', 'en') }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">{{ trans('general.Notes') }} :</label>
                                                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3">{{ $Grade->Notes }}</textarea>
                                                    </div>
                                                    <br><br>
                                            </div>
                                            <!-- End Modal Body -->
                                            <!-- Start modal-footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    {{ trans('general.Close') }}
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    {{ trans('general.update') }}
                                                </button>
                                            </div>
                                            <!-- Start modal-footer -->
                                            </form>
                                            <!-- End Add Form -->
                                        </div>
                                        <!-- End modal-content -->
                                    </div>
                                    <!-- End modal-dialog -->
                                </div>
                                <!-- End Edit Grade Modal -->
                                <!-- Start Delete Grade Modal -->
                                <div class="modal fade" id="delete{{ $Grade->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <!-- Start modal-dialog -->
                                    <div class="modal-dialog" role="document">
                                        <!-- Start modal-content -->
                                        <div class="modal-content">
                                            <!-- Start Modal Header -->
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                    <i class="fa fa-trash" aria-hidden="true"> </i>
                                                    {{ trans('grades.delete_grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <!-- End Modal Header -->
                                            <!-- Start Modal Body -->
                                            <br>
                                            <div class="modal-body">
                                                <form action="{{ route('Grades.destroy', 'test') }}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('grades.delete_warning_grade') }} <span class="text-danger font-bold">{{ $Grade->getTranslation('Name', 'ar') }}</span>
                                                    <input type="hidden" id="id" value="{{ $Grade->id }}" name="id" class="form-control">
                                                    <!-- Start modal-footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                            {{ trans('general.Close') }}
                                                        </button>
                                                        <button type="submit" class="btn btn-danger">
                                                            {{ trans('general.Delete') }}
                                                        </button>
                                                    </div>
                                                    <!-- Start modal-footer -->
                                                </form>
                                            </div>
                                            <!-- End Modal Body -->
                                            <!-- End Add Form -->
                                        </div>
                                        <!-- End modal-content -->
                                    </div>
                                    <!-- End modal-dialog -->
                                </div>
                                <!-- End Delete Grade Modal -->
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table -->
                </div>
                <!-- End table-responsive -->
            </div>
            <!-- End card-body -->
        </div>
        <!-- End card -->
    </div>
    <!-- End col-xl-12 mb-30 -->

    <!-- add_modal_Grade -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Start modal-dialog -->
        <div class="modal-dialog" role="document">
            <!-- Start modal-content -->
            <div class="modal-content">
                <!-- Start Modal Header -->
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        <i class="fa fa-pencil" aria-hidden="true"> </i>
                        {{ trans('grades.add_grade_info') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- End Modal Header -->
                <!-- Start Modal Body -->
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('Grades.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">{{ trans('grades.stage_name_ar') }} :</label>
                                <input id="Name" type="text" name="Name" class="form-control" required>
                            </div>
                            @error('Name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">{{ trans('grades.stage_name_en') }} :</label>
                                <input type="text" class="form-control" name="Name_en" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{ trans('general.Notes') }} :</label>
                            <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <br><br>
                </div>
                <!-- End Modal Body -->
                <!-- Start modal-footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ trans('general.Close') }}
                    </button>
                    <button type="submit" class="btn btn-success">
                            {{ trans('general.submit') }}
                    </button>
                </div>
                <!-- Start modal-footer -->
                </form>
                <!-- End Add Form -->
            </div>
            <!-- End modal-content -->
        </div>
        <!-- End modal-dialog -->
    </div>
    <!-- End Add Grade Modal -->
</div>
<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
