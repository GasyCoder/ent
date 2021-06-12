@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.scolarite') }} @stop

@section('content')



<div class="panel panel-default panel-main">
  <br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.scolarite') }}</li>
  </ol>


<div class="clear"></div><hr>


<div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>#</th>
            <th>{{ Lang::get($path.'.fullname') }}</th>         
            <th>{{ Lang::get($path.'.contact') }}</th>
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


            <td><a href="{{ URL::route('t_contact', $manager->id) }}"><i class="glyphicon glyphicon-envelope large"></i></a></td>
            


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