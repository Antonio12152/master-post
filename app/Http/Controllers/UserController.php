<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Zeigt eine paginierte Liste aller Benutzer an, sortierbar und durchsuchbar.
     *
     * @param \Illuminate\Http\Request mixed $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $search = $request->get('search', '');

        $users = User::where('name', 'like', '%' . $search . '%')->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact('users'));
    }
    /**
     * Zeigt ein einzelnes Benutzerprofil mit paginierten Posts an, sortierbar und filterbar.
     *
     * @param \Illuminate\Http\Request mixed $request
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $search = $request->get('search', '');

        $user = User::findOrFail($id);

        $posts = $user->posts()->where(function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
                ->orWhere('text', 'like', "%$search%");
        })->orderBy($sort, $direction)->paginate(10)->withQueryString();

        return view('users.show', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
    /**
     * Zeigt das Formular zum Erstellen eines neuen Benutzers an.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }
    /**
     * Speichert einen neuen Benutzer in der Datenbank.
     *
     * @param \Illuminate\Http\Request mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());

        return redirect()->route('users.show', ['id' => $user->id]);
    }
    /**
     * Zeigt das Formular zur Bearbeitung eines vorhandenen Benutzers an.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Aktualisiert die Benutzerdaten, überprüft optional das aktuelle Passwort.
     *
     * @param \Illuminate\Http\Request mixed $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect'
            ]);
        }

        $user->update($request->all());

        return redirect()->route('users.index');
    }
    /**
     * Löscht einen Benutzer aus der Datenbank. 
     * Falls der aktuell angemeldete Benutzer sich selbst löscht, wird die Session invalidiert.
     *
     * @param \Illuminate\Http\Request mixed $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->user()->id === $user->id) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        $user->delete();

        return redirect()->route('users.index');
    }
}
