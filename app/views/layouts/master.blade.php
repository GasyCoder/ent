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
        <li><a href="{{ URL::route('page', ['id'=>$page->id, 'slug'=>$page->slug]) }}"><span class="fa fa-folder"></span> {{ $page->name }}</a></li> 
      @endforeach 
    <li><a href="{{ URL::route('contact') }}"><span class="fa fa-envelope"></span> CONTACTEZ-NOUS</a></li>
      </ul>
    </div>

</div>  
</div>

<div class="clear"></div>

@if ($control->marquee_rtl == 1)
    {{ HTML::style('css/marquee_rtl.css') }}

<div class="list-group-item news">
  <div class="row">
    <div class="col-xs-2"><h3 class="btn-block">{{ Lang::get($path.'.last_news') }}</h3></div>
    <div class="col-xs-10 marquee"><p>{{ $control->news }}</p></div>
  </div>
</div>

@else

<div class="list-group-item news">
  <div class="row">
    <div class="col-xs-10 marquee"><p>{{ $control->news }}</p></div>
    <div class="col-xs-2"><h3 class="btn-block">{{ Lang::get($path.'.last_news') }}</h3></div>
  </div>
</div>


@endif


@if ($control->slide == 1)

<?php $slide = DB::table('slide_fste')->where('id', '1')->first(); ?>

<div class="clear"></div>
<div class="slide-hr"></div>

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    @if(!empty($slide->img_1))
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    @endif
    @if(!empty($slide->img_2))
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    @endif
    @if(!empty($slide->img_3))
       <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    @endif
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

    @if(!empty($slide->img_1))
      <div class="item active">
        <a href="{{ $slide->url_1 }}"><img src="{{ $slide->img_1 }}" alt=""></a>
      </div>
    @endif

    @if(!empty($slide->img_2))
      <div class="item">
        <a href="{{ $slide->url_2 }}"><img src="{{ $slide->img_2 }}" alt=""></a>
      </div>
    @endif

    @if(!empty($slide->img_3))
       <div class="item">
        <a href="{{ $slide->url_3 }}"><img src="{{ $slide->img_3 }}" alt=""></a>
      </div>
    @endif

  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="slide-hr"></div>

@endif

<div class="clear"></div>



<div class="main container-fluid">

  <div class="row">

    <div class="col-md-9">
      @yield('content')
    </div>


    <div class="col-md-3">
        <div class="panel panel-default sidebar">
          <div class="panel-body">
            <h5>{{ Lang::get($path.'.Get_in_touch') }} :</h5>
            <div class="clearfix"></div>
            <ul class="social-circle">
                <li><a class="facebook-bg" href="{{ $control->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a class="red-bg" href="{{ $control->youtube }}" target="_blank"><i class="fa fa-youtube"></i></a></li>
                <li><a class="twitter-bg" href="{{ $control->twitter }}" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a class="orange-bg" href="{{ $control->google_plus }}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
             </ul>
            <div class="clearfix"></div>
          </div>
        </div>

<?php $categories = Category::orderBy('id', 'desc')->get(); ?>

@if(count($categories) >= 1)
        <div class="panel panel-default sidebar">
          <div class="panel-body widget">
            <h5>{{ Lang::get($path.'.category') }} :</h5>
            <div class="clearfix"></div>
            <ul>
            @foreach($categories as $categorie)
                <li><a href="{{ URL::route('category', ['id'=>$categorie->id, 'slug'=>$categorie->slug ]) }}">{{ $categorie->name }}</a></li>
            @endforeach 
            </ul>
          </div>
        </div>
@endif

    </div>


  </div>


</div>







<div class="clearfix"></div>

<div class="container-fluid main-footer">

<footer>

<div class="container">

          <div class="row">


            <div class="column col-xs-4 col-md-4">
              <h3 class="center">{{ Lang::get($path.'.contact') }}</h3>
              <address class="font-opensans">
                <ul>
                  <li class="footer-sprite">
                  <i class="fa fa-map-marker"></i> {{ $control->address }}
                  </li>
                  <li class="footer-sprite">
                  <i class="fa fa-phone"></i>  {{ Lang::get($path.'.phone') }}: {{ $control->phone }}
                  </li>
                  <li class="footer-sprite email">
                  <i class="fa fa-envelope"></i>  <a href="mailto:{{ $control->email }}">{{ $control->email }}</a>
                  </li>
                </ul>
              </address>
            </div>


            <div class="column col-xs-4 col-md-4">
              <h3 class="center">{{ Lang::get($path.'.RECENT_POSTS') }}</h3>

<?php $last_articles = Article::orderBy('id', 'desc')->take(3)->get(); ?>

@foreach($last_articles as $last_article)

              <div class="post-item center">
                <small>{{ substr($last_article->created_at, 0, 10) }}</small>
                <h3><a href="{{ URL::route('article', ['id'=>$last_article->id, 'slug'=>$last_article->slug]) }}">{{ $last_article->title }} ..</a></h3>
              </div>

@endforeach             

            </div>


            <div class="column col-xs-4 col-md-4">
              <h3 class="center">{{ Lang::get($path.'.about') }}</h3>
              {{ HTML::image('images/logo592418a0c6970.png', '', ['class'=>'img-responsive']) }}
              <p class="center">{{ mb_substr($control->description, 0, 150, 'utf-8') }} ..</p>
            </div>
 

        </div>

</div>

</footer>

</div>
<div class="clear"></div>
<div class="footer-copy center">
  © 2017 - Université de Mahajanga | DTIC | Created by FLORENT BEZARA | Tous droit réservés.
</div>


     
     {{ HTML::script('js/bootstrap.min.js') }}
     {{ HTML::script('js/validator/validator.js') }}
</body>
</html>
