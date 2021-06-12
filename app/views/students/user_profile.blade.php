@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ $user->fullname }} @stop

@section('content')

  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @if($user->is_teacher)
      <li><a href="{{ URL::route('student_teachers') }}">{{ Lang::get($path.'.teachers') }}</a></li>
    @endif
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

                  @if($user->is_teacher)
                    @if(!empty($user->image))
                    <?php echo HTML::image('uploads/profiles/teachers/'.$user->image.'', '', ['class'=>'img-thumbnail img-responsive']) ?>
                    @else
                      {{ HTML::image('uploads/profiles/teacher.jpg', '', ['class'=>'img-thumbnail img-responsive']) }}
                    @endif
                  @endif

                </div>
                
    
                <div class=" col-md-9 col-lg-9"> 
                  <table class="table table-user-information">
                    <tbody>

                      <tr>
                        <td>{{ Lang::get($path.'.fullname') }} :</td>
                        <td class="td_details">{{ $user->fullname }}</td>
                      </tr>

@if($user->is_teacher)
                      <tr>
                        <td>{{ Lang::get($path.'.grade') }} :</td>
                        <td class="td_details">{{ $user->grade }}</td>
                      </tr>

                      <tr>
                        <td>{{ Lang::get($path.'.matricule') }} :</td>
                        <td class="td_details">{{ $user->matricule }}</td>
                      </tr>

                      <tr>
                        <td>{{ Lang::get($path.'.position') }} :</td>
                        <td class="td_details">{{ $user->position }}</td>
                      </tr>

                      <tr>
                        <td>{{ Lang::get($path.'.etat_civil') }} :</td>
                        <td class="td_details">{{ $user->etat_civil }}</td>
                      </tr>
@endif             
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
            <div class="panel-footer">
              <a href="" class="btn btn-sm btn-default"><i class="fa fa-print"></i></a>
              <a href="{{ URL::route('s_contact', $user->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-envelope"></i></a>
            </div>
            
          </div>

  </div>
     



  </div>
</div>

@stop