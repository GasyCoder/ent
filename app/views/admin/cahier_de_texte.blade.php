@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.cahier_de_texte') }} @stop


@section('content')

{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}

   <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
  <ol class="breadcrumb no-print">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.cahier_de_texte') }}</li>
   </ol>
<hr class="no-print">
<div class="col-xs-12 no-print">
    <span class="btn btn-sm btn-default pull-right " onclick="window.print();">
      <i class="fa fa-print"></i>
    </span>
</div>

<div class="clear"></div><hr>



<?php 

$read_cahier_de_texte = CahierTexte::where('read', 0)->get();
foreach ($read_cahier_de_texte as $txt) {
  $txt->read = '1';
  $txt->save();  
}

 ?>
  


@if (count($cahier_de_texte) >= 1)


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead> 
          <tr class="tr">
            <th>{{ Lang::get($path.'.date') }}</th>                     
            <th>{{ Lang::get($path.'.time') }}</th> 
            <th>{{ Lang::get($path.'.salle') }}</th>     
            <th>{{ Lang::get($path.'.class') }}</th>    
            <th>{{ Lang::get($path.'.teacher') }}</th>    
            <th>{{ Lang::get($path.'.subject') }}</th>    
            <th>{{ Lang::get($path.'.note') }}</th>    
          </tr>
        </thead>
        <tbody> 


@foreach($cahier_de_texte as $txt)

          <tr class="tr-body">

      <td><strong>{{ $txt->the_date }}</strong></td>
      <td><span class="badge red-bg">{{ $txt->the_time }}</span></td>
      <td><strong>{{ $txt->salle }}</strong></td>
      <td>

            @if(!empty($txt->class_id))
            <strong>{{ $txt->Tclass->name }}</strong>
            @else
            -
            @endif
      </td>
            <td>
            @if(!empty($txt->teacher_id))
             <span class="badge green-bg table-link"><a class="" href="{{ URL::route('profile_teacher', $txt->TheTeacher->id ) }}">{{ $txt->TheTeacher->fullname }}</a></span>  
            @else
            -
            @endif
            </td>
            <td><strong>{{ $txt->activite }}</strong></td>
            <td>{{ $txt->note }}</td>


          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $cahier_de_texte->links() }}
    </div>

@endif

  </div>
</div>



@stop