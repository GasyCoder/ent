@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.DATA') }} @stop

@section('content')

{{ HTML::style('css/theme.css') }}

{{ HTML::script('js/jquery-1.9.1.min.js') }}
{{ HTML::script('js/flot/jquery.flot.resize.js') }}
{{ HTML::script('js/datatables/jquery.dataTables.js') }}
{{ HTML::script('js/common.js') }}

<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.DATA') }}</li>
  </ol>


<div class="clear"></div><hr>

<div class="col-md-6 col-md-offset-3">
<div class="panel panel-success" style="padding: 20px;">
    {{ Form::open(['route'=>'users_data_s_store', 'files'=>'true', 'class'=>'', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
    <div class="form-group">
      <label class="control-label">{{ Lang::get($path.'.CSV_file') }}  : </label>
        {{ Form::file('csv_file', ['class'=>'btn btn-default', 'id'=>'file']) }}
      @if($errors->first('csv_file'))
        <span class="help-block red-color">{{ $errors->first('csv_file') }}</span>
      @endif
    </div>
    <div class="form-group">
    {{ Form::submit(Lang::get($path.'.import_CSV'), ['class'=>'btn btn-warning']) }}
    </div>
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

  <strong><a href="{{ url() }}/uploads/data_s/{{ Session::get('download') }}">{{ Lang::get($path.'.download') }}</a></strong>
</div>
@endif


 <div class="clear"></div><hr>

          <section class="panel">

                        <header class="panel-heading">
                              <div class="col-md-4">
                                <h3>{{ Lang::get($path.'.list_data') }}</h3>
                                <label><span class="label label-success">{{ count($teachers) }}</span>  {{ Lang::get($path.'.students') }}</label>
                              </div>
                              <div class="col-md-4 center">
                                
{{ Form::open(['route'=>'admin_data', 'method'=>'GET', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

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
                                
{{ Form::open(['route'=>'users_data_s_export', 'files'=>'true' , 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
    <div class="form-group">
    <button type="submit" class="btn btn-default btn-block"><i class="fa fa-database"></i> {{ Lang::get($path.'.export_CSV') }}</button>
    </div>
  {{ Form::close() }}

                              </div>

                        </header>

                        <div class="clear"></div>
                          <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                          <!-- DATA TABLE -->  
                      <div class="span9">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <h3>
                                        DataTables</h3>
                                </div>
                      <div class="module-body table">
                      <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display table table-striped table-advance table-hover" width="100%">       
                                        <thead>
                           <tr class="tr">
                                 <th><i class="fa fa-user"></i> {{ Lang::get($path.'.EC') }}</th>
                                 <th><i class="glyphicon glyphicon-blackboard"></i> {{ Lang::get($path.'.Credit EC') }}</th>
                                 <th><i class="fa fa-barcode"></i> {{ Lang::get($path.'.Code EC') }}</th>
                                 <th><i class="fa fa-book"></i> {{ Lang::get($path.'.UE') }}</th>
                                 <th><i class="fa fa-book"></i> {{ Lang::get($path.'.Credit_T') }}</th>
                                 <th><i class="fa fa-info-circle"></i> {{ Lang::get($path.'. matricule') }}</th>
                                  <th><i class="fa fa-info-circle"></i> {{ Lang::get($path.'. semestre') }}</th>
                                  <th><i class="fa fa-info-circle"></i> {{ Lang::get($path.'. delete') }}</th>
                            </tr>
                            </thead>

                        <tbody>
                        <tr class="odd gradeX">
                            @foreach($teachers as $teacher)
                                 <td>{{ $teacher->element_c }}</td>
                                 <td>{{ $teacher->credit_ec }}</td>
                                 <td>{{ $teacher->code_ec }}</td>
                                 <td>{{ $teacher->unite_e}}</td>
                                 <td>{{ $teacher->credit_t }}</td>
                                 <td>{{ $teacher->matricule_t }}</td>
                                 <td>{{ $teacher->semestre }}</td>
                                 <td class="center">
                                  <div class="btn-group center">
                                     <a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" class="label label-danger" href="{{ URL::route('data_teacher_s_delete', $teacher->id) }}"><i class="fa fa-trash"></i></a>
                                  </div>
                                  </td>
                              </tr>
                            @endforeach       
                            </tbody>
                                    </table>
                                </div>
                            </div>
                             </div>
                            </div>
                            </div>

                              </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                            <!--/.module-->   

                  </section>

 <div class="clear"></div>
    <div class="center">
        {{ $teachers->links() }}
    </div>


  </div>
</div>



@stop