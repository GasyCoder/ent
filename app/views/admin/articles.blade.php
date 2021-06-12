@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.articles') }} @stop

@section('content')


<div class="panel panel-default panel-main">
   <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.articles') }}</li>
  </ol>
  
<a href="{{ URL::route('create_article') }}" class="btn btn-warning btn-lg"><i class="fa fa-edit"></i> {{ Lang::get($path.'.new_article') }}</a>&nbsp;&nbsp;&nbsp;<a href="{{ URL::route('admin_categories') }}" class="btn btn-default btn-lg"><i class="fa fa-list-alt"></i> {{ Lang::get($path.'.categories') }}</a>

@if (count($articles) >= 1)

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
            <th>{{ Lang::get($path.'.article') }}</th>
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>



@foreach($articles as $article)

          <tr class="tr-body">

            <td><a class="table-link" href="{{ URL::route('article', ['id'=>$article->id, 'slug'=>$article->slug]) }}">{{ $article->title }}</a></td>
            
            <td><a href="{{ URL::route('edit_article', $article->id) }}"><i class="fa fa-edit large"></i></a></td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('delete_article', $article->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $articles->links() }}
    </div>

@endif

  </div>
</div>



@stop