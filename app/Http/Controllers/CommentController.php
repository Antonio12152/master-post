<?php

namespace App\Http\Controllers;

/** @var \App\Models\Comment[] $comments */

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Speichert einen neuen Kommentar.
     *
     * Validiert die eingehenden Daten und erstellt einen neuen Kommentar.
     *
     * @param \Illuminate\Http\Request mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'post_id' => 'required',
            'user_id' => 'required',
            'text' => 'required',
            'parent_id' => 'nullable'
        ]);

        Comment::create($data);

        return back();
    }
    /**
     * Löscht einen bestehenden Kommentar. Wird im Code nicht verwendet.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        Comment::destroy($id);

        return redirect()->back()->with('message', 'Operation Successful !');
    }
}
