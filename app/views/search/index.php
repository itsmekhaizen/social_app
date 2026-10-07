<?php

$keyword = $keyword ?? '';
$users = $users ?? [];

require '../app/views/layout/header.php';
?>

<div class="row justify-content-center">

    <div class="col-lg-8">

        <div class="card shadow-sm mb-4">

            <div class="card-body">

                <h4 class="mb-3">
                    Search Users
                </h4>

                <form action="index.php"
                      method="GET">

                    <input type="hidden"
                           name="page"
                           value="search">

                    <div class="input-group">

                        <input type="text"
                               name="keyword"
                               class="form-control"
                               value="<?= e($keyword) ?>"
                               placeholder="Name or username"
                               required>

                        <button class="btn btn-primary">
                            Search
                        </button>

                    </div>

                </form>

            </div>

        </div>

        <?php if ($keyword !== ''): ?>

            <h5 class="mb-3">
                Results for "<?= e($keyword) ?>"
            </h5>

            <?php if (empty($users)): ?>

                <div class="alert alert-info">
                    No users found.
                </div>

            <?php else: ?>

                <?php foreach ($users as $user): ?>

                    <div class="card shadow-sm mb-3">

                        <div class="card-body">

                            <div class="d-flex align-items-center gap-3">

                                <?php if (!empty($user['profile_image'])): ?>

                                    <img src="uploads/<?= e($user['profile_image']) ?>"
                                         class="avatar">

                                <?php else: ?>

                                    <div class="avatar avatar-default">
                                        👤
                                    </div>

                                <?php endif; ?>

                                <div>

                                    <a class="fw-bold text-decoration-none"
                                       href="index.php?page=profile&id=<?= $user['id'] ?>">

                                        <?= e($user['full_name']) ?>

                                    </a>

                                    <div class="text-muted">
                                        @<?= e($user['username']) ?>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php endif; ?>

        <?php endif; ?>

    </div>

</div>

<?php require '../app/views/layout/footer.php'; ?>