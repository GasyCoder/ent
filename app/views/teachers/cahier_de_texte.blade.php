@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.cahier_de_texte') }} @stop


@section('content')

{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}

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
    <li class="active">{{ Lang::get($path.'.cahier_de_texte') }}</li>

    <li>
     <span href="" style="color: #fff" class="label label-default pull-center" data-toggle="popover" title="Guide sur cette page" data-content="Cliquez le bouton Nouvel note et puis remplisez les information!">{{ Lang::get($path.'.help') }} <i class="fa fa-question"></i></span></li>

  </ol>



<a data-toggle="modal" data-target="#new_class"  href="#" class="btn btn-warning btn-lg"><i class="fa fa-book"></i> {{ Lang::get($path.'.new_note') }}</a>



<div class="modal fade bs-example-modal-lg" id="new_class">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get($path.'.new_note') }}</h4>
      </div>
      <div class="modal-body">
        

{{ Form::open(['route'=>'cahier_de_texte_store', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

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
                {{ Form::text('date', '', ['placeholder'=>'', 'class'=>'form-control input-lg datepicker', 'data-provide'=>'datepicker', 'data-date-format'=>'dd/mm/yyyy']) }} 
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


      <div class="col-md-6">
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
        </div>

  <div class="col-md-6">
        
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
   </div>

      <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.salle') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                  <select name="salle" class="form-control input-lg">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
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


    <!--<div class="col-md-16">
             <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.subject') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                {{ Form::text('activite', '', ['placeholder'=> Lang::get($path.'.your_subjects'), 'class'=>'form-control input-lg']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>
      </div>-->

      <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.subject') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <select name="subject" class="form-control input-lg">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    
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
                <label class="control-label">{{ Lang::get($path.'.magistrale') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                  <select name="magistrale" class="form-control input-lg">
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
                  <select name="tp" class="form-control input-lg">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
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
              {{ Form::submit( Lang::get($path.'.new_note') , ['class'=>'btn btn-info btn-block input-lg']) }} 
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
            url: '{{ route("cahier_de_texte_store") }}',
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







@if (count($cahier_de_texte) >= 1)

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



    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.date') }}</th>                     
            <th>{{ Lang::get($path.'.time_c') }}</th> 
            <th>{{ Lang::get($path.'.salle') }}</th>     
            <th>{{ Lang::get($path.'.class') }}</th>  
            <th>{{ Lang::get($path.'.parcour') }}</th>     
            <th>{{ Lang::get($path.'.subject') }}</th>
            <th>{{ Lang::get($path.'.magistrale') }}</th>    
            <th>{{ Lang::get($path.'.tp') }}</th>      
            <th>{{ Lang::get($path.'.note') }}</th> 
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>    
          </tr>
        </thead>
        <tbody>


@foreach($cahier_de_texte as $txt)

          <tr class="tr-body">

            <td><span class="" style="font-size:13px; font-weight: bold;">{{ $txt->the_date }}</span></td>
            
            <td><span class="btn badge btn-default-bg" style="font-size: 13px;">{{ $txt->the_time }}</span></td>
            
            <td><span class="" style="font-size:13px; font-weight: bold;">{{ $txt->salle }}</span></td>
            
            <td><span class="btn badge  btn-danger" style="font-size: 13px;">
            @if(!empty($txt->class_id))
            {{ $txt->Tclass->name }}
            @else
            -
            @endif</span>
            </td>

            <td><span class="btn badge btn-success" style="font-size: 13px;">
              @if(!empty($txt->parcours))
               {{ $txt->parcours}}
            @else
            -
            @endif</span>
            </td>

            <td><span class="btn badge btn-primary" style="font-size: 13px;">
            @if(!empty($txt->subject_id))
            {{ $subject->name }}
            @else
            -
            @endif</span></td>

             <td><span class="" style="font-size:13px; font-weight: bold;">@if($txt->magistrale == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($txt->magistrale == 0) {{ Lang::get($path.'.no') }} - @endif</span></td>

            <td><span class="" style="font-size:13px; font-weight: bold;">@if($txt->tp == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($txt->tp == 0) {{ Lang::get($path.'.no') }} @else - @endif</span></td>


            <td>{{ $txt->note }}</td>

             <td><a href="{{ URL::route('cahier_de_texte_edit', $txt->id) }}"><i class="fa fa-edit large"></i></a></td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('cahier_de_texte_destroy', $txt->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $cahier_de_texte->links() }}
    </div>

@endif

  </div>
</div>



@stop