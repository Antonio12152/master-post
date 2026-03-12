<!-- Seite: Neuer Beitrag erstellen

Ermöglicht angemeldeten Nutzern, einen neuen Beitrag zu erstellen.
Das Formular sammelt:
- Titel
- Text
- automatisch gesetzte User-ID (aktueller Benutzer)

Die Daten werden per POST an die Route 'posts.store' gesendet. -->
@extends('layout')

@section('content')

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-xl">
        <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900">
            Create a new post
        </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-xl">
        <form method="POST" action="{{ route('posts.store') }}" class="space-y-6">
            @csrf

            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

            <div>
                <label for="title" class="block text-sm font-medium text-gray-900">
                    Title
                </label>

                <div class="mt-2">
                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Post title"
                        required
                        class="block w-full rounded-md bg-white px-3 py-2 text-black outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500">
                </div>
            </div>

            <div>
                <label for="text" class="block text-sm font-medium text-gray-900">
                    Text
                </label>

                <div class="mt-2">
                    <textarea
                        id="text"
                        name="text"
                        rows="6"
                        placeholder="Write your post..."
                        required
                        class="block w-full rounded-md bg-white px-3 py-2 text-black outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 resize-none">{{ old('text') }}</textarea>
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    Create Post
                </button>
            </div>

            @if ($errors->any())
            <div class="text-red-600 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

        </form>
    </div>
</div>

@endsection