@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') categories @stop

@section('content')


<div class="panel panel-default panel-main">
   <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('admin_articles') }}">{{ Lang::get($path.'.articles') }}</a></li>
    <li class="active">{{ Lang::get($path.'.categories') }}</li>
  </ol>
  
<a data-toggle="modal" data-target="#new_catg"  href="#" class="btn btn-warning btn-lg"><i class="fa fa-edit"></i> {{ Lang::get($path.'.new_category') }}</a>






<div class="modal fade" id="new_catg">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get($path.'.new_category') }}</h4>
      </div>
      <div class="modal-body">
        

{{ Form::open(['route'=>'categorie_store', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
          <div id="resultajax" class="center"></div>
      </div>

      <div class="col-md-12">  
      
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.name') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
                {{ Form::text('name', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('name'))
                  <span class="help-block red-color">{{ $errors->first('name') }}</span>
                  @endif
              </div>

      </div>


            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.new_category'), ['class'=>'btn btn-info btn-block input-lg']) }} 
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
            url: '{{ route("categorie_store") }}',
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






@if (count($categories) >= 1)

<div class="clear"></div><hr>




<?php 
if (isset($_GET['id'])) { 
  
$id = htmlspecialchars($_GET['id']);

$getCategory = Category::find($id);

if ($getCategory !== null) {  ?>


{{ Form::open(['route'=>['categorie_delete',$getCategory->id], 'class'=>'col-md-8 col-md-offset-2', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">
          <div id="resultajax2" class="center"></div>
      </div>

      <div class="col-md-12">  
      
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.name') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                {{ Form::text('name', $getCategory->name, ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('name'))
                  <span class="help-block red-color">{{ $errors->first('name') }}</span>
                  @endif
              </div>

      </div>

 

            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.update'), ['class'=>'btn btn-success btn-block input-lg']) }} 
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
            url: '{{ route("categorie_update",$getCategory->id) }}',
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
            <th>{{ Lang::get($path.'.category') }}</th>
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>



@foreach($categories as $categorie)

          <tr class="tr-body">

            <td>{{ $categorie->name }}</td>
            
            <td><a href="{{ URL::current() . '?id=' . $categorie->id }}"><i class="fa fa-edit large"></i></a></td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('categorie_delete', $categorie->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->


@endif

  </div>
</div>



@stop