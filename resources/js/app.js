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

document.querySelectorAll('.upvote, .downvote').forEach(button => {
    button.addEventListener('click', async (e) => {
        const postId = button.dataset.id;
        const voteType = button.dataset.type;
        const vote = button.classList.contains('upvote') ? 1 : -1;

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const res = await fetch('/vote', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                voteable_id: postId,
                voteable_type: voteType,
                vote: vote
            })
        });

        const data = await res.json();

        const containerId = voteType.includes('Comment') ? 'comment-' + postId : 'post-' + postId;
        const container = document.getElementById(containerId);
        if (container) {
            const scoreSpan = container.querySelector('.score');
            if (scoreSpan) scoreSpan.textContent = data.score;
        }
    });
});