@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@if(Auth::user()->is_admin)
  @section('title') {{ Lang::get($path.'.Control_Panel') . ' - ' . Lang::get($path.'.admin') }} @stop
@endif

@if(Auth::user()->is_student)
  @section('title') {{ Lang::get($path.'.Control_Panel') . ' - ' . Lang::get($path.'.student') }} @stop
@endif

@if(Auth::user()->is_teacher)
  @section('title') {{ Lang::get($path.'.Control_Panel') . ' - ' . Lang::get($path.'.teacher') }} @stop
@endif  

@if(Auth::user()->is_manager)
  @section('title') {{ Lang::get($path.'.Control_Panel') . ' - ' . Lang::get($path.'.manager') }} @stop
@endif

@section('content')

@if(Auth::check())
<br><br><br><br>
<div class="panel-main fixed-top">
@if(Auth::user()->is_admin)
@if(!Auth::user()->is_manager)
  <div class="col-md-12" id="status">
        <div class="row" >
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="{{ URL::route('home') }}#articles">
                                <div class="circle-tile-heading purple">
                                    <i class="fa fa-bullhorn fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content purple">
                                <div class="circle-tile-description text-faded">  
                                  <div class="title">{{ Lang::get($path.'.article') }}</div>       
                                </div>
                                <div class="circle-tile-number text-faded">
                                    <div class="count">{{ count($articles) }}</div>
                                    <span id="sparklineA"></span>
                                </div>
                                <a href="{{ URL::route('home') }}#articles" class="circle-tile-footer">{{ Lang::get($path.'.moreinfo') }} <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="{{ URL::route('admin_students') }}">
                                <div class="circle-tile-heading blue">
                                    <i class="fa fa-graduation-cap fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content blue">
                                <div class="circle-tile-description text-faded">
                                  <div class="title">{{ Lang::get($path.'.student') }}</div>     
                                </div>
                                <div class="circle-tile-number text-faded">
                                <div class="count" style="">{{ count($students) }}</div>
                                </div>
                                <a href="{{ URL::route('admin_students') }}" class="circle-tile-footer">{{ Lang::get($path.'.moreinfo') }} <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="{{ URL::route('admin_teachers') }}">
                                <div class="circle-tile-heading red">
                                    <i class="fa fa-users fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content red">
                                <div class="circle-tile-description text-faded">
                                 <div class="title">{{ Lang::get($path.'.teacher') }}</div>
                                </div>
                                <div class="circle-tile-number text-faded">
                                 <div class="count" style="">{{ count($teachers) }}</div>
                                </div>
                                <a href="{{ URL::route('admin_teachers') }}" class="circle-tile-footer">{{ Lang::get($path.'.moreinfo') }} <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="{{ URL::route('admin_managers') }}">
                                <div class="circle-tile-heading green">
                                    <i class="fa fa-university fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content green">
                                <div class="circle-tile-description text-faded">
                                  <div class="title">{{ Lang::get($path.'.managers') }}</div>
                                </div>
                                <div class="circle-tile-number text-faded">
                                  <div class="count" style="">{{ count($managers) }}</div>
                                    <span id="sparklineB"></span>
                                </div>
                               <a href="{{ URL::route('admin_managers') }}" class="circle-tile-footer">{{ Lang::get($path.'.moreinfo') }} <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="{{ URL::route('admin_pages') }}">
                                <div class="circle-tile-heading orange">
                                    <i class="fa fa-tasks fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content orange">
                                <div class="circle-tile-description text-faded">
                                    <div class="title">{{ Lang::get($path.'.pages_manger') }}</div>
                                </div>
                                <div class="circle-tile-number text-faded">
                                  <div class="count" style="">{{ count($pages) }}</div>
                                    <span id="sparklineC"></span>
                                </div>
                                <a href="{{ URL::route('admin_pages') }}" class="circle-tile-footer">{{ Lang::get($path.'.moreinfo') }} <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="circle-tile">
                            <a href="#">
                                <div class="circle-tile-heading dark-blue">
                                    <i class="fa fa-comments fa-fw fa-3x"></i>
                                </div>
                            </a>
                            <div class="circle-tile-content dark-blue">
                                <div class="circle-tile-description text-faded">
                                    Mentions
                                </div>
                                <div class="circle-tile-number text-faded">
                                    96
                                    <span id="sparklineD"></span>
                                </div>
                              <a href="#" class="circle-tile-footer">{{ Lang::get($path.'.moreinfo') }} <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
               </div>
 @endif

<div class="panel-main">
@if(Auth::user()->is_manager)
<div class="col-md-12" id="status">
     <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="info-box blue-bg">
            <i class="fa fa-bullhorn faa-wrench animated"></i><div class="clear"></div>
            <div class="count">{{ count($articles) }}</div>
            <div class="title">{{ Lang::get($path.'.article') }}</div>            
          </div><!--/.info-box-->     
        </div><!--/.col-->

    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="info-box green-bg">
            <i class="fa fa-graduation-cap faa-bounce animated"></i><div class="clear"></div>
            <div class="count">{{ count($students) }}</div>
            <div class="title">{{ Lang::get($path.'.student') }}</div>           
          </div><!--/.info-box-->     
        </div><!--/.col-->
        
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="info-box red-bg">
            <i class="fa fa-university faa-pulse animated"></i><div class="clear"></div>
            <div class="count">{{ count($teachers) }}</div>
            <div class="title">{{ Lang::get($path.'.teacher') }}</div>            
          </div><!--/.info-box-->     
        </div><!--/.col-->  
        
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="info-box orange-bg">
            <i class="fa fa-flag checkered faa-horizontal animated"></i><div class="clear"></div>
            <div class="count">{{ count($managers) }}</div>
            <div class="title">{{ Lang::get($path.'.managers') }}</div>            
          </div><!--/.info-box-->     
        </div><!--/.col-->
        

</div>


@endif
<div class="clear"></div><br>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
<div class="row url-icons">

    <div class="col-md-3">
      <a href="{{ URL::route('home') }}">
          <div class="link">
            {{ HTML::image('images/icons/home128.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.Home') }}</span>
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('admin_articles') }}">
          <div class="link">
            {{ HTML::image('images/icons/1476216384_document_pencil.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.articles') }}</span>
         </div>
      </a>  
    </div>
@if(!Auth::user()->is_manager)
    <div class="col-md-3">
      <a href="{{ URL::route('admin_pages') }}">
          <div class="link">
            {{ HTML::image('images/icons/pages.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.pages_manger') }}</span>
         </div>
      </a>
    </div>
@endif

@if(!Auth::user()->is_manager)
    <div class="col-md-3">
      <a href="{{ URL::route('admin_managers') }}">
          <div class="link">
            {{ HTML::image('images/icons/1309690678_user3.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.scolarite') }}</span>
         </div>
      </a>
    </div>
@endif

    <div class="col-md-3">
      <a href="{{ URL::route('admin_students') }}">
          <div class="link">
            {{ HTML::image('images/icons/student.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.students') }}</span>
         </div>
      </a>
    </div>


    <div class="col-md-3">
      <a href="{{ URL::route('admin_teachers') }}">
          <div class="link">
            {{ HTML::image('images/icons/1476216712_nerd.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.teachers') }}</span>
         </div>
      </a>
    </div>


    <div class="col-md-3">
      <a href="{{ URL::route('admin_classes') }}">
          <div class="link">
            {{ HTML::image('images/icons/class.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.classes') }}</span>
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('admin_subjects') }}">
          <div class="link">
            {{ HTML::image('images/icons/books.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.subjects') }}</span>
         </div>
      </a>
    </div>

    <!--<div class="col-md-3">
      <a href="{{ URL::route('teacher_register') }}">
          <div class="link">
            {{ HTML::image('images/icons/book.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.check') }}</span>
         </div>
      </a>
    </div>-->

<?php 
$admin_count_absences = Absence::where('admin_read_stut', 1)->get();
?>
    <div class="col-md-3">
      <a href="{{ URL::route('admin_absences') }}">
          <div class="link">
            {{ HTML::image('images/icons/1476216703.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.absences') }}</span>@if(count($admin_count_absences) >= 1) &nbsp;&nbsp;<span class="badge red-bg">{{ count($admin_count_absences) }}</span> @endif
         </div>
      </a>
    </div>

<?php 
$admin_count_reports = Report::where('admin_read_stut', 1)->get();
?>

    <div class="col-md-3">
      <a href="{{ URL::route('admin_reports') }}">
          <div class="link">
            {{ HTML::image('images/icons/1476216487_document.png', '', ['width'=>'80px']) }}
            <div class="clear"></div>
            <span>{{ Lang::get($path.'.reports') }}</span>@if(count($admin_count_reports) >= 1) &nbsp;&nbsp;<span class="badge red-bg">{{ count($admin_count_reports) }}</span> @endif
         </div>
      </a>
    </div>


<?php 
$admin_count_cahier_texte = CahierTexte::where('read', 0)->get();
?>

    <div class="col-md-3">
      <a href="{{ URL::route('admin_cahier_texte') }}">
          <div class="link">
            {{ HTML::image('images/icons/notepad.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.cahier_de_texte') }}</span>@if(count($admin_count_cahier_texte) >= 1) &nbsp;&nbsp;<span class="badge red-bg">{{ count($admin_count_cahier_texte) }}</span> @endif
         </div>
      </a>
    </div>

<?php 
$admin_pedagogiques = Pedagogique::where('read', 0)->get();
?>

    <div class="col-md-3">
      <a href="{{ URL::route('admin_pedagogiques') }}">
          <div class="link">
            {{ HTML::image('images/icons/126.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.pedagogiques') }}</span>@if(count($admin_pedagogiques) >= 1) &nbsp;&nbsp;<span class="badge red-bg">{{ count($admin_pedagogiques) }}</span> @endif
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('emploi_du_temps') }}">
          <div class="link">
            {{ HTML::image('images/icons/timedate_cpl_7.png', '', ['width'=>'80px']) }}
            <div class="clear"></div>
            <span>{{ Lang::get($path.'.emploi_du_temps') }}</span>
         </div>
      </a>
    </div>


    <div class="col-md-3">
      <a href="{{ URL::route('admin_library') }}">
          <div class="link">
            {{ HTML::image('images/icons/library128.png', '', ['width'=>'80px']) }}
            <div class="clear"></div>
            <span>{{ Lang::get($path.'.library') }}</span>
         </div>
      </a>
    </div>


    <div class="col-md-3">
      <a href="{{ URL::route('annuaire_teachers') }}">
          <div class="link">
            {{ HTML::image('images/icons/Contacts2.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.annuaire') }}</span>
         </div>
      </a>
    </div>


<?php 
$user_id = Auth::user()->id;
$admin_count_messages = Message::where('receiver_id', $user_id)->where('receiver_statu', 0)->where('read', 0)->get();
?>

    <div class="col-md-3">
      <a href="{{ URL::route('admin_messages_incoming') }}">
          <div class="link">
            {{ HTML::image('images/icons/new-message64.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.incoming_messages') }}</span>@if(count($admin_count_messages) >= 1) &nbsp;&nbsp;<span class="badge red-bg">{{ count($admin_count_messages) }}</span> @endif
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('admin_messages_outgoing') }}">
          <div class="link">
            {{ HTML::image('images/icons/message-already-read64.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.outgoing_messages') }}</span>
         </div>
      </a>
    </div>

@if(!Auth::user()->is_manager)
    <div class="col-md-3">
      <a href="{{ URL::route('admin_transport') }}" class="" tabindex="">
          <div class="link">
            {{ HTML::image('images/icons/bus.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.transport_scolaire') }}</span>
         </div>
      </a>
    </div>
@endif

    <div class="col-md-3">
      <a href="{{ URL::route('admin_payments') }}">
          <div class="link">
            {{ HTML::image('images/icons/1305242219.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.payments') }}</span>
         </div>
      </a>
    </div>

@if(!Auth::user()->is_manager)
    <div class="col-md-3">
      <a href="{{ URL::route('admin_users_data') }}">
          <div class="link">
            {{ HTML::image('images/icons/basic-data128.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.export_import_data') }}</span>
         </div>
      </a>
    </div>
@endif

@if(!Auth::user()->is_manager)
    <div class="col-md-3">
      <a href="{{ URL::route('admin_data') }}">
          <div class="link">
            {{ HTML::image('images/icons/39-128.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.data_semestre') }}</span>
         </div>
      </a>
    </div>
@endif
 

</div>

@endif



                                                  <!-- Session Students -->

@if(Auth::user()->is_student)

<div class="row url-icons">

    <div class="col-md-3">
      <a href="{{ URL::route('home') }}">
          <div class="link">
            {{ HTML::image('images/icons/home128.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.Home') }}</span>
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('student_subjects') }}">
          <div class="link">
            {{ HTML::image('images/icons/books.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.subject') }}</span>
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('student_teachers') }}">
          <div class="link">
            {{ HTML::image('images/icons/1476216712_nerd.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.teachers') }}</span>
         </div>
      </a>
    </div>

<?php 
$user_id = Auth::user()->id;
$student_count_absences = Absence::where('user_id', $user_id)->where('student_read_stut', 1)->get();
?>

    <div class="col-md-3">
      <a href="{{ URL::route('student_absence') }}">
          <div class="link">
            {{ HTML::image('images/icons/1476216703.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.absences') }}</span>@if(count($student_count_absences) >= 1) &nbsp;&nbsp;<span class="badge red-bg">{{ count($student_count_absences) }}</span> @endif
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('student_exams') }}">
          <div class="link">
            {{ HTML::image('images/icons/1305214346_preferences-system-time.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.exams_times') }}</span>
         </div>
      </a>
    </div>

<?php 
$user_id = Auth::user()->id;
$student_count_marks = Marks::where('student_id', $user_id)->where('student_read_stut', 1)->get();
?>

    <div class="col-md-3">
      <a href="{{ URL::route('student_marks') }}">
          <div class="link">
            {{ HTML::image('images/icons/exam.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.exams_marks') }}</span>@if(count($student_count_marks) >= 1) &nbsp;&nbsp;<span class="badge red-bg">{{ count($student_count_marks) }}</span> @endif
         </div>
      </a>
    </div>


<?php 
$user_id = Auth::user()->id;
$student_count_messages = Message::where('receiver_id', $user_id)->where('receiver_statu', 0)->where('read', 0)->get();
?>

    <div class="col-md-3">
      <a href="{{ URL::route('student_messages_incoming') }}">
          <div class="link">
            {{ HTML::image('images/icons/new-message64.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.incoming_messages') }}</span>@if(count($student_count_messages) >= 1) &nbsp;&nbsp;<span class="badge red-bg">{{ count($student_count_messages) }}</span> @endif
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('student_messages_outgoing') }}">
          <div class="link">
            {{ HTML::image('images/icons/message-already-read64.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.outgoing_messages') }}</span>
         </div>
      </a>
    </div>
    

    <div class="col-md-3">
      <a href="{{ URL::route('student_lessons') }}">
          <div class="link">
            {{ HTML::image('images/icons/course_t.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.lessons') }}</span>
         </div>
      </a>
    </div>


    <div class="col-md-3">
      <a href="{{ URL::route('student_emploi_du_temps') }}">
          <div class="link">
            {{ HTML::image('images/icons/timedate_cpl_7.png', '', ['width'=>'80px']) }}
            <div class="clear"></div>
            <span>{{ Lang::get($path.'.emploi_du_temps') }}</span>
         </div>
      </a>
    </div>
    

    <div class="col-md-3">
      <a href="{{ URL::route('student_library') }}">
          <div class="link">
            {{ HTML::image('images/icons/library128.png', '', ['width'=>'80px']) }}
            <div class="clear"></div>
            <span>{{ Lang::get($path.'.library') }}</span>
         </div>
      </a>
    </div>


    <!--<div class="col-md-3">
      <a href="{{ URL::route('student_transport') }}">
          <div class="link">
            {{ HTML::image('images/icons/bus.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.transport_scolaire') }}</span>
         </div>
      </a>
    </div>-->

    <div class="col-md-3">
      <a href="{{ URL::route('student_payments') }}">
          <div class="link">
            {{ HTML::image('images/icons/1305242219.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.payments') }}</span>
         </div>
      </a>
    </div>


    <!--<div class="col-md-3">
      <a href="{{ URL::route('student_edit_profile') }}">
          <div class="link">
            {{ HTML::image('images/icons/1476216378_user_info.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.edit_profile') }}</span>
         </div>
      </a>
    </div>-->

</div>
@endif







                                                <!-- Session teacher -->



@if(Auth::user()->is_teacher)

<div class="row url-icons">

    <div class="col-md-3">
      <a href="{{ URL::route('home') }}">
          <div class="link">
            {{ HTML::image('images/icons/home128.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.Home') }}</span>
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('teacher_subjects') }}">
          <div class="link">
            {{ HTML::image('images/icons/book.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.class_subject') }}</span>
         </div>
      </a>
    </div>



   <!--<div class="col-md-3">
      <a href="{{ URL::route('teacher_register') }}">
          <div class="link">
            {{ HTML::image('images/icons/book.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.check') }}</span>
         </div>
      </a>
    </div>-->



    <div class="col-md-3">
      <a href="{{ URL::route('teacher_pedagogiques') }}">
          <div class="link">
            {{ HTML::image('images/icons/126.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.pedagogiques') }}</span>
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('teacher_emploi_du_temps') }}">
          <div class="link">
            {{ HTML::image('images/icons/timedate_cpl_7.png', '', ['width'=>'80px']) }}
            <div class="clear"></div>
            <span>{{ Lang::get($path.'.emploi_du_temps') }}</span>
         </div>
      </a>
    </div>


    <div class="col-md-3">
      <a href="{{ URL::route('teacher_lessons') }}">
          <div class="link">
            {{ HTML::image('images/icons/1476216692_education_course_training.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.lessons') }}</span>
         </div>
      </a>
    </div>


    <div class="col-md-3">
      <a href="{{ URL::route('teacher_cahier_texte') }}">
          <div class="link">
            {{ HTML::image('images/icons/notepad.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.cahier_de_texte') }}</span>
         </div>
      </a>
    </div>

     <div class="col-md-3">
      <a href="{{ URL::route('teacher_exams') }}">
          <div class="link">
            {{ HTML::image('images/icons/1305214346_preferences-system-time.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.exams_times') }}</span>
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('teacher_marks') }}">
          <div class="link">
            {{ HTML::image('images/icons/exam.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.exams_marks') }}</span>
         </div>
      </a>
    </div>


    <div class="col-md-3">
      <a href="{{ URL::route('teacher_absence') }}">
          <div class="link">
            {{ HTML::image('images/icons/1476216384_document_pencil.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.absence_registration') }}</span>
         </div>
      </a>
    </div>


    <div class="col-md-3">
      <a href="{{ URL::route('teacher_students') }}">
          <div class="link">
            {{ HTML::image('images/icons/student.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.students') }}</span>
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('teacher_scolarite') }}">
          <div class="link">
            {{ HTML::image('images/icons/1309690678_user3.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.scolarite') }}</span>
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('teacher_library') }}">
          <div class="link">
            {{ HTML::image('images/icons/library128.png', '', ['width'=>'80px']) }}
            <div class="clear"></div>
            <span>{{ Lang::get($path.'.library') }}</span>
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('t_annuaire_teachers') }}">
          <div class="link">
            {{ HTML::image('images/icons/icons8-Contacts-64.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.t_annuaire') }}</span>
         </div>
      </a>
    </div>

   
<?php 
$user_id = Auth::user()->id;
$teacher_count_messages = Message::where('receiver_id', $user_id)->where('receiver_statu', 0)->where('read', 0)->get();
?>


    <div class="col-md-3">
      <a href="{{ URL::route('teacher_messages_incoming') }}">
          <div class="link">
            {{ HTML::image('images/icons/new-message64.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.incoming_messages') }}</span>@if(count($teacher_count_messages) >= 1) &nbsp;&nbsp;<span class="badge red-bg">{{ count($teacher_count_messages) }}</span> @endif
         </div>
      </a>
    </div>

    <div class="col-md-3">
      <a href="{{ URL::route('teacher_messages_outgoing') }}">
          <div class="link">
            {{ HTML::image('images/icons/message-already-read64.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.outgoing_messages') }}</span>
         </div>
      </a>
    </div>
    

    <!--<<?php $administration = User::where('is_admin', true)->first(); ?>
    div class="col-md-3">
      <a href="{{ URL::route('t_contact', $administration->id ) }}">
          <div class="link">
            {{ HTML::image('images/icons/school.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.contact_administration') }}</span>
         </div>
      </a>
    </div>-->

    <div class="col-md-3">
      <a href="{{ URL::route('teacher_edit_profile') }}">
          <div class="link">
            {{ HTML::image('images/icons/1476216378_user_info.png', '', ['width'=>'80px']) }}
            <div class="clear"></div><span>{{ Lang::get($path.'.edit_profile') }}</span>
         </div>
      </a>
    </div>
</div>
@endif
</div>
</div>
</div>

</div>   
@endif 


@stop