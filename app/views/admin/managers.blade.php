@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.scolarite') }} @stop

@section('content')


   <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.scolarite') }}</li>
  </ol>
  
<a href="{{ URL::route('create_manager') }}" class="btn btn-warning btn-lg"><i class="fa fa-user"></i> {{ Lang::get($path.'.new_manager') }}</a>


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



<div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.image') }}</th>
            <th>{{ Lang::get($path.'.fullname') }}</th>         
            <th>{{ Lang::get($path.'.contact') }}</th>
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>



@foreach($managers as $manager)

          <tr class="tr-body">

            <td>
            @if(!empty($manager->image))
            <?php echo HTML::image('uploads/profiles/managers/'.$manager->image.'', '', ['class'=>'img-circle', 'width'=>'60px','height'=>'60px']) ?>
            @else
            {{ HTML::image('uploads/profiles/manager.png', '', ['class'=>'img-circle', 'width'=>'60px','height'=>'60px']) }}
            @endif
            </td>

            <td>{{ $manager->fullname }}</td>


            <td><a href="{{ URL::route('a_contact', $manager->id) }}"><i class="glyphicon glyphicon-envelope large"></i></a></td>
            
            <td><a href="{{ URL::route('manager_edit', $manager->id) }}"><i class="fa fa-edit large"></i></a></td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('manager_delete', $manager->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $managers->links() }}
    </div>



  </div>
</div>



@stop