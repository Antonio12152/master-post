<!-- Seite: Benutzerkonto aktualisieren

Ermöglicht dem Nutzer, seine Kontodaten zu ändern (Name, E-Mail, Beschreibung, Passwort, Typ).
Erwartet die Variable:
$user: User -->

@extends('layout')

@section('content')


<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Update your account" class="mx-auto h-10 w-auto" />
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Update your account</h2>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PATCH')
            <div>
                <label for="name" class="block text-sm/6 font-medium text-gray-900">New Name</label>
                <div class="mt-2">
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="New Name"
                        required
                        value="{{ $user->name }}" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">
                </div>
            </div>
            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">New Email address</label>
                <div class="mt-2">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="New Email"
                        required
                        value="{{ $user->email }}" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">
                </div>
            </div>

            <div class="relative w-full min-w-[200px]">
                <label class="block text-sm/6 font-medium text-gray-900">New Description</label>
                <textarea
                    class="block w-full rounded-md bg-white/5 px-3 py-1.5 h-24 text-base text-black outline-1 -outline-offset-1 outline-black/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 resize-none"
                    name="description"
                    placeholder=" ">{{ $user->description }}</textarea>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">New Password</label>
                </div>
                <div class="mt-2">
                    <input id="password" type="password" name="password" placeholder="New Password" autocomplete="current-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="current_password" class="block text-sm/6 font-medium text-gray-900">Current Password</label>
                </div>
                <div class="mt-2">
                    <input id="current_password" type="password" name="current_password" placeholder="Password" required autocomplete="current-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-black outline-1 -outline-offset-1 outline-black/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                </div>
            </div>
            <div>
                <div class="flex items-center justify-between">
                    <label for="type" class="block text-sm/6 font-medium text-gray-900 sr-only">Type</label>
                </div>
                <div class="mt-2">
                    <select id="type" name="type" class="block py-2.5 ps-0 w-full text-sm text-body bg-transparent rounded-md outline-1 -outline-offset-1 outline-black/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 peer">
                        <option value="user" selected>User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    Update
                </button>
            </div>
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
        </form>
    </div>
</div>

@endsection