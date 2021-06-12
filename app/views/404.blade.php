@extends('layouts.master')

<?php $control = Control::find(1); ?>
<?php $path = Session::get('language'); ?>


@section('metaTages') 
<meta name="keywords" content="{{ $control->keywords }}">
<meta name="description" content="{{ $control->description }}">
@stop

@section('title') Error 404 @stop

@section('content')

<ol class="breadcrumb link-map">
  <li><a href="{{ URL::route('home') }}">{{ Lang::get($path.'.Home') }}</a></li>
  <li class="active">Error 404</li>
</ol>

<div class="articles">

  <div class="single">

  	 <div class="panel panel-default">
        <div class="panel-body">
  	        <h3>Error 404</h3>
  	        <div class="clear"></div>
      	</div>
      </div>

      <div class="panel panel-default bord">
        <div class="panel-body">

        	Page not found


          
        </div>
      </div>

  </div>  

</div>

@stop