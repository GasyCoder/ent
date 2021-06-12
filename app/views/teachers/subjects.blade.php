@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.classes') }} / {{ Lang::get($path.'.subject') }} @stop

@section('content')

{{ HTML::style('js/bootstrap-select/css/bootstrap-select.css') }} 
{{ HTML::script('js/bootstrap-select/js/bootstrap-select.js') }}

<script type="text/javascript">$(function () {
  $('[data-toggle="popover"]').popover()
})</script>


<br><br><br><br>
<div class="panel panel-default panel-main">
<div class="panel-body">
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.classes') }} / {{ Lang::get($path.'.subject') }}</li>
    <li>
     <span href="" style="color: #fff" class="label label-default pull-center" data-toggle="popover" title="Guide sur cette page" data-content="Cliquez le bouton Nouvel matière et puis remplisez les information!">Aide <i class="fa fa-question"></i></span></li>
  </ol>


<a data-toggle="modal" data-target="#new_class"  href="#" class="btn btn-success btn"><i class="fa fa-plus"></i> {{ Lang::get($path.'.add_your_subject') }}</a>

<div class="modal fade" id="new_class">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get($path.'.new_subject') }}</h4>
      </div>

      <div class="modal-body">
        

{{ Form::open(['route'=>'teacher_store_subject', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>
      <div class="col-md-12">  

            <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.semestres') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                  <select name="semestre" class="form-control input">
                    <option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                    <option value="S4">S4</option>
                    <option value="S5">S5</option>
                    <option value="S6">S6</option>
                    <option value="S7">S7</option>
                    <option value="S8">S8</option>
                    <option value="S9">S9</option>
                    <option value="S10">S10</option>
                  </select>
                </div>
              </div>

         
              <div class="form-group element_c">
                <label class="control-label">{{ Lang::get($path.'.name_of_subject') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
                  
                  <select name="name" class="form-control input">
                    <option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
                    
                    <?php $data_users = DB::table('data_users_fste')->get(); ?>
                    @foreach ($data_users as $data)
                      <option value="{{ $data->element_c }}">{{ $data->element_c}}</option>
                    @endforeach
                  </select>

                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('element_c '))
                  <span class="help-block red-color">{{ $errors->first('element_c ') }}</span>
                  @endif
              </div>



              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.VH') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                {{ Form::number('times', '', ['placeholder'=>'en heur', 'class'=>'form-control input', 'required' => 'required']) }} 
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
                  <select name="class_id" class="form-control input">
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
                  <select name="parcours[]" id="done" class="form-control input selectpicker" multiple data-done-button="true">
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
              {{ Form::submit( Lang::get($path.'.add') , ['class'=>'btn btn-info btn-block input']) }} 
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
            url: '{{ route("teacher_store_subject") }}',
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

  if ($getsubject->teacher_id == Auth::user()->id) {


?>




{{ Form::open(['route'=>['teacher_subject_update',$getsubject->id], 'class'=>'col-md-12', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
          <div id="resultajax2" class="center"></div>
      </div>


        
    <div class="col-md-6">

          <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.semestres') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                  <select name="semestre" class="form-control input">
                              @if(!empty($getsubject->semestre))
<option value="{{ $getsubject->semestre}}" selected="selected">{{ $getsubject->semestre}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                    <option value="S4">S4</option>
                    <option value="S5">S5</option>
                    <option value="S6">S6</option>
                    <option value="S7">S7</option>
                    <option value="S8">S8</option>
                    <option value="S9">S9</option>
                    <option value="S10">S10</option>
                  </select>
                </div>
              </div>

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
                <label for="done" class="control-label">{{ Lang::get($path.'.parcour') }}  : </label>
                <div class="form-group">
                  <select name="parcours[]" id="done" class="form-control input selectpicker" multiple data-done-button="true">
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
              {{ Form::submit(Lang::get($path.'.update') , ['class'=>'btn btn-success btn-block input']) }} 
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
            url: '{{ route("teacher_subject_update",$getsubject->id) }}',
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


<?php } } else {  } } ?>


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



    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.subject') }}</th> 
            <th>{{ Lang::get($path.'.semestre') }}</th>                     
            <th>{{ Lang::get($path.'.class') }}</th> 
            <th>{{ Lang::get($path.'.parcour') }}</th> 
            <th>{{ Lang::get($path.'.note') }}</th>    
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>    
          </tr>
        </thead>
        <tbody>


@foreach($subjects as $subject)

          <tr class="tr-body">

            <td><span class="badge green-bg">{{ $subject->name }}</span> - <span class="badge red-bg">vh-{{ $subject->times }}h</span></td>
            <td>{{ $subject->semestre}}</td>
            <td><b>
            @if(!empty($subject->class_id))
            {{ $subject->theclass->name }}
            @else
            -
            @endif</b>
            </td>
            <td><span class="badge default-bg">{{ $subject->parcours }}</span></td>
            <td>{{ $subject->note }}</td>

             <td><a href="{{ URL::current() . '?id=' . $subject->id }}"><i class="fa fa-edit large"></i></a></td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('teacher_subject_delete', $subject->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

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