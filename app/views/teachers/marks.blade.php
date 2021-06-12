@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.marks') }} @stop

@section('content')

<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.marks') }}</li>
  </ol>



<a data-toggle="modal" data-target="#new_absence"  href="#" class="btn btn-warning btn-lg"><i class="fa fa-clipboard"></i> {{ Lang::get($path.'.new_mark') }}</a>


<div class="modal fade" id="new_absence">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get($path.'.new_mark') }}</h4>
      </div>
      <div class="modal-body">
        

{{ Form::open(['route'=>'teacher_store_mark', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>

      <div class="col-md-12">  



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
              </div>


            <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.class') }}  : </label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                    <select name="class_id" id="class" class="form-control  input-lg" required>
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                        @foreach($classes as $class)
                          <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach

                    </select>
                  </div>
              </div>

              <div class="form-group student">
                  <label class="control-label">{{ Lang::get($path.'.student') }} : </label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                  <select name="student_id" id="student" class="form-control input-lg" required>
                      <option value="">{{ Lang::get($path.'.select') }}</option>
                  </select>
                  </div>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
              </div>


<script type="text/javascript">
$(document).ready(function () { 

            $('#class').on('change',function(e){
            var class_id = e.target.value;

            $(".student").css ({"display":"block"});

            $.ajax({
            type: "GET",
            url: "{{ url() }}/ajax-class?class_id="+class_id,
                success: function(data) {  

                    var subcat =  $('#student').empty();

                    subcat.append('<option value ="">{{ Lang::get($path.'.select') }}</option>');

                    $.each(data,function(create,subcatObj){
                    var option = $('<option/>', {id:create, value:subcatObj});
                    subcat.append('<option value ="'+subcatObj+'">'+create+'</option>');
                    });

                }
            });


        });
});
</script>



              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.mark') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                {{ Form::text('mark', '', ['placeholder'=>'', 'class'=>'form-control input-lg mark', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.note') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-sticky-note-o"></i></span>
                {{ Form::text('note', '', ['class'=>'form-control input-lg']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

      </div>


            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.add') , ['class'=>'btn btn-info btn-block input-lg']) }} 
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
            url: '{{ route("teacher_store_mark") }}',
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






@if (count($marks) >= 1)

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
            <th>{{ Lang::get($path.'.subject') }}</th>
            <th>{{ Lang::get($path.'.class') }}</th>     
            <th>{{ Lang::get($path.'.student') }}</th>
            <th>{{ Lang::get($path.'.mark') }}</th>
            <th>{{ Lang::get($path.'.note') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>


@foreach($marks as $mark)

          <tr class="tr-body">

            <td>{{ $mark->maSubject->name }}</td>
            <td>{{ $mark->maClass->name }}</td>

            <td><a href="{{ URL::route('teacher_p_student', $mark->maStudent->id) }}"><span class="badge green-bg size-1">{{ $mark->maStudent->fullname }}</span></a></td>

            <td><span class="badge size-2">{{ $mark->mark }}</span></td>
            <td>{{ $mark->note }}</td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('mark_delete', $mark->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $marks->links() }}
    </div>

@endif






  

  </div>
</div>



@stop