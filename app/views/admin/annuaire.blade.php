@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.annuaire') }} @stop

@section('content')



<div class="panel panel-default panel-main">
   <br><br><br><br>
  <div class="panel-body">  
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.annuaire') }}</li>
  </ol>
 

<div class="clear"></div><hr>


<br><br>

{{ Form::open(['route'=>'annuaire_teachers', 'method'=>'GET', 'class'=>'col-md-8 col-md-offset-2', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}


              <div class="col-md-10">
                <div class="form-group">
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  @if(Input::has('q'))
                    {{ Form::text('q', Input::get('q'), ['class'=>'form-control input-lg']) }}
                  @else
                    {{ Form::text('q', '', [ 'placeholder'=> Lang::get($path.'.name') , 'class'=>'form-control input-lg']) }}
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

<div class="clear"></div><br><br>

<?php if (isset($_GET['q']) AND !empty($_GET['q'])) {  ?>

<a href="{{ URL::route('annuaire_teachers') }}" class="btn btn-sm btn-default"> <i class="fa fa-reply-all"></i></a>
<div class="clear"></div><br>

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.image') }}</th>
            <th>{{ Lang::get($path.'.fullname') }}</th>
            <th>{{ Lang::get($path.'.email') }}</th> 
            <th>@if (!empty($teacher->phone)) {{ $teacher->phone }} @else {{ Lang::get($path.'.phone') }} @endif</th>   
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
             <td><a class="" href="{{ URL::route('profile_teacher', $teacher->id) }}"><b>{{ $teacher->grade }}.</b> {{ $teacher->fullname }} </a></td>
             
            <td>@if (!empty($teacher->email)) <a href="mailto:{{ $teacher->email }}"> {{ $teacher->email }} </a> @else - @endif</td>
            <td>{{ $teacher->phone }}</td>

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
            <th>{{ Lang::get($path.'.email') }}</th> 
            <th>{{ Lang::get($path.'.phone') }}</th> 
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

            <td><a class="" href="{{ URL::route('profile_teacher', $teacher->id) }}"><b>{{ $teacher->grade }}.</b> {{ $teacher->fullname }} </a></td>

             <td>@if (!empty($teacher->email)) <a href="mailto:{{ $teacher->email }}"> {{ $teacher->email }} </a> @else - @endif</td>

            <td>@if (!empty($teacher->phone)) {{ $teacher->phone }} @else - @endif</td>

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