@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.subjects') }} @stop

@section('content')
{{ HTML::style('js/bootstrap-select/css/bootstrap-select.css') }}
{{ HTML::script('js/bootstrap-select/js/bootstrap-select.js') }}

   <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.subjects') }}</li>
  </ol>
  
<a data-toggle="modal" data-target="#new_class"  href="#" class="btn btn-warning btn-lg"><i class="fa fa-book"></i> {{ Lang::get($path.'.new_subject') }}</a>

@if (count($subjects) >= 1)

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
    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.element_c') }}</th>
            <th>{{ Lang::get($path.'.credit_ec') }}</th>        
            <th>{{ Lang::get($path.'.code_ec') }}</th>    
            <th>{{ Lang::get($path.'.unite_e') }}</th>       
            <th>{{ Lang::get($path.'.credit_t') }}</th>         
            <th>{{ Lang::get($path.'.matricule_t') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>


@foreach($subjects as $subject)

          <tr class="tr-body">

            <td><span class="badge green-bg">{{ $subject->element_c }}</span></td>
            <td><span class="badge default-bg">{{ $subject->credit_ec }}</span></td>
            <td>{{ $subject->code_ec }}</td>
            <td>{{ $subject->unite_e }}</td>
            <td>{{ $subject->credit_t}}</td>
            <td>{{ $subject->matricule_t}}</td>
            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('subject_delete', $subject->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $subjects->links() }}
    </div>

@endif

  </div>
</div>



@stop