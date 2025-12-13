@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('main_trans.Edit_Teacher') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Edit_Teacher') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('Teachers.update','test')}}" method="post">
                             {{method_field('patch')}}
                             @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('main_trans.Email')}}</label>
                                    <input type="hidden" value="{{$Teachers->id}}" name="id">
                                    <input type="email" name="email" value="{{$Teachers->email}}" class="form-control">

                                </div>
                                <div class="col">
                                    <label for="title">{{trans('main_trans.Password')}}</label>
                                    <input type="password" name="password" value="" class="form-control">

                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('main_trans.Name_Teacher')}}</label>
                                    <input type="text" name="Name" value="{{ $Teachers->name }}" class="form-control">

                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{trans('main_trans.specialization')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="specialization_id">
                                        <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                        @foreach($specializations as $specialization)
                                              <option value="{{$specialization->id}}" {{$specialization->id == $Teachers->specialization_id ? 'selected' : "" }}> {{$specialization->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{trans('main_trans.Gender')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                        <option selected disabled>{{trans('main_trans.Choose')}}...</option>
                                            @foreach($genders as $gender)
                                                <option value="{{$gender->id}}" {{$gender->id == $Teachers->gender_id ? 'selected' : ""}}>{{$gender->name}}</option>
                                            @endforeach

                                    </select>

                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('main_trans.Joining_Date')}}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text"  id="datepicker-action"  value="{{$Teachers->Joining_Date}}" name="joining_Date" data-date-format="yyyy-mm-dd">
                                    </div>

                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('main_trans.Address')}}</label>
                                <textarea class="form-control" name="address"
                                          id="exampleFormControlTextarea1" rows="4">{{$Teachers->Address}}</textarea>

                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('main_trans.Next')}}</button>
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

@endsection
