@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.send_message_to') }} {{ $user->fullname }} @stop

@section('content')


  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    @if($auth_user->is_admin)
      <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @endif
    @if($auth_user->is_student)
      <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @endif
    @if($auth_user->is_teacher)
      <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @endif
    @if($auth_user->is_parent)
      <li><a href="{{ URL::route('parent_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @endif
    <li class="active">{{ Lang::get($path.'.send_message_to') }} {{ $user->fullname }}</li>
  </ol>
  <div class="clear"></div><hr>



<div class="col-md-12">
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
</div>

<div class="clear"></div><br>



@if($auth_user->is_admin)

  {{ Form::open(['route'=>['a_contact_store', $user->id ], 'files'=>'true', 'id'=>'myForm', 'class'=>'col-md-10 col-md-offset-1'])  }}

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>

      <div class="col-md-12">  
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.message_subject') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                {{ Form::text('subject', '', ['placeholder'=>'', 'class'=>'form-control input-lg empty', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.message') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-sticky-note-o"></i></span>
                {{ Form::textarea('message', '', ['class'=>'form-control empty', 'rows'=>'7']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.Attached_File') }} : </label>
                  {{ Form::file('file[]', ['class'=>'btn btn-default', 'id'=>'file', 'multiple'=>'multiple']) }}

                    @if($errors->first('file'))
                      <span class="help-block red-color">{{ $errors->first('file') }}</span>
                    @endif

                    <span class="help-block">{{ Lang::get($path.'.Permitted_files') }} : doc, docx, ppt, pptx, pdf, rar, zip</span>

              </div>

      </div>


            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.send'), ['class'=>'btn btn-info btn-block input-lg']) }} 
            </div>


              {{ Form::close() }}

     
        <div class="clear"></div><br>


@endif







@if($auth_user->is_student)

  {{ Form::open(['route'=>['s_contact_store', $user->id ], 'files'=>'true', 'id'=>'myForm', 'class'=>'col-md-10 col-md-offset-1'])  }}

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>

      <div class="col-md-12">  
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.message_subject') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                {{ Form::text('subject', '', ['placeholder'=>'', 'class'=>'form-control input-lg empty', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.message') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-sticky-note-o"></i></span>
                {{ Form::textarea('message', '', ['class'=>'form-control empty', 'rows'=>'7']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

             
              <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.Attached_File') }} : </label>
                   {{ Form::file('file[]', ['class'=>'btn btn-default', 'id'=>'file', 'multiple'=>'multiple']) }}

                    @if($errors->first('file'))
                      <span class="help-block red-color">{{ $errors->first('file') }}</span>
                    @endif

                    <span class="help-block">{{ Lang::get($path.'.Permitted_files') }} : doc, docx, ppt, pptx, pdf, rar, zip</span>

              </div>
            

      </div>


            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.send'), ['class'=>'btn btn-info btn-block input-lg']) }} 
            </div>


              {{ Form::close() }}

     
        <div class="clear"></div><br>

@endif






@if($auth_user->is_teacher)

  {{ Form::open(['route'=>['t_contact_store', $user->id ], 'files'=>'true', 'id'=>'myForm', 'class'=>'col-md-10 col-md-offset-1'])  }}

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>

      <div class="col-md-12">  
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.message_subject') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                {{ Form::text('subject', '', ['placeholder'=>'', 'class'=>'form-control input-lg empty', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.message') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-sticky-note-o"></i></span>
                {{ Form::textarea('message', '', ['class'=>'form-control empty', 'rows'=>'7']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.Attached_File') }} : </label>
                   {{ Form::file('file[]', ['class'=>'btn btn-default', 'id'=>'file', 'multiple'=>'multiple']) }}

                    @if($errors->first('file'))
                      <span class="help-block red-color">{{ $errors->first('file') }}</span>
                    @endif

                    <span class="help-block">{{ Lang::get($path.'.Permitted_files') }} : doc, docx, ppt, pptx, pdf, rar, zip</span>

              </div>

      </div>


            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.send'), ['class'=>'btn btn-info btn-block input-lg']) }} 
            </div>


              {{ Form::close() }}

     
        <div class="clear"></div><br>

@endif






  </div>
</div>



@stop