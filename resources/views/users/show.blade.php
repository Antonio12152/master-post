<!-- Seite: Benutzerprofil

Zeigt das Profil eines Nutzers und dessen Beiträge.
Wenn der angemeldete Nutzer der Profilinhaber ist, werden Links zum Bearbeiten und Erstellen von Beiträgen angezeigt.

Erwartete Variablen:
$user: User
$posts: Collection<Post> -->
@extends('layout')

@section('content')

<div>
    @include('users.user', ['user' => $user, 'f'=>true, 'u'=>true])
    @auth
    @if(Auth::id()==$user->id)
    <a href="{{ route('users.edit', $user->id) }}">Update</a>
    <a href="{{ route('posts.create', $user->id) }}">Create Post</a>
    @endif
    @if(Auth::id() == $user->id)
    @include('users.delete')
    @endif
    @endauth
</div>
<div class="bg-white py-24 sm:py-32">
    @include('form.query', [
    'url' => route('users.show', ['id' => $user->id]),
    'q' => 'p'
    ])
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto  lg:mx-0">
            <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Posts</h2>
        </div>
        {{ $posts->links() }}
        @foreach ($posts as $post)
        <a href="{{route('posts.show', $post->id)}}">
            @include('posts.post', ['post' => $post, 'u'=>false])
        </a>
        @endforeach
        {{ $posts->links() }}
    </div>
</div>

@endsection