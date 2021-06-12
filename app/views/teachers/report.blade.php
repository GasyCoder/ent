@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.report') }} - {{ $user->fullname }} @stop

@section('content')


<div class="panel panel-default panel-main">
  <br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('teacher_students') }}">{{ Lang::get($path.'.students') }}</a></li>
    <li class="active">{{ Lang::get($path.'.report') }} [ {{ $user->fullname }} ]</li>
  </ol>



{{ Form::open(['route'=>['teacher_report_store', $user->id], 'class'=>'col-md-8 col-md-offset-2', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

              <div class="form-group">
                  <div id="resultajax" class="center"></div>
              </div>

              <input type="hidden" name="copy_to_parent" value="0">


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.report') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-warning"></i></span>
                {{ Form::textarea('report', '', ['rows'=>'5', 'class'=>'form-control']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('report'))
                  <span class="help-block red-color">{{ $errors->first('report') }}</span>
                  @endif
              </div>

      
            <div class="form-group">
              {{ Form::submit(Lang::get($path.'.send'), ['class'=>'btn btn-info btn-block input-lg']) }} 
            </div>


              {{ Form::close() }}

     
        <div class="clear"></div><br>

<script type="text/javascript">
      

        $('#myForm').submit(function(event) {

          event.preventDefault();

          $('#resultajax').append('<img src="{{ url() }}/images/loader.gif" alt="{{Lang::get($path.'.please_wait')}}" />');

          $('#myForm input.btn').hide();

          
           $.ajax({
            type: 'POST',
            url: '{{ route("teacher_report_store", $user->id) }}',
            data: $(this).serialize(),

            success: function(data) {
                              
                if(data == 'true') {   
                  $('#resultajax').html("<br><div class='alert alert-success center'><strong>{{ Lang::get($path.'.report_send_successfully') }}</strong></div>");
                  $('#myForm input.btn').show();
                  $('.empty').empty();
                 }

                if(data == 'false') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.error_please_try_again') }}</strong></div>");
                  $('#myForm input.btn').show();
                }
                                     
              }

            });
                          
          });


</script>






  </div>
</div>



@stop