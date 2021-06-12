@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.payments') }} @stop

@section('content')
  
{{ HTML::style('js/bootstrap_datepicker/css/bootstrap-datepicker.css') }}
{{ HTML::script('js/bootstrap_datepicker/js/bootstrap-datepicker.js') }}




<div class="panel panel-default panel-main">
 <br><br><br><br>
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.payments') }}</li>
  </ol>



<a data-toggle="modal" data-target="#new_payments"  href="#" class="btn btn-warning btn-lg"><i class="fa fa-clipboard"></i> {{ Lang::get($path.'.add_payment') }}</a>



<div class="modal fade bs-example-modal-lg" id="new_payments">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button onclick="refresh();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ Lang::get($path.'.add_payment') }}</h4>
      </div>
      <div class="modal-body">
        

{{ Form::open(['route'=>'payments_store', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}

      <div class="col-md-12">

<div class="row">
            <div class="col-md-6">
              <div class="form-group">
                    <label class="control-label">{{ Lang::get($path.'.class') }}  : </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-blackboard"></i></span>
                      <select name="class_id" id="class" class="form-control  input-lg" required>
                      <option value="">{{ Lang::get($path.'.select_class') }}</option>
                          @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                          @endforeach

                      </select>
                    </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group student">
                    <label class="control-label">{{ Lang::get($path.'.student') }} : </label>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                    <select name="student_id" id="student" class="form-control input-lg" required>
                        <option value="">{{ Lang::get($path.'.all_students') }}</option>
                    </select>
                    </div>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
              </div>
</div>
              


<script type="text/javascript">
$(document).ready(function () { 

            $('#class').on('change',function(e){
            var class_id = e.target.value;

            $(".student").css ({"display":"block"});

            $.ajax({
            type: "GET",
            url: "{{ url() }}/ajax-class?class_id="+class_id,
                success: function(data) {  

                    var subcat =  $('#student').empty();

                    subcat.append('<option value ="">{{ Lang::get($path.'.all_students') }}</option>');

                    $.each(data,function(create,subcatObj){
                    var option = $('<option/>', {id:create, value:subcatObj});
                    subcat.append('<option value ="'+subcatObj+'">'+create+'</option>');
                    });

                }
            });


        });
});
</script>



<script type="text/javascript">
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-3d'
});
</script>
              
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.Payment_Title') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                {{ Form::text('Payment_Title', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('Payment_Title'))
                  <span class="help-block red-color">{{ $errors->first('Payment_Title') }}</span>
                  @endif
              </div>

            <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.Payment_Trance') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                {{ Form::number('Payment_Trance', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('Payment_Trance'))
                  <span class="help-block red-color">{{ $errors->first('Payment_Trance') }}</span>
                  @endif
              </div>


              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.payment_amount') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-money"></i></span>
                {{ Form::number('amount', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('amount'))
                  <span class="help-block red-color">{{ $errors->first('amount') }}</span>
                  @endif
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.payment_status') }} : </label>
                  <div class="radio">
                  <label class="ng-binding">
                      <input name="paymentStatus" value="0" required="" checked="checked" class="ng-pristine ng-invalid ng-invalid-required" type="radio">
                      <span style="color: #c33; font-size: 16px;">{{ Lang::get($path.'.UNPAID') }}</span>
                  </label>
                  </div>
                  <div class="radio">
                      <label class="ng-binding">
                          <input name="paymentStatus" value="1" required="" class="ng-pristine ng-invalid ng-invalid-required" type="radio">
                          <span style="color: #36e29b; font-size: 16px;">{{ Lang::get($path.'.PAID') }}</span>
                      </label>
                  </div>
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.date') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                {{ Form::text('date', '', ['placeholder'=>'', 'class'=>'form-control input-lg', 'data-provide'=>'datepicker', 'data-date-format'=>'dd/mm/yyyy']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('date'))
                  <span class="help-block red-color">{{ $errors->first('date') }}</span>
                  @endif
              </div>

      </div>


            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.add'), ['class'=>'btn btn-info btn-block input-lg']) }} 
            </div>


            <div class="col-md-12">
              <div id="resultajax" class="center"></div>
          </div>


              {{ Form::close() }}

     
        <div class="clear"></div><br>

<script type="text/javascript">
      

        $('#myForm').submit(function(event) {

          event.preventDefault();

          $('#resultajax').append('<img src="{{ url() }}/images/loader.gif" alt="{{Lang::get($path.'.please_wait')}}" />');

          $('#myForm input.btn').hide();

          
           $.ajax({
            type: 'POST',
            url: '{{ route("payments_store") }}',
            data: $(this).serialize(),

            success: function(data) {
                              
                if(data == 'true') {   
                  $('#resultajax').html("<br><div class='alert alert-success center'><strong>{{ Lang::get($path.'.add_successfully') }}</strong></div>");
                  $('#myForm input.btn').show();
                 }

                if(data == 'false') {
                  $('#resultajax').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.error_please_try_again') }} </strong></div>");
                  $('#myForm input.btn').show();
                }
                                     
              }

            });
                          
          });

          function refresh() {
            // to current URL
            window.location='{{ URL::current() }}';
          }

</script>




      </div>
      <div class="modal-footer">
        <button type="button" onclick="refresh();" class="btn btn-default" data-dismiss="modal">{{ Lang::get($path.'.close') }}</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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


@if (count($payments) >= 1)

<?php 

if (isset($_GET['id'])) { 

$id = htmlspecialchars($_GET['id']);

$getpayment = Payments::find($id);

if ($getpayment !== null) {

?>

<a href="{{ URL::route('admin_payments') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.all_payments') }}</a><div class="clear"></div><br>

      

{{ Form::open(['route'=>['payments_update', $getpayment->id], 'class'=>'col-md-12', 'id'=>'myForm2', 'data-toggle'=>'validator'])  }}
        
      


      <div class="col-md-12">


      <div class="col-md-12">
          <div id="resultajax2" class="center"></div><br>
      </div>

<div class="row">
              
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.Payment_Title') }} : </label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                  {{ Form::text('Payment_Title', $getpayment->title, ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                  </div>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                  @if($errors->first('Payment_Title'))
                    <span class="help-block red-color">{{ $errors->first('Payment_Title') }}</span>
                    @endif
                </div>
              </div>

              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.Payment_Trance') }} : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                {{ Form::number('Payment_Trance', $getpayment->trance, ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('Payment_Trance'))
                  <span class="help-block red-color">{{ $errors->first('Payment_Trance') }}</span>
                  @endif
              </div> 

              <div class="col-md-6">
                <div class="form-group student">
                    <label class="control-label">{{ Lang::get($path.'.student') }} : </label>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-mortar-board"></i></span>
                    <select name="student_id" id="student" class="form-control input-lg" required>
                        <option value="{{ $getpayment->student->id }}">{{ $getpayment->student->fullname }}</option>
                    </select>
                    </div>
                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    <div class="help-block with-errors"></div>
                </div>
              </div>

          
<script type="text/javascript">

$('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    startDate: '-3d'
});

</script>

          
              
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.payment_amount') }} : </label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-money"></i></span>
                  {{ Form::number('amount', $getpayment->payment_amount, ['placeholder'=>'', 'class'=>'form-control input-lg', 'required' => 'required']) }} 
                  </div>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                  @if($errors->first('amount'))
                    <span class="help-block red-color">{{ $errors->first('amount') }}</span>
                    @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.date') }} : </label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  {{ Form::text('date',  $getpayment->payment_date, ['placeholder'=>'', 'class'=>'form-control input-lg', 'data-provide'=>'datepicker', 'data-date-format'=>'dd/mm/yyyy']) }} 
                  </div>
                  <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                  <div class="help-block with-errors"></div>
                  @if($errors->first('date'))
                    <span class="help-block red-color">{{ $errors->first('date') }}</span>
                    @endif
                </div>
              </div>

</div>
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.payment_status') }} : </label>
                  <div class="radio">
                  <label class="ng-binding">
                    @if($getpayment->payment_status == 0)
                      <input name="paymentStatus" value="0" checked="checked" class="ng-pristine ng-invalid ng-invalid-required" type="radio">
                    @else
                      <input name="paymentStatus" value="0" class="ng-pristine ng-invalid ng-invalid-required" type="radio">
                    @endif
                      <span style="color: #c33; font-size: 16px;">{{ Lang::get($path.'.UNPAID') }}</span>
                  </label>
                  </div>
                  <div class="radio">
                      <label class="ng-binding">
                      @if($getpayment->payment_status == 1)
                          <input name="paymentStatus" value="1" checked="checked" class="ng-pristine ng-invalid ng-invalid-required" type="radio">
                      @else
                          <input name="paymentStatus" value="1" class="ng-pristine ng-invalid ng-invalid-required" type="radio">
                      @endif
                          <span style="color: #36e29b; font-size: 16px;">{{ Lang::get($path.'.PAID') }}</span>
                      </label>
                  </div>
              </div>


      </div>


            <div class="clear"></div><br>
            <div class="col-md-12">
              {{ Form::submit(Lang::get($path.'.update'), ['class'=>'btn btn-info btn-block input-lg']) }} 
            </div>



              {{ Form::close() }}

     
        <div class="clear"></div><br>

<script type="text/javascript">
      

        $('#myForm2').submit(function(event) {

          event.preventDefault();

          $('#resultajax2').append('<img src="{{ url() }}/images/loader.gif" alt="{{Lang::get($path.'.please_wait')}}" />');

          $('#myForm2 input.btn').hide();

          
           $.ajax({
            type: 'POST',
            url: '{{ route("payments_update", $getpayment->id) }}',
            data: $(this).serialize(),

            success: function(data) {
                              
                if(data == 'true') {   
                  $('#resultajax2').html("<br><div class='alert alert-success center'><strong>{{ Lang::get($path.'.was_update') }}</strong></div>");
                  $('#myForm2 input.btn').show();
                 }

                if(data == 'false') {
                  $('#resultajax2').html("<br><div class='alert alert-danger center'><strong>{{ Lang::get($path.'.error_please_try_again') }} </strong></div>");
                  $('#myForm2 input.btn').show();
                }
                                     
              }

            });
                          
          });

          function refresh() {
            // to current URL
            window.location='{{ URL::current() }}';
          }

</script>





<?php  } } else { ?>

    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>
          <tr class="tr">
            <th>{{ Lang::get($path.'.Payment_Title') }} / {{ Lang::get($path.'.date') }}</th>
            <th>{{ Lang::get($path.'.Payment_Trance') }}</th>
            <th>{{ Lang::get($path.'.student') }}</th>        
            <th>{{ Lang::get($path.'.amount') }}</th>        
            <th>{{ Lang::get($path.'.payment_status') }}</th>
            <th>{{ Lang::get($path.'.View_invoice') }}</th>        
            <th>{{ Lang::get($path.'.edit') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
        </thead>
        <tbody>

@foreach($payments as $payment)
        

          <tr class="tr-body">

            <td>{{ $payment->title }} - {{ $payment->payment_date }}</td>
            <td>{{ $payment->trance }}</td>

            <td><a class="table-link" href="{{ URL::route('profile_student', $payment->student->id) }}">{{ $payment->student->fullname }}</a></td>
<?php $control = Control::find(1); ?>
            <td>{{ $payment->payment_amount . ' ' . $control->payment_unit }}</td>

            @if($payment->payment_status == 0)
              <td><span class="badge red-bg size-1">{{ Lang::get($path.'.UNPAID') }}</span></td>
            @else
              <td><span class="badge green-bg size-1">{{ Lang::get($path.'.PAID') }}</span></td>
            @endif

            <td><a href="{{ URL::route('admin_payment_invoice', ['id'=>$payment->id, 'index'=>$payment->payment_index]) }}"><i class="fa fa-credit-card large"></i></a></td>

            <td><a href="{{ URL::current() . '?id=' . $payment->id }}"><i class="fa fa-edit large"></i></a></td>

            <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('payments_destroy', $payment->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>
          
          </tr>

@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $payments->links() }}
    </div>

<?php } ?>

@endif

  </div>
</div>



@stop