<!-- Komponente: Einzelner Kommentar

Zeigt einen Kommentar an, inklusive Autor und Text.
Ermöglicht das Antworten auf den Kommentar und das Anzeigen von Antworten (Replies).

Erwartete Variable:
$comment: Comment -->
<div class="ml-5 mt-4">

    <a href="{{ route('users.show', $comment->user->id) }}"
        class="font-semibold text-gray-800 hover:underline">
        {{ $comment->user->name }}
    </a>

    <p class="mt-1 text-gray-700">
        {{ $comment->text }}
    </p>
    <div id="comment-{{ $comment->id }}">
        <button class="upvote" data-id="{{ $comment->id }}" data-type="App\Models\Comment">⬆️</button>
        <span class="score">{{ $comment->votes()->sum('vote') }}</span>
        <button class="downvote" data-id="{{ $comment->id }}" data-type="App\Models\Comment">⬇️</button>
    </div>
    @include('comments.form', [
    'post_id' => $comment->post_id,
    'parent_id' => $comment->id ?? null
    ])

    @if ($comment->replies->count())
    <button
        id="button_comment_{{ $comment->id }}"
        onclick="close_open('{{ $comment->id }}','{{ $comment->replies->count() }}')"
        class="mt-2 text-sm text-gray-500 hover:text-gray-800">
        Show comments {{ $comment->replies->count() }}
    </button>

    <div id="sub_comments_{{ $comment->id }}" class="hidden mt-2">

        @foreach ($comment->replies as $reply)
        @include('comments.comment', ['comment' => $reply])
        @endforeach

    </div>
    @endif

</div>