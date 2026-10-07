<?php require '../app/views/layout/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3">Edit Profile</h3>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= e($error) ?></div>
                <?php endif; ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="<?= e($user['full_name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bio / About</label>
                        <textarea name="bio" class="form-control" rows="4"><?= e($user['bio']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profile Photo</label>
                        <input type="file" name="profile_image" class="form-control" accept="image/jpeg,image/png,image/webp">
                    </div>
                    <button class="btn btn-primary">Save Changes</button>
                    <a href="index.php?page=profile" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require '../app/views/layout/footer.php'; ?>
