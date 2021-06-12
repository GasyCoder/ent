@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.pedagogiques') }} @stop


@section('content')

{{ HTML::style('js/bootstrap-select/css/bootstrap-select.css') }}
{{ HTML::script('js/bootstrap-select/js/bootstrap-select.js') }}

{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}

<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.pedagogiques') }}</li>
  </ol>



<a data-toggle="modal" data-target="#new_class"  href="#" class="btn btn-warning btn"><i class="fa fa-plus"></i> {{ Lang::get($path.'.new_pedagogique') }}</a>

&nbsp;&nbsp;&nbsp;<a href="{{ URL::route('teacher_pedagogique_archives') }}" class="btn btn-default btn"><i class="fa fa-archive"></i> {{ Lang::get($path.'.archive') }}</a>


<div class="modal fade bs-example-modal-lg" id="new_class">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get($path.'.new_pedagogique') }}</h4>
      </div>
      <div class="modal-body">
        

{{ Form::open(['route'=>'pedagogiques_store', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>

      <div class="col-md-12">  


     <!-- <div class="col-md-6">
        
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.time') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <select name="time" class="form-control input-lg">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    <option value="1h">1h</option>
                    <option value="2h">2h</option>
                    <option value="3h">3h</option>
                    <option value="4h">4h</option>
                    <option value="5h">5h</option>
                    <option value="6h">6h</option>
                    <option value="7h">7h</option>
                    <option value="8h">8h</option>
                    <option value="9h">9h</option>
                    <option value="10h">10h</option>
                  </select>
                </div>
              </div>
      </div>

<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});

  $('.datepicker2').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});
</script>-->

      <div class="col-md-6">
             <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.date_start') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('date_start', '', ['placeholder'=>'', 'class'=>'form-control input datepicker', 'data-provide'=>'datepicker', 'data-date-format'=>'yyyy/mm/dd']) }} 
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
                {{ Form::text('date_end', '', ['placeholder'=>'', 'class'=>'form-control input datepicker2', 'data-provide'=>'datepicker', 'data-date-format'=>'yyyy/mm/dd']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>
      </div>

  <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.hour_m') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <select name="hour_start" class="form-control input">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    <option value="7h00">7h00</option>
                    <option value="7h30">7h30</option>
                    <option value="8h00">8h00</option>
                    <option value="8h30">8h30</option>
                    <option value="9h00">9h00</option>
                    <option value="9h30">9h30</option>
                    <option value="10h00">10h00</option>
                    <option value="10h30">10h30</option>
                    <option value="11h00">11h00</option>
                    <option value="11h30">11h30</option>
                    <option value="12h00">12h00</option>
                    <option value="12h30">12h30</option>
                    <option value="13h00">13h00</option>
                    <option value="13h30">13h30</option>
                    <option value="14h00">14h00</option>
                    <option value="14h30">14h30</option>
                    <option value="15h00">15h00</option>
                    <option value="15h30">15h30</option>
                    <option value="16h00">16h00</option>
                    <option value="16h30">16h30</option>
                    <option value="17h00">17h00</option>
                    <option value="17h30">17h30</option>
                    <option value="18h00">18h00</option>
                    <option value="18h30">18h30</option>
                  </select>
                </div>
              </div>
      </div>

       <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.hour_s') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <select name="hour_end" class="form-control input">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                   <option value="7h00">7h00</option>
                    <option value="7h30">7h30</option>
                    <option value="8h00">8h00</option>
                    <option value="8h30">8h30</option>
                    <option value="9h00">9h00</option>
                    <option value="9h30">9h30</option>
                    <option value="10h00">10h00</option>
                    <option value="10h30">10h30</option>
                    <option value="11h00">11h00</option>
                    <option value="11h30">11h30</option>
                    <option value="12h00">12h00</option>
                    <option value="12h30">12h30</option>
                    <option value="13h00">13h00</option>
                    <option value="13h30">13h30</option>
                    <option value="14h00">14h00</option>
                    <option value="14h30">14h30</option>
                    <option value="15h00">15h00</option>
                    <option value="15h30">15h30</option>
                    <option value="16h00">16h00</option>
                    <option value="16h30">16h30</option>
                    <option value="17h00">17h00</option>
                    <option value="17h30">17h30</option>
                    <option value="18h00">18h00</option>
                    <option value="18h30">18h30</option>
                  </select>
                </div>
              </div>
      </div>

<div class="col-md-6">
        
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
   </div>


      <div class="col-md-6">

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
              </div>
      </div>



      <div class="col-md-6">

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.subject') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <select name="subject" class="form-control input">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    
                    <?php $subjects = Subject::where('teacher_id', Auth::user()->id)->get(); ?>

                    @foreach ($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach

                  </select>
                </div>
              </div>
      </div>

        <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.VH') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                {{ Form::number('time', '', ['placeholder'=>'en heur', 'class'=>'form-control input', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('time'))
                  <span class="help-block red-color">{{ $errors->first('time') }}</span>
                  @endif
              </div>

      <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.magistrale') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                  <select name="magistrale" class="form-control input">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    <option value="1">{{ Lang::get($path.'.yes') }}</option>
                    <option value="2">{{ Lang::get($path.'.no') }}</option>
                  </select>
                </div>
              </div>
      </div>

      <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.tp') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                  <select name="tp" class="form-control input">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    <option value="1">{{ Lang::get($path.'.yes') }}</option>
                    <option value="2">{{ Lang::get($path.'.no') }}</option>
                  </select>
                </div>
              </div>
      </div>
        <div class="col-md-12">
                <label class="control-label">{{ Lang::get($path.'.your_grade') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <select name="grade" class="form-control">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    <option value="Professeur">Professeur</option>
                    <option value="Mitre de conference">Maitre de conference</option>
                    <option value="Docteur">Docteur</option>
                    <option value="Monsieur">Monsieur</option>
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('grade'))
                  <span class="help-block red-color">{{ $errors->first('grade') }}</span>
                  @endif
              </div>
          <div class="col-md-12">
            
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

      </div>


            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit( Lang::get($path.'.new_pedagogique') , ['class'=>'btn btn-info btn-block input']) }} 
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
            url: '{{ route("pedagogiques_store") }}',
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





@if (count($pedagogiques) >= 1)

<div class="clear"></div><hr>



<?php 
if (isset($_GET['id'])) { 

$id = htmlspecialchars($_GET['id']);

$pedagogique = Pedagogique::find($id);

if ($pedagogique !== null) {

  if ($pedagogique->teacher_id == Auth::user()->id) {


?>


{{ Form::open(['route'=>['pedagogique_update',$pedagogique->id], 'class'=>'col-md-12', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
      <div id="resultajax2" class="center"></div>
      </div>
    <div class="col-md-12">  
<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-3d'
});

  $('.datepicker2').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-3d'
});
</script>      
      <div class="col-md-6">
             <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.date_start') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('date_start', $pedagogique->date_start, ['placeholder'=>'', 'class'=>'form-control input-lg datepicker', 'data-provide'=>'datepicker',  'style'=>'color:green;font-weight:bold',  'data-date-format'=>'yyyy/mm/dd']) }} 
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
                {{ Form::text('date_end', $pedagogique->date_end, ['placeholder'=>'', 'class'=>'form-control input-lg datepicker2', 'style'=>'color:green;font-weight:bold', 'data-provide'=>'datepicker', 'data-date-format'=>'yyyy/mm/dd']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>
      </div>

<div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.hour_m') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <select name="hour_start" class="form-control input-lg">
@if(!empty($pedagogique->hour_start))
<option value="{{$pedagogique->hour_start}}" selected="selected" style="color:green; font-weight:bold;">{{$pedagogique->hour_start}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif
                    <option value="7h00">7h00</option>
                    <option value="7h30">7h30</option>
                    <option value="8h00">8h00</option>
                    <option value="8h30">8h30</option>
                    <option value="9h00">9h00</option>
                    <option value="9h30">9h30</option>
                    <option value="10h00">10h00</option>
                    <option value="10h30">10h30</option>
                    <option value="11h00">11h00</option>
                    <option value="11h30">11h30</option>
                    <option value="12h00">12h00</option>
                    <option value="12h30">12h30</option>
                    <option value="13h00">13h00</option>
                    <option value="13h30">13h30</option>
                    <option value="14h00">14h00</option>
                    <option value="14h30">14h30</option>
                    <option value="15h00">15h00</option>
                    <option value="15h30">15h30</option>
                    <option value="16h00">16h00</option>
                    <option value="16h30">16h30</option>
                    <option value="17h00">17h00</option>
                    <option value="17h30">17h30</option>
                    <option value="18h00">18h00</option>
                    <option value="18h30">18h30</option>
                  </select>
                </div>
              </div>
      </div>


       <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.hour_s') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <select name="hour_end" class="form-control input-lg">
@if(!empty($pedagogique->hour_end))
<option value="{{$pedagogique->hour_end}}" selected="selected" style="color:green; font-weight:bold;">{{$pedagogique->hour_end}}</option>
@else
<option value="" selected="selected">{{ Lang::get($path.'.select') }}</option>
@endif
                   <option value="7h00">7h00</option>
                    <option value="7h30">7h30</option>
                    <option value="8h00">8h00</option>
                    <option value="8h30">8h30</option>
                    <option value="9h00">9h00</option>
                    <option value="9h30">9h30</option>
                    <option value="10h00">10h00</option>
                    <option value="10h30">10h30</option>
                    <option value="11h00">11h00</option>
                    <option value="11h30">11h30</option>
                    <option value="12h00">12h00</option>
                    <option value="12h30">12h30</option>
                    <option value="13h00">13h00</option>
                    <option value="13h30">13h30</option>
                    <option value="14h00">14h00</option>
                    <option value="14h30">14h30</option>
                    <option value="15h00">15h00</option>
                    <option value="15h30">15h30</option>
                    <option value="16h00">16h00</option>
                    <option value="16h30">16h30</option>
                    <option value="17h00">17h00</option>
                    <option value="17h30">17h30</option>
                    <option value="18h00">18h00</option>
                    <option value="18h30">18h30</option>
                  </select>
                </div>
              </div>
      </div>

  <div class="col-md-6">
          <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.parcour') }}  : </label>
                <div class="form-group">
                
                   <select name="parcours[]" id="done" class="form-control input-lg selectpicker" multiple data-done-button="true">
@if(!empty($pedagogique->parcours))
<option value="{{$pedagogique->parcours}}" selected="selected" style="color:green; font-weight:bold;">{{$pedagogique->parcours}}</option>
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
                <label class="control-label">{{ Lang::get($path.'.class') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                  <select name="class_id" class="form-control input-lg">
                    
                    <option style="color:green; font-weight:bold;" value="{{ $pedagogique->class_id }}">{{ $pedagogique->Tclass->name }}</option>

                    @foreach($classes as $class)
                      <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>
      </div>



      <div class="col-md-6">

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.subject') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <select name="subject" class="form-control input-lg">
                    
                    <option style="color:green; font-weight:bold;" value="{{ $pedagogique->subject_id }}">{{ $pedagogique->Tsubject->name }}</option>
                    
                    <?php $subjects = Subject::where('teacher_id', Auth::user()->id)->get(); ?>

                    @foreach ($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach

                  </select>
                </div>
              </div>
  </div>

  <div class="col-md-6">
        <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.VH') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                {{ Form::number('time', $pedagogique->times, ['placeholder'=>'en heur', 'class'=>'form-control input-lg', 'style'=>'color:green;font-weight:bold', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('time'))
                  <span class="help-block red-color">{{ $errors->first('time') }}</span>
                  @endif
      </div>
  </div>     

    
      <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.magistrale') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                  <select name="magistrale" class="form-control input-lg">
                    <option value="{{ $pedagogique->magistrale }}" style="color:green; font-weight:bold;">@if($pedagogique->magistrale == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($pedagogique->magistrale == 0) {{ Lang::get($path.'.no') }} @endif</option>
                    <option value="1">{{ Lang::get($path.'.yes') }}</option>
                    <option value="2">{{ Lang::get($path.'.no') }}</option>
                    
                  </select>
                </div>
              </div>
      </div>

      <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.tp') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                  <select name="tp" class="form-control input-lg">
                    <option value="{{ $pedagogique->tp }}"  style="color:green; font-weight:bold;">@if($pedagogique->tp == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($pedagogique->tp == 0) {{ Lang::get($path.'.no') }} @endif</option>
                    <option value="1">{{ Lang::get($path.'.yes') }}</option>
                    <option value="2">{{ Lang::get($path.'.no') }}</option>
                  </select>
                </div>
              </div>
      </div>

          <div class="col-md-12">
            
            <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.note') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
                {{ Form::textarea('note', $pedagogique->note, ['rows'=>'5', 'class'=>'form-control']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('note'))
                  <span class="help-block red-color">{{ $errors->first('note') }}</span>
                  @endif
          </div>
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
            url: '{{ route("pedagogique_update",$pedagogique->id) }}',
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


<!--<div class="clear"></div><br>

<div class="col-xs-12 no-print">
    <button class="btn btn-default pull-right " onclick="window.print();">
      <i class="fa fa-print"></i> <b>{{ Lang::get($path.'.print') }}</b>
    </button>

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


 <div class="col-md-6 col-md-offset-3 pull-left">
  
{{ Form::open(['route'=>'teacher_pedagogiques', 'method'=>'GET', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

              <div class="col-md-10" style="padding: 3px;">
                <div class="form-group">
                  @if(Input::has('q'))
                    {{ Form::text('q', Input::get('q'), ['class'=>'form-control datepicker2', 'data-provide'=>'datepicker', 'data-date-format'=>'yyyy-mm-dd']) }}
                  @else
                    {{ Form::text('q', '', [ 'placeholder'=>Lang::get($path.'.date_start') . ' ..', 'class'=>'form-control datepicker', 'data-provide'=>'datepicker', 'data-date-format'=>'yyyy-mm-dd']) }}
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

</div>-->

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <!--<th>{{ Lang::get($path.'.day') }}</th>-->                     
            <th>{{ Lang::get($path.'.date') }}</th> 
            <th>{{ Lang::get($path.'.hour') }}</th> 
            <th>{{ Lang::get($path.'.parcour') }}</th>     
            <th>{{ Lang::get($path.'.class') }}</th>    
            <th>{{ Lang::get($path.'.subject') }}</th>   
            <th>{{ Lang::get($path.'.magistrale') }}</th>    
            <th>{{ Lang::get($path.'.tp') }}</th>    
            <th>{{ Lang::get($path.'.note') }}</th>    
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>    
          </tr>
        </thead>
        <tbody>


@foreach($pedagogiques as $pedagogique)

          <tr class="tr-body">

            <!--<td>
            @if(!empty($pedagogique->days))
            {{ $pedagogique->Tday->name }}
            @else
            -
            @endif
            </td>-->

            <td><b>{{ $pedagogique->date_start }} / {{ $pedagogique->date_end }}</b></td>
            <td><span class="label label-default">{{ $pedagogique->hour_start }} / {{ $pedagogique->hour_end }}</span></td>

            <td>
            @if(!empty($pedagogique->parcours))
            
            <?php $parcours = explode(",", $pedagogique->parcours); ?>

            <?php foreach ($parcours as $parcour): ?>

              <span class="label label-primary"><?php echo  $parcour;?></span>
              
            <?php endforeach ?>

            @endif
            </td>

            <td><span class="label label-info">
            @if(!empty($pedagogique->class_id))
            {{ $pedagogique->Tclass->name }}
            @else
            -
            @endif</span>
            </td>

            <td>  <span class="btn badge btn-warning">
            @if(!empty($pedagogique->subject_id))
            {{ $pedagogique->Tsubject->name }}</span> -   <span class="label label-danger">vh :{{ $pedagogique->times }}h</span>
            @else
            -
            @endif
            </td>


            <td><strong>@if($pedagogique->magistrale == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($pedagogique->magistrale == 0) {{ Lang::get($path.'.no') }} @endif</strong></td>

            <td><strong>@if($pedagogique->tp == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($pedagogique->tp == 0) {{ Lang::get($path.'.no') }} @else - @endif</strong></td>

            <td>{{ $pedagogique->note }}</td>

             <td><a href="{{ URL::current() . '?id=' . $pedagogique->id }}"><i class="fa fa-edit large"></i></a></td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('pedagogique_delete', $pedagogique->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $pedagogiques->links() }}
    </div>

@endif

  </div>
</div>



@stop