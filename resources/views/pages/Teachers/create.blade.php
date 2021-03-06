@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('general.technoSoft') }} | {{ trans('teachers.Add_Teacher') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0">{{ trans('teachers.Add_New_Teacher') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}" class="default-color">{{{ trans('main_sidebar.main_dashboard') }}}</a></li>
                    <li class="breadcrumb-item active">{{ trans('teachers.Add_Teacher') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">


                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br><br>
                            <form action="{{route('Teachers.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="file" class="input-file">
                                            <i class="fa fa-camera-retro la-lg la-fw"> </i>
                                            <span id="photo_label_span">{{trans('general.Photo_Attachment')}}</span>
                                        </label>
                                        <input type="file" id="file" name="file" onchange="previewPhotoFile(this)">
                                        <img id="previewImg" class="rounded-circle pull-left" style="max-width: 250px; margin-left: 150px;">
                                        @error('photo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('teachers.Email')}}</label>
                                        <input type="email" name="Email" class="form-control">
                                        @error('Email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('teachers.Password')}}</label>
                                        <input type="password" name="Password" class="form-control">
                                        @error('Password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{trans('teachers.Name_ar')}}</label>
                                        <input type="text" name="Name_ar" class="form-control">
                                        @error('Name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{trans('teachers.Name_en')}}</label>
                                        <input type="text" name="Name_en" class="form-control">
                                        @error('Name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="title">{{trans('teachers.Mobile_Number')}}</label>
                                        <input type="number" name="Mobile" class="form-control">
                                        @error('Mobile')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity">{{trans('teachers.specialization')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="Specialization_id">
                                            <option selected disabled>{{trans('parents.Choose')}}...</option>
                                            @foreach($specializations as $specialization)
                                                <option value="{{$specialization->id}}">{{$specialization->Name}}</option>
                                            @endforeach
                                        </select>
                                        @error('Specialization_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputState">{{trans('teachers.Gender')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="Gender_id">
                                            <option selected disabled>{{trans('parents.Choose')}}...</option>
                                            @foreach($genders as $gender)
                                                <option value="{{$gender->id}}">{{$gender->Name}}</option>
                                            @endforeach
                                        </select>
                                        @error('Gender_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <label for="title">{{trans('teachers.Joining_Date')}}</label>
                                        <div class='input-group date'>
                                            <input class="form-control" type="text"  id="datepicker-action" name="Joining_Date" data-date-format="yyyy-mm-dd"  required>
                                        </div>
                                        @error('Joining_Date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{trans('teachers.Address')}}</label>
                                    <textarea class="form-control" name="Address"
                                              id="exampleFormControlTextarea1" rows="4"></textarea>
                                    @error('Address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('general.submit')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function (){
            $("#file").on("change", function(e){
            var file = $(this)[0].files, filename = e.target.value.split('\\').pop();
            if(file.length == 1){
                $(".input-file").find(".fa-camera-retro").toggleClass("fa-upload");
                $("#photo_label_span").text(filename + "  " + '{{ trans("general.photo_is_ready") }}');
            } else{
                alert('{{ __("general.please_upload_one_photo_only") }}');
            }
            });
        });
        function previewPhotoFile(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $("#previewImg").attr("src",reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
