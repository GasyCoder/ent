@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.emploi_du_temps') }} @stop

@section('content')



{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}

  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
 
    <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
 
    <li class="active">{{ Lang::get($path.'.emploi_du_temps') }}</li>
  </ol>

<div class="clear"></div><hr>



<div class="col-xs-12 no-print">
    <button class="btn btn-default pull-right " onclick="window.print();"><i class="fa fa-print"></i></button>

  <script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-3d'
});

  $('.datepicker2').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-3d'
});

</script>

        <div class="col-md-6 col-md-offset-3 pull-left">
  
{{ Form::open(['route'=>'student_emploi_du_temps', 'method'=>'GET', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

              <div class="col-md-10" style="padding: 3px;">
                <div class="form-group">
                  @if(Input::has('q'))
                    {{ Form::text('q', Input::get('q'), ['class'=>'form-control datepicker2', 'data-provide'=>'datepicker', 'data-date-format'=>'dd/mm/yyyy']) }}
                  @else
                    {{ Form::text('q', '', [ 'placeholder'=>Lang::get($path.'.date_start') . ' ..', 'class'=>'form-control datepicker', 'data-provide'=>'datepicker', 'data-date-format'=>'dd/mm/yyyy']) }}
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

</div> 
<div class="clear"></div>

<?php 

if (count($emploi) >= 1) {

 ?>

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">       
        @foreach($emploi as $em)
<p> {{$em->Tday->date_start}}</p>
@endforeach 
        <thead>
  <div class="clear"></div>
<a href="{{ URL::route('student_emploi_du_temps') }}" class="btn btn-sm btn-default"> <i class="fa fa-reply-all"></i></a>          
          <tr class="tr">
            <th>{{ Lang::get($path.'.day') }}</th>
            <th>{{ Lang::get($path.'.subject') }}</th>
            <th>{{ Lang::get($path.'.teacher') }}</th>                  
            <th>{{ Lang::get($path.'.salle') }}</th>         
            <th>{{ Lang::get($path.'.hour') }}</th>       
          </tr>
        </thead>
        <tbody>        


@foreach($emploi as $em)
<?php 

$array = explode(',', $em->parcours);

if (in_array($parcour, $array)) {

?>

          <tr class="tr-body">
@if($path == 'en')
            <td>{{ $em->Tday->name_en }}</td>
@else
          <td><span class="" style="font-size: 18px; font-weight: bold;">{{ $em->Tday->name }}</span> &nbsp;&nbsp;<sup style="font-size:10px;"><u>{{ $em->date_start}}</u></sup></td>
@endif
            <td>@if(!empty($em->subject_id)) <span class="btn badge #0404B4-bg">{{ $em->Tsubject->name }}</span> @else - @endif </td>

            <td>@if(!empty($em->teacher_id))<sup style="font-size:10px;">{{ $em->Teacher->grade }}</sup><span class="badge green-bg" style="font-size: 14px;">
              <a class="table-link" style="color: #fff" href="{{ URL::route('profile_teacher', $em->Teacher->id) }}">{{ $em->Teacher->fullname }}</a> </span>@else - @endif</td>

              <td><span class="badge red-bg" style="font-size: 14px;">{{ $em->salle }}</span></td>


            <td>@if(!empty($em->the_hour))<span class="badge green-bg">{{ $em->Thour->hour }}</span> @endif - @if(!empty($em->end_hour))<span class="badge red-bg">{{ $em->TEndhour->hour }}</span>@endif</td>
            
            @if(Auth::user()->is_admin)
              <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('destroy_emploi', $em->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>
            @endif

          </tr>

<?php } ?>


@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $emploi->links() }}
    </div>

<?php } ?>


  </div>
</div>



@stop