@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.absence_registration') }} @stop

@section('content')

{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}
  
  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.absence_registration') }}</li>
  </ol>




<a data-toggle="modal" data-target="#new_absence"  href="#" class="btn btn-warning btn-lg"><i class="fa fa-clipboard"></i> {{ Lang::get($path.'.send_absence') }}</a>





<div class="modal fade" id="new_absence">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get($path.'.absence_registration') }}</h4>
      </div>
      <div class="modal-body">
        

{{ Form::open(['route'=>'teacher_store_absence', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

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
                <label class="control-label">{{ Lang::get($path.'.date') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('date', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required', 'data-provide'=>'datepicker']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('date'))
                  <span class="help-block red-color">{{ $errors->first('date') }}</span>
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
              {{ Form::submit( Lang::get($path.'.send') , ['class'=>'btn btn-info btn-block input-lg']) }} 
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
            url: '{{ route("teacher_store_absence") }}',  
            data: $(this).serialize(),

            success: function(data) {
                              
                if(data == 'true') {   
                  $('#resultajax').html("<br><div class='alert alert-success center'><strong>{{ Lang::get($path.'.send_successfully') }}</strong></div>");
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


  

@if (count($absences) >= 1)

<div class="clear"></div><hr>


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.date') }}</th>        
            <th>{{ Lang::get($path.'.note') }}</th>
          </tr>
        </thead>
        <tbody>


@foreach($absences as $absence)

          <tr class="tr-body">

            <td>{{ $absence->date }}</td>
            <td>{{ $absence->note }}</td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $absences->links() }}
    </div>

@endif

  </div>
</div>



@stop