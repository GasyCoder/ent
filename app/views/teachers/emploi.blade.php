@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.emploi_du_temps') }} @stop

@section('content')


{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}

  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">  
    
  <ol class="breadcrumb no-print">
 
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
 
    <li class="active">{{ Lang::get($path.'.emploi_du_temps') }}</li>
  </ol>

<div class="clear"></div><hr class="no-print">


<div class="col-xs-12 no-print">
    <button class="btn btn-default pull-right " onclick="window.print();">
      <i class="fa fa-print"></i> <b>{{ Lang::get($path.'.print') }}</b>
    </button>

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
  
{{ Form::open(['route'=>'teacher_emploi_du_temps', 'method'=>'GET', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

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

<div class="clear"></div><br>



<?php 

if (count($emploi) >= 1) {  

 ?>




    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <h4 class="center">{{ Lang::get($path.'.my_emploi') }} : </h4> 
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.day') }}</th>
            <th>{{ Lang::get($path.'.subject') }}</th>
            <th>{{ Lang::get($path.'.salle') }}</th>
            <th>{{ Lang::get($path.'.class') }}</th>            
            <th>{{ Lang::get($path.'.parcour') }}</th>            
            <th>{{ Lang::get($path.'.hour') }}</th>
            @if(Auth::user()->is_admin)
            <th>{{ Lang::get($path.'.delete') }}</th>
            @endif
          </tr>
        </thead>
        <tbody>

@foreach($emploi as $em)

          <tr class="tr-body">

@if($path == 'en')
            <td>{{ $em->Tday->name_en }}</td>
@else
          <td><span class="" style="font-size: 18px; font-weight: bold;">{{ $em->Tday->name }}</span></td>
@endif
            <td><span class="btn badge btn-info" style="font-size: 18px;">@if(!empty($em->subject_id)) {{ $em->Tsubject->name }} @else - @endif</span></td>

            <td><span class="btn badge btn-danger" style="font-size: 18px;">{{ $em->salle }}</span></td>

            <td><span class="btn badge btn-warning" style="font-size: 18px;">@if(!empty($em->class_id)) {{ $em->Tclass->name }} @else - @endif</span></td>

            <td><span class="btn badge btn-success" style="font-size: 18px;">{{ $em->parcours }}</span></td>

            <td>@if(!empty($em->the_hour))
              <span class="btn badge green-bg" style="font-size: 18px;">
              {{ $em->Thour->hour }} @endif</span>  - @if(!empty($em->end_hour))
              <span class="btn badge red-bg" style="font-size: 18px;">
              {{ $em->TEndhour->hour }}@endif</span>
            </td>
          
          @if(Auth::user()->is_admin)
              <td><a onclick="return confirm('{{ Lang::get($path.'.confirm_delete') }}')" href="{{ URL::route('destroy_emploi', $em->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>
            @endif

          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{-- $emploi->links() --}}
    </div>

<?php } ?>


  </div>
</div>



@stop