@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ $lesson->title }} @stop

@section('content')
 
{{ HTML::script('js/emoti.js') }}



  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('student_lessons') }}">{{ Lang::get($path.'.lessons') }}</a></li>
    <li class="active">{{ $lesson->title }}</li>
  </ol>
  <div class="clear"></div><hr>

  <div class="panel panel-info">
      <div class="panel-heading">
        <h2 class="panel-title">{{ $lesson->title }}</h2>
      </div>
      <div class="panel-body">
        <p style="font-weight: 15px;">{{ htmlspecialchars_decode($lesson->content) }}</p>
        <div class="clear"></div><hr>

        <p style="padding: 8px; font-weight: bold; color: #a3a3a3;"><i class="fa fa-calendar"></i> {{ $lesson->created_at }}</p>

        @if(!empty($lesson->jointe))
          


<?php $one_file = explode(",", $lesson->jointe); ?>

          <p class="bg-warning" style="padding: 8px;">

{{ Lang::get($path.'.Download_the_attached_file') }} ({{ count($one_file) . ' ' . Lang::get($path.'.Attached_File') }}) : <br><br> 

<?php 
for ($i=0 ; $i < count($one_file) ; $i++) {  
   ?>            
            <a style="color: #c55; text-decoration: none;font-size: 18px;" href="{{ url() }}/uploads/lessons/{{ $one_file[$i] }}" download="" target="_blank"> &nbsp;&nbsp;&nbsp;/<i class="fa fa-paperclip faa-float animated"></i><i class="fa fa-cloud-download" aria-hidden="true"></i>
</a>
          
<?php } ?>      
</p>

        @endif

<?php 

$comments = $lesson->comments;

 ?>

<div class="clear"></div><hr>
<h4>Laiser votre commentaire : </h4> 
@if(count($comments) >= 1)

    @foreach($comments as $comment)
    <div class="bs-example" data-example-id="default-media">
        <div class="media comments">
          <div class="media-left">
            
    

                @if($comment->user->is_student)
                    @if(!empty($comment->user->image))
                    <?php echo HTML::image('uploads/profiles/students/'.$comment->user->image.'', '', []) ?>
                    @else
                      {{ HTML::image('uploads/profiles/student.png', '', []) }}
                    @endif
                @endif


                @if($comment->user->is_teacher)
                    @if(!empty($comment->user->image))
                    <?php echo HTML::image('uploads/profiles/teachers/'.$comment->user->image.'', '', []) ?>
                    @else
                      {{ HTML::image('uploads/profiles/teacher.jpg', '', []) }}
                    @endif
                @endif
            
          </div>
          <div class="media-body">
            <h4 class="media-heading">{{ $comment->user->fullname }}</h4>
            <div class="pull-left">
                {{ $comment->content }}
            </div>
            <div class="pull-right">
                @if(Auth::check())

                    @if ($comment->user->id == Auth::user()->id)
                        {{ Form::open(['route'=>['s_lesson_comment_delete', $comment->id], 'method'=>'POST']) }}
                        <button type="submit" class="btn btn-warning"><i class="fa fa-trash"></i></button>
                        {{ Form::close() }}
                    @endif
                @endif
            </div>
            
          </div>
        </div>
    </div>
   
    @endforeach


@endif



      {{ Form::open(['route'=>['s_lesson_comment_store', $lesson->id], 'method'=>'POST']) }}

                <div class="form-group">
                  {{ Form::textarea('content', '', ['class'=>'form-control', 'rows'=>'5']) }} 

                  @if($errors->first('content'))
                  <span class="help-block red-color">{{ $errors->first('content') }}</span>
                  @endif

                </div>

                {{ Form::submit(Lang::get($path.'.comment'), ['class'=>'btn btn-success']) }} 

      {{ Form::close() }}


      </div>
    </div>



  
  </div>
</div>

<script type="text/javascript">
  $('#myForm').validator();
</script>

@stop