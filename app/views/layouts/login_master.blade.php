<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('metaTages')
    <link rel="icon" href="{{ url() }}/images/favicon.png" />
    <title>@yield('title')</title>
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/bootstrap-theme.min.css') }}
    {{ HTML::style('fonts/font-awesome/css/font-awesome.css') }}
    {{ HTML::style('css/style.css') }}
    {{ HTML::script('js/jquery-1.11.3.min.js') }}

    @if(Session::get('language') == 'ar')
      {{ HTML::style('css/bootstrap-rtl.min.css') }}
      {{ HTML::style('css/rtl.css') }}
    @endif
    
  </head>

<body style="background: #f2f2f2 url('{{ url() }}/images/bg.png');">

<?php $control = Control::find(1); ?>
<?php $path = Session::get('language'); ?>
<div class="top-bar navbar">
<div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div> 

    <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="false">
        
        @if(Session::get('language') == 'ar') 
        <ul class="nav navbar-nav contact-info navbar-right"> @else <ul class="nav navbar-nav contact-info navbar-left"> @endif
        
          <li><i class="fa fa-envelope"></i> {{ $control->email }} | </li>
          <li><i class="glyphicon glyphicon-phone"></i> {{ $control->phone }}</li>
        </ul>


        @if(Session::get('language') == 'ar') 
        <ul class="nav navbar-nav navbar-left"> @else <ul class="nav navbar-nav navbar-right"> @endif
        
          @if (Auth::check()) 
            @if(Auth::user()->is_admin)
              <li class="center"><a href="{{ URL::route('panel.admin') }}"><span class="fa fa-dashboard "></span> {{ Lang::get($path.'.Control_Panel') }}</a></li>
              <li class="center"><a href="{{ URL::route('users.logout') }}"><span class="glyphicon glyphicon-log-out"></span>  {{ Lang::get($path.'.logout') }}</a></li>
            @endif
            @if(Auth::user()->is_student)
              <li class="center"><a href="{{ URL::route('student_panel') }}"><span class="fa fa-dashboard "></span> {{ Lang::get($path.'.Control_Panel') }}</a></li>
              <li class="center"><a href="{{ URL::route('users.logout') }}"><span class="glyphicon glyphicon-log-out"></span>  {{ Lang::get($path.'.logout') }}</a></li>
            @endif
            @if(Auth::user()->is_teacher)
              <li class="center"><a href="{{ URL::route('teacher_panel') }}"><span class="fa fa-dashboard "></span> {{ Lang::get($path.'.Control_Panel') }}</a></li>
              <li class="center"><a href="{{ URL::route('users.logout') }}"><span class="glyphicon glyphicon-log-out"></span>  {{ Lang::get($path.'.logout') }}</a></li>
            @endif
            @if(Auth::user()->is_parent)
             <li class="center"><a href="{{ URL::route('parent_panel') }}"><span class="fa fa-dashboard "></span> {{ Lang::get($path.'.Control_Panel') }}</a></li>
             <li class="center"><a href="{{ URL::route('users.logout') }}"><span class="glyphicon glyphicon-log-out"></span>  {{ Lang::get($path.'.logout') }}</a></li>
            @endif
          @else 
          
          <li class="center"><a href="{{ URL::route('users_register') }}"><span class="fa fa-user"></span> {{ Lang::get($path.'.register') }}</a></li>

            <li class="center"><a href="{{ URL::route('users.login') }}"><span class="glyphicon glyphicon-lock"></span> {{ Lang::get($path.'.login') }}</a></li>
          @endif

        </ul>
        
    </div>
  

</div>
</div>

<div class="clear"></div>



<div class="clear"></div>

<div class="navbar navbar-default" style="margin-bottom: 0px;">
<div class="container-fluid"> 
 
    <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav navbar-nav navbar-left">
          <a href="{{ URL::route('home') }}">{{ HTML::image('images/logo.png', '', ['class'=>'img-responsive img-logo', 'width'=>'250px']) }}</a>
        </div>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">

    @if(Session::get('language') == 'ar') 
      <ul class="nav navbar-nav navbar-left center" style="margin-top: 8px; margin-right: 10px;"> 
    @else <ul class="nav navbar-nav navbar-right center" style="margin-top: 8px; margin-right: 10px;"> @endif
      
     <?php $pages = Page::orderBy('id', 'desc')->get(); ?> 
      @foreach($pages as $page)
        <li><a href="{{ URL::route('page', ['id'=>$page->id, 'slug'=>$page->slug]) }}"> <span class="fa fa-folder"></span> {{ $page->name }}</a></li> 
      @endforeach 
     <li><a href="{{ URL::route('contact') }}"><span class="fa fa-envelope"></span> CONTACTEZ-NOUS</a></li>
      </ul>
    </div>

</div>
</div>

<div class="clear"></div>


<div class="container-fluid">

    <div class="col-md-12">
      @yield('content')
    </div>

</div>




     
     {{ HTML::script('js/bootstrap.min.js') }}
     {{ HTML::script('js/validator/validator.js') }}
</body>
</html>
