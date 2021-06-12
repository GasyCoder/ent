@extends('layouts.master')

<?php $control = Control::find(1); ?>
<?php $path = Session::get('language'); ?>

@section('metaTages') 
<meta name="keywords" content="{{ $control->keywords }}">
<meta name="description" content="{{ $control->description }}">
@stop

@section('title') {{ $category->name }} @stop

@section('content')

<ol class="breadcrumb link-map">
  <li><a href="{{ URL::route('home') }}">{{ Lang::get($path.'.Home') }}</a></li>
  <li class="active">{{ $category->name }}</li>
</ol>

<div class="articles">

@if(count($articles) >= 1)


@foreach($articles as $article)

<div class="single">
    <div class="panel panel-default bord-t">
      <div class="panel-body">
            
            <a href="{{ URL::route('article', ['id'=>$article->id, 'slug'=>$article->slug]) }}"><h3>{{ $article->title }}</h3></a>
            <div class="clear"></div>

            <div class="row">
                <div class="col-xs-12 col-sm-3">
                    <ol class="breadcrumb">
                      <li><i class="fa fa-calendar"></i> {{ substr($article->created_at, 0, 10) }}</li>
                    </ol>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <ol class="breadcrumb">
                      <li><a href="{{ URL::route('article', ['id'=>$article->id, 'slug'=>$article->slug]) }}"><i class="fa fa-comments"></i> {{ $article->count_comment }} {{ Lang::get($path.'.comments') }}</a></li>
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

        <div class="col-md-4">
          <a href="{{ URL::route('article', ['id'=>$article->id, 'slug'=>$article->slug]) }}">
            @if(!empty($article->image))
            <?php echo HTML::image('uploads/articles/'.$article->image.'', '', ['class'=>'img-thumbnail article-img']) ?>
            @else
            {{ HTML::image('uploads/articles/article.jpg', '', ['class'=>'img-thumbnail article-img']) }}
            @endif
          </a>
        </div>
        <div class="col-md-8">
            <p class="desc">{{ mb_substr(strip_tags(htmlspecialchars_decode($article->content)), 0, 300, 'utf-8') }} ..</p>
             <div class="clear"></div><hr>
             @if(Session::get('language') == 'ar') 
             <div class="pull-left">
                <a href="{{ URL::route('article', ['id'=>$article->id, 'slug'=>$article->slug]) }}" class="read-more btn" >{{ Lang::get($path.'.continue_reading') }}</a>
             </div>
             @else
             <div class="pull-right">
                <a href="{{ URL::route('article', ['id'=>$article->id, 'slug'=>$article->slug]) }}" class="read-more btn" >{{ Lang::get($path.'.continue_reading') }}</a>
             </div>
             @endif
        </div>
        
      </div>
    </div>

 </div>  

@endforeach

<div class="clear"></div>
<div class="well-sm center">
    {{ $articles->links() }}

</div>


@else 
<div class="single">
    <div class="panel panel-default bord-t">
      <div class="panel-body">
      <br>
        <div class="alert alert-info center" role="alert">
          <strong>{{ Lang::get($path.'.no_articles_in') }} {{ $category->name }}</strong>
        </div>

      </div>
    </div>
</div>

@endif



</div>


@stop