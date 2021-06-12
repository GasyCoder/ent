@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.archive') }} @stop


@section('content') 

<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('teacher_pedagogiques') }}">{{ Lang::get($path.'.pedagogiques') }}</a></li>
    <li class="active">{{ Lang::get($path.'.archive') }}</li>
  </ol>




@if (count($pedagogiques) >= 1)

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



    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.date') }}</th> 
            <th>{{ Lang::get($path.'.hour') }}</th> 
            <th>{{ Lang::get($path.'.parcour') }}</th>     
            <th>{{ Lang::get($path.'.class') }}</th>    
            <th>{{ Lang::get($path.'.subject') }}</th>   
            <th>{{ Lang::get($path.'.magistrale') }}</th>    
            <th>{{ Lang::get($path.'.tp') }}</th>    
            <th>{{ Lang::get($path.'.note') }}</th>    
            <th>{{ Lang::get($path.'.delete') }}</th>   
          </tr>
        </thead>
        <tbody>


@foreach($pedagogiques as $pedagogique)

          <tr class="tr-body">

            <!--<td>
            @if(!empty($pedagogique->days))
            {{ $pedagogique->Tday->name }}
            @else
            -
            @endif
            </td>-->

            <td><b>{{ $pedagogique->date_start }} / {{ $pedagogique->date_end }}</b></td>
            <td><span class="label label-default">{{ $pedagogique->hour_start }} / {{ $pedagogique->hour_end }}</span></td>

            <td>
            @if(!empty($pedagogique->parcours))
            
            <?php $parcours = explode(",", $pedagogique->parcours); ?>

            <?php foreach ($parcours as $parcour): ?>

              <span class="label label-primary"><?php echo  $parcour;?></span>
              
            <?php endforeach ?>

            @endif
            </td>

            <td><span class="label label-info">
            @if(!empty($pedagogique->class_id))
            {{ $pedagogique->Tclass->name }}
            @else
            -
            @endif</span>
            </td>

            <td>  <span class="btn badge btn-warning">
            @if(!empty($pedagogique->subject_id))
            {{ $pedagogique->Tsubject->name }}</span> -   <span class="label label-danger">vh :{{ $pedagogique->times }}h</span>
            @else
            -
            @endif
            </td>

            <td>@if($pedagogique->magistrale == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($pedagogique->magistrale == 0) {{ Lang::get($path.'.no') }} @endif</td>

            <td>@if($pedagogique->tp == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($pedagogique->tp == 0) {{ Lang::get($path.'.no') }} @else - @endif</td>

            <td>{{ $pedagogique->note }}</td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('pedagogique_delete', $pedagogique->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $pedagogiques->links() }}
    </div>

@endif

  </div>
</div>



@stop