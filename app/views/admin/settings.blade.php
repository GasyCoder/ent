@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.settings') }} @stop

@section('content')


{{ HTML::style('js/inputTags/css/inputTags.css') }}
{{ HTML::script('js/inputTags/js/inputTags.jquery.js') }}

   <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.settings') }}</li>
  </ol>
  <hr>

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


{{ Form::open(['route'=>'settings_update', 'method'=>'POST']) }}

<h2 class="bg-title">{{ Lang::get($path.'.General_settings') }}:</h2>

<div class="col-md-6">
      <div class="form-group">
        <label>{{ Lang::get($path.'.school_name') }} :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
          <input name="school_name" placeholder="" class="form-control" type="text" value="{{ $control->school_name }}">
        </div>
        @if($errors->first('school_name'))
          <span class="help-block red-color">{{ $errors->first('school_name') }}</span>
        @endif
      </div>

      <div class="form-group">
        <label>{{ Lang::get($path.'.school_Email') }} :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
          <input name="email" placeholder="" class="form-control" type="text" value="{{ $control->email }}">
        </div>
        @if($errors->first('email'))
          <span class="help-block red-color">{{ $errors->first('email') }}</span>
        @endif
      </div>

      <div class="form-group">
        <label>{{ Lang::get($path.'.school_Phone') }} :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
          <input name="phone" placeholder="" class="form-control" type="text" value="{{ $control->phone }}">
        </div>
        @if($errors->first('phone'))
          <span class="help-block red-color">{{ $errors->first('phone') }}</span>
        @endif
      </div>

      <div class="form-group">
        <label>{{ Lang::get($path.'.school_Address') }} :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
          <input name="address" placeholder="" class="form-control" type="text" value="{{ $control->address }}">
        </div>
        @if($errors->first('address'))
          <span class="help-block red-color">{{ $errors->first('address') }}</span>
        @endif
      </div>

      <div class="form-group">
        <label>{{ Lang::get($path.'.pagination') }}</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-copy"></i></span>
          <input name="pagination" placeholder="" class="form-control" type="text" value="{{ $control->paginate }}">
        </div>
        @if($errors->first('pagination'))
          <span class="help-block red-color">{{ $errors->first('pagination') }}</span>
        @endif
      </div>


      <div class="form-group">
          <div class="center yellow-box" style="padding-bottom: 5px; margin-top: 5px;">
            <label>{{ Lang::get($path.'.marquee_ltr_direction') }} :</label>&nbsp;&nbsp;&nbsp;
            <label class="radio-inline">
              @if($control->marquee_rtl == 1)
                {{ Form::radio('marquee_rtl', true, ['checked'=>'checked']) }} {{ Lang::get($path.'.Yes') }}
              @else
                {{ Form::radio('marquee_rtl', true) }} {{ Lang::get($path.'.Yes') }}
              @endif
            </label>
            <label class="radio-inline">
              @if($control->marquee_rtl == 0)
                {{ Form::radio('marquee_rtl', false, ['checked'=>'checked']) }} {{ Lang::get($path.'.No') }}
              @else
                {{ Form::radio('marquee_rtl', false) }} {{ Lang::get($path.'.No') }}
              @endif
            </label>
          </div>
      </div>      
</div>

<div class="col-md-6">
      <div class="form-group">
        <label>{{ Lang::get($path.'.description') }} :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>
          <textarea name="description" class="form-control" rows="3">{{ $control->description }}</textarea>
        </div>
        @if($errors->first('description'))
          <span class="help-block red-color">{{ $errors->first('description') }}</span>
        @endif
      </div>

      <div class="form-group">
        <label>{{ Lang::get($path.'.Meta_keywords') }} :</label>
        <div class="input-group">
          <input type="text" name="keywords" id="tags" value="{{ $control->keywords }}" id="tags" />
        </div>
        @if($errors->first('keywords'))
          <span class="help-block red-color">{{ $errors->first('keywords') }}</span>
        @endif
      </div>


<script type="text/javascript">
  $('#tags').inputTags({
    max: 25
  });
</script>


      <div class="form-group">
        <label>sitemap :</label><br>
        <div class="yellow-box" style="padding-left:5px; padding-bottom: 5px; margin-top: 5px; background-color: #f9f9f9;">
          <a style="color: #c55;" href="{{ url() }}/sitemap.xml">{{ url() }}/sitemap.xml</a>
        </div>
        
      </div>


      <div class="form-group">
        <label>{{ Lang::get($path.'.Last_News') }} :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
          <textarea name="news" class="form-control" rows="3">{{ $control->news }}</textarea>
        </div>
        @if($errors->first('news'))
          <span class="help-block red-color">{{ $errors->first('news') }}</span>
        @endif
      </div>

      

      
</div>

<div class="col-md-12">
  <button type="submit" class="btn btn-info">{{ Lang::get($path.'.save_change') }}</button>
</div>


<div class="clear"></div>
<h2 class="bg-title">{{ Lang::get($path.'.slide') }} (1400px*400px) :</h2>

<div class="col-md-12">
      <div class="form-group">
          <div class="center yellow-box" style="padding-bottom: 5px; margin-top: 5px;">
            <label>{{ Lang::get($path.'.slide_active') }} :</label>&nbsp;&nbsp;&nbsp;
            <label class="radio-inline">
              @if($control->slide == 1)
                {{ Form::radio('slide', true, ['checked'=>'checked']) }} {{ Lang::get($path.'.Yes') }}
              @else
                {{ Form::radio('slide', true) }} {{ Lang::get($path.'.Yes') }}
              @endif
            </label>
            <label class="radio-inline">
              @if($control->slide == 0)
                {{ Form::radio('slide', false, ['checked'=>'checked']) }} {{ Lang::get($path.'.No') }}
              @else
                {{ Form::radio('slide', false) }} {{ Lang::get($path.'.No') }}
              @endif
            </label>
          </div>
      </div> 
</div>


<div class="col-md-6">
      <div class="form-group">
        <label>{{ Lang::get($path.'.image') }} 1:</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
          <input name="img_1" placeholder="" class="form-control" type="text" value="{{ $slide->img_1 }}">
        </div>
      </div>
      <div class="form-group">
        <label>{{ Lang::get($path.'.image') }} 2 :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
          <input name="img_2" placeholder="" class="form-control" type="text" value="{{ $slide->img_2 }}">
        </div>
      </div>
      <div class="form-group">
        <label>{{ Lang::get($path.'.image') }} 3 :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
          <input name="img_3" placeholder="" class="form-control" type="text" value="{{ $slide->img_3 }}">
        </div>
      </div>     
</div>

<div class="col-md-6">
      <div class="form-group">
        <label>{{ Lang::get($path.'.link') }} 1 :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-link"></i></span>
          <input name="url_1" placeholder="" class="form-control" type="text" value="{{ $slide->url_1 }}">
        </div>
      </div>
      <div class="form-group">
        <label>{{ Lang::get($path.'.link') }} 2 :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-link"></i></span>
          <input name="url_2" placeholder="" class="form-control" type="text" value="{{ $slide->url_2 }}">
        </div>
      </div>
      <div class="form-group">
        <label>{{ Lang::get($path.'.link') }} 3 :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-link"></i></span>
          <input name="url_3" placeholder="" class="form-control" type="text" value="{{ $slide->url_3 }}">
        </div>
      </div>     
</div>


<div class="col-md-12">
  <button type="submit" class="btn btn-info">{{ Lang::get($path.'.save_change') }}</button>
</div>



<div class="clear"></div>
<h2 class="bg-title">{{ Lang::get($path.'.Social_media') }} :</h2>


<div class="col-md-6">
      <div class="form-group">
        <label>facebook</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-facebook"></i></span>
          <input name="facebook" placeholder="" class="form-control" type="text" value="{{ $control->facebook }}">
        </div>
        @if($errors->first('facebook'))
          <span class="help-block red-color">{{ $errors->first('facebook') }}</span>
        @endif
      </div>

      <div class="form-group">
        <label>twitter</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
          <input name="twitter" placeholder="" class="form-control" type="text" value="{{ $control->twitter }}">
        </div>
        @if($errors->first('twitter'))
          <span class="help-block red-color">{{ $errors->first('twitter') }}</span>
        @endif
      </div>       
</div>
<div class="col-md-6">
      <div class="form-group">
        <label>youtube</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-youtube"></i></span>
          <input name="youtube" placeholder="" class="form-control" type="text" value="{{ $control->youtube }}">
        </div>
        @if($errors->first('youtube'))
          <span class="help-block red-color">{{ $errors->first('youtube') }}</span>
        @endif
      </div>

      <div class="form-group">
        <label>google plus</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
          <input name="google_plus" placeholder="" class="form-control" type="text" value="{{ $control->google_plus }}">
        </div>
        @if($errors->first('google_plus'))
          <span class="help-block red-color">{{ $errors->first('google_plus') }}</span>
        @endif
      </div>
</div>

<div class="col-md-12">
  <button type="submit" class="btn btn-info">{{ Lang::get($path.'.save_change') }}</button>
</div>


<div class="clear"></div>
<h2 class="bg-title">{{ Lang::get($path.'.payments') }} :</h2>

<div class="col-md-6">
      <div class="form-group">
        <label>{{ Lang::get($path.'.Payment_Tax') }} % :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-percent"></i></span>
          <input name="payment_tax" placeholder="" class="form-control" type="text" value="{{ $control->payment_tax }}">
        </div>
        @if($errors->first('payment_tax'))
          <span class="help-block red-color">{{ $errors->first('payment_tax') }}</span>
        @endif
      </div>
</div>

<div class="col-md-6">
      <div class="form-group">
        <label>{{ Lang::get($path.'.payment_unit') }} :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-money"></i></span>
          <input name="payment_unit" placeholder="" class="form-control" type="text" value="{{ $control->payment_unit }}">
        </div>
        @if($errors->first('payment_unit'))
          <span class="help-block red-color">{{ $errors->first('payment_unit') }}</span>
        @endif
      </div>
</div>

<div class="col-md-12">
  <button type="submit" class="btn btn-info">{{ Lang::get($path.'.save_change') }}</button>
</div>

<div class="clear"></div>
<h2 class="bg-title">{{ Lang::get($path.'.website_mode') }} :</h2>
  

<div class="col-md-6">
      <div class="center yellow-box" style="padding-bottom: 5px; margin-top: 20px;">
      <label>{{ Lang::get($path.'.Close_website') }} :</label>

      <div class="radio">
        <label class="radio-inline">
          @if($control->close_site == 1)
            {{ Form::radio('close_site', true, ['checked'=>'checked']) }} {{ Lang::get($path.'.Yes') }}
          @else
            {{ Form::radio('close_site', true) }} {{ Lang::get($path.'.Yes') }}
          @endif
        </label>
        <label class="radio-inline">
          @if($control->close_site == 0)
            {{ Form::radio('close_site', false, ['checked'=>'checked']) }} {{ Lang::get($path.'.No') }}
          @else
            {{ Form::radio('close_site', false) }} {{ Lang::get($path.'.No') }}
          @endif
        </label>
      </div>

      </div>
</div> 

<div class="col-md-6">

      <div class="form-group">
        <label>{{ Lang::get($path.'.closing_msg') }} :</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
          <textarea name="closing_msg" class="form-control" rows="3">{{ $control->closing_msg }}</textarea>
        </div>
        @if($errors->first('closing_msg'))
          <span class="help-block red-color">{{ $errors->first('closing_msg') }}</span>
        @endif
      </div>

</div> 

<div class="col-md-12">
  <button type="submit" class="btn btn-info">{{ Lang::get($path.'.save_change') }}</button>
</div>



<div class="clear"></div>
<h2 class="bg-title">{{ Lang::get($path.'.library') }} :</h2>
  

<div class="col-md-6">
      <div class="center yellow-box" style="padding-bottom: 5px; margin-top: 20px;">
      <label>{{ Lang::get($path.'.teacher_and_student_upload_files') }} :</label>

      <div class="radio">
        <label class="radio-inline">
          @if($control->library_apv == 1)
            {{ Form::radio('library_apv', true, ['checked'=>'checked']) }} {{ Lang::get($path.'.Yes') }}
          @else
            {{ Form::radio('library_apv', true) }} {{ Lang::get($path.'.Yes') }}
          @endif
        </label>
        <label class="radio-inline">
          @if($control->library_apv == 0)
            {{ Form::radio('library_apv', false, ['checked'=>'checked']) }} {{ Lang::get($path.'.No') }}
          @else
            {{ Form::radio('library_apv', false) }} {{ Lang::get($path.'.No') }}
          @endif
        </label>
      </div>

      </div>
</div> 
 

<div class="col-md-12">
  <button type="submit" class="btn btn-info">{{ Lang::get($path.'.save_change') }}</button>
</div>


{{ Form::close() }}



<div class="clear"></div>
<h2 class="bg-title">{{ Lang::get($path.'.my_information') }} :</h2>

{{ Form::open(['route'=>'update_admin', 'files'=>'true', 'class'=>'col-md-6', 'method'=>'POST']) }}


                    <div class="form-group">
                        <label class="control-label">{{ Lang::get($path.'.email') }}  : </label>
                         <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        {{ Form::email('email', $user->email, ['placeholder'=>'', 'class'=>'form-control', 'data-error'=>'Adresse email invalide']) }} 
                        </div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <div class="help-block with-errors"></div>
                        @if($errors->first('email'))
                          <span class="help-block red-color">{{ $errors->first('email') }}</span>
                          @endif
                    </div>


                    <div class="form-group">
                      <label class="control-label">{{ Lang::get($path.'.image') }}  : </label>
                        {{ Form::file('image', ['class'=>'btn btn-default', 'id'=>'file']) }}
                            @if($errors->first('image'))
                              <span class="help-block red-color">{{ $errors->first('image') }}</span>
                            @endif
                    </div>

                    <div class="from-group">
                      @if(!empty($user->image))
                        <?php echo HTML::image('uploads/profiles/'.$user->image.'', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'120px', 'height'=>'120px']) ?>
                      @endif
                    </div><br>

                    <div class="form-group">
                      <button type="submit" class="btn btn-info">{{ Lang::get($path.'.save_change') }}</button>
                    </div>
{{ Form::close() }}

{{ Form::open(['route'=>'admin_password', 'files'=>'true', 'class'=>'col-md-6', 'method'=>'POST']) }}

                  <div class="form-group">
                          <label class="control-label">{{ Lang::get($path.'.old_password') }}  : </label>
                          <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                          <input name="old_password" type="password" class="form-control" required>
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
                          <input name="password" type="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="" required>
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
                          <input name="password_confirm" type="password" class="form-control" data-match="#inputPassword" data-match-error="Votre champ n'est pas identique" placeholder="" required>
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



@stop