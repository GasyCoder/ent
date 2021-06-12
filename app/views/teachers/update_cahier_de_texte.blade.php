@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.cahier_de_texte') }} @stop


@section('content')

{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}

{{ HTML::style('js/bootstrap-select/css/bootstrap-select.css') }}
{{ HTML::script('js/bootstrap-select/js/bootstrap-select.js') }}

<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('teacher_cahier_texte') }}">{{ Lang::get($path.'.cahier_de_texte') }}</a></li>
    <li class="active">{{ Lang::get($path.'.edit') }}</li>
  </ol>


     

{{ Form::open(['route'=>['cahier_de_texte_update', $cahier_de_texte->id], 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

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

      <div class="col-md-6">
             <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.date') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('date', $cahier_de_texte->the_date, ['placeholder'=>'', 'class'=>'form-control input-lg datepicker', 'data-provide'=>'datepicker', 'data-date-format'=>'dd/mm/yyyy']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>
      </div>

    
      <div class="col-md-6">
        
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.time_c') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <select name="time" class="form-control input-lg">
<option style="color: red;" value="{{ $cahier_de_texte->the_time }}">{{ $cahier_de_texte->the_time }}</option>
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


      <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.class') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                  <select name="class_id" class="form-control input-lg">

<option style="color: red;" value="{{ $cahier_de_texte->class_id }}">{{ $cahier_de_texte->Tclass->name }}</option>

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
        <label for="done" class="control-label">{{ Lang::get($path.'.parcour')}}  : </label>
         <div class="form-group">
         <select name="parcours[]" id="done" class="form-control input-lg selectpicker" multiple data-done-button="true">
        @if(!empty($cahier_de_texte->parcours))
        <option value="{{ $cahier_de_texte->parcours }}" selected="selected">{{ $cahier_de_texte->parcours }}</option>
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
                <label class="control-label">{{ Lang::get($path.'.salle') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                  <select name="salle" class="form-control input-lg">
 
 <option style="color: red;" value="{{ $cahier_de_texte->salle }}">{{ $cahier_de_texte->salle }}</option>


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
                <label class="control-label">{{ Lang::get($path.'.magistrale') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                  <select name="magistrale" class="form-control input-lg">
                    <option value="{{ $cahier_de_texte->magistrale }}">@if($cahier_de_texte->magistrale == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($cahier_de_texte->magistrale == 0) {{ Lang::get($path.'.no') }} @endif</option>
                    <option value="1">{{ Lang::get($path.'.yes') }}</option>
                    <option value="2">{{ Lang::get($path.'.no') }}</option>
                  </select>
                </div>
              </div>
      </div>

        <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.subject') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                  <select name="subject_id" class="form-control input-lg">

        @if(!empty($cahier_de_texte->subject))
        <option value="{{$cahier_de_texte->subject_id}}" selected="selected" style="color: red;">{{$cahier_de_texte->Tsubject->name}}</option>
        @else
        @endif
         <?php $subjects = Subject::where('teacher_id', Auth::user()->id)->get(); ?>
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
                <label class="control-label">{{ Lang::get($path.'.tp') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                  <select name="tp" class="form-control input-lg">
                    <option value="{{ $cahier_de_texte->tp }}">@if($cahier_de_texte->tp == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($cahier_de_texte->tp == 0) {{ Lang::get($path.'.no') }} @endif</option>
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
                {{ Form::textarea('note', $cahier_de_texte->note, ['rows'=>'5', 'class'=>'form-control']) }} 
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
              {{ Form::submit( Lang::get($path.'.edit') , ['class'=>'btn btn-info btn-block input-lg']) }} 
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
            url: '{{ route("cahier_de_texte_update", $cahier_de_texte->id) }}',
            data: $(this).serialize(),

            success: function(data) {
                              
                if(data == 'true') {   
                  $('#resultajax').html("<br><div class='alert alert-success center'><strong>{{ Lang::get($path.'.was_update') }}</strong></div>");
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
</div>



@stop