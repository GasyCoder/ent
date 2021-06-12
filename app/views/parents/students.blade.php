@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.childrens') }} @stop

@section('content')



<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('parent_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.childrens') }}</li>
  </ol>


@if (count($students) >= 1)

<div class="clear"></div><hr>


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>#</th>
            <th>{{ Lang::get($path.'.fullname') }}</th>
            <th>{{ Lang::get($path.'.class') }}</th>         
            <th>{{ Lang::get($path.'.marks') }}</th>
            <th>{{ Lang::get($path.'.reports') }}</th>
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

            <td>@if(!empty($student->class_id)) {{ $student->studClass->name }} @else - @endif</td>


            <td><a href="{{ URL::route('parent_show_mark_s', $student->id) }}"><i class="glyphicon glyphicon-education large"></i></a></td>

            <td><a href="{{ URL::route('parent_show_report_s', $student->id) }}"><i class="fa fa-warning large"></i></a></td>      

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