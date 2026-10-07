<?php require '../app/views/layout/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="mb-3">Create Account</h2>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= e($error) ?></div>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" minlength="6" required>
                    </div>
                    <button class="btn btn-primary w-100">Register</button>
                </form>
                <p class="mt-3 mb-0">Already have an account? <a href="index.php?page=login">Login here</a></p>
            </div>
        </div>
    </div>
</div>
<?php require '../app/views/layout/footer.php'; ?>
