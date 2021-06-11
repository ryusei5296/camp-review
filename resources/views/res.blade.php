
@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <h1 class='pagetitle'>レビュー詳細ページ</h1>
  <div class="card">
    <div class="card-body d-flex">
      <section class='review-main'>
        <h2 class='h2'>キャンプ地</h2>
        <p class='h5 mb20'>{{ $review->title }}</p>
        <h2 class='h2'>レビュー本文</h2>
        <p>{{ $review->body }}</p>
        
      </section>  
      <aside class='review-image'>
		@if(!empty($review->image))
		        <img class='book-image' src="{{ asset('storage/images/'.$review->image) }}">
		@else
		        <img class='book-image' src="{{ asset('images/dummy.png') }}">
		@endif
      </aside>
	    
    </div>
    <a href="{{ route('index') }}" class='btn btn-info btn-back mb20'>一覧へ戻る</a>
    
  </div>
  <div class="container card mb20 center">
  	<br>
	  	@foreach($comments as $comment)
	    	<div class="form-group center">
	    	{{ $comment->user->name }} : {{ $comment->description }}
	    	</div>
	    @endforeach
	      <form method='POST' action="{{ route('res-store',['id' => $review->id ]) }}">
	        @csrf
	              <div class="form-group center">
	                <input type='text' name='description' placeholder='コメントを入力'>
	                <input type='submit' class='btn btn-primary' value='送信'>
	              </div>
	      </form>
		    
		</div>
</div>

@endsection