function toggleLike(postId) {
    const btn = document.querySelector(`.post-card[data-id="${postId}"] .like-btn`);
    const countSpan = btn.querySelector('.count');
    
    const formData = new FormData();
    formData.append('post_id', postId);

    fetch('ajax/toggle_like.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success') {
            countSpan.textContent = data.likes;
            btn.classList.toggle('liked', data.action === 'liked');
        }
    });
}

// Simple Notification polling for InfinityFree
function checkNotifications() {
    fetch('ajax/get_notifications.php')
    .then(res => res.json())
    .then(data => {
        const badge = document.getElementById('notif-badge');
        if(data.count > 0) {
            badge.style.display = 'block';
            badge.textContent = data.count;
        }
    });
}

if(typeof USER_ID !== 'undefined') {
    setInterval(checkNotifications, 10000); // Check every 10 seconds
}
