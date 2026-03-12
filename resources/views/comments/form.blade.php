<!-- Komponente: Kommentarformular

Ermöglicht angemeldeten Nutzern, einen Kommentar oder eine Antwort auf einen Beitrag zu schreiben.

Erwartete Variablen:
$post_id: int (ID des Beitrags)
$parent_id: int|null (ID des übergeordneten Kommentars, falls Antwort)
Der angemeldete Nutzer wird automatisch über Auth::id() gesetzt. -->
@auth
<form method="POST" action="{{ route('comments.store') }}" class="mt-3">
    @csrf

    <input type="hidden" name="post_id" value="{{ $post_id }}">
    <input type="hidden" name="parent_id" value="{{ $parent_id }}">
    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

    <div class="relative w-full min-w-[200px]">
        <textarea name="text" class="form-textarea peer" placeholder=" "></textarea>
        <label class="form-label peer-focus:text-gray-900">
            Write a comment
        </label>
    </div>

    <button class="mt-2 text-sm text-blue-600 hover:underline" type="submit">
        Reply
    </button>
</form>
@endauth