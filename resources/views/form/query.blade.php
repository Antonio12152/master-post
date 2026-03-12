<!-- Komponente: Such- und Sortierformular

Dient zum Filtern und Sortieren von Datensätzen, z. B. Benutzern oder Beiträgen.
Erwartete Variable:
$url: string (Ziel-URL des Formulars) -->
<div class="w-full my-2">
    <form method="GET" action="{{ $url }}">

        <div class="flex flex-col gap-2 sm:flex-row">

            <select name="sort"
                class="rounded border py-2 px-2 text-sm text-slate-600">
                <option value="created_at" {{ request('sort')=='created_at' ? 'selected' : '' }}>Created</option>
                <option value="name" {{ request('name')=='name' ? 'selected' : '' }}>Name</option>
            </select>

            <select name="direction"
                class="rounded border py-2 px-2 text-sm text-slate-600">
                <option value="desc" {{ request('direction')=='desc' ? 'selected' : '' }}>DESC</option>
                <option value="asc" {{ request('direction')=='asc' ? 'selected' : '' }}>ASC</option>
            </select>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="flex-1 border rounded-md px-3 py-2 text-sm"
                placeholder="Search..." />

            <button
                type="submit"
                class="rounded bg-slate-800 px-3 py-2 text-sm text-white hover:bg-slate-700">
                Search
            </button>

        </div>

    </form>
</div>