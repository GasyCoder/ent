@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.absences') }} @stop

@section('content') 

{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}

  

<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.absences') }}</li>
  </ol>




<a data-toggle="modal" data-target="#new_absence"  href="#" class="btn btn-warning btn-lg"><i class="fa fa-clipboard"></i> {{ Lang::get($path.'.add_student_absence') }}</a>



<div class="modal fade" id="new_absence">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get($path.'.add_student_absence') }}</h4>
      </div>
      <div class="modal-body">
        

{{ Form::open(['route'=>'admin_absence_store', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>

      <div class="col-md-12">



              <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.class') }}  : </label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                    <select name="class_id" id="class" class="form-control  input-lg" required>
                    <option value="">{{ Lang::get($path.'.select_class') }}</option>
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
                      <option value="">{{ Lang::get($path.'.all_students') }}</option>
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

                    subcat.append('<option value ="">{{ Lang::get($path.'.all_students') }}</option>');

                    $.each(data,function(create,subcatObj){
                    var option = $('<option/>', {id:create, value:subcatObj});
                    subcat.append('<option value ="'+subcatObj+'">'+create+'</option>');
                    });

                }
            });


        });
});
</script>



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
                {{ Form::text('date', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required', 'data-provide'=>'datepicker', 'data-date-language'=>'ar']) }} 
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
              {{ Form::submit(Lang::get($path.'.add'), ['class'=>'btn btn-info btn-block input-lg']) }} 
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
            url: '{{ route("admin_absence_store") }}',
            data: $(this).serialize(),

            success: function(data) {
                              
                if(data == 'true') {   
                  $('#resultajax').html("<br><div class='alert alert-success center'><strong>{{ Lang::get($path.'.add_successfully') }}</strong></div>");
                  $('#myForm input.btn').show();
                 }

                if(data == 'false') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.error_please_try_again') }} </strong></div>");
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

<?php 

$read_abs = Absence::where('admin_read_stut', 1)->get();
foreach ($read_abs as $read_ab) {
  $read_ab->admin_read_stut = '0';
  $read_ab->save();  
}

 ?>
  

@if (count($absences) >= 1)

<div class="clear"></div><hr>


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.type') }}</th>
            <th>{{ Lang::get($path.'.name') }}</th>
            <th>{{ Lang::get($path.'.date') }}</th>        
            <th>{{ Lang::get($path.'.note') }}</th>
          </tr>
        </thead>
        <tbody>


@foreach($absences as $absence)
        
        @if($absence->admin_read_stut == 1)
          <tr class="tr-body" style="background-color:#ffface;">
        @else
          <tr class="tr-body">
        @endif

            <td>
            @if($absence->user->is_teacher == 1)

            <span class="badge green-bg">{{ Lang::get($path.'.teacher') }}</span>

            @elseif ($absence->user->is_student == 1)

            <span class="badge orange-bg">{{ Lang::get($path.'.student') }}</span>

            @endif
            </td>

            <td>{{ $absence->user->grade }} - <span class="label label-primary">{{ $absence->user->fullname }}</span></td>
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