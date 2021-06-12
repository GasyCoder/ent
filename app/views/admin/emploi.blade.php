@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.emploi_du_temps') }} @stop

@section('content')


<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
  @if(Auth::user()->is_teacher)
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
  @endif
  @if(Auth::user()->is_student)
    <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
  @endif
  @if(Auth::user()->is_admin)
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
  @endif
    <li class="active">{{ Lang::get($path.'.emploi_du_temps') }}</li>
  </ol>

@if(Auth::user()->is_admin)
<a href="{{ URL::route('create_emploi_du_temps') }}" class="btn btn-warning btn-lg"><i class="fa fa-calendar"></i> {{ Lang::get($path.'.new_emploi') }}</a>
@endif

<div class="clear"></div><hr>


<?php 
if (isset($_GET['class'])) { 

$class_id = htmlspecialchars($_GET['class']);

if(Auth::user()->is_admin) {
  $emploi = Emploi::where('class_id', $class_id)->orderBy('the_day', 'desc')->paginate(20);
  $emploi->appends(Input::except('page'));
}


if (count($emploi) >= 1) {

 ?>

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

  @if(Auth::user()->is_teacher)
    <a href="{{ URL::route('teacher_emploi_du_temps') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.tous_classes') }}</a><div class="clear"></div><br>
  @endif
  @if(Auth::user()->is_student)
    <a href="{{ URL::route('student_emploi_du_temps') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.tous_classes') }}</a><div class="clear"></div><br>
  @endif
  @if(Auth::user()->is_admin)
    <a href="{{ URL::route('emploi_du_temps') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.tous_classes') }}</a><div class="clear"></div><br>
  @endif



    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.day') }}</th>
            <th>{{ Lang::get($path.'.subject') }}</th> 
            <th>{{ Lang::get($path.'.salle') }}</th>
            <th>{{ Lang::get($path.'.parcour') }}</th>         
            <th>{{ Lang::get($path.'.teacher') }}</th>         
            <th>{{ Lang::get($path.'.hour') }}</th>
            @if(Auth::user()->is_admin)
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
            @endif
          </tr>
        </thead>
        <tbody>

@foreach($emploi as $em)

          <tr class="tr-body">

@if($path == 'ar')
            <td>{{ $em->Tday->name_ar }}</td>
@elseif($path == 'en')
          <td>{{ $em->Tday->name_en }}</td>
@else
          <td>{{ $em->Tday->name }}</td>
@endif
            <td>@if(!empty($em->subject_id)) {{ $em->Tsubject->name }} @else - @endif</td>

             <td>{{ $em->salle }}</td>
             
            <td>{{ $em->parcours }}</td>

            <td>@if(!empty($em->teacher_id))
             @if(Auth::user()->is_admin)
              <a class="table-link" href="{{ URL::route('profile_teacher', $em->Teacher->id) }}"> {{ $em->Teacher->fullname }} </a>
             @else {{ $em->Teacher->fullname }} @endif
            @else - @endif</td>

            <td>@if(!empty($em->the_hour))<span class="badge green-bg">{{ $em->Thour->hour }}</span> @endif - @if(!empty($em->end_hour))<span class="badge red-bg">{{ $em->TEndhour->hour }}</span>@endif</td>
            
            @if(Auth::user()->is_admin)
            <td><a href="{{ URL::route('edit_emploi', $em->id) }}"><i class="fa fa-edit large"></i></a></td>
              <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('destroy_emploi', $em->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>
            @endif

          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $emploi->links() }}
    </div>


<?php } else {  ?>
  <a href="{{ URL::route('emploi_du_temps') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.tous_classes') }}</a><div class="clear"></div><br><div class="alert alert-info center" role="alert"><strong>{{ Lang::get($path.'.no_emploi_du_temps_in_this_class') }}</strong></div>
<?php } 

} else { ?>


<div class="clear"></div>

@if(count($classes) >= 1)

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.class') }}</th>
            <th>{{ Lang::get($path.'.emploi_du_temps') }}</th>
          </tr>
        </thead>
        <tbody>

@foreach($classes as $class)

          <tr class="tr-body">

            <td>{{ $class->name }}</td>
            <td><a href="{{ URL::current() . '?class=' . $class->id }}"><i class="fa fa-calendar large"></i></a></td>

          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->


@endif


<?php } ?>



  </div>
</div>



@stop