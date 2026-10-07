<?php require '../app/views/layout/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="mb-3">Login</h2>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= e($error) ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100">Login</button>
                </form>
                <p class="mt-3 mb-0">No account? <a href="index.php?page=register">Register here</a></p>
            </div>
        </div>
    </div>
</div>
<?php require '../app/views/layout/footer.php'; ?>
