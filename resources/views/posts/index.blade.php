<!-- Seite: Beitragsübersicht

Zeigt eine Liste aller Beiträge mit Paginierung und Such-/Filterformular.
Erwartete Variable:
$posts: Collection<Post> -->

@extends('layout')

@section('content')

<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto  lg:mx-0">
            <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Posts</h2>
        </div>
        @include('form.query', [
        'url' => route('posts.index'),
        'q' => 'p'
        ])
        {{ $posts->links() }}
        @foreach ($posts as $post)
        <a href="{{route('posts.show', $post->id)}}">
            @include('posts.post', ['post' => $post, 'f'=>false])
        </a>
        @endforeach
        {{ $posts->links() }}
    </div>
</div>

@endsection