@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sample.css') }}">
@endsection

@section('content')
<h1 class='pagetitle'>マイページ</h1>

<div class="row justify-content-center">
	
	@foreach($reviews as $review)
	
	    <div class="col-md-4">
	        <div class="card mb50">
	            <div class="card-body">
	            	<h3 class='h1 book-title'>{{ $review->title }}</h3>
	            	@if(!empty($review->image))
			            <div class='image-wrapper'><img class='book-image' src="{{ asset('storage/images/'.$review->image) }}"></div>
			        @else
		                <div class='image-wrapper'><img class='book-image' src="{{ asset('images/canp.jpg') }}"></div>
	                @endif
	                
	                
	                <p class='description'>
	                    {{ $review->body }}
	                </p>
	 
	            <a href="{{ route('show', ['id' => $review->id ]) }}" class='btn btn-secondary detail-btn'>詳細を読む</a>
	            <br>
	             @if($review->is_liked_by_auth_user())
				  <a href="{{ route('review.unlike', ['id' => $review->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $review->likes->count() }}</span></a>
				@else
				  <a href="{{ route('review.like', ['id' => $review->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $review->likes->count() }}</span></a>
				@endif
				
	            <a href="{{ route('res', ['id' => $review->id]) }}" class="btn btn-primary">コメントする</a>
	            
	            @if($review->user->id == \Auth::id())
	            
		            <a href="{{ route('edit',['id' => $review->id]) }}" class="btn btn-success">編集する</a>
		            
		            <a href="{{ route('delete',['id' => $review->id]) }}" class="btn btn-danger">削除する</a>
		        @endif
		        
	            </div>
	        </div>
	    </div>
	    
	@endforeach 
	
</div>
 <a href="{{ route('index') }}" class='btn btn-info btn-back back-btn mb20'>一覧へ戻る</a>

{{ $reviews->links() }}

@endsection