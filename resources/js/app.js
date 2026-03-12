import '@tailwindplus/elements';
import 'https://unpkg.com/flowbite@latest/dist/flowbite.min.js';
/**
 * Kommentare können durch Ändern des Textes auf der Schaltfläche geöffnet und geschlossen werden.
 *
 * @param int $id
 * @param int $c
 * @return void
 */
window.close_open = function (id, c) {
    const replies = document.getElementById("sub_comments_" + id);
    const button = document.getElementById("button_comment_" + id);
    replies.classList.toggle("hidden");
    if (replies.classList.contains("hidden")) {
        button.innerText = "Show comments " + c;
    } else {
        button.innerText = "Hide comments";
    }
}