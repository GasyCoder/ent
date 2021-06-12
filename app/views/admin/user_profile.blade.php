@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ $user->fullname }} @stop

@section('content')

   <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb no-print">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @if($user->is_student)
    	<li><a href="{{ URL::route('admin_students') }}">{{ Lang::get($path.'.students') }}</a></li>
    @endif
    @if($user->is_parent)
    	<li><a href="{{ URL::route('admin_parents') }}">{{ Lang::get($path.'.parents') }}</a></li>
    @endif
    @if($user->is_teacher)
    	<li><a href="{{ URL::route('admin_teachers') }}">{{ Lang::get($path.'.teachers') }}</a></li>
    @endif
    <li class="active">{{ $user->fullname }}</li>
  </ol>
  <div class="clear"></div><hr class="no-print">


     
    <div class="col-md-12" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading no-print">
              <h3 class="panel-title">{{ $user->fullname }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">


                <div class="col-md-3 col-lg-3" align="center"> 

                  @if($user->is_student)
                    @if(!empty($user->image))
                    <?php echo HTML::image('uploads/profiles/students/'.$user->image.'', '', ['class'=>'img-thumbnail img-responsive']) ?>
                    @else
                      {{ HTML::image('uploads/profiles/student.png', '', ['class'=>'img-thumbnail img-responsive']) }}
                    @endif
                  @endif

                  @if($user->is_parent)
                    @if(!empty($user->image))
                    <?php echo HTML::image('uploads/profiles/parents/'.$user->image.'', '', ['class'=>'img-thumbnail img-responsive']) ?>
                    @else
                      {{ HTML::image('uploads/profiles/parent.png', '', ['class'=>'img-thumbnail img-responsive']) }}
                    @endif
                  @endif

                  @if($user->is_teacher)
                    @if(!empty($user->image))
                    <?php echo HTML::image('uploads/profiles/teachers/'.$user->image.'', '', ['class'=>'img-thumbnail img-responsive']) ?>
                    @else
                      {{ HTML::image('uploads/profiles/teacher.jpg', '', ['class'=>'img-thumbnail img-responsive']) }}
                    @endif
                  @endif

                </div>
                
<div id="pdf2htmldiv">

                <div class=" col-md-9 col-lg-9"> 
                  <table class="table table-user-information">
                    <tbody>

                      <tr>
                        <td></td>
                        <td></td>
                      </tr>

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

@if($user->is_student)
                      <tr>
                        <td>{{ Lang::get($path.'.registration_num') }} :</td>
                        <td class="td_details">{{ $user->registration_num }}</td>
                      </tr>

                      <tr>
                        <td>{{ Lang::get($path.'.mentions') }} :</td>
                        <td class="td_details">{{ $user->mention }}</td>
                      </tr>

                      <tr>
                        <td>{{ Lang::get($path.'.parcour') }} :</td>
                        <td class="td_details">{{ $user->parcour }}</td>
                      </tr>
                      
                      <tr>
                        <td>{{ Lang::get($path.'.class') }} :</td>
                        <td class="td_details">@if (!empty($user->class_id)) {{ $user->studClass->name }} @else - @endif</td>
                      </tr>
                      <tr>
                        <td>{{ Lang::get($path.'.birthday') }} :</td>
                        <td class="td_details">{{ $user->birthday }}</td>
                      </tr> 

                       <tr>
                        <td>{{ Lang::get($path.'.birth_localite') }} :</td>
                        <td class="td_details">{{ $user->birth_localite }}</td>
                      </tr> 

                      <tr>
                        <td>{{ Lang::get($path.'.region') }} :</td>
                        <td class="td_details">{{ $user->region }}</td>
                      </tr>   
@endif

                      <tr>
                        <td>{{ Lang::get($path.'.gender') }} :</td>
                        <td class="td_details">@if($user->gender == 1) {{ Lang::get($path.'.male') }} @elseif($user->gender == 2) {{ Lang::get($path.'.female') }} @else - @endif</td>
                      </tr>
                      <tr>
                        <td>{{ Lang::get($path.'.address') }} :</td>
                        <td class="td_details">{{ $user->address }}</td>
                      </tr>
                      <tr>
                        <td>{{ Lang::get($path.'.email') }} :</td>
                        <td class="td_details">{{ $user->email }}</td>
                      </tr>
                      <tr>
                        <td>{{ Lang::get($path.'.phone') }} :</td>
                        <td class="td_details">{{ $user->phone }}</td>
                      </tr>
@if($user->is_parent)
                      <tr>
                        <td>{{ Lang::get($path.'.childrens') }} :</td>
                        <td class="td_details">{{ count($user->children) }}</td>
                      </tr>
@endif
                                     
                    </tbody>
                  </table>
                </div>
</div>

              </div>

            </div>
            <div class="panel-footer no-print">
              <a onclick="window.print();" class="btn btn-sm btn-default"><i class="fa fa-print"></i></a>
              <a href="{{ URL::route('a_contact', $user->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-envelope"></i></a>
            </div>
            
          </div>

  </div>
    


  </div>
</div>

@stop