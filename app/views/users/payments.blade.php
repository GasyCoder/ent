@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.payments') }} @stop

@section('content')


<div class="panel panel-default panel-main">
  <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
  @if(Auth::user()->is_student)
    <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
  @endif
  @if(Auth::user()->is_parent)
    <li><a href="{{ URL::route('parent_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
  @endif
    <li class="active">{{ Lang::get($path.'.payments') }}</li>
  </ol>

<div class="clear"></div><hr>

@if (count($payments) >= 1)


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
          @if(Auth::user()->is_parent)
            <th>{{ Lang::get($path.'.student') }}</th>
          @endif
            <th>{{ Lang::get($path.'.Payment_Title') }} / {{ Lang::get($path.'.date') }}</th>      
            <th>{{ Lang::get($path.'.amount') }}</th>        
            <th>{{ Lang::get($path.'.payment_status') }}</th>
            <th>{{ Lang::get($path.'.View_invoice') }}</th>        
          </tr>
        </thead>
        <tbody>

@foreach($payments as $payment)
        

          <tr class="tr-body">

          @if(Auth::user()->is_parent)
            <td>{{ $payment->student->fullname }}</td>
          @endif

            <td>{{ $payment->title }} - {{ $payment->payment_date }}</td>
<?php $control = Control::find(1); ?>
            <td>{{ $payment->payment_amount . ' ' . $control->payment_unit  }}</td>

            @if($payment->payment_status == 0)
              <td><span class="badge red-bg size-1">{{ Lang::get($path.'.UNPAID') }}</span></td>
            @else
              <td><span class="badge green-bg size-1">{{ Lang::get($path.'.PAID') }}</span></td>
            @endif

            @if(Auth::user()->is_student)
              <td><a href="{{ URL::route('student_payment_invoice', ['id'=>$payment->id, 'index'=>$payment->payment_index]) }}"><i class="fa fa-credit-card large"></i></a></td>
            @endif
            @if(Auth::user()->is_parent)
              <td><a href="{{ URL::route('parent_payment_invoice', ['id'=>$payment->id, 'index'=>$payment->payment_index]) }}"><i class="fa fa-credit-card large"></i></a></td>
            @endif
            
            
          
          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $payments->links() }}
    </div>


@endif

  </div>
</div>



@stop