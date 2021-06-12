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

<div class="clear"  style="margin-top: 20px;"></div>


{{ Form::open(['route'=>'teacher_register', 'method'=>'GET', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}


              <div class="col-md-10">
                <div class="form-group">

                  @if(Input::has('matricule_t'))
                    {{ Form::text('matricule_t', Input::get('matricule_t'), ['class'=>'form-control input-lg']) }}
                  @else
                    {{ Form::text('matricule_t', '', [ 'placeholder'=>Lang::get($path.'.tapez_ici_voter_n_inscription'), 'class'=>'form-control input-lg']) }}
                  @endif

                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                {{ Form::submit(Lang::get($path.'.valider'), ['class'=>'btn btn-info btn-block input-lg']) }}
                </div>
              </div>


{{ Form::close() }}

<?php
if (isset($_GET['matricule_t'])) {

  $code_inscription = htmlspecialchars($_GET['matricule_t']);

  $get_user = UsersData::where('matricule_t', $code_matricule_t)->first();

  if ($get_user !== null) {

    $check_table_users = User::where('matricule_t', $code_matricule_t)->first();

    if ($check_table_users == null) {


?>

<hr>
  <div class="col-md-12"><div class="alert alert-info center alert-dismissible" role="alert">
   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>{{ HTML::image('images/icons/happy.png', '', ['width'=>'20px']) }} Bonjour! <u>{{$get_user->element_c}}</u></strong>

  </div>


    {{ Form::open(['route'=>'teacher_register_store', 'files'=>'true', 'id'=>'register', 'data-toggle'=>'validator'])  }}



            <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.matricule_t') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                {{ Form::text('matricule_t', Input::get('matricule_t'), ['placeholder'=>'', 'class'=>'form-control input-lg', 'readonly'=>'readonly']) }}
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('matricule_t'))
                  <span class="help-block red-color">{{ $errors->first('matricule_t') }}</span>
                  @endif
            </div>

            <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.element_c') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <select name="mention" class="form-control input-lg">

@if(!empty($get_user->element_c))
<option value="{{$get_user->element_c}}" selected="selected" style="color: red;">{{$get_user->element_c}}</option>
@else
<option value="" selected="selected">{{$get_user->element_c}}</option>
@endif
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('element_c'))
                  <span class="help-block red-color">{{ $errors->first('element_c') }}</span>
                  @endif
              </div>


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.credit_ec') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <select name="credit_ec" class="form-control input-lg">

@if(!empty($get_user->credit_ec))
<option value="{{$get_user->credit_ec}}" selected="selected" style="color: red;">{{$get_user->credit_ec}}</option>
@else
<option value="" selected="selected">{{$get_user->credit_ec}}</option>
@endif
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('credit_ec'))
                  <span class="help-block red-color">{{ $errors->first('credit_ec') }}</span>
                  @endif
              </div>


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.code_ec') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <select name="code_ec" class="form-control input-lg">

@if(!empty($get_user->code_ec))
<option value="{{$get_user->code_ec}}" selected="selected" style="color: red;">{{$get_user->code_ec}}</option>
@else
<option value="" selected="selected">{{$get_user->code_ec}}</option>
@endif

                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('code_ec'))
                  <span class="help-block red-color">{{ $errors->first('code_ec') }}</span>
                  @endif
              </div>



            <div class="form-group">
           <label class="control-label">{{ Lang::get($path.'.unite_ec') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-star"></i></span>
                {{ Form::text('unite_ec', $get_user->unite_ec, ['placeholder'=> Lang::get($path.'.unite_ec') , 'class'=>'form-control input-lg']) }}
                </div>

                @if($errors->first('unite_ec'))
                  <span class="help-block red-color">{{ $errors->first('unite_ec') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.credit_t') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <select name="credit_t" class="form-control input-lg">
                  @if(!empty($get_user->credit_t))
                  <option value="{{$get_user->gender}}" selected="selected" style="color: red;">{{$get_user->credit_t}}</option>
                  @else
                  <option value="" selected="selected">{{$get_user->credit_t}}</option>
                  @endif
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('credit_t'))
                  <span class="help-block red-color">{{ $errors->first('credit_t') }}</span>
                  @endif
              </div>


<div class="clear"></div><hr>

            <div class="form-group">
                {{ Form::submit( Lang::get($path.'.register') , []) }}
            </div>

    {{ Form::close() }}


<?php
 }
  // esle if  exist in table users
  else {

    echo '<div class="clear"></div><br>
    <div class="col-md-12"><div class="alert alert-warning center alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>' . Lang::get($path.'.inscription_code_error2') .' </strong>
  </div> </div><div class="clear"></div>';

  }

} else {

    echo '<div class="clear"></div><br>
    <div class="col-md-12"><div class="alert alert-danger center alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>' . Lang::get($path.'.inscription_code_error') .' </strong>
  </div> </div><div class="clear"></div>';

      }
}
?>




  </div>

</div>

<div class="clear"></div> <br><br>


</div>

<script type="text/javascript">
  $('#teacher').validator();
</script>


@stop
