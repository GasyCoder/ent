@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.subjects') }} @stop

@section('content')
{{ HTML::style('js/bootstrap-select/css/bootstrap-select.css') }}
{{ HTML::script('js/bootstrap-select/js/bootstrap-select.js') }}


<div class="panel panel-default panel-main">
   <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.subjects') }}</li>
  </ol>
  
<a data-toggle="modal" data-target="#new_class"  href="#" class="btn btn-warning btn-lg"><i class="fa fa-book"></i> {{ Lang::get($path.'.new_subject') }}</a>



<div class="modal fade" id="new_class">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get($path.'.new_subject') }}</h4>
      </div>
      <div class="modal-body">
        

{{ Form::open(['route'=>'store_subject', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>

      <div class="col-md-12">  
      
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.name') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                {{ Form::text('name', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('name'))
                  <span class="help-block red-color">{{ $errors->first('name') }}</span>
                  @endif
              </div>

             
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.VH') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                {{ Form::number('times', '', ['placeholder'=>'en heur', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('times'))
                  <span class="help-block red-color">{{ $errors->first('times') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.class') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                  <select name="class_id" class="form-control input-lg">
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
                <label for="done" class="control-label">{{ Lang::get($path.'.parcour') }}  : </label>
                <div class="form-group">
                  <select name="parcours[]" id="done" class="form-control input-lg selectpicker" multiple data-done-button="true">
                   <option value="">{{ Lang::get($path.'.select') }}</option>
                    <optgroup label="LICENCES">
                    <option value="SVE">SVE</option>
                    <option value="STE">STE</option>
                    <option value="BSE">BSE</option>
                    <option value="Physique">Physique</option>
                    <option value="Chimie">Chimie</option>
                    </optgroup>
                    <optgroup label="MASTERS">
                    <option value="PANA">PANA</option>
                    <option value="ECOPRIM">ECOPRIM</option>
                    <option value="ZOO">ZOO</option>
                    <option value="BC">BC</option>
                    <option value="VBS">VBS</option>
                    <option value="GM">GM</option>
                    <option value="PM">PM</option>  
                    <option value="STEM">STEM</option>
                    <option value="STTD">STTD</option>
                    <option value="BMBA">BMBA</option>
                    <option value="EBHS">EBHS</option>
                    <option value="DyACO">DyACO</option>
                    <option value="ATSI">ATSI</option>
                    <option value="Physique">Physique</option>
                    <option value="Chimie">Chimie</option>
                    </optgroup>
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('parcour'))
                  <span class="help-block red-color">{{ $errors->first('parcour') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.teacher') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <select name="teacher_id" class="form-control input-lg">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    @foreach($teachers as $teacher)
                      <option value="{{ $teacher->id }}">{{ $teacher->fullname }}</option>
                    @endforeach
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('teacher_id'))
                  <span class="help-block red-color">{{ $errors->first('teacher_id') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.note') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                {{ Form::textarea('note', '', ['rows'=>'5', 'class'=>'form-control']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('note'))
                  <span class="help-block red-color">{{ $errors->first('note') }}</span>
                  @endif
              </div>

      </div>

 

            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit( Lang::get($path.'.new_subject') , ['class'=>'btn btn-info btn-block input-lg']) }} 
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
            url: '{{ route("store_subject") }}',
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



@if (count($subjects) >= 1)

<div class="clear"></div><hr>


<?php 
if (isset($_GET['id'])) { 
$id = htmlspecialchars($_GET['id']);

$getsubject = Subject::find($id);

if ($getsubject !== null) {


?>




{{ Form::open(['route'=>['subject_update',$getsubject->id], 'class'=>'col-md-12', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
          <div id="resultajax2" class="center"></div>
      </div>

        
    <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.name') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                {{ Form::text('name', $getsubject->name, ['placeholder'=>'', 'class'=>'form-control', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('name'))
                  <span class="help-block red-color">{{ $errors->first('name') }}</span>
                  @endif
              </div>

               <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.VH') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                {{ Form::number('times', $getsubject->times, ['placeholder'=>'en heur', 'class'=>'form-control', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('times'))
                  <span class="help-block red-color">{{ $errors->first('times') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.class') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                    
                    <?php $check_class = TheClass::find($getsubject->class_id);
                          $classes_array= TheClass::lists('name', 'id');  ?>

                      @if($check_class !== null)
                        {{ Form::select('class_id', array($check_class->id => $check_class->name) + $classes_array + [' ' => '-- null --'], '', ['class'=>'form-control']) }}
                      @else
                        {{ Form::select('class_id', array('' => 'all classes') + $classes_array, '', ['class'=>'form-control']) }}
                      @endif

                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('class_id'))
                  <span class="help-block red-color">{{ $errors->first('class_id') }}</span>
                @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.teacher') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    
                    <?php $check_teacher = User::find($getsubject->teacher_id);
                          $teachers_array= User::where('is_teacher', true)->lists('fullname', 'id');  ?>

                      @if($check_teacher !== null)
                        {{ Form::select('teacher_id', array($check_teacher->id => $check_teacher->fullname) + $teachers_array + [' ' => '-- null --'], '', ['class'=>'form-control']) }}
                      @else
                        {{ Form::select('teacher_id', array('' => 'all teachers') + $teachers_array, '', ['class'=>'form-control']) }}
                      @endif


                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('teacher_id'))
                  <span class="help-block red-color">{{ $errors->first('teacher_id') }}</span>
                @endif
              </div>

                <div class="form-group">
                <label for="done" class="control-label">{{ Lang::get($path.'.parcour') }}  : </label>
                <div class="form-group">
                  <select name="parcours[]" id="done" class="form-control input-lg selectpicker" multiple data-done-button="true">
                  @if(!empty($getsubject->parcours))
<option value="{{ $getsubject->parcours }}" selected="selected">{{ $getsubject->parcours }}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif
                    <optgroup label="LICENCES">
                    <option value="SVE">SVE</option>
                    <option value="STE">STE</option>
                    <option value="BSE">BSE</option>
                    <option value="Physique">Physique</option>
                    <option value="Chimie">Chimie</option>
                    </optgroup>
                    <optgroup label="MASTERS">
                    <option value="PANA">PANA</option>
                    <option value="ECOPRIM">ECOPRIM</option>
                    <option value="ZOO">ZOO</option>
                    <option value="BC">BC</option>
                    <option value="VBS">VBS</option>
                    <option value="GM">GM</option>
                    <option value="PM">PM</option>
                    <option value="STEM">STEM</option>
                    <option value="STTD">STTD</option>
                    <option value="BMBA">BMBA</option>
                    <option value="EBHS">EBHS</option>
                    <option value="DyACO">DyACO</option>
                    <option value="ATSI">ATSI</option>
                    <option value="Physique">Physique</option>
                    <option value="Chimie">Chimie</option>
                    </optgroup>
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('parcour'))
                  <span class="help-block red-color">{{ $errors->first('parcour') }}</span>
                  @endif
              </div>

    </div>
    <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.note') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                {{ Form::textarea('note', $getsubject->note, ['rows'=>'7', 'class'=>'form-control']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('note'))
                  <span class="help-block red-color">{{ $errors->first('note') }}</span>
                  @endif
              </div>

      </div>

 
            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.update') , ['class'=>'btn btn-success btn-block input-lg']) }} 
            </div>


              {{ Form::close() }}

     
        <div class="clear"></div><br><br>

<script type="text/javascript">
      
      function refresh() {
        // to current URL
        window.location='{{ URL::current() }}';
      }

        $('#myForm2').submit(function(event) {

          event.preventDefault();

          $('#resultajax2').append('<img src="{{ url() }}/images/loader.gif" alt="{{Lang::get($path.'.please_wait')}}" />');

          $('#myForm2 input.btn').hide();

          
           $.ajax({
            type: 'POST',
            url: '{{ route("subject_update",$getsubject->id) }}',
            data: $(this).serialize(),

            success: function(data) {
                              
                if(data == 'true') {   
                  $('#resultajax2').html("<br><div class='alert alert-success center'><strong>{{ Lang::get($path.'.was_update') }}</strong></div>");
                  $('#myForm2 input.btn').show();
                  setInterval(refresh, 2000);
                 }

                if(data == 'false') {
                  $('#resultajax2').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.error_please_try_again') }}</strong></div>");
                  $('#myForm2 input.btn').show();
                }
                                     
              }

            });
                          
          });


</script>


<?php } } ?>


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
            <th>{{ Lang::get($path.'.teacher') }}</th>    
            <th>{{ Lang::get($path.'.parcour') }}</th>       
            <th>{{ Lang::get($path.'.note') }}</th>         
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>



@foreach($subjects as $subject)

          <tr class="tr-body">

           <td><span class="badge green-bg">{{ $subject->name }}</span> - <span class="badge red-bg">{{ $subject->times }}</span></td>

            <td>
            @if(!empty($subject->class_id))
            {{ $subject->theclass->name }}
            @else
            -
            @endif 
            </td>

            

            <td>
            @if(!empty($subject->teacher_id))

              <?php $check_teacher2 = User::find($subject->teacher_id); ?>
              @if($check_teacher2 !== null)
                <a href="{{ URL::route('profile_teacher', $subject->teacher->id) }}"><span class="badge green-bg">{{ $subject->teacher->fullname }}</span></a>
              @else - @endif

            @else
            -
            @endif
            </td>
            <td><span class="badge default-bg">{{ $subject->parcours }}</span></td>
            <td>{{ $subject->note }}</td>

            <td><a href="{{ URL::current() . '?id=' . $subject->id }}"><i class="fa fa-edit large"></i></a></td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('subject_delete', $subject->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $subjects->links() }}
    </div>

@endif

  </div>
</div>



@stop