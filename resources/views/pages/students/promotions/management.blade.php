@extends('layouts.master')
@section('css')
@section('title')
    {{trans('main_trans.students_list')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.students_list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                    تراجع الكل
                                </button>
                              <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="60"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('main_trans.student_name')}}</th>
                                            <th class="alert-danger">{{trans('main_trans.previous_Grade')}}</th>
                                            <th class="alert-danger">{{trans('main_trans.previous_Classroom')}}</th>
                                            <th class="alert-danger">{{trans('main_trans.previous_Section')}}</th>
                                            <th class="alert-danger">{{trans('main_trans.academic_year')}}</th>
                                            <th class="alert-success">{{trans('main_trans.next_Grade')}}</th>
                                            <th class="alert-success">{{trans('main_trans.next_Classroom')}}</th>
                                            <th class="alert-success">{{trans('main_trans.next_Section')}}</th>
                                            <th class="alert-success">{{trans('main_trans.academic_year_new')}}</th>
                                            <th>{{trans('Grade_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->student->name}}</td>
                                                <td>{{$promotion->f_grade->name}}</td>
                                                <td>{{$promotion->f_classroom->name_class}}</td>
                                                <td>{{$promotion->f_section->name}}</td>
                                                <td>{{$promotion->academic_year}}</td>
                                                <td>{{$promotion->t_grade->name}}</td>
                                                <td>{{$promotion->t_classroom->name_class}}</td>
                                                <td>{{$promotion->t_section->name}}</td>
                                                <td>{{$promotion->academic_year_new}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#Delete_one{{$promotion->id}}">ارجاع الطالب</button>
                                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">تخرج الطالب</button>
                                                </td>
                                            </tr>
                                             @include('pages.students.promotions.delete_all')
                                             @include('pages.students.promotions.delete_one')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
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
@endsection
