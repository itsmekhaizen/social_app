<?php require '../app/views/layout/header.php'; ?>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h4 class="mb-3">Create a Post</h4>
                <form action="index.php?page=post_create" method="POST" enctype="multipart/form-data">
                    <textarea name="content" class="form-control mb-3" rows="3" placeholder="What are you thinking?" required></textarea>
                    <input type="file" name="image" class="form-control mb-3" accept="image/jpeg,image/png,image/webp">
                    <button class="btn btn-primary">Post</button>
                </form>
            </div>
        </div>

        <?php foreach ($posts as $post): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex gap-2">
                            <?php if ($post['profile_image']): ?>
                                <img src="uploads/<?= e($post['profile_image']) ?>" class="avatar">
                            <?php else: ?>
                                <div class="avatar avatar-default">👤</div>
                            <?php endif; ?>
                            <div>
                                <a class="fw-bold text-decoration-none" href="index.php?page=profile&id=<?= $post['user_id'] ?>"><?= e($post['full_name']) ?></a>
                                <div class="text-muted small">@<?= e($post['username']) ?> · <?= e($post['created_at']) ?></div>
                            </div>
                        </div>
                        <?php if ($post['user_id'] == currentUserId()): ?>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">⋮</button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="index.php?page=post_edit&id=<?= $post['id'] ?>">Edit</a></li>
                                    <li><a class="dropdown-item text-danger" href="index.php?page=post_delete&id=<?= $post['id'] ?>" data-confirm="Delete this post?">Delete</a></li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                    <p class="mt-3 mb-2 text-wrap"><?= nl2br(e($post['content'])) ?></p>
                    <?php if ($post['image']): ?>
                        <img src="uploads/<?= e($post['image']) ?>" class="img-fluid rounded mb-3 post-image">
                    <?php endif; ?>
                    <a href="index.php?page=like&post_id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-primary">Like (<?= e($post['like_count']) ?>)</a>

                    <div class="mt-3">
                        <?php foreach ($commentData[$post['id']] as $comment): ?>
                            <div class="comment-box mb-2 p-2 rounded">
                                <div class="small fw-bold"><?= e($comment['full_name']) ?> <span class="text-muted">@<?= e($comment['username']) ?></span></div>
                                <div><?= nl2br(e($comment['content'])) ?></div>
                                <?php if ($comment['user_id'] == currentUserId()): ?>
                                    <form class="mt-2" action="index.php?page=comment_edit&id=<?= $comment['id'] ?>" method="POST">
                                        <input type="text" name="content" class="form-control form-control-sm" value="<?= e($comment['content']) ?>" required>
                                        <button class="btn btn-sm btn-link px-0">Save</button>
                                        <a class="btn btn-sm btn-link text-danger px-0" href="index.php?page=comment_delete&id=<?= $comment['id'] ?>" data-confirm="Delete this comment?">Delete</a>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                        <form action="index.php?page=comment_create" method="POST" class="d-flex gap-2">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <input type="text" name="content" class="form-control form-control-sm" placeholder="Write a comment..." required>
                            <button class="btn btn-sm btn-secondary">Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5>Search Users</h5>
                <form action="index.php?page=search" method="GET">
                    <input type="hidden" name="page" value="search">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Name or username" required>
                        <button class="btn btn-outline-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Project Features</h5>
                <p class="mb-1">Authentication</p>
                <p class="mb-1">Profile</p>
                <p class="mb-1">Posts CRUD</p>
                <p class="mb-1">Comments CRUD</p>
                <p class="mb-1">Likes</p>
                <p class="mb-0">User Search</p>
            </div>
        </div>
    </div>
</div>
<?php require '../app/views/layout/footer.php'; ?>
