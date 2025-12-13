@extends('layouts.master')
@section('css')

@section('title')
    {{trans('Grade_trans.title_page')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('main_trans.Grades')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.Grades')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
  <div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
      <div class="card-body">
          <button type="button" class="button x-small" data-toggle="modal"
                  data-target="#addModal" style="margin-bottom :20px;">
                  {{trans('Grade_trans.add_Grade')}}

          </button>
        <div class="table-responsive">
        <table id="datatable" class="table table-striped table-bordered p-0">
          <thead>
              <tr>
                  <th>#</th>
                  <th>{{trans('Grade_trans.Name')}}</th>
                  <th>{{trans('Grade_trans.Notes')}}</th>
                  <th>{{trans('Grade_trans.Processes')}}</th>

              </tr>
          </thead>
          <tbody>
                @foreach($Grades as $grade)
                  <tr>
                      <td>{{ $grade->id }}</td>
                      <td>{{ $grade->name }}</td>
                      <td>{{ $grade->notes }}</td>

                      <td>
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                  data-target="#editModal{{$grade->id}}"
                                  title="{{trans('Grade_trans.edit_Grade')}}">
                              <i class="fa fa-edit"></i>
                          </button>
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                  data-target="#openDeleteModal" id="btnDeleteModal"
                                  data-id="{{$grade->id}}"
                                  title="{{trans('')}}">
                              <i class="fa fa-trash"></i>
                          </button>

                      </td>
                  </tr>

                  <!-- edit_modal_Grade -->
                                             <div class="modal fade" id="editModal{{$grade->id}}" tabindex="-1" role="dialog"
                                                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                 <div class="modal-dialog" role="document">
                                                     <div class="modal-content">
                                                         <div class="modal-header">
                                                             <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                 id="exampleModalLabel">
                                                                 {{ trans('Grade_trans.edit_Grade') }}
                                                             </h5>
                                                             <button type="button" class="close" data-dismiss="modal"
                                                                     aria-label="Close">
                                                                 <span aria-hidden="true">&times;</span>
                                                             </button>
                                                         </div>
                                                         <div class="modal-body">
                                                             <!-- add_form -->
                                                             <form action="{{route('Grades.update','test')}}" method="post">
                                                                 {{method_field('patch')}}
                                                                 @csrf
                                                                 <div class="row">
                                                                     <div class="col">
                                                                         <label for="Name"
                                                                                class="mr-sm-2">{{ trans('Grade_trans.stage_name_ar') }}
                                                                             :</label>
                                                                         <input id="Name" type="text" name="Name"
                                                                                class="form-control"
                                                                                value="{{$grade->getTranslation('name', 'ar')}}"
                                                                                required>
                                                                         <input id="id" type="hidden" name="id" class="form-control"
                                                                                value="{{ $grade->id }}">
                                                                     </div>
                                                                     <div class="col">
                                                                         <label for="Name_en"
                                                                                class="mr-sm-2">{{ trans('Grade_trans.stage_name_en') }}
                                                                             :</label>
                                                                         <input type="text" class="form-control"
                                                                                value="{{$grade->getTranslation('name', 'en')}}"
                                                                                name="Name_en" required>
                                                                     </div>
                                                                 </div>
                                                                 <div class="form-group">
                                                                     <label
                                                                         for="exampleFormControlTextarea1">{{ trans('Grade_trans.Notes') }}
                                                                         :</label>
                                                                     <textarea class="form-control" name="Notes"
                                                                               id="exampleFormControlTextarea1"
                                                                               rows="3">{{ $grade->notes }}</textarea>
                                                                 </div>
                                                                 <br><br>

                                                                 <div class="modal-footer">
                                                                     <button type="button" class="btn btn-secondary"
                                                                             data-dismiss="modal">{{ trans('Grade_trans.Close') }}</button>
                                                                     <button type="submit"
                                                                             class="btn btn-success">{{ trans('Grade_trans.Edit') }}</button>
                                                                 </div>
                                                             </form>

                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>

                @endforeach

          </tbody>


       </table>
      </div>
      </div>
    </div>
  </div>

    <!-- Add model  -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">  اضافه جديد : <span class="userName"></span> </h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('Grades.store')}}" method="post" enctype="multipart/form-data">

                        {{csrf_field()}}
                          <div class="row">
                              <div class="col">
                                  <label for="Name"
                                         class="mr-sm-2">{{ trans('Grade_trans.stage_name_ar') }}
                                      :</label>
                                  <input id="Name" type="text" name="Name" class="form-control">
                              </div>

                              <div class="col">
                                    <label for="Name_en"
                                           class="mr-sm-2">{{ trans('Grade_trans.stage_name_en') }}
                                        :</label>
                                    <input type="text" class="form-control" name="Name_en">
                              </div>
                          </div>
                          <div class="form-group">
                                <label
                                    for="exampleFormControlTextarea1">{{ trans('Grade_trans.Notes') }}
                                    :</label>
                                <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                                          rows="3">
                                </textarea>
                            </div>
                             <br><br>


                             <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('Grade_trans.Close') }}</button>
                                <button type="submit"
                                        class="btn btn-success">{{ trans('Grade_trans.submit') }}</button>
                             </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

      <!-- Delete model  -->
    <div class="modal fade" id="openDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ trans('Grade_trans.Warning_Grade') }} <span class="userName"></span> </h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Grades.destroy','test') }}" method="post">

                         {{method_field('Delete')}}
                        <!-- token and user id -->
                        @csrf
                        <input required="" type="hidden" name="id" value="">
                        <!-- /token and user id -->
                        <div class="modal-footer">
                           <button type="button" class="btn btn-secondary"
                                   data-dismiss="modal">{{ trans('Grade_trans.Close') }}</button>
                           <button type="submit"
                                   class="btn btn-success">{{ trans('Grade_trans.Delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

<!-- row closed -->
@endsection
@section('js')
    <script type="text/javascript">
        $(document).on('click','#btnDeleteModal',function(){

            var id = $(this).data('id');

            $("input[name='id']").val(id);
        });
    </script>
@endsection
