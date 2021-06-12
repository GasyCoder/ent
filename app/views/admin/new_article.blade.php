@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.new_article') }} @stop

@section('content')

<div class="panel panel-default panel-main">
   <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('admin_articles') }}">{{ Lang::get($path.'.articles') }}</a></li>
    <li class="active">{{ Lang::get($path.'.new_article') }}</li>
  </ol>
  <div class="clear"></div><hr>


        {{ Form::open(['route'=>'store_article', 'files'=>'true', 'class'=>'col-md-10 col-md-offset-1'])  }}

       

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
                {{ Form::text('title', '', ['class'=>'form-control input-lg']) }}
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('title'))
                  <span class="help-block red-color">{{ $errors->first('title') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.category') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
                  <select name="category_id" class="form-control input-lg">

                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    @foreach($categories as $categorie)
                      <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                    @endforeach
                    
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('category_id'))
                  <span class="help-block red-color">{{ $errors->first('category_id') }}</span>
                  @endif
              </div>


              <div class="form-group" >
                  <label class="control-label">{{ Lang::get($path.'.image') }} : </label>
                  {{ Form::file('image', ['class'=>'btn btn-default', 'id'=>'file']) }}

                    @if($errors->first('image'))
                      <span class="help-block red-color">{{ $errors->first('image') }}</span>
                    @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.content') }}  : </label>
          
                  {{ Form::textarea('content', '', ['id'=>'elm1', 'class'=>'form-control', 'rows'=>'7']) }}
             
                @if($errors->first('content'))
                  <span class="help-block red-color">{{ $errors->first('content') }}</span>
                  @endif
              </div>


            <div class="form-group">
              {{ Form::submit(Lang::get($path.'.publish') , ['class'=>'btn btn-info btn-block input-lg']) }} 
            </div>


              {{ Form::close() }}

  
  </div>
</div>


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