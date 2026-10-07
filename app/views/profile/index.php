<?php

$user = $user ?? null;
$posts = $posts ?? [];

require '../app/views/layout/header.php';
?>

<?php if (!$user): ?>

    <div class="alert alert-danger">
        User not found.
    </div>

<?php else: ?>

    <div class="card shadow-sm mb-4">

        <div class="card-body text-center">

            <?php if (!empty($user['profile_image'])): ?>

                <img src="uploads/<?= e($user['profile_image']) ?>"
                     class="profile-photo mb-3">

            <?php else: ?>

                <div class="profile-photo profile-default mb-3">
                    👤
                </div>

            <?php endif; ?>

            <h2>
                <?= e($user['full_name']) ?>
            </h2>

            <p class="text-muted mb-1">
                @<?= e($user['username']) ?>
            </p>

            <p>
                <?= e($user['bio'] ?? '') ?>
            </p>

            <?php if ($user['id'] == currentUserId()): ?>

                <a href="index.php?page=profile_edit"
                   class="btn btn-primary">
                    Edit Profile
                </a>

            <?php endif; ?>

        </div>

    </div>

    <h4 class="mb-3">
        Posts
    </h4>

    <?php if (empty($posts)): ?>

        <p class="text-muted">
            No posts yet.
        </p>

    <?php else: ?>

        <?php foreach ($posts as $post): ?>

            <div class="card shadow-sm mb-3">

                <div class="card-body">

                    <p class="mb-1">
                        <?= nl2br(e($post['content'])) ?>
                    </p>

                    <?php if (!empty($post['image'])): ?>

                        <img src="uploads/<?= e($post['image']) ?>"
                             class="img-fluid rounded post-image">

                    <?php endif; ?>

                    <div class="text-muted small mt-2">

                        <?= e($post['created_at']) ?>

                        ·

                        Likes:
                        <?= e($post['like_count']) ?>

                    </div>

                    <?php if ($user['id'] == currentUserId()): ?>

                        <div class="mt-3">

                            <a href="index.php?page=post_edit&id=<?= $post['id'] ?>"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <a href="index.php?page=post_delete&id=<?= $post['id'] ?>"
                               class="btn btn-sm btn-danger"
                               data-confirm="Delete this post?">
                                Delete
                            </a>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        <?php endforeach; ?>

    <?php endif; ?>

<?php endif; ?>

<?php require '../app/views/layout/footer.php'; ?>