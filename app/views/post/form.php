<?php require '../app/views/layout/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3"><?= isset($post) ? 'Edit Post' : 'Create Post' ?></h3>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= e($error) ?></div>
                <?php endif; ?>
                <form method="POST" enctype="multipart/form-data">
                    <textarea name="content" class="form-control mb-3" rows="6" required><?= e($post['content'] ?? '') ?></textarea>
                    <label class="form-label">Image, optional</label>
                    <input type="file" name="image" class="form-control mb-3" accept="image/jpeg,image/png,image/webp">
                    <button class="btn btn-primary">Save</button>
                    <a href="index.php?page=home" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require '../app/views/layout/footer.php'; ?>
