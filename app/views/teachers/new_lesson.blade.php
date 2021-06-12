@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.new_lesson') }} @stop

@section('content')


<div class="panel panel-default panel-main">
<br><br><br><br>
  <div class="panel-body">
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('teacher_lessons') }}">{{ Lang::get($path.'.lessons') }}</a></li>
    <li class="active">{{ Lang::get($path.'.new_lesson') }}</li>
  </ol>
  <div class="clear"></div><hr>


        {{ Form::open(['route'=>'teacher_lesson_store', 'files'=>'true', 'class'=>'col-md-10 col-md-offset-1', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

       

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

      
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.title') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                {{ Form::text('title', '', ['class'=>'form-control input-lg', 'required'=>'required']) }}
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('title'))
                  <span class="help-block red-color">{{ $errors->first('title') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.subject') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                <select name="subject_id" class="form-control input-lg" required>
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    @foreach($subjects as $subject)
                      <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>


              <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.class') }}  : </label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                    <select name="class_id" id="class" class="form-control  input-lg" required>
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                        @foreach($classes as $class)
                          <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach

                    </select>
                  </div>
              </div>




              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.mentions') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <select name="mention" class="form-control input-lg">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    <optgroup label="LICENCE">
                    <option value="SVTE">SVTE</option>
                    <option value="SMS">SMS</option>
                    </optgroup>
                    <optgroup label="MASTER">
                    <option value="SVE">SVE</option>
                    <option value="STE">STE</option>
                    <option value="BSE">BSE</option>
                    <option value="SMS">SMS</option>
                    </optgroup>
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('mention'))
                  <span class="help-block red-color">{{ $errors->first('mention') }}</span>
                  @endif
              </div>


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.parcour') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-book"></i></span>
                  <select name="parcour" class="form-control input-lg">
                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    <optgroup label="LICENCE">
                    <option value="SVE">SVE</option>
                    <option value="STE">STE</option>
                    <option value="BSE">BSE</option>
                    <option value="Physique">Physique</option>
                    <option value="Chimie">Chimie</option>
                    </optgroup>
                    <optgroup label="MASTER">
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

                    </optgroup>
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('parcour'))
                  <span class="help-block red-color">{{ $errors->first('parcour') }}</span>
                  @endif
              </div>

              

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.content') }}  : </label>
          
                  {{ Form::textarea('content', '', ['id'=>'elm1', 'class'=>'form-control', 'rows'=>'6']) }}
             
                @if($errors->first('content'))
                  <span class="help-block red-color">{{ $errors->first('content') }}</span>
                  @endif
              </div>

              <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.Attached_File') }} : </label>
                  {{ Form::file('file[]', ['class'=>'btn btn-default', 'id'=>'file', 'multiple'=>'multiple']) }}

                    @if($errors->first('file'))
                      <span class="help-block red-color">{{ $errors->first('file') }}</span>
                    @endif

                    <span class="help-block">{{ Lang::get($path.'.Permitted_files') }} : doc, docx, ppt, pptx, pdf</span>

              </div>


            <div class="form-group">
              {{ Form::submit(Lang::get($path.'.publish'), ['class'=>'btn btn-info btn-block input-lg']) }} 
            </div>

              {{ Form::close() }}

  
  </div>
</div>


<script type="text/javascript">
  $('#myForm').validator();
</script>




{{ HTML::script('js/tinymce/tinymce.min.js') }}

<script>
  tinymce.init({

    relative_urls : false,
    remove_script_host : false,
    convert_urls : true,

    selector: "textarea#elm1",
    theme: "modern",

    plugins: [
      "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
      "save table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker codesample"
    ],
    content_css: "css/development.css",
    add_unload_trigger: false,
    autosave_ask_before_unload: false,

    toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
    toolbar2: "cut copy paste pastetext | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media help code | insertdatetime preview | forecolor backcolor",
    toolbar3: "table | emoticons",
    
    menubar: false,
    toolbar_items_size: 'small',

    style_formats: [
      {title: 'Bold text', inline: 'b'},
      {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
      {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
      {title: 'Example 1', inline: 'span', classes: 'example1'},
      {title: 'Example 2', inline: 'span', classes: 'example2'},
      {title: 'Table styles'},
      {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ],

    templates: [
      {title: 'My template 1', description: 'Some fancy template 1', content: 'My html'},
      {title: 'My template 2', description: 'Some fancy template 2', url: 'development.html'}
    ],

        spellchecker_callback: function(method, data, success) {
      if (method == "spellcheck") {
        var words = data.match(this.getWordCharPattern());
        var suggestions = {};

        for (var i = 0; i < words.length; i++) {
          suggestions[words[i]] = ["First", "second"];
        }

        success({words: suggestions, dictionary: true});
      }

      if (method == "addToDictionary") {
        success();
      }
    }
  });

 
</script>


@stop