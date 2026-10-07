<?php require '../app/views/layout/header.php'; ?>
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h3>Search Users</h3>
        <form action="index.php" method="GET" class="input-group">
            <input type="hidden" name="page" value="search">
            <input type="text" name="keyword" class="form-control" value="<?= e($keyword) ?>" placeholder="Name or username" required>
            <button class="btn btn-primary">Search</button>
        </form>
    </div>
</div>

<?php if ($keyword !== ''): ?>
    <h5 class="mb-3">Results for "<?= e($keyword) ?>"</h5>
    <?php foreach ($users as $user): ?>
        <div class="card shadow-sm mb-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold"><?= e($user['full_name']) ?></div>
                    <div class="text-muted">@<?= e($user['username']) ?></div>
                </div>
                <a href="index.php?page=profile&id=<?= $user['id'] ?>" class="btn btn-outline-primary">View Profile</a>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (!$users): ?>
        <div class="alert alert-info">No users found.</div>
    <?php endif; ?>
<?php endif; ?>
<?php require '../app/views/layout/footer.php'; ?>
