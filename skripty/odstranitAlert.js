function deletePost(postId) {
    if (confirm('Are you sure you want to delete this post?')) {
        window.location.href = 'profil/smazat/' + postId;
    }
}