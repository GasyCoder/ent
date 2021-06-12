@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.new_teacher') }} @stop

@section('content')

<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('admin_teachers') }}">{{ Lang::get($path.'.teachers') }}</a></li>
    <li class="active">{{ Lang::get($path.'.new_teacher') }}</li>
  </ol>
  <div class="clear"></div><hr>


@if(Session::has('success'))
<div class="col-md-12">
  <div class="alert alert-success center alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>{{ Lang::get($path.'.success_added') }}</strong>
  </div>
</div>
@endif



        {{ Form::open(['route'=>'store_teacher', 'files'=>'true', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

      

      <div class="col-md-6">  
      
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.fullname') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-star"></i></span>
                {{ Form::text('fullname', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('fullname'))
                  <span class="help-block red-color">{{ $errors->first('fullname') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.gender') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <select name="gender" class="form-control input-lg">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    <option value="1">{{ Lang::get($path.'.male') }}</option>
                    <option value="2">{{ Lang::get($path.'.female') }}</option>
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('gender'))
                  <span class="help-block red-color">{{ $errors->first('gender') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.username') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {{ Form::text('username', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('username'))
                  <span class="help-block red-color">{{ $errors->first('username') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.password') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input name="password" type="password" data-minlength="6" class="form-control input-lg" id="inputPassword" placeholder="" required>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('password'))
                  <span class="help-block red-color">{{ $errors->first('password') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.password_confirmation') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input name="password_confirm" type="password" class="form-control input-lg" data-match="#inputPassword" data-match-error="Votre champ n'est pas identique" placeholder="" required>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('password_confirm'))
                  <span class="help-block red-color">{{ $errors->first('password_confirm') }}</span>
                  @endif
              </div>


                  <div class="form-group" style="background-color: #f9f9f9; border: 1px #ccc dashed; padding: 10px;">
                  <label class="control-label">{{ Lang::get($path.'.image') }}  : </label>
                  {{ Form::file('image', ['class'=>'btn btn-default', 'id'=>'file']) }}

                    @if($errors->first('image'))
                      <span class="help-block red-color">{{ $errors->first('image') }}</span>
                    @endif
                </div>

      </div>

      <div class="col-md-6">


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.grade') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <select name="grade" class="form-control input-lg">
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

               <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.matricule') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                {{ Form::text('matricule', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'pattern' =>'.{6,}', 'title' =>'6 caractères minimum requise', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('matricule'))
                  <span class="help-block red-color">{{ $errors->first('matricule') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.position') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <select name="position" class="form-control input-lg">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    <option value="permanente">permanente</option>
                    <option value="vacataire">vacataire</option>
                    <option value="missionnaire">missionnaire</option>
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('position'))
                  <span class="help-block red-color">{{ $errors->first('position') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.etat_civil') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                  <select name="etat_civil" class="form-control input-lg">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    <option value="Marié">Marié</option>
                    <option value="Célibataire">Célibataire</option>
                    <option value="Divorce">Divorce</option>
                    <option value="Veuf">Veuf</option>
                    <option value="Fiancé">Fiancé</option>
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('etat_civil'))
                  <span class="help-block red-color">{{ $errors->first('etat_civil') }}</span>
                  @endif
              </div>


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.address') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                {{ Form::text('address', '', ['placeholder'=>'', 'class'=>'form-control input-lg']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('address'))
                  <span class="help-block red-color">{{ $errors->first('address') }}</span>
                  @endif
              </div>


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.email') }}  : </label>
                 <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                {{ Form::email('email', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'data-error'=>'Adresse email invalide']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('email'))
                  <span class="help-block red-color">{{ $errors->first('email') }}</span>
                  @endif
              </div>


                  <div class="form-group">
                    <label class="control-label">{{ Lang::get($path.'.phone') }} : </label>

                    <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                      {{ Form::text('phone', '', ['pattern'=>'^[_0-9-+]{1,}$', 'maxlength'=>'20', 'data-error'=>Lang::get($path.'.phone_invalide'), 'class'=>'form-control input-lg']) }} 
                    </div>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>

                    @if($errors->first('phone'))
                      <span class="help-block red-color">{{ $errors->first('phone') }}</span>
                      @endif
                  </div>

                
                
        </div>

            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.new_teacher'), ['class'=>'btn btn-info btn-block input-lg']) }} 
            </div>


              {{ Form::close() }}

  
  </div>
</div>

<script type="text/javascript">
  $('#myForm').validator();
</script>

@stop