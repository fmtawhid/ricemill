<!-- resources/views/news/result.blade.php -->

@extends('layouts.news')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>সার্চ রেজাল্ট: "{{ $query }}"</h2>

            @if ($results->isEmpty())
                <p>কোনো ফলাফল পাওয়া যায়নি।</p>
            @else
                <div class="category-page">
                    @foreach ($results as $post)
                        <div class="category-content-single">
                            <a href="{{ route('single', $post->slug) }}">
                                <div class="category-content-single-left">
                                    <img class="img-fluid" 
                                        src="{{ asset('img/posts/' . $post->image) }}"
                                        alt="{{ $post->title }}">
                                </div>
                                <div class="category-content-single-right">
                                    <h2>{{ $post->title }}</h2>
                                    <p>{{ \Illuminate\Support\Str::limit($post->short_summary, 100) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
