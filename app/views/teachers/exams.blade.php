@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.exams') }} @stop

@section('content')


{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}


<div class="panel panel-default panel-main">
  <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.exams') }}</li>
  </ol>




<a data-toggle="modal" data-target="#new_absence"  href="#" class="btn btn-warning btn-lg"><i class="fa fa-clipboard"></i> {{ Lang::get($path.'.new_exam_time') }}</a>





<div class="modal fade" id="new_absence">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get($path.'.new_exam_time') }}</h4>
      </div>
      <div class="modal-body">
        

{{ Form::open(['route'=>'teacher_store_exam', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>

      <div class="col-md-12">  


<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-3d'
});
</script>


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.class') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                <select name="class_id" class="form-control input-lg" required>
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                  @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                  @endforeach
                </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('class_id'))
                  <span class="help-block red-color">{{ $errors->first('class_id') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.subject') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                <select name="subject_id" class="form-control input-lg" required>
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    @foreach($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('subject_id'))
                  <span class="help-block red-color">{{ $errors->first('subject_id') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.date') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('exam_date', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required', 'data-provide'=>'datepicker']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('exam_date'))
                  <span class="help-block red-color">{{ $errors->first('exam_date') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.time') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                {{ Form::text('exam_time', '', ['placeholder'=>'00:00', 'class'=>'form-control input-lg']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('exam_time'))
                  <span class="help-block red-color">{{ $errors->first('exam_time') }}</span>
                  @endif
              </div>



      </div>

 

            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit( Lang::get($path.'.add') , ['class'=>'btn btn-info btn-block input-lg']) }} 
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
            url: '{{ route("teacher_store_exam") }}',
            data: $(this).serialize(),

            success: function(data) {
                              
                if(data == 'true') {   
                  $('#resultajax').html("<br><div class='alert alert-success center'><strong>{{ Lang::get($path.'.add_successfully') }}</strong></div>");
                  $('#myForm input.btn').show();
                 }

                if(data == 'false') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.error_please_try_again') }}</strong></div>");
                  $('#myForm input.btn').show();
                }
                                     
              }

            });
                          
          });

          function refresh() {
            // to current URL
            window.location='{{ URL::current() }}';
          }

</script>




      </div>
      <div class="modal-footer">
        <button type="button" onclick="refresh();" class="btn btn-default" data-dismiss="modal">{{ Lang::get($path.'.close') }}</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


  

@if (count($exams) >= 1)

<div class="clear"></div><hr>




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

<div class="clear"></div>


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.class') }}</th>        
            <th>{{ Lang::get($path.'.subject') }}</th>
            <th>{{ Lang::get($path.'.date') }}</th>
            <th>{{ Lang::get($path.'.time') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>


@foreach($exams as $exam)

          <tr class="tr-body">

            <td>{{ $exam->exClass->name }}</td>
            <td>{{ $exam->exSubject->name }}</td>
            <td>{{ $exam->exam_date }}</td>
            <td>{{ $exam->exam_time }}</td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('exam_delete', $exam->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $exams->links() }}
    </div>

@endif

  </div>
</div>



@stop