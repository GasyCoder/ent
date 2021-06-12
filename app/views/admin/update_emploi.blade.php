@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.edit') }} @stop

@section('content')


{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}


{{ HTML::style('js/bootstrap-select/css/bootstrap-select.css') }}
{{ HTML::script('js/bootstrap-select/js/bootstrap-select.js') }}

<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('emploi_du_temps') }}">{{ Lang::get($path.'.emploi_du_temps') }}</a></li>
    <li class="active">{{ Lang::get($path.'.edit') }}</li>
  </ol>

  <div class="clear"></div><hr>



{{ Form::open(['route'=>['update_emploi', $emploi->id], 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

    
      <div class="col-md-12">  

<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});

  $('.datepicker2').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});
</script>


        <div class="col-md-6">
             <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.date_start') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('date_start', $emploi->date_start, ['placeholder'=>'', 'class'=>'form-control input-lg datepicker', 'data-provide'=>'datepicker', 'data-date-format'=>'yyyy-mm-dd']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>
      </div>

      <div class="col-md-6">
             <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.date_end') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('date_end', $emploi->date_end, ['placeholder'=>'', 'class'=>'form-control input-lg datepicker2', 'data-provide'=>'datepicker', 'data-date-format'=>'yyyy-mm-dd']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>
      </div>

        <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.class') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                  <select name="class_id" class="form-control input-lg">

@if(!empty($emploi->class_id))
<option value="{{$emploi->class_id}}" selected="selected" style="color: red;">{{$emploi->Tclass->name}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif


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
        </div>




        <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.day') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <select name="days" class="form-control input-lg">


@if(!empty($emploi->the_day))
<option value="{{$emploi->the_day}}" selected="selected" style="color: red;">{{$emploi->Tday->name}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif

                    <?php $days = DB::table('days_fste')->get(); ?>

@if($path == 'ar')
                    @foreach ($days as $day)
                      <option value="{{ $day->id }}">{{ $day->name_ar }}</option>
                    @endforeach
@elseif($path == 'en')
                    @foreach ($days as $day)
                      <option value="{{ $day->id }}">{{ $day->name_en }}</option>
                    @endforeach
@else
                    @foreach ($days as $day)
                      <option value="{{ $day->id }}">{{ $day->name }}</option>
                    @endforeach
@endif
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('days'))
                  <span class="help-block red-color">{{ $errors->first('days') }}</span>
                  @endif
              </div>
        </div>



        <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.teacher') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <select name="teacher" class="form-control input-lg">

@if(!empty($emploi->teacher_id))
<option value="{{$emploi->teacher_id}}" selected="selected" style="color: red;">{{$emploi->Teacher->fullname}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif
                    @foreach($teachers as $teacher)
                      <option value="{{ $teacher->id }}"><b>{{ $teacher->grade }}.</b> {{ $teacher->fullname }}</option>
                    @endforeach
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('teacher'))
                  <span class="help-block red-color">{{ $errors->first('teacher') }}</span>
                  @endif
              </div>
        </div>


        <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.subject') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                  <select name="subject_id" class="form-control input-lg">

@if(!empty($emploi->subject_id))
<option value="{{$emploi->subject_id}}" selected="selected" style="color: red;">{{$emploi->Tsubject->name}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif

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
        </div>


        <div class="col-md-6">
          <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.parcour') }}  : </label>
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
        </div>


        <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.salle') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                  <select name="salle" class="form-control input-lg">

@if(!empty($emploi->salle))
<option value="{{$emploi->salle}}" selected="selected" style="color: red;">{{$emploi->salle}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif

                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('salle'))
                  <span class="help-block red-color">{{ $errors->first('salle') }}</span>
                  @endif
              </div>
        </div>


        <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.hour_start') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <select name="hour_start" class="form-control input-lg">
 
@if(!empty($emploi->the_hour))
<option value="{{$emploi->the_hour}}" selected="selected" style="color: red;">{{$emploi->Thour->hour}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif

                    <?php $hours = DB::table('emploi_hours_fste')->get(); ?>
                    @foreach ($hours as $hour)
                      <option value="{{ $hour->id }}">{{ $hour->hour }}</option>
                    @endforeach

                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('hour'))
                  <span class="help-block red-color">{{ $errors->first('hour') }}</span>
                  @endif
              </div>
        </div>

        <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.hour_end') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <select name="hour_end" class="form-control input-lg">

@if(!empty($emploi->end_hour))
<option value="{{$emploi->end_hour}}" selected="selected" style="color: red;">{{$emploi->TEndhour->hour}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif                  
                    <?php $hours = DB::table('emploi_hours_fste')->get(); ?>
                    @foreach ($hours as $hour)
                      <option value="{{ $hour->id }}">{{ $hour->hour }}</option>
                    @endforeach

                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('hour'))
                  <span class="help-block red-color">{{ $errors->first('hour') }}</span>
                  @endif
              </div>
        </div>


            <div class="clear"></div><br>

            <div class="col-md-12">
              <div id="resultajax" class="center"></div>
            </div>

            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.edit'), ['class'=>'btn btn-info btn-block input-lg']) }} 
            </div>


            <div class="clear"></div><br>

      </div>
 

  {{ Form::close() }}
  



<script type="text/javascript">
      

        $('#myForm').submit(function(event) {

          event.preventDefault();

          $('#resultajax').append('<img src="{{ url() }}/images/loader.gif" alt="{{Lang::get($path.'.please_wait')}}" />');

          $('#myForm input.btn').hide();

          
           $.ajax({
            type: 'POST',
            url: '{{ route("update_emploi", $emploi->id) }}',
            data: $(this).serialize(),

            success: function(data) {
                              
                if(data == 'true') {   
                  $('#resultajax').html("<br><div class='alert alert-success center'><strong>{{ Lang::get($path.'.add_successfully') }}</strong></div>");
                  $('#myForm input.btn').show();
                 }

                if(data == 'false') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.required_filed') }}</strong></div>");
                  $('#myForm input.btn').show();
                }

                if(data == 'occupee_salle') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.Salle_Occupee') }}</strong></div>");
                  $('#myForm input.btn').show();
                }

                if(data == 'occupee_teacher') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.Prof_Occupee') }}</strong></div>");
                  $('#myForm input.btn').show();
                }

                if(data == 'occupee_classe') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.Classe_Occupee') }}</strong></div>");
                  $('#myForm input.btn').show();
                }


                if(data == 'occupee_teacher_in_this_hour') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.teacher2') }}</strong></div>");
                  $('#myForm input.btn').show();
                }



              if(data == 'occupee_salle_in_this_hour') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.salle2') }}</strong></div>");
                  $('#myForm input.btn').show();
                }

              if(data == 'occupee_classe_in_this_hour') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.classe2') }}</strong></div>");
                  $('#myForm input.btn').show();
                }


                if(data == 'false2') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.hour_start_em') .  ' doit superieur '  . Lang::get($path.'.hour_end_em') }}</strong></div>");
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
</div>



@stop