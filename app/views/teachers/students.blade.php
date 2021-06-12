@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.students') }} @stop

@section('content')


  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.students') }}</li>
  </ol>

<div class="clear"></div><hr>
<br><br>

{{ Form::open(['route'=>'teacher_students', 'method'=>'GET', 'class'=>'col-md-8 col-md-offset-2', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}


              <div class="col-md-10">
                <div class="form-group">
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                  @if(Input::has('q'))
                    {{ Form::text('q', Input::get('q'), ['class'=>'form-control input-lg']) }}
                  @else
                    {{ Form::text('q', '', [ 'placeholder'=>Lang::get($path.'.name_or_numbr'), 'class'=>'form-control input-lg']) }}
                  @endif
                  </div>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                {{ Form::submit(Lang::get($path.'.find'), ['class'=>'btn btn-info btn-block input-lg']) }} 
                </div>
              </div>


{{ Form::close() }}



<div class="clear"></div><br><br>

<?php if (isset($_GET['q']) AND !empty($_GET['q'])) {  ?>

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.image') }}</th>
            <th>{{ Lang::get($path.'.fullname') }}</th>
            <th>{{ Lang::get($path.'.profile') }}</th>          
            <th>{{ Lang::get($path.'.contact') }}</th>
            <th>{{ Lang::get($path.'.report') }}</th>
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

            <td><b>{{ $student->fullname }}</b></td>
            <td><a href="{{ URL::route('teacher_p_student', $student->id) }}"><i class="glyphicon glyphicon-user large"></i></a></td>


            <td><a href="{{ URL::route('t_contact', $student->id) }}"><i class="glyphicon glyphicon-envelope large"></i></a></td>

            <td><a href="{{ URL::route('teacher_report_student', $student->id) }}"><i class="fa fa-warning large"></i></a></td>      

          </tr>
          
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $students->links() }}
    </div>


<?php } ?>

  </div>
</div>



@stop