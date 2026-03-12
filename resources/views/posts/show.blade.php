<!-- Seite: Beitragsdetails

Zeigt einen einzelnen Beitrag mit allen zugehörigen Kommentaren an.
Ermöglicht dem Beitragsersteller oder einem Admin:
- den Beitrag zu bearbeiten
- den Beitrag zu löschen

Erwartete Variablen:
$post: Post -->

@extends('layout')

@section('content')

<div class="max-w-3xl mx-auto">

    @include('posts.post', [
    'post' => $post,
    'f' => true,
    'u' => true
    ])

    @auth
    @if(Auth::id() === $post->user_id)
    <a href="{{ route('posts.edit', $post->id) }}"
        class="text-blue-600 hover:underline">
        Update
    </a>
    @endif
    @if(Auth::id() == $post->user->id || Auth::user()->type === 'admin')
    @include('posts.delete', ['post'=>$post])
    @endif
    @endauth

    <div class="mt-8">

        @include('comments.form', [
        'post_id' => $post->id,
        'parent_id' => null
        ])

        @foreach ($post->comments->whereNull('parent_id') as $comment)
        @include('comments.comment', ['comment' => $comment])
        @endforeach

    </div>

</div>

@endsection