<!-- Komponente: Einzelner Beitrag

Zeigt die Informationen eines Beitrags an (Titel, Text, Datum, Autor).
Optionale Anzeige des vollständigen Textes über die Variable:
$f: bool (Standard: true)
Erwartete Variable:
$post: Post -->
@php
$f = $f ?? true;
@endphp
<article class="flex max-w-xl flex-col items-start justify-between">

    <div class="group relative grow">

        <h3 class="mt-3 text-lg font-semibold text-gray-900 group-hover:text-gray-600">
            {{ $post->title }}
        </h3>

        @if($f)
        <p class="mt-5 text-sm text-gray-600">
            {{ $post->text }}
        </p>
        <div id="post-{{ $post->id }}">
            <button class="upvote" data-id="{{ $post->id }}" data-type="App\Models\Post">⬆️</button>
            <span class="score">{{ $post->votes()->sum('vote') }}</span>
            <button class="downvote" data-id="{{ $post->id }}" data-type="App\Models\Post">⬇️</button>
        </div>
        @else
        <p class="mt-5 line-clamp-3 text-sm text-gray-600">
            {{ $post->text }}
        </p>
        @endif

    </div>

    <div class="flex items-center gap-x-4 text-xs mt-4">
        <time class="text-gray-500">
            {{ $post->updated_at }}
        </time>
    </div>

    <a href="{{ route('users.show', $post->user->id) }}">
        <span>
            By @include('users.user', ['user' => $post->user, 'u' => false])
        </span>
    </a>

</article>