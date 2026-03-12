<!-- Startseite der Seite. 
Dient als Einstiegspunkt zur Community mit Links zu Beiträgen, Nutzern und Registrierung. -->

@extends('layout')

@section('content')

<section class="bg-white">
    <div class="mx-auto max-w-7xl px-6 py-20 lg:px-8 text-center">

        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
            Welcome to the Community
        </h1>

        <p class="mt-6 text-lg leading-8 text-gray-600 max-w-2xl mx-auto">
            Discover posts, share ideas, and join discussions with other users.
            Create posts, write comments, and explore what the community is talking about.
        </p>

        <div class="mt-10 flex items-center justify-center gap-x-6">
            <a href="{{ route('posts.index') }}"
                class="rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-500">
                Explore Posts
            </a>

            <a href="{{ route('users.index') }}"
                class="text-sm font-semibold text-gray-900 hover:text-indigo-600">
                Browse Users →
            </a>
        </div>

    </div>
</section>


<section class="bg-gray-50 py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">
                What you can do
            </h2>
        </div>

        <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900">
                    Create Posts
                </h3>
                <p class="mt-3 text-gray-600">
                    Share your thoughts, ideas, and experiences with the community by creating posts.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900">
                    Join Discussions
                </h3>
                <p class="mt-3 text-gray-600">
                    Comment on posts and reply to other users to participate in conversations.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900">
                    Discover People
                </h3>
                <p class="mt-3 text-gray-600">
                    Explore profiles and find interesting users in the community.
                </p>
            </div>

        </div>
    </div>
</section>


<section class="py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">

        <h2 class="text-3xl font-bold text-gray-900">
            Ready to get started?
        </h2>

        <p class="mt-4 text-gray-600">
            Join the community today and start sharing your ideas.
        </p>

        <div class="mt-8">
            <a href="{{ route('register') }}"
                class="rounded-md bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-500">
                Create an Account
            </a>
        </div>

    </div>
</section>

@endsection