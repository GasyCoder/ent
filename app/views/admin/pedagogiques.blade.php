@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.pedagogiques') }} @stop
@section('content')

{{ HTML::style('css/theme.css') }}

{{ HTML::script('js/jquery-1.9.1.min.js') }}
{{ HTML::script('js/flot/jquery.flot.resize.js') }} 
{{ HTML::script('js/datatables/jquery.dataTables.js') }}
{{ HTML::script('js/common.js') }}

<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li class="active">{{ Lang::get($path.'.pedagogiques') }}</li>
</ol>

 
<?php 

$read_pedagogique = Pedagogique::where('read', 0)->get();
foreach ($read_pedagogique as $txt) {
  $txt->read = '1';
  $txt->save();  
}

 ?>
  


@if (count($pedagogiques) >= 1)

<!--<div class="clear"></div><hr>-->
     <div class="wrapper">
            <div class="container">
                <div class="row">

<div class="no-print">
    <span class="btn btn-sm btn-default pull-right " onclick="window.print();">
      <i class="fa fa-print"></i> {{ Lang::get($path.'.print') }}
    </span>
</div>                 
                          <!-- DATA TABLE -->  
                      <div class="span9">
                        <div class="content">
                            <div class="module">
                                <div class="module-head">
                                    <h3>
                                <b>{{ Lang::get($path.'.teacher_pro') }}</b></h3>

                                </div>
                      <div class="module-body table">
                      <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display table table-striped table-advance table-hover" width="100%">       

            <thead>
            <tr>
            <th>{{ Lang::get($path.'.teacher') }}</th>                    
            <th>{{ Lang::get($path.'.date') }}</th> 
            <th>{{ Lang::get($path.'.hour') }}</th> 
            <th>{{ Lang::get($path.'.parcour') }}</th>     
            <th>{{ Lang::get($path.'.class') }}</th>    
            <th>{{ Lang::get($path.'.subject') }}</th>   
            <th>{{ Lang::get($path.'.magistrale') }}</th>    
            <th>{{ Lang::get($path.'.tp') }}</th>    
            <th>{{ Lang::get($path.'.note') }}</th>       
            </tr>
             </thead>

          <tbody>
          @foreach($pedagogiques as $pedagogique)

          <tr class="tr-body">
            <td>
            @if(!empty($pedagogique->teacher_id))<b>{{ $pedagogique->grade }}</b>
             <span class="btn btn-sm btn-success"><a class="" style="color: #fff; font-weight: bold;" href="{{ URL::route('profile_teacher', $pedagogique->TheTeacher->id ) }}">
              {{$pedagogique->TheTeacher->fullname }}</a></span>  
            @else
            -
            @endif
            </td>

            <td><span class="label label-default">{{ $pedagogique->date_start }}</span> / <span class="label label-primary">{{ $pedagogique->date_end }}</span></td>
            
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


            <td><strong>@if($pedagogique->magistrale == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($pedagogique->magistrale == 0) {{ Lang::get($path.'.no') }} @endif</strong></td>

            <td><strong>@if($pedagogique->tp == 1) {{ Lang::get($path.'.yes') }}
            @elseif ($pedagogique->tp == 0) {{ Lang::get($path.'.no') }} @else - @endif</strong></td>

            <td>{{ $pedagogique->note }}</td>


          </tr>

@endforeach 

                            </tbody>
                                    </table>
                                </div>
                            </div>
                             </div>
                            </div>
                            </div>

                              </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                            <!--/.module-->   

    <div class="clear"></div>
    <div class="center">
        {{ $pedagogiques->links() }}
    </div>

@endif

  </div>
</div>



@stop