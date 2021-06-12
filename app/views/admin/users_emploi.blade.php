@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.emploi_du_temps_upload') }} @stop

@section('content')

  

<div class="panel panel-default panel-main">
   <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.emploi_du_temps_upload') }}</li>
  </ol>


<div class="clear"></div><hr>

<div class="col-md-6 col-md-offset-3">
<div class="panel panel-success" style="padding: 20px;">
    {{ Form::open(['route'=>'users_data_store', 'files'=>'true', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
    <div class="form-group">
      <label class="control-label">{{ Lang::get($path.'.CSV_file') }}  : </label>
        {{ Form::file('csv_file', ['class'=>'btn btn-default', 'id'=>'file']) }}
      @if($errors->first('csv_file'))
        <span class="help-block red-color">{{ $errors->first('csv_file') }}</span>
      @endif
    </div>
    <div class="form-group">
    {{ Form::submit(Lang::get($path.'.import_CSV'), ['class'=>'btn btn-warning']) }}</div>
    {{ Form::close() }}
</div>
</div>

<div class="clear"></div>


@if(Session::has('error'))
<div class="alert alert-danger center alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{{ Session::get('error') }}</strong>
</div>
@endif

@if(Session::has('success'))
<div class="alert alert-success center alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif

@if(Session::has('download'))
<div class="alert alert-warning center alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

  <strong><a href="{{ url() }}/uploads/data/{{ Session::get('download') }}">
@endif


 <div class="clear"></div><hr>

          <section class="panel">

                        <header class="panel-heading">
                              <div class="col-md-4">
                                <h3>{{ Lang::get($path.'.list_students') }}</h3>
                                <label>{{ count($students) }} {{ Lang::get($path.'.student') }}</label>
                              </div>
                              <div class="col-md-4 center">
                                
{{ Form::open(['route'=>'admin_users_data', 'method'=>'GET', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

              <div class="col-md-10" style="padding: 3px;">
                <div class="form-group">
                  @if(Input::has('q'))
                    {{ Form::text('q', Input::get('q'), ['class'=>'form-control']) }}
                  @else
                    {{ Form::text('q', '', [ 'placeholder'=>Lang::get($path.'.name_or_numbr'), 'class'=>'form-control']) }}
                  @endif
                </div>
              </div>

              <div class="col-md-2" style="padding: 3px;">
                <div class="form-group">
                  <button type="submit" class="btn btn-info btn-block"><i class="fa fa-search"></i></button>
                </div>
              </div>


{{ Form::close() }}

                              </div>

                              <div class="col-md-2 col-md-offset-2 center">
                                
{{ Form::open(['route'=>'users_data_export', 'files'=>'true' , 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
    <div class="form-group">
    <button type="submit" class="btn btn-default btn-block"><i class="fa fa-database"></i> {{ Lang::get($path.'.export_CSV') }}</button>
    </div>
  {{ Form::close() }}

                              </div>

                        </header>

                        <div class="clear"></div>
                     
                          <table class="table table-striped table-advance table-hover">
                           <tbody>
                              <tr>
                                 <th><i class="fa fa-user"></i> {{ Lang::get($path.'.fullname') }}</th>
                                 <th><i class="glyphicon glyphicon-blackboard"></i> {{ Lang::get($path.'.class') }}</th>
                                 <th><i class="fa fa-barcode"></i> {{ Lang::get($path.'.registration_num') }}</th>
                                 <th><i class="fa fa-book"></i> {{ Lang::get($path.'.parcour') }}</th>
                                 <th><i class="fa fa-book"></i> {{ Lang::get($path.'.mentions') }}</th>
                                 <th><i class="fa fa-info-circle"></i> {{ Lang::get($path.'.admission') }}</th>
                                 <th><i class="fa fa-calendar"></i> {{ Lang::get($path.'.birthday') }}</th>
                                 <th><i class="fa fa-envelope"></i> {{ Lang::get($path.'.email') }}</th>
                                 <th><i class="fa fa-trash"></i> {{ Lang::get($path.'.delete') }}</th>
                              </tr>
 
 @foreach($students as $student)

                              <tr>
                                 <td>{{ $student->fullname }}</td>
                                 <td>{{ $student->class }}</td>
                                 <td>{{ $student->registration_num }}</td>
                                 <td>{{ $student->parcour }}</td>
                                 <td>{{ $student->mention }}</td>
                                 <td>{{ $student->admission }}</td>
                                 <td>{{ $student->birthday }}</td>
                                 <td>{{ $student->email }}</td>
                                 <td>
                                  <div class="btn-group">
                                      <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" class="btn btn-danger" href="{{ URL::route('data_student_delete', $student->id) }}"><i class="fa fa-trash"></i></a>
                                  </div>
                                  </td>
                              </tr>
@endforeach                        
                                                  
                           </tbody>
                        </table>
                  </section>

 <div class="clear"></div>
    <div class="center">
        {{ $students->links() }}
    </div>


  </div>
</div>



@stop