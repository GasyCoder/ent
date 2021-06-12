@extends('layouts.panel_master')
<?php $path = Session::get('language'); ?>

@section('title') {{ Lang::get($path.'.library') }} @stop

@section('content')

<br><br><br><br>
<div class="panel panel-default panel-main">
  <div class="panel-body">
    
  <ol class="breadcrumb">
    @if($user->is_student)
      <li><a href="{{ URL::route('student_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @endif
    @if($user->is_admin)
      <li><a href="{{ URL::route('panel.admin') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @endif
    @if($user->is_teacher)
      <li><a href="{{ URL::route('teacher_panel') }}">{{ Lang::get($path.'.Home') }}</a></li>
    @endif
    <li class="active">{{ Lang::get($path.'.library') }}</li>
  </ol>

<div class="clear"></div><hr>

@if($user->is_admin == true OR $library_apv == 1)

<button class="btn btn-warning btn-lg" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-file"></i> {{ Lang::get($path.'.upload_file') }}</button>

@if($user->is_admin == true) &nbsp;&nbsp;&nbsp;<a href="{{ URL::route('admin_library_catg') }}" class="btn btn-default btn-lg"><i class="fa fa-list-alt"></i> {{ Lang::get($path.'.categories') }}</a>
@endif

@if(Session::has('css'))
  {{ Session::get('css') }}
@endif
<div class="collapse" id="collapseExample">

    @if($user->is_student)
      {{ Form::open(['route'=>'student_library_upload', 'files'=>'true', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
    @endif
    @if($user->is_admin)
      {{ Form::open(['route'=>'admin_library_upload', 'files'=>'true', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
    @endif
    @if($user->is_teacher)
      {{ Form::open(['route'=>'teacher_library_upload', 'files'=>'true', 'class'=>'col-md-12', 'id'=>'myForm', 'data-toggle'=>'validator'])  }}
    @endif


<div class="library-box">
    
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.file_name') }}  : </label>
                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file"></i></span>
                  {{ Form::text('file_name', '', ['class'=>'form-control input-lg']) }}
                  </div>
                @if($errors->first('content'))
                  <span class="help-block red-color">{{ $errors->first('content') }}</span>
                  @endif
              </div>
            </div>

 
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label">{{ Lang::get($path.'.category') }}  : </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>
                  <select name="category_id" class="form-control input-lg">

                    <option value="">{{ Lang::get($path.'.select') }}</option>
                    @foreach($categories as $categorie)
                      <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                    @endforeach
                    
                  </select>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
                @if($errors->first('category_id'))
                  <span class="help-block red-color">{{ $errors->first('category_id') }}</span>
                  @endif
              </div>
            </div>


            <div class="col-md-6">
              <div class="form-group">
                  <label class="control-label">{{ Lang::get($path.'.Attached_File') }} : </label>
                  {{ Form::file('file', ['class'=>'btn btn-default', 'id'=>'file']) }}

                    @if($errors->first('file'))
                      <span class="help-block red-color">{{ $errors->first('file') }}</span>
                    @endif

                    <span class="help-block">{{ Lang::get($path.'.Permitted_files') }} : doc, docx, ppt, pptx, pdf, rar, zip</span>

              </div>
            </div>

            <div class="col-md-12">
                {{ Form::submit(Lang::get($path.'.upload'), ['class'=>'btn btn-info']) }} 
            </div>
 </div>

    {{ Form::close() }}

</div>

@endif




<?php 
if (isset($_GET['catg'])) { 

$catg_id = htmlspecialchars($_GET['catg']);

$library_files = Library::where('category_id', $catg_id)->orderBy('id', 'desc')->paginate(15);


if (count($library_files) >= 1) {

 ?>



<div class="clear"></div><br>


@if(Auth::user()->is_teacher)
    <a href="{{ URL::route('teacher_library') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.all_library') }}</a>
@endif
@if(Auth::user()->is_student)
    <a href="{{ URL::route('student_library') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.all_library') }}</a>
@endif
@if(Auth::user()->is_admin)
    <a href="{{ URL::route('admin_library') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> {{ Lang::get($path.'.all_library') }}</a>
@endif


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

<div class="clear"></div><br>


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>

        <tr class="tr">
            <th>{{ Lang::get($path.'.file_name') }}</th>
            <th>{{ Lang::get($path.'.download') }}</th>
            <th>{{ Lang::get($path.'.by') }}</th>
            <th>{{ Lang::get($path.'.date') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
          
        </thead>
        <tbody>

@foreach($library_files as $library_file)

          <tr class="tr-body">

            <td>{{ $library_file->file_name }}</td>

            <td><a href="{{ url() }}/uploads/library/{{ $library_file->file_path }}"><i class="fa fa-cloud-download large"></i></a></td>

            @if(!empty($library_file->user_id))
              <td>{{ $library_file->user->fullname }}</td>
            @else
              <td>-</td>
            @endif

            <td>{{ $library_file->created_at }}</td>

@if($user->is_admin OR $library_file->user_id == $user->id)
    
    @if($user->is_student)
      <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('student_library_delete', $library_file->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>
    @endif
    @if($user->is_teacher)
      <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('teacher_library_delete', $library_file->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>
    @endif
    @if($user->is_admin)
      <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('admin_library_delete', $library_file->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>
    @endif
            
@endif

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $library_files->links() }}
    </div>






<?php } } else { ?>




@if (count($library_files) >= 1)

<div class="clear"></div><br>

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

<div class="clear"></div><br>


    <div class="table-responsive">
      <table class="table table table-striped table-bordered">
        <thead>

        <tr class="tr">
            <th>{{ Lang::get($path.'.category') }}</th>
            <th>{{ Lang::get($path.'.file_name') }}</th>
            <th>{{ Lang::get($path.'.download') }}</th>
            <th>{{ Lang::get($path.'.by') }}</th>
            <th>{{ Lang::get($path.'.date') }}</th>
            <th>{{ Lang::get($path.'.delete') }}</th>
          </tr>
          
        </thead>
        <tbody>

@foreach($library_files as $library_file)

          <tr class="tr-body">

            <td>
            @if(!empty($library_file->category_id))
              <a class="table-link" href="{{ URL::current() . '?catg=' . $library_file->category_id }}">{{ $library_file->category->name }}</a>
            @else - @endif
            </td>

            <td>{{ $library_file->file_name }}</td>

            <td><a href="{{ url() }}/uploads/library/{{ $library_file->file_path }}"><i class="fa fa-cloud-download large"></i></a></td>

            @if(!empty($library_file->user_id))
              <td>{{ $library_file->user->fullname }}</td>
            @else
              <td>-</td>
            @endif

            <td>{{ $library_file->created_at }}</td>

@if($user->is_admin OR $library_file->user_id == $user->id)
    
    @if($user->is_student)
      <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('student_library_delete', $library_file->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>
    @endif
    @if($user->is_teacher)
      <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('teacher_library_delete', $library_file->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>
    @endif
    @if($user->is_admin)
      <td><a onclick="return confirm('{{ Lang::get($path.'.delete') }}')" href="{{ URL::route('admin_library_delete', $library_file->id) }}"><i class="glyphicon glyphicon-trash large"></i></a></td>
    @endif
            
@endif

          </tr>
@endforeach 

        </tbody>
      </table>
    </div><!-- /.table-responsive -->

    <div class="clear"></div>
    <div class="center">
        {{ $library_files->links() }}
    </div>

@endif

<?php } ?>

  </div>
</div>



@stop