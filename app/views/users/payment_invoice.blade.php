@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.View_invoice') }} @stop

@section('content')
    

<div class="panel panel-default panel-main">
    <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb no-print">
    @if(Auth::user()->is_student)
        <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
        <li class="active"><a href="{{ URL::route('student_payments') }}">{{ Lang::get($path.'.payments') }}</a></li>
    @endif
    @if(Auth::user()->is_parent)
        <li class="active"><a href="{{ URL::route('parent_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
        <li><a href="{{ URL::route('parent_payments') }}">{{ Lang::get($path.'.payments') }}</a></li>
    @endif
    <li class="active">{{ Lang::get($path.'.View_invoice') }}</li>
  </ol>
  <div class="clear"></div><hr class="no-print">


<div class="col-md-12">
    
    <div class="table-responsive">

            <div class="col-xs-12">
                <h2 class="page-header">
                {{ HTML::image('images/logo.png', '', ['class'=>'img-responsive img-logo', 'width'=>'150px']) }} 
                   <i class="fa fa-flag" style="font-size:20px;color: #15e428;"></i> {{ $control->school_name }}
                    @if($path == 'ar')
                        <small class="pull-left">{{ Lang::get($path.'.date') }} : {{ $payment->payment_date }}</small>
                    @else
                        <small class="pull-right">{{ Lang::get($path.'.date') }} : {{ $payment->payment_date }}</small>
                    @endif
                </h2>
            </div><!-- /.col -->


            <div class="col-sm-4 invoice-col ">
                {{ Lang::get($path.'.from') }}
                <address class="">
                    <strong class="">{{ $control->school_name }}</strong><br>
                    {{ Lang::get($path.'.phone') }}: {{ $control->phone }}<br>
                    {{ Lang::get($path.'.email') }}: {{ $control->email }}
                </address>
            </div><!-- /.col -->
            <div class="col-sm-5">
               <address class="">
                    {{ Lang::get($path.'.student') }} :
                    <br>
                    <strong class="">{{ $payment->student->fullname }}</strong><br>
                    {{ Lang::get($path.'.address') }}: {{ $payment->student->address }}<br>
                    {{ Lang::get($path.'.phone') }}: {{ $payment->student->phone }}<br>
                    {{ Lang::get($path.'.email') }}: {{ $payment->student->email }}<br>
                    {{ Lang::get($path.'.class') }}: {{ $payment->student->studClass->name }}<br>
                    {{ Lang::get($path.'.parcour') }}: {{ $payment->student->parcour }}<br>
                    {{ Lang::get($path.'.registration_num') }}: {{ $payment->student->registration_num }}
                </address>
            </div><!-- /.col -->
            <div class="col-sm-3">
              @if($payment->payment_status == 0)
                <span style="color:red; font-size:38px;font-weight:bold;">{{ Lang::get($path.'.UNPAID') }}</span>
              @else
                <span style="color:green; font-size:38px;font-weight:bold;">{{ Lang::get($path.'.PAID') }}</span><br>
                {{ Lang::get($path.'.of_bank_BNI') }}<br>
                {{ Lang::get($path.'.acount_number') }}
              @endif
            </div>

           <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="">{{ Lang::get($path.'.detail') }}</th>
                            <th class="">{{ Lang::get($path.'.somme') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="">{{ $payment->title }}</td>
                            <td class="">{{ $payment->payment_amount . ' ' . $control->payment_unit }}</td>
                        </tr>

                         <tr>
                            <td class="">{{ Lang::get($path.'.Payment_Trance') }}</td>
                            <td class="">{{ $payment->trance }}</td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.col -->


            <div class="col-xs-6 col-xs-offset-6">
                <p class="lead "><br>{{ Lang::get($path.'.Amount_Due') }} {{ $payment->payment_date }}</p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody><tr>
                            <th style="width:50%" class="">{{ Lang::get($path.'.Subtotal') }}:</th>
                            <td class="">{{ $payment->payment_amount . ' ' . $control->payment_unit }}</td>
                        </tr>
                        <tr>
                            <th class="">{{ Lang::get($path.'.Payment_Tax') }} ({{$control->payment_tax}}%) :</th>
                            <td class="">{{ $tax . ' ' . $control->payment_unit }}</td>
                        </tr>
                        <tr>
                            <th class="">{{ Lang::get($path.'.Total') }}:</th>
                            <td class="">{{ $total . ' ' . $control->payment_unit }}</td>
                        </tr>
                    </tbody></table>
                </div>
            </div><!-- /.col -->


            <div class="col-xs-12 no-print">
                <button class="btn btn-lg btn-primary" onclick="window.print();"><i class="fa fa-print"></i> {{ Lang::get($path.'.print') }}</button>
            </div>
    </div>
  </div>





  </div>
</div>



@stop