<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="author" content="Florent Bezara">
    <meta name="description" content="Espace numérique : Université de Mahajanga">
    <link rel="icon" href="{{ url() }}/images/fste.gif" />
    <title>@yield('title')</title>
    {{ HTML::style('css/bootstrap.css') }}  
    {{ HTML::style('css/bootstrap-theme.min.css') }}
    {{ HTML::style('fonts/font-awesome/css/font-awesome.css') }}
    {{ HTML::script('js/jquery-1.11.3.min.js') }}

    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/style1.css') }}
    {{ HTML::style('css/footer.css') }}
    {{ HTML::style('css/flag-icon-css-master/css/flag-icon.css') }}
    {{ HTML::style('css/flag-icon-css-master/css/flag-icon.min.css') }}
    {{ HTML::style('css/font-awesome-animation.css') }}

  </head>

<body>

<?php $path = Session::get('language'); ?>

<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

        <a href="{{ URL::route('home') }}">{{ HTML::image('images/logo.png', '', ['class'=>'img-responsive img-logo', 'width'=>'210px']) }}</a>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav"></ul>
       
<?php 
$user_id = Auth::user()->id;
$count_messages_nav = Message::where('receiver_id', $user_id)->where('receiver_statu', 0)->where('read', 0)->get();
?>

          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown messages-menu">

                  @if(Auth::user()->is_student)
                <a class="" href="{{ URL::route('student_messages_incoming') }}">
               <i class="fa fa-comments fa-2x  label label-sm btn-default" style="color: #174be6; font-size:14px;"> {{  Lang::get($path.'.incoming_messages') }} @if(count($count_messages_nav) >= 1) <span class="label label-danger">{{ count($count_messages_nav) }}</span> @endif
                </i>
              </a>
          @endif

            <!-- 
                  @if(Auth::user()->is_parent)
                  <a class="btn btn-default btn-sm" href="{{ URL::route('parent_messages_incoming') }}" style="font-size:12px;">
                   <i class="fa fa-envelope-o btn btn-xs btn-default" style="color: #174be6;">{{  Lang::get($path.'.incoming_messages') }} @if(count($count_messages_nav) >= 1) &nbsp;&nbsp;<span class="btn-group badge btn-danger">{{ count($count_messages_nav) }}</span> @endif
                    </i> 
                </a>                  
                @endif -->

          @if(Auth::user()->is_admin)
          <a class="" href="{{ URL::route('admin_messages_incoming') }}">
          <i class="fa fa-comments fa-2x label label-sm btn-default" style="color: #174be6; font-size:14px;"> {{  Lang::get($path.'.messages') }} @if(count($count_messages_nav) >= 1)<span class="label label-danger">{{ count($count_messages_nav) }}</span> @endif
          </i> 
          </a>
          @endif
          @if(Auth::user()->is_teacher)
           <a class="" href="{{ URL::route('teacher_messages_incoming') }}"><i class="fa fa-comments fa-2x label label-sm btn-default" style="color: #174be6; font-size:14px;"> {{  Lang::get($path.'.incoming_messages') }} @if(count($count_messages_nav) >= 1) <span class="label label-danger">{{ count($count_messages_nav) }}</span> @endif
          </i> 
          </a>
           @endif
            </li>

<li class="dropdown messages-menu">          
@if(Auth::user()->is_teacher)
<?php 

$lessons = Lesson::where('teacher_id', $user_id)->orderBy('id', 'desc')->get();

$lessons_array = array();

foreach ($lessons as $lesson) {
   $lessons_array[] = $lesson->id;
}

$count_comments_nav = LessonsComment::where('read', 0)->whereIn('lesson_id', $lessons_array)->get();

?>                    
          <a class="" href="#" data-toggle="modal" data-target="#myModaln"> 
          <i class="fa fa-bell fa-2x label label-sm btn-default" style="color: #174be6;font-size:14px;"> {{  Lang::get($path.'.notifications') }} @if(count($count_comments_nav) >= 1) <span class="label label-danger">{{ count($count_comments_nav) }}</span> @endif
          </i>
          </a>
          @endif
</li>   

@if(Auth::user()->is_student)
<li class="dropdown dropdown-nav">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
<i class="fa fa-bell fa-2x label label-sm btn-default" style="color: #174be6; font-size:14px;"> {{  Lang::get($path.'.notifications') }}
</i> 
<span class="caret"></span></a>
<ul class="dropdown-menu ">
<?php 
$user_id = Auth::user()->id;
$student_count_absences = Absence::where('user_id', $user_id)->where('student_read_stut', 1)->get();
?>
<li role="separator" class="divider"></li>
<li>
  <a class="table-link" href="{{ URL::route('student_absence') }}"><b><i class="fa fa-eye-slash"></i> {{ Lang::get($path.'.absences') }}</b></span>@if(count($student_count_absences) >= 1) &nbsp;<span class="badge red-bg">{{ count($student_count_absences) }}</span> @endif
  </a>
</li>

</ul>
</li>
@endif

@if(Auth::user()->is_admin)
<li class="dropdown dropdown-nav">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
<i class="fa fa-bell fa-2x label label-sm btn-default" style="color: #174be6; font-size:14px;"> {{  Lang::get($path.'.notifications') }}
</i> 
<span class="caret"></span></a>

<ul class="dropdown-menu ">
<?php 
$admin_count_cahier_texte = CahierTexte::where('read', 0)->get();
?>

<li> <a class="table-link" href="{{ URL::route('admin_cahier_texte') }}">
<b><i class="fa fa-book"></i> {{ Lang::get($path.'.cahier_de_texte') }}</b> @if(count($admin_count_cahier_texte) >= 1) &nbsp;&nbsp;<span class="badge red-bg">{{ count($admin_count_cahier_texte) }}</span> @endif</a>
</li>



<?php 
$admin_pedagogiques = Pedagogique::where('read', 0)->get();
?>
<li role="separator" class="divider"></li>
<li> <a class="table-link" href="{{ URL::route('admin_pedagogiques') }}"><b>
<i class="fa fa-archive"></i> {{ Lang::get($path.'.pedagogiques') }}</b></span>@if(count($admin_pedagogiques) >= 1) &nbsp;<span class="badge red-bg">{{ count($admin_pedagogiques) }}</span> @endif  
</a>
</li>



<?php 
$admin_count_reports = Report::where('admin_read_stut', 1)->get();
?>
<li role="separator" class="divider"></li>
<li><a class="table-link" href="{{ URL::route('admin_reports') }}"><b>
<i class="fa fa-asterisk"></i> {{ Lang::get($path.'.reports') }}</b>
@if(count($admin_count_reports) >= 1) &nbsp;<span class="badge green-bg">{{ count($admin_count_reports) }}</span> @endif
</a>
</li>


<?php 
$admin_count_absences = Absence::where('admin_read_stut', 1)->get();
?>
<li role="separator" class="divider"></li>
<li><a class="table-link" href="{{ URL::route('admin_absences') }}"><b><i class="fa fa-eye-slash"></i> {{ Lang::get($path.'.absences') }}</b></span>@if(count($admin_count_absences) >= 1) &nbsp;<span class="badge red-bg">{{ count($admin_count_absences) }}</span> @endif
</a></li>
</ul>
</li>
@endif

<?php 
$fullname = Auth::user()->fullname;
$username = Auth::user()->username;
 ?>
                <li class="dropdown dropdown-nav">
                  <a href="#"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                @if(!empty(Auth::user()->image))

                  @if(Auth::user()->is_student)
                    <?php echo HTML::image('uploads/profiles/students/'.Auth::user()->image.'', '', ['class'=>'img-thumbnail navbar-img']) ?>
                  @endif

                  @if(Auth::user()->is_parent)
                    <?php echo HTML::image('uploads/profiles/parents/'.Auth::user()->image.'', '', ['class'=>'img-thumbnail navbar-img']) ?>
                  @endif

                  @if(Auth::user()->is_teacher)
                    <?php echo HTML::image('uploads/profiles/teachers/'.Auth::user()->image.'', '', ['class'=>'img-thumbnail navbar-img']) ?>
                  @endif

                  @if(Auth::user()->is_admin)
                    @if(!Auth::user()->is_manager)
                    <?php echo HTML::image('uploads/profiles/'.Auth::user()->image.'', '', ['class'=>'img-circle navbar-img']) ?>
                    @endif

                    @if(Auth::user()->is_manager)
                    <?php echo HTML::image('uploads/profiles/managers/'.Auth::user()->image.'', '', ['class'=>'img-thumbnail navbar-img']) ?>
                    @endif
                  @endif

                @else
                  {{ HTML::image('uploads/profiles/user.png', '', ['class'=>'img-circle navbar-img']) }}
                @endif 

                @if(!empty($fullname)){{ $fullname }} @else {{ $username }} @endif <span class="caret"></span></a>

<ul class="dropdown-menu ">
                                 
@if(Auth::user()->is_student)
<li><a href="{{ URL::route('student_edit_profile') }}"><i class="fa fa-user"></i> {{ Lang::get($path.'.profile') }} <i class="fa fa-circle" style="color: #15e428;font-size:10px;"></a></i></li>
@endif

@if(Auth::user()->is_parent)
<li><a href="{{ URL::route('parent_edit_profile') }}">{{ Lang::get($path.'.profile') }} <i class="glyphicon glyphicon-user"></i></a></li>
@endif

@if(Auth::user()->is_teacher)
<li><a href="{{ URL::route('teacher_edit_profile') }}"><i class="fa fa-ellipsis-v"></i> {{ Lang::get($path.'.profile') }} <i class="fa fa-circle" style="color: #15e428;font-size:10px;"></i></a></li>
@endif

@if(Auth::user()->is_teacher)
  <li><a href="#" target="_blank"><i class="fa fa-ellipsis-v"></i> {{ Lang::get($path.'.webmail') }} <i class="fa fa-envelope" style="color: blue;"></i></a></li>
@endif

@if(Auth::user()->is_admin)

  @if(!Auth::user()->is_manager)
  <li><a href="{{ URL::route('admin_settings') }}"><i class="fa fa-gear"></i> {{ Lang::get($path.'.settings') }}</a></li>
  @endif

  @if(Auth::user()->is_manager)
  <li><a href="{{ URL::route('manager_edit_profile') }}"><i class="fa fa-ellipsis-v"></i> {{ Lang::get($path.'.profile') }} <i class="fa fa-circle" style="color: #15e428;font-size:10px;"></i></a></li>
  @endif

   @if(Auth::user()->is_manager)
    <?php $administration = User::where('is_admin', true)->first(); ?>
  <li><a href="{{ URL::route('a_contact', $administration->id ) }}"><i class="fa fa-ellipsis-v"></i> {{ Lang::get($path.'.contact_administration') }} <i class="fa fa-user" style="color: blue;"></i></a></li>
  @endif

  @if(Auth::user()->is_manager)
  <li><a href="#" target="_blank"><i class="fa fa-ellipsis-v"></i> {{ Lang::get($path.'.webmail') }} <i class="fa fa-envelope" style="color: blue;"></i></a></li>
  @endif


@endif

<li><a href="{{ URL::route('users.logout') }}"><i class="fa fa-power-off" style="color:red; font-weight: bold;"></i> {{ Lang::get($path.'.logout') }}</a></li>

          </ul>

        </div><!--/.nav-collapse -->
      </div>
    </nav>
<!-- #Header Starts -->


<div class="clear"></div>

<div class="container-fluid">


@if(Auth::user()->is_teacher)

<!-- Modal -->
<div class="modal fade" id="myModaln" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{  Lang::get($path.'.notifications') }}</h4>
      </div>
      <div class="modal-body">

<?php 

$comments_array = array();

foreach ($count_comments_nav as $comment_nav) {
   $comments_array[] = $comment_nav->lesson_id;
}

$lessons_notifications = Lesson::whereIn('id', $comments_array)->get();

?>

@foreach($lessons_notifications as $lesson_notifications)


<table class="table">
    
      <tbody>
        <tr class="active">
          <th><a class="table-link" href="{{ URL::route('teacher_lesson_show', $lesson_notifications->id) }}">{{ $lesson_notifications->title }} ..</a><br></th>
        </tr>
      </tbody>
    </table>

@endforeach

      </div>

    </div>
  </div>
</div>

@endif

@yield('content')


</div>

      {{ HTML::script('js/bootstrap.min.js') }}
      {{ HTML::script('js/validator/validator.js') }}

<div class="clear"><br><br><br><br></div>
<div class="copyright">
  <div class="container">
    <div class="col-md-6">
      <p>© 2017 - Université de Mahajanga | DTIC | Tous droit réservés .</p>
    </div>
    <div class="col-md-6">
      <ul class="bottom_ul">
         <li><a href="{{ URL::to('/lang?set=fr') }}"><span class="flag-icon flag-icon-fr"></span> {{ Lang::get($path.'.francais') }}</a></li>
                    
          <li><a href="{{ URL::to('/lang?set=en') }}"><span class="flag-icon flag-icon-gb"></span> {{ Lang::get($path.'.english') }}</a></li>

          <li><a href="#"><span class="fa fa-code"></span> Developpeur</a></li>

      </ul>
    </div>
  </div>
</div>  
<style>
<!--
.ms-grid8-main { border-left-style: none; border-right: .75pt solid navy; 
               border-top: .75pt solid navy; border-bottom: .75pt solid navy; 
               background-color: white }
.ms-grid8-tl { font-weight: bold; color: white; border-left: .75pt solid navy; 
               border-right-style: none; border-top-style: none; 
               border-bottom: .75pt solid navy; background-color: navy }
.ms-grid8-left { font-weight: normal; color: black; border-left: .75pt solid navy; 
               border-right-style: none; border-top-style: none; 
               border-bottom: .75pt solid navy; background-color: white }
.ms-grid8-top { font-weight: bold; color: white; border-left: .75pt solid navy; 
               border-right-style: none; border-top-style: none; 
               border-bottom: .75pt solid navy; background-color: navy }
.ms-grid8-even { font-weight: normal; color: black; border-left: .75pt solid navy; 
               border-right-style: none; border-top-style: none; 
               border-bottom: .75pt solid navy; background-color: white }

</style>
</body>
</html>
