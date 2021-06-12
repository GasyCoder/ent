@extends('layouts.panel_master')

<?php $path = Session::get('language'); ?>

@section('title') {{ $lesson->title }} @stop

@section('content')

  {{ HTML::style('css/smile.css') }}

    <!-- Begin emoji-picker Stylesheets -->
{{ HTML::style('lib/css/emoji.css') }}
    <!-- End emoji-picker Stylesheets -->
 {{ HTML::script('https://code.jquery.com/jquery-1.11.3.min.js') }}

    <!-- Begin emoji-picker JavaScript -->
    {{ HTML::script('lib/js/config.js') }}
    {{ HTML::script('lib/js/util.js') }}
    {{ HTML::script('lib/js/jquery.emojiarea.js') }}
    {{ HTML::script('lib/js/emoji-picker.js') }}
    <!-- End emoji-picker JavaScript -->
    
  <br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    <li><a href="{{ URL::route('teacher_lessons') }}">{{ Lang::get($path.'.lessons') }}</a></li>
    <li class="active">{{ $lesson->title }}</li>
  </ol>
  <div class="clear"></div><hr>

  <div class="panel panel-info">
      <div class="panel-heading">
        <h3 class="panel-title">{{ $lesson->title }}</h3>
      </div>
      <div class="panel-body">
        {{ htmlspecialchars_decode($lesson->content) }}
        <div class="clear"></div><hr>

        <p style="padding: 8px; color: #a3a3a3;"><i class="fa fa-calendar"></i> {{ $lesson->created_at }}</p>


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
                        {{ Form::open(['route'=>['t_lesson_comment_delete', $comment->id], 'method'=>'POST']) }}
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


      {{ Form::open(['route'=>['t_lesson_comment_store', $lesson->id], 'method'=>'POST']) }}

                <div class="form-group">
                  <p class="lead emoji-picker-container">
                  {{ Form::textarea('content', '', ['class'=>'form-control textarea-control', 'rows'=>'5', 'data-emojiable'=>'true']) }} 

                  @if($errors->first('content'))
                  <span class="help-block red-color">{{ $errors->first('content') }}</span>
                  @endif
                  </p
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


    <script>
      $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: 'lib/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      });
    </script>
    <script>
      // Google Analytics
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-49610253-3', 'auto');
      ga('send', 'pageview');
    </script>
@stop