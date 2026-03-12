<?php

namespace App\Http\Controllers;

/** @var \App\Models\Post[] $posts */
/** @var \App\Models\Post $post */
/** @var \App\Models\Comment[] $comments */

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Zeigt eine paginierte Liste von Posts an.
     *
     * @param Request $request
     * @param string|null $request->sort Spalte zum Sortieren (Standard: 'created_at')
     * @param string|null $request->direction Sortierrichtung (Standard: 'desc')
     * @param string|null $request->search Suchbegriff für Titel oder Text
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $search = $request->get('search', '');

        $posts = Post::where(function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
                ->orWhere('text', 'like', "%$search%");
        })->orderBy($sort, $direction)->paginate(10)->withQueryString();
        return view('posts.index', ['posts' => $posts]);
    }
    /**
     * Zeigt einen einzelnen Post zusammen mit seinen Kommentaren an.
     *
     * @param int $id Die ID des Posts
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $comments = Comment::with('user')->where('post_id', $id)->orderBy('created_at', 'desc')->get();

        $post = Post::with('user')->findOrFail($id);

        $post->setRelation('comments', $comments);
        return view('posts.show', compact('post'));
    }
    /**
     * Zeigt das Formular zur Erstellung eines neuen Posts an.
     *
     * @param int $id Die ID des Benutzers, für den der Post erstellt wird
     * @return \Illuminate\View\View
     */
    public function create($id)
    {
        return view('posts.create', ['id' => $id]);
    }
    /**
     * Speichert einen neuen Post in der Datenbank.
     *
     * @param Request $request Enthält alle Post-Daten
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $post = Post::create($request->all());

        return redirect()->route('posts.show', ['id' => $post->id]);
    }
    /**
     * Zeigt das Formular zum Bearbeiten eines bestehenden Posts an.
     *
     * @param int $id Die ID des zu bearbeitenden Posts
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }
    /**
     * Aktualisiert einen bestehenden Post in der Datenbank.
     *
     * @param Request $request Enthält die aktualisierten Post-Daten
     * @param int $id Die ID des zu aktualisierenden Posts
     * @return \Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return view('posts.show', ['post' => $post]);
    }
    /**
     * Löscht einen Post aus der Datenbank.
     *
     * @param int $id Die ID des zu löschenden Posts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Post::destroy($id);

        return redirect()->route('posts.index');
    }
}
