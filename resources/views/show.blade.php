
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
        <h2 class='h2'>本のタイトル</h2>
        <p class='h2 mb20'>{{ $review->title }}</p>
        <h2 class='h2'>レビュー本文</h2>
        <p>{{ $review->body }}</p>
      </section>  
      <aside class='review-image'>
@if(!empty($review->image))
        <img class='book-image' src="{{ asset('storage/images/'.$review->image) }}">
@else
        <img class='book-image' src="{{ asset('images/dummy.png') }}">
@endif
<div>
  @if($review->is_liked_by_auth_user())
    <a href="{{ route('review.unlike', ['id' => $review->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $review->likes->count() }}</span></a>
  @else
    <a href="{{ route('review.like', ['id' => $review->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $review->likes->count() }}</span></a>
  @endif
</div>
      </aside>
    </div>
    <a href="{{ route('index') }}" class='btn btn-info btn-back mb20'>一覧へ戻る</a>
  </div>
</div>
@endsection