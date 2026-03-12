<!-- Dieser Code wird nicht verwendet. -->
@extends('layout')

@section('content')

<form method="POST" action="{{ route('users.store') }}">
    @csrf

    <input
        type="text"
        name="name"
        placeholder="Name"
        required>

    <input
        type="email"
        name="email"
        placeholder="Email"
        required>
    <input
        type="text"
        name="description"
        placeholder="Description"
        required>
        
    <input
        type="password"
        name="password"
        placeholder="Passwort"
        required>

    <select name="type">
        <option value="user" selected>User</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit">Create</button>

</form>

@endsection