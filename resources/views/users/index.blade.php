<!-- Seite: Benutzerübersicht.

Zeigt eine Liste aller Nutzer mit Paginierung und Such-/Filterformular.

Erwartete Variablen:
$users: Collection<User> -->

@extends('layout')

@section('content')
<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto  lg:mx-0">
            <h2 class="text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">Users</h2>
        </div>
        @include('form.query', [
        'url' => route('users.index'),
        'q' => 'u'
        ])
        {{ $users->links() }}
        <div class="mx-auto mt-10 grid gap-x-8 gap-y-16 sm:mt-16 lg:mx-0 lg:grid-cols-3">
            @foreach ($users as $user)
            <a href="{{ route('users.show', $user->id) }}">
                @include('users.user', ['user' => $user, 'u'=>true])
            </a>
            @endforeach
        </div>
        {{ $users->links() }}
    </div>
</div>
@endsection