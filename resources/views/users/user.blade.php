<!-- Komponente: Einzelner Benutzer-Artikel

Zeigt die Informationen eines Nutzers an (Name, Beschreibung, Typ, Datum der letzten Aktualisierung).
Optionale Anzeige der Details über die Variable:
$u: bool (Standard: true)
Erwartete Variable:
$user: User -->
@php
$u = $u ?? true;
@endphp
<article class="flex flex-col justify-between border-b border-gray-200 pb-6 mb-6">
    <div class="mt-3">
        <h3 class="text-lg font-semibold text-gray-900">
            {{ $user->name }}
        </h3>
        @if($u)
        <p class="mt-2 text-base text-gray-800">{{ $user->description }}</p>
        <p class="mt-2 text-sm text-gray-600">{{ $user->type }}</p>
        @endif
    </div>
    @if($u)
    <div class="flex items-center gap-x-4 text-xs text-gray-500">
        <time>{{ $user->updated_at }}</time>
    </div>
    @endif
</article>