@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.transport') }} @stop

@section('content')

  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.transport') }}</li>
  </ol>
  
<a data-toggle="modal" data-target="#new_class"  href="#" class="btn btn-warning btn-lg disabled"><i class="fa fa-bus"></i> {{ Lang::get($path.'.new_transport') }}</a>


<div class="modal fade" id="new_class">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get($path.'.new_transport') }}</h4>
      </div>
      <div class="modal-body">
        

{{ Form::open(['route'=>'store_transport', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>

      <div class="col-md-12">  

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
                <label class="control-label">{{ Lang::get($path.'.day') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <select name="days" class="form-control input-lg">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    
                    <?php $days = DB::table('days')->get(); ?>

@if($path == 'en')
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

      
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.time_start') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                {{ Form::text('time_start', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('time_start'))
                  <span class="help-block red-color">{{ $errors->first('time_start') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.time_return') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                {{ Form::text('time_return', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('time_return'))
                  <span class="help-block red-color">{{ $errors->first('time_return') }}</span>
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
            url: '{{ route("store_transport") }}',
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

<div class="clear"></div><hr>


<?php 
if (isset($_GET['class'])) { 

$class_id = htmlspecialchars($_GET['class']);

$transport = Transport::where('class_id', $class_id)->orderBy('id', 'desc')->paginate(15);

$transport->appends(Input::except('page'));

if (count($transport) >= 1) {

 ?>

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

<a href="{{ URL::route('admin_transport') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.all_class_transport') }}</a><div class="clear"></div><br>


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.day') }}</th>
            <th>{{ Lang::get($path.'.class') }}</th>
            <th>{{ Lang::get($path.'.time_start') }}</th>         
            <th>{{ Lang::get($path.'.time_return') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>

@foreach($transport as $tr)

          <tr class="tr-body">

@if($path == 'aen')
            <td>{{ $tr->Tday->name_en }}</td>
@else
          <td>{{ $tr->Tday->name }}</td>
@endif
            <td>{{ $tr->Tclass->name }}</td>

            <td>{{ $tr->time_start }}</td>

            <td>{{ $tr->time_start }}</td>
            
            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('destroy_transport', $tr->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $transport->links() }}
    </div>


<?php } else {  ?>
  <a href="{{ URL::route('admin_transport') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.all_class_transport') }}</a><div class="clear"></div><br><div class="alert alert-info center" role="alert"><strong>{{ Lang::get($path.'.no_transport_in_this_class') }}</strong></div>
<?php } 

} else { ?>


<div class="clear"></div>

@if(count($classes) >= 1)

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.class') }}</th>
            <th>{{ Lang::get($path.'.transport') }}</th>
          </tr>
        </thead>
        <tbody>

@foreach($classes as $class)

          <tr class="tr-body">

            <td>{{ $class->name }}</td>
            <td><a href="{{ URL::current() . '?class=' . $class->id }}"><i class="fa fa-bus large"></i></a></td>

          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->


@endif


<?php } ?>



  </div>
</div>



@stop