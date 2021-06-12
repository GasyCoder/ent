@extends('layouts.master')

<?php $control = Control::find(1); ?>
<?php $path = Session::get('language'); ?>


@section('metaTages') 
<meta name="keywords" content="{{ $control->keywords }}">
<meta name="description" content="{{ substr($article->content, 0, 80) }} ..">
@stop

@section('title') {{ $article->title }} @stop

@section('content')

<ol class="breadcrumb link-map">
  <li><a href="{{ URL::route('home') }}">{{ Lang::get($path.'.Home') }}</a></li>
  <li class="active">{{ $article->title }}</li>
</ol>

<div class="articles">

<style type="text/css">
.single img { 
  max-width: 100%;
  height: auto; 
}
</style>

<div class="single">
	<div class="panel panel-default">
      <div class="panel-body">
        	
	        <h3>{{ $article->title }}</h3>
	        <div class="clear"></div>

	        <div class="row">
	        	<div class="col-xs-12 col-sm-3">
	        		<ol class="breadcrumb">
					  <li><i class="fa fa-calendar"></i> {{ substr($article->created_at, 0, 10) }}</li>
					</ol>
	        	</div>
	        	<div class="col-xs-12 col-sm-3">
	        		<ol class="breadcrumb">
					  <li><i class="fa fa-comments"></i> {{ $article->count_comment }} {{ Lang::get($path.'.comments') }}</li>
					</ol>
	        	</div>	
	        	<div class="col-xs-12 col-sm-3">
	        		<ol class="breadcrumb">
					     @if($article->category_id > 0) 
                  <li><a href="{{ URL::route('category', ['id'=>$article->category->id, 'slug'=>$article->category->slug ]) }}"><i class="fa fa-folder"></i> {{ $article->category->name }}</a></li>
                @else
                  <li><i class="fa fa-folder"></i> {{ Lang::get($path.'.category') }}</li>
                @endif
					     </ol>
	        	</div>	

	        </div>
	        <div class="clear"></div>
    	</div>
    </div>

    <div class="panel panel-default bord">
      <div class="panel-body">

        <p class="desc">{{ htmlspecialchars_decode($article->content) }}</p>

      <div class="clear"></div>

<div class="social-gh">
      <div class="col-md-6">
              <a class="btn btn-block btn-social btn-facebook" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>">
              <span class="fa fa-facebook"></span> <label> {{ Lang::get($path.'.share_facebook') }}</label>
            </a>
      </div>
      <div class="col-md-6">
              <a class="btn btn-block btn-social btn-twitter" target="_blank" href="https://twitter.com/intent/tweet?text={{ $article->title }}&url=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>">
              <span class="fa fa-twitter"></span> <label> {{ Lang::get($path.'.share_twitter') }}</label>
            </a>
      </div>
</div>

        <div class="clear"></div><hr>

@if(Session::has('success'))
<div class="alert alert-success center alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>{{ Session::get('success') }}</strong>
</div>
@endif

<div class="clear"></div>


@if($article->count_comment >= 1)

    @foreach($comments as $comment)
    <div class="bs-example" data-example-id="default-media">
        <div class="media comments">
          <div class="media-left">
            
                @if($comment->user->is_admin)
                    @if(!empty($comment->user->image))
                    <?php echo HTML::image('uploads/profiles/'.$comment->user->image.'', '', []) ?>
                    @else
                      {{ HTML::image('uploads/profiles/administrator.png', '', []) }}
                    @endif
                @endif

                @if($comment->user->is_student)
                    @if(!empty($comment->user->image))
                    <?php echo HTML::image('uploads/profiles/students/'.$comment->user->image.'', '', []) ?>
                    @else
                      {{ HTML::image('uploads/profiles/student.png', '', []) }}
                    @endif
                @endif

                @if($comment->user->is_parent)
                    @if(!empty($comment->user->image))
                    <?php echo HTML::image('uploads/profiles/parents/'.$comment->user->image.'', '', []) ?>
                    @else
                      {{ HTML::image('uploads/profiles/parent.png', '', []) }}
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

                    @if (Auth::user()->is_admin OR $comment->user->id == Auth::user()->id)
                        {{ Form::open(['route'=>['comment_delete', $comment->id], 'method'=>'POST']) }}
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




        @if(Auth::check())

            {{ Form::open(['route'=>['comment_store', $article->id], 'method'=>'POST']) }}

                <div class="form-group">
                  {{ Form::textarea('content', '', ['class'=>'form-control', 'rows'=>'5']) }} 

                  @if($errors->first('content'))
                  <span class="help-block red-color">{{ $errors->first('content') }}</span>
                  @endif

                </div>

                {{ Form::submit(Lang::get($path.'.comment'), ['class'=>'btn btn-success']) }} 

            {{ Form::close() }}



        @else 


<div class='alert alert-info center'><br><p>{{ Lang::get($path.'.login_to_comment') }}</p><br> <a target="_blank" href="{{ URL::route('users.login') }}" class="btn btn-default btn-lg">{{ Lang::get($path.'.login') }}</a> </div>



        @endif


        
      </div>
    </div>

 </div>  



</div>

@stop