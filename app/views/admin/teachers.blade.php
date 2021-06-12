@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.teachers') }} @stop

@section('content')


<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.teachers') }}</li>
  </ol>
  
<a href="{{ URL::route('create_teacher') }}" class="btn btn-warning btn-lg"><i class="fa fa-user"></i> {{ Lang::get($path.'.new_teacher') }}</a>



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

{{ Form::open(['route'=>'admin_teachers', 'method'=>'GET', 'class'=>'col-md-8 col-md-offset-2', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}


              <div class="col-md-10">
                <div class="form-group">
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  @if(Input::has('q'))
                    {{ Form::text('q', Input::get('q'), ['class'=>'form-control input-lg']) }}
                  @else
                    {{ Form::text('q', '', [ 'placeholder'=> Lang::get($path.'.fullname_or_phone_or_grade') , 'class'=>'form-control input-lg']) }}
                  @endif
                  </div>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                {{ Form::submit( Lang::get($path.'.find'), ['class'=>'btn btn-info btn-block input-lg']) }} 
                </div>
              </div>

{{ Form::close() }}
<div class="col-md-4">
  <h3>{{ Lang::get($path.'.list_teachers') }}</h3>
  <label>{{ count($teachers) }} {{ Lang::get($path.'.teacher') }}</label>
</div>
<div class="clear"></div>

<?php if (isset($_GET['q']) AND !empty($_GET['q'])) {  ?>

<a href="{{ URL::route('admin_teachers') }}" class="btn btn-sm btn-default"> <i class="fa fa-reply-all"></i></a>
<div class="clear"></div><br>

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.image') }}</th>
            <th>{{ Lang::get($path.'.grade') }}</th>
            <th>{{ Lang::get($path.'.fullname') }}</th>
            <th>{{ Lang::get($path.'.profile') }}</th>        
            <th>{{ Lang::get($path.'.contact') }}</th>
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>

@foreach($teachers as $teacher)

          <tr class="tr-body">

            <td>
            @if(!empty($teacher->image))
            <?php echo HTML::image('uploads/profiles/teachers/'.$teacher->image.'', '', ['class'=>'img-circle', 'width'=>'60px','height'=>'60px']) ?>
            @else
            {{ HTML::image('uploads/profiles/teacher.jpg', '', ['class'=>'img-circle', 'width'=>'60px','height'=>'60px']) }}
            @endif
            </td>

            <td>{{ $teacher->grade }}</td>

            <td>{{ $teacher->fullname }}</td>

            <td><a href="{{ URL::route('profile_teacher', $teacher->id) }}"><i class="glyphicon glyphicon-user large"></i></a></td>


            <td><a href="{{ URL::route('a_contact', $teacher->id) }}"><i class="glyphicon glyphicon-envelope large"></i></a></td>
            
            <td><a href="{{ URL::route('teacher_edit', $teacher->id) }}"><i class="fa fa-edit large"></i></a></td>

            <td><a  onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('teacher_delete', $teacher->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $teachers->links() }}
    </div>

<?php } else { ?>



<div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.image') }}</th>
            <th>{{ Lang::get($path.'.fullname') }}</th>
            <!--<th>{{ Lang::get($path.'.profile') }}</th>-->     
            <th>{{ Lang::get($path.'.contact') }}</th>
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>

@foreach($teachers as $teacher)

          <tr class="tr-body">

            <td><a href="{{ URL::route('profile_teacher', $teacher->id) }}">
            @if(!empty($teacher->image))
            <?php echo HTML::image('uploads/profiles/teachers/'.$teacher->image.'', '', ['class'=>'img-circle', 'width'=>'60px','height'=>'60px']) ?>
            @else
            {{ HTML::image('uploads/profiles/teacher.jpg', '', ['class'=>'img-circle', 'width'=>'60px','height'=>'60px']) }}
            @endif
            </a></td>

            <td><b >{{ $teacher->grade }}</b><a href="{{ URL::route('profile_teacher', $teacher->id) }}">. {{ $teacher->fullname}} </a></td>

            <!--<td><a href="{{ URL::route('profile_teacher', $teacher->id) }}"><i class="glyphicon glyphicon-user large"></i></a></td>-->


            <td><a href="{{ URL::route('a_contact', $teacher->id) }}"><i class="glyphicon glyphicon-envelope large"></i></a></td>
            
            <td><a href="{{ URL::route('teacher_edit', $teacher->id) }}"><i class="fa fa-edit large"></i></a></td>

            <td><a  onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('teacher_delete', $teacher->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $teachers->links() }}
    </div>



<?php } ?>

  </div>
</div>



@stop