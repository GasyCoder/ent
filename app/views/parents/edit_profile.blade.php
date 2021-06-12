@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ $user->fullname }} @stop

@section('content')


<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('parent_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ $user->fullname }}</li>
  </ol>
  <div class="clear"></div><hr>


     
    <div class="col-md-12" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{ $user->fullname }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">

                <div class="col-md-3 col-lg-3" align="center"> 


                    @if(!empty($user->image))
                    <?php echo HTML::image('uploads/profiles/parents/'.$user->image.'', '', ['class'=>'img-thumbnail img-responsive']) ?>
                    @else
                      {{ HTML::image('uploads/profiles/parent.png', '', ['class'=>'img-thumbnail img-responsive']) }}
                    @endif
                  

                </div>
                
    
                <div class=" col-md-9 col-lg-9"> 
                  <table class="table table-user-information">
                    <tbody>

                      <tr>
                        <td>{{ Lang::get($path.'.fullname') }} :</td>
                        <td class="td_details">{{ $user->fullname }}</td>
                      </tr>

                      <tr>
                        <td>{{ Lang::get($path.'.gender') }} :</td>
                        <td class="td_details">@if($user->gender == 1) {{ Lang::get($path.'.male') }} @elseif($user->gender == 2) {{ Lang::get($path.'.female') }} @else - @endif</td>
                      </tr>
                      <tr>
                        <td>{{ Lang::get($path.'.address') }} :</td>
                        <td class="td_details">{{ $user->address }}</td>
                      </tr>
                      <tr>
                        <td>{{ Lang::get($path.'.email') }} :</td>
                        <td class="td_details">{{ $user->email }}</td>
                      </tr>
                      <tr>
                        <td>{{ Lang::get($path.'.phone') }} :</td>
                        <td class="td_details">{{ $user->phone }}</td>
                      </tr>

                                     
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
           
            
          </div>

  </div>


<div class="col-md-12">

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

<div class="clear"></div> <hr>      


          <div class="col-md-6">
            

            {{ Form::open(['route'=>'parent_update_profile', 'files'=>'true', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}     



                      <div class="form-group">
                        <label class="control-label">{{ Lang::get($path.'.address') }} : </label>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                        {{ Form::text('address', $user->address, ['placeholder'=>'', 'class'=>'form-control input-lg']) }} 
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
                        {{ Form::email('email', $user->email, ['placeholder'=>'', 'class'=>'form-control input-lg', 'data-error'=>'Adresse email invalide']) }} 
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
                              {{ Form::text('phone', $user->phone, ['pattern'=>'^[_0-9-+]{1,}$', 'maxlength'=>'20', 'data-error'=>Lang::get($path.'.phone_invalide'), 'class'=>'form-control input-lg']) }} 
                            </div>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            <div class="help-block with-errors"></div>

                            @if($errors->first('phone'))
                              <span class="help-block red-color">{{ $errors->first('phone') }}</span>
                              @endif
                          </div>

                          <div class="form-group">
                          <label class="control-label">{{ Lang::get($path.'.image') }}  : </label>
                          {{ Form::file('image', ['class'=>'btn btn-default', 'id'=>'file']) }}

                            @if($errors->first('image'))
                              <span class="help-block red-color">{{ $errors->first('image') }}</span>
                            @endif
                          </div> 
                        

                    <div class="form-group">
                      {{ Form::submit( Lang::get($path.'.save_change') , ['class'=>'btn btn-info btn-block']) }} 
                    </div>


                      {{ Form::close() }}


          </div>

            <div class="col-md-6">

              {{ Form::open(['route'=>'parent_update_password', 'files'=>'true', 'id'=>'myForm', 'data-toggle'=>'validator'])  }} 

                    

                        <div class="form-group">
                          <label class="control-label">{{ Lang::get($path.'.old_password') }}  : </label>
                          <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                          <input name="old_password" type="password" class="form-control input-lg" required>
                          </div>
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="help-block with-errors"></div>
                          @if($errors->first('old_password'))
                            <span class="help-block red-color">{{ $errors->first('old_password') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                          <label class="control-label">{{ Lang::get($path.'.new_password') }}  : </label>
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
    

                        <div class="form-group">
                          {{ Form::submit(Lang::get($path.'.update_password'), ['class'=>'btn btn-danger btn-block']) }}
                        </div>


          {{ Form::close() }}

          </div>

</div>  
     



  </div>
</div>

@stop