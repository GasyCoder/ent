@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>
@section('title') {{ Lang::get($path.'.incoming_messages') }} @stop

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
    <li class="active">{{ Lang::get($path.'.incoming_messages') }}</li>
  </ol>
  <div class="clear"></div><hr>


<?php 
$user_id = Auth::user()->id;
$read_msgs = Message::where('receiver_id', $user_id)->where('receiver_statu', 0)->where('read', 0)->get();
foreach ($read_msgs as $read_msg) {
  $read_msg->read = '1';
  $read_msg->save();  
}

 ?>


<div class="messages">

    <table class="table table-filter">
                <tbody>

@foreach($messages as $message)                
                  <tr>
                    <td>
                      <div class="media" data-toggle="modal" data-target=".modelmsg_{{ $message->id }}" >
                        <a href="#" class="pull-left">
                        @if(!empty($message->getSender->image))
                          
                          @if($message->getSender->is_admin)
                            @if(!$message->getSender->is_manager)
                            <?php echo HTML::image('uploads/profiles/'.$message->getSender->image.'', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px']) ?>
                            @endif
                            @if($message->getSender->is_manager)
                            <?php echo HTML::image('uploads/profiles/managers/'.$message->getSender->image.'', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px']) ?>
                            @endif
                          @endif

                          @if($message->getSender->is_student)
                            <?php echo HTML::image('uploads/profiles/students/'.$message->getSender->image.'', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px']) ?>
                          @endif

                          @if($message->getSender->is_parent)
                            <?php echo HTML::image('uploads/profiles/parents/'.$message->getSender->image.'', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px']) ?>
                          @endif

                          @if($message->getSender->is_teacher)
                            <?php echo HTML::image('uploads/profiles/teachers/'.$message->getSender->image.'', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px']) ?>
                          @endif

                        @else
                            {{ HTML::image('uploads/profiles/mail.png', '', ['class'=>'img-thumbnail img-responsive', 'width'=>'48px', 'height'=>'48px']) }}
                        @endif
                        </a>
                        <div class="media-body">
                          <span class="media-meta pull-right">{{ $message->created_at }}</span>
                          <h4 class="title">
                            {{ $message->getSender->fullname }}
                            <span class="pull-right pagado">@if($message->getSender->is_admin) ({{ Lang::get($path.'.admin') }}) @elseif($message->getSender->is_student) ({{ Lang::get($path.'.student') }}) @elseif($message->getSender->is_teacher) ({{ Lang::get($path.'.teacher') }}) @elseif($message->getSender->is_parent) ({{ Lang::get($path.'.guardian') }}) @endif</span>
                          </h4>
                          <p class="summary">{{ $message->subject }}</p>
                        </div>
                      </div>


                      @if($auth_user->is_admin)
                        <a href="{{ URL::route('admin_messages_destroy', $message->id) }}" class="dlt btn btn-default btn-sm pull-right"><i class="glyphicon glyphicon-trash"></i></a>
                      @endif
                      @if($auth_user->is_student)
                        <a href="{{ URL::route('student_messages_destroy', $message->id) }}" class="dlt btn btn-default btn-sm pull-right"><i class="glyphicon glyphicon-trash"></i></a>
                      @endif
                      @if($auth_user->is_teacher)
                        <a href="{{ URL::route('teacher_messages_destroy', $message->id) }}" class="dlt btn btn-default btn-sm pull-right"><i class="glyphicon glyphicon-trash"></i></a>
                      @endif
                      @if($auth_user->is_parent)
                        <a href="{{ URL::route('parent_messages_destroy', $message->id) }}" class="dlt btn btn-default btn-sm pull-right"><i class="glyphicon glyphicon-trash"></i></a>
                      @endif

                    </td>
                  </tr>


<div class="modal fade bs-example-modal-lg modelmsg_{{ $message->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ $message->subject }}</h4>
      </div>
      <div class="modal-body">
        <p>{{ $message->message }}</p>

        @if(!empty($message->file_path))


<?php $one_file = explode(",", $message->file_path); ?>

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
      <div class="modal-footer">
        @if($auth_user->is_admin)
          <a href="{{ URL::route('a_contact', $message->getSender->id ) }}" class="btn btn-warning btn-lg"><i class="fa fa-wechat"></i> {{ Lang::get($path.'.reply') }}</a>
        @endif
        @if($auth_user->is_student)
          <a href="{{ URL::route('s_contact', $message->getSender->id ) }}" class="btn btn-warning btn-lg"><i class="fa fa-wechat"></i> {{ Lang::get($path.'.reply') }}</a>
        @endif
        @if($auth_user->is_teacher)
          <a href="{{ URL::route('t_contact', $message->getSender->id ) }}" class="btn btn-warning btn-lg"><i class="fa fa-wechat"></i> {{ Lang::get($path.'.reply') }}</a>
        @endif
        @if($auth_user->is_parent)
          <a href="{{ URL::route('p_contact', $message->getSender->id ) }}" class="btn btn-warning btn-lg"><i class="fa fa-wechat"></i> {{ Lang::get($path.'.reply') }}</a>
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
        {{ $messages->links() }}
    </div>




  </div>
</div>



@stop