@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.childrens_of') }} {{ $parent->fullname }} @stop

@section('content')


<div class="panel panel-default panel-main">
   <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.childrens_of') }} {{ $parent->fullname }}</li>
  </ol>
 
@if (count($students) >= 1)

<div class="clear"></div>


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

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>#</th>
            <th>{{ Lang::get($path.'.fullname') }}</th>
            <th>{{ Lang::get($path.'.profile') }}</th>         
            <th>{{ Lang::get($path.'.contact') }}</th>
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>



@foreach($students as $student)

          <tr class="tr-body">

            <td>
            @if(!empty($student->image))
            <?php echo HTML::image('uploads/profiles/students/'.$student->image.'', '', ['class'=>'img-circle', 'width'=>'60px','height'=>'60px']) ?>
            @else
            {{ HTML::image('uploads/profiles/student.png', '', ['class'=>'img-circle', 'width'=>'60px','height'=>'60px']) }}
            @endif
            </td>

            <td>{{ $student->fullname }}</td>
            <td><a href="{{ URL::route('profile_student', $student->id) }}"><i class="glyphicon glyphicon-user large"></i></a></td>


            <td><a href="{{ URL::route('a_contact', $student->id) }}"><i class="glyphicon glyphicon-envelope large"></i></a></td>
            
            <td><a href="{{ URL::route('student_edit', $student->id) }}"><i class="glyphicon glyphicon-pencil large"></i></a></td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('student_delete', $student->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $students->links() }}
    </div>

@endif

  </div>
</div>



@stop