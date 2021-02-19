@extends('layouts.master')
@section('css')
@toastr_css
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta/js/bootstrap-select.min.js">
@section('title')
    {{ trans('classes.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{ trans('main_sidebar.school_classes_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}" class="default-color">{{{ trans('main_sidebar.main_dashboard') }}}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_sidebar.school_classes') }}</li>
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
                <!-- Start col-xl-6 pull-right -->
                <div class="col-xl-6 pull-right">
                    <!-- Start Add New Class Button -->
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        {{ trans('classes.add_class') }}
                    </button>
                    <!-- End Add New Class Button -->
                    <!-- Start Delete Selected Classes Button -->
                    <button type="button" class="button red x-small" id="btn_delete_all">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        {{ trans('classes.delete_selected_classes_checkbox') }}
                    </button>

                    <!-- End Delete Selected Classes Button -->
                </div>
                <!-- End col-xl-6 pull-right -->
                <!-- Start col-xl-6 pull-left -->
                <div class="col-xl-6 pull-left">
                    <li class=list-unstyled>
                        <a href="" class="button cyan x-small dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-file" aria-hidden="true"></i>
                            {{ trans('general.import_and_export_operations') }}
                        </a>
                        <ul class="dropdown-menu" style="min-width:20.5rem;">
                            <li>
                                <form action="{{ route('export_excel') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="button cyan x-small center" style="width: 95%; margin-right: 8px; margin-bottom:5px;">
                                        {{ trans('general.export_excel_file') }}
                                    </button>
                                </form>
                            </li>
                            <li>
                                <a href="" class="button cyan x-small center" style="width: 95%; margin-right: 8px; margin-bottom:5px;">
                                    {{ trans('general.import_excel_file') }}
                                </a>
                            </li>
                            <li class="divider"></li>
                        </ul>
                    </li>
                </div>
                <!-- End col-xl-6 pull-left -->
                <br><br>
                <!-- Start Grade Filter Div col-xl-12 -->
                <div class="col-xl-12" style="margin-top: 30px;">
                    <!-- Start Grade Filter -->
                    <form action="{{ route('classes_filter') }}" method="POST">
                        {{ csrf_field() }}
                        <select class="select2dropdown-menu" data-style="button black" name="Grade_id" required onchange="this.form.submit()">
                            <option value="" selected disabled>{{ trans('classes.search_by_grade') }}</option>
                            @foreach ($Grades as $Grade)
                                <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                            @endforeach
                        </select>
                    </form>
                    <!-- End Grade Filter -->
                </div>
                <!-- End Grade Filter Div col-xl-12 -->
                <br><br>
                <!-- Start table-responsive -->
                <div class="table-responsive">
                    <!-- Start Table -->
                    <table id="datatable" class="table table-striped table-hover table-responsive-lg table-bordered p-0" data-page-length="50" style="text-align: center">
                        <!-- Start thead -->
                        <thead class="thead-dark">
                            <tr>
                                <th><input name="select_all" id="example-select-all" class="checkall" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                                <th>#</th>
                                <th>{{ trans('classes.Name_class') }}</th>
                                <th>{{ trans('classes.Name_Grade') }}</th>
                                <th>{{ trans('classes.Processes') }}</th>
                            </tr>
                        </thead>
                        <!-- End thead -->
                        <!-- Start tbody -->
                        <tbody>
                            @if (isset($details))
                                <?php $List_Classes = $details ?>
                            @else
                                <?php $List_Classes = $Classrooms ?>
                            @endif
                            <?php $i = 0; ?>
                            @foreach ($List_Classes as $Classroom)
                                <tr>
                                    <?php $i++; ?>
                                    <td><input type="checkbox" value="{{ $Classroom->id }}" class="box1" ></td>
                                    <td>{{ $i }}</td>
                                    <td>{{ $Classroom->Class_Name }}</td>
                                    <td>{{ $Classroom->Grade->Name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $Classroom->id }}"
                                                title="{{ trans('general.Edit') }}"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $Classroom->id }}"
                                                title="{{ trans('general.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <!-- Start Edit Classroom Modal -->
                                <div class="modal fade" id="edit{{ $Classroom->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                   id="exampleModalLabel">
                                                   {{ trans('grades.edit_grade') }}
                                               </h5>
                                               <button type="button" class="close" data-dismiss="modal"
                                                       aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                           <div class="modal-body">
                                               <!-- add_form -->
                                               <form action="{{ route('Classrooms.update', 'test') }}" method="post">
                                                   {{ method_field('patch') }}
                                                   @csrf
                                                   <div class="row">
                                                       <div class="col">
                                                           <label for="Name"
                                                                  class="mr-sm-2">{{ trans('classes.stage_name_ar') }}
                                                               :</label>
                                                           <input id="Name" type="text" name="Name"
                                                                  class="form-control"
                                                                  value="{{ $Classroom->getTranslation('Class_Name', 'ar') }}"
                                                                  required>
                                                           <input id="id" type="hidden" name="id" class="form-control"
                                                                  value="{{ $Classroom->id }}">
                                                       </div>
                                                       <div class="col">
                                                           <label for="Name_en"
                                                                  class="mr-sm-2">{{ trans('classes.stage_name_en') }}
                                                               :</label>
                                                           <input type="text" class="form-control"
                                                                  value="{{ $Classroom->getTranslation('Class_Name', 'en') }}"
                                                                  name="Name_en" required>
                                                       </div>
                                                   </div>
                                                   <br>
                                                   <div class="form-group">
                                                       <label for="exampleFormControlTextarea1">{{ trans('grades.grade_name') }} :</label>
                                                       <select class="form-control form-control-lg" id="exampleFormControlSelect1" name="Grade_id">
                                                           <option value="{{ $Classroom->Grade->id }}">
                                                               {{ $Classroom->Grade->Name }}
                                                           </option>
                                                           @foreach ($Grades as $Grade)
                                                               <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                                           @endforeach
                                                       </select>
                                                   </div>
                                                   <br><br>

                                                   <div class="modal-footer">
                                                       <button type="button" class="btn btn-secondary"
                                                               data-dismiss="modal">{{ trans('general.Close') }}</button>
                                                       <button type="submit"
                                                               class="btn btn-success">{{ trans('general.update') }}</button>
                                                   </div>
                                               </form>

                                           </div>
                                       </div>
                                   </div>
                                </div>
                                <!-- End Edit Classroom Modal -->
                                <!-- Start Delete Classroom Modal -->
                                <div class="modal fade" id="delete{{ $Classroom->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                   <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                   id="exampleModalLabel">
                                                   {{ trans('classes.delete_class') }}
                                               </h5>
                                               <button type="button" class="close" data-dismiss="modal"
                                                       aria-label="Close">
                                                   <span aria-hidden="true">&times;</span>
                                               </button>
                                           </div>
                                           <div class="modal-body">
                                               <form action="{{ route('Classrooms.destroy', 'test') }}" method="post">
                                                   {{ method_field('Delete') }}
                                                   @csrf
                                                   {{ trans('classes.Warning_class') }}
                                                   <input id="id" type="hidden" name="id" class="form-control"
                                                          value="{{ $Classroom->id }}">
                                                   <div class="modal-footer">
                                                       <button type="button" class="btn btn-secondary"
                                                               data-dismiss="modal">{{ trans('general.Close') }}</button>
                                                       <button type="submit"
                                                               class="btn btn-danger">{{ trans('general.Delete') }}</button>
                                                   </div>
                                               </form>
                                           </div>
                                       </div>
                                   </div>
                                </div>
                                <!-- End Delete Classroom Modal -->
                            @endforeach
                        </tbody>
                        <!-- End tbody -->
                    </table>
                    <!-- End Table -->
                </div>
                <!-- End table-responsive -->
            </div>
            <!-- End card-body -->
        </div>
        <!-- End card card-statistics h-100 -->
    </div>
    <!-- End col-xl-12 mb-30 -->
    <!-- Start Add New Class Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            <i class="fa fa-pencil" aria-hidden="true"> </i>
                            {{ trans('classes.add_new_class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class=" row mb-30" action="{{ route('Classrooms.store') }}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_Classes">
                                        <div data-repeater-item>

                                            <div class="row">

                                                <div class="col">
                                                    <label for="Name"
                                                           class="mr-sm-2">{{ trans('classes.Name_class') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="Name" required />
                                                </div>


                                                <div class="col">
                                                    <label for="Name"
                                                           class="mr-sm-2">{{ trans('classes.Name_class_en') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="Name_class_en" required />
                                                </div>


                                                <div class="col">
                                                    <label for="Name_en"
                                                           class="mr-sm-2">{{ trans('classes.Name_Grade') }}
                                                        :</label>

                                                    <div class="box">
                                                        <select class="fancyselect" name="Grade_id">
                                                            @foreach ($Grades as $Grade)
                                                                <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <label for="Name_en"
                                                           class="mr-sm-2">{{ trans('general.Processes') }}
                                                        :</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                           type="button" value="{{ trans('classes.delete_row') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="{{ trans('classes.add_new_class_row') }}"/>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('general.Close') }}</button>
                                        <button type="submit"
                                                class="btn btn-success">{{ trans('general.submit') }}</button>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>
    <!-- End Add New Class Modal -->
    <!-- Start Multi Delete Classes Modal -->
    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Start Modal Header -->
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('classes.delete_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- End Modal Header -->
                <!-- Start Delete Form -->
                <form action="{{ route('delete_all') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        {{ trans('classes.Warning_class') }}
                        <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('general.Close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('general.Delete') }}</button>
                    </div>
                </form>
                <!-- End Delete Form -->
            </div>
            <!-- End Modal Content -->
        </div>
        <!-- End Modal Dialog -->
    </div>
    <!-- End Multi Delete Classes Modal -->
</div>
<!-- End row -->
@endsection

@section('js')
    @toastr_js
    @toastr_render
@endsection
