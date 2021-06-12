<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ url() }}/images/favicon.png" />
    <title>@yield('title')</title>
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/bootstrap-theme.min.css') }}
    {{ HTML::style('fonts/font-awesome/css/font-awesome.css') }}
    {{ HTML::style('css/style.css') }}
    {{ HTML::script('js/jquery-1.11.3.min.js') }}
   
  </head>

<body style="background: #EFEFEF;">



<div class="panel panel-default install">
@yield('content')
</div>


     
     {{ HTML::script('js/bootstrap.min.js') }}
     {{ HTML::script('js/validator/validator.js') }}
</body>
</html>
