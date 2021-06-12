@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.students') }} @stop

@section('content')


<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.students') }}</li>
  </ol>
  
<a href="{{ URL::route('create_student') }}" class="btn btn-warning btn-lg"><i class="fa fa-user"></i> {{ Lang::get($path.'.new_student') }}</a>


<div class="clear"></div><hr>


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
<br><br>

<?php /* ?>

{{ Form::open(['route'=>'admin_students', 'method'=>'GET', 'class'=>'col-md-8 col-md-offset-2', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}


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

<?php */ ?>

<section class="panel" style="overflow: auto;">

  <header class="panel-heading">
                              <div class="col-md-4">
                                <h3>{{ Lang::get($path.'.list_students') }}</h3>
                                <label>{{ count($students) }} {{ Lang::get($path.'.student') }}</label>
                              </div>
                              <div class="col-md-4 center">
                                
{{ Form::open(['route'=>'admin_students', 'method'=>'GET', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

              <div class="col-md-10" style="padding: 3px;">
                <div class="form-group">
                  @if(Input::has('q'))
                    {{ Form::text('q', Input::get('q'), ['class'=>'form-control']) }}
                  @else
                    {{ Form::text('q', '', [ 'placeholder'=>Lang::get($path.'.name_or_numbr'), 'class'=>'form-control']) }}
                  @endif
                </div>
              </div>

              <div class="col-md-2" style="padding: 3px;">
                <div class="form-group">
                  <button type="submit" class="btn btn-info btn-block"><i class="fa fa-search"></i></button>
                </div>
              </div>


{{ Form::close() }}

                              </div>

                        
                        </header>


  <div class="clear"></div>



<?php if (isset($_GET['q']) AND !empty($_GET['q'])) {  ?>


<div><a href="{{ URL::route('admin_students') }}" class="btn btn-xs btn-default"> <i class="fa fa-reply-all"></i></a></div>
<div class="clear"></div><br>

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.image') }}</th>
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
            
            <td><a href="{{ URL::route('student_edit', $student->id) }}"><i class="fa fa-edit large"></i></a></td>

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

<?php } else { ?>




<div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
             <th>{{ Lang::get($path.'.image') }}</th>
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
            
            <td><a href="{{ URL::route('student_edit', $student->id) }}"><i class="fa fa-edit large"></i></a></td>

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


<?php } ?>



</section>

  </div>
</div>



@stop