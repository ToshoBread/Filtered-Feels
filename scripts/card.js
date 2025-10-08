const allPosts = document.querySelectorAll(".post");

if (allPosts !== null) {
  allPosts.forEach((card) => {
    card.addEventListener("mouseenter", () => {
      card.classList.remove("shadow");
      card.classList.add("shadow-lg");
    });

    card.addEventListener("mouseleave", () => {
      card.classList.remove("shadow-lg");
      card.classList.add("shadow");
    });

    card.addEventListener("click", () => {
      const userId = card.dataset.userId;
      const postId = card.dataset.postId;
      openCard(postId, userId);
    });
  });
}

function openCard(postId, userId = null) {
  const params = new URLSearchParams({
    user: userId,
    post: postId,
  });

  window.location.href = `post.php?${params.toString()}`;
}
