@extends('layouts.app')

@section('content')
	<h1 class='pagetitle'>編集ページ</h1>
	
	@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
	
	<div class="row justify-content-center container">
	    <div class="col-md-10">
	      <form method='POST' action="{{ route('update',['id' => $data->id]) }}" enctype="multipart/form-data">
	        @csrf
	        <div class="card">
	            <div class="card-body">
	              <div class="form-group">
	                <label>キャンプ場</label>
	                <input type='text' name='title' value="{{ $data->title }}" placeholder='タイトルを入力'>
	              </div>
	              <div class="form-group">
	              <label>レビュー本文</label>
	                <textarea class='description form-control' name='body'>{{ $data->body }}</textarea>
	              </div>
	              <div class="form-group">
	                <label for="file1">キャンプのサムネイル</label>
	                <input type="file" id="file1" name='image' class="form-control-file" value="あ.jpg">
	              </div>
	              <input type='submit' class='btn btn-primary' value='レビューを登録'>
	            </div>
	        </div>
	      </form>
	    </div>
	</div>
@endsection