@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>
@section('title') {{ Lang::get($path.'.outgoing_messages') }} @stop

@section('content')


  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    @if($auth_user->is_admin)
      <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @endif
    @if($auth_user->is_student)
      <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @endif
    @if($auth_user->is_teacher)
      <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @endif
    @if($auth_user->is_parent)
      <li><a href="{{ URL::route('parent_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @endif
    <li class="active">{{ Lang::get($path.'.outgoing_messages') }}</li>
  </ol>
  <div class="clear"></div><hr>



<div class="messages">

    <table class="table table-filter">
                <tbody>

@foreach($send_messages as $send_message)                
                  <tr>
                    <td>
                      <div class="media" data-toggle="modal" data-target=".modelmsg_{{ $send_message->id }}">
                        <a href="#" class="pull-left">
                        @if(!empty($send_message->getRecevier->image))
                          
                          @if($send_message->getRecevier->is_admin)
                            @if(!$send_message->getRecevier->is_manager)
                            <?php echo HTML::image('uploads/profiles/'.$send_message->getRecevier->image.'', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px']) ?>
                            @endif
                            @if($send_message->getRecevier->is_manager)
                            <?php echo HTML::image('uploads/profiles/managers/'.$send_message->getRecevier->image.'', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px'])  ?>
                            @endif
                          @endif

                          @if($send_message->getRecevier->is_student)
                            <?php echo HTML::image('uploads/profiles/students/'.$send_message->getRecevier->image.'', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px']) ?>
                          @endif

                          @if($send_message->getRecevier->is_parent)
                            <?php echo HTML::image('uploads/profiles/parents/'.$send_message->getRecevier->image.'', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px']) ?>
                          @endif

                          @if($send_message->getRecevier->is_teacher)
                            <?php echo HTML::image('uploads/profiles/teachers/'.$send_message->getRecevier->image.'', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px']) ?>
                          @endif

                        @else
                            {{ HTML::image('uploads/profiles/mail.png', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px']) }}
                        @endif
                        </a>
                        <div class="media-body">
                          <span class="media-meta pull-right">{{ $send_message->created_at }}</span>
                          <h4 class="title">
                            {{ $send_message->getRecevier->fullname }}

                            <span class="pull-right pagado">@if($send_message->getRecevier->is_admin) ({{ Lang::get($path.'.admin') }}) @elseif($send_message->getRecevier->is_student) ({{ Lang::get($path.'.student') }}) @elseif($send_message->getRecevier->is_teacher) ({{ Lang::get($path.'.teacher') }}) @elseif($send_message->getRecevier->is_parent) ({{ Lang::get($path.'.guardian') }}) @endif</span>
                          </h4>
                          <p class="summary">{{ $send_message->subject }}</p>
                        </div>
                      </div>

                      @if($auth_user->is_admin)
                        <a href="{{ URL::route('admin_messages_destroy', $send_message->id) }}" class="dlt btn btn-default btn-sm pull-right"><i class="glyphicon glyphicon-trash"></i></a>
                      @endif
                      @if($auth_user->is_student)
                        <a href="{{ URL::route('student_messages_destroy', $send_message->id) }}" class="dlt btn btn-default btn-sm pull-right"><i class="glyphicon glyphicon-trash"></i></a>
                      @endif
                      @if($auth_user->is_teacher)
                        <a href="{{ URL::route('teacher_messages_destroy', $send_message->id) }}" class="dlt btn btn-default btn-sm pull-right"><i class="glyphicon glyphicon-trash"></i></a>
                      @endif
                      @if($auth_user->is_parent)
                        <a href="{{ URL::route('parent_messages_destroy', $send_message->id) }}" class="dlt btn btn-default btn-sm pull-right"><i class="glyphicon glyphicon-trash"></i></a>
                      @endif
                      
                    </td>
                  </tr>



<div class="modal fade bs-example-modal-lg modelmsg_{{ $send_message->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ $send_message->subject }}</h4>
      </div>
      <div class="modal-body">
        <p>{{ $send_message->message }}</p>

        @if(!empty($send_message->file_path))

  
<?php $one_file = explode(",", $send_message->file_path); ?>

          <p class="bg-warning" style="padding: 8px;">

{{ Lang::get($path.'.Download_the_attached_file') }} ({{ count($one_file) . ' ' . Lang::get($path.'.Attached_File') }}) : <br><br> 

<?php 
for ($i=0 ; $i < count($one_file) ; $i++) {  
   ?>            
            <a style="color: #c55; text-decoration: none;" href="{{ url() }}/uploads/files_messages/{{ $one_file[$i] }}">- <i class="glyphicon glyphicon-paperclip"></i> {{ Lang::get($path.'.download') }}</a><br>
          
<?php } ?>      
</p>
        @endif
        
      </div>
      


    </div>
  </div>
</div>


@endforeach
                </tbody>
              </table>

</div>

    <div class="clear"></div>
    <div class="center">
        {{ $send_messages->links() }}
    </div>




  </div>
</div>



@stop