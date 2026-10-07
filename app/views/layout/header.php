<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Social Network</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg bg-white border-bottom mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?page=home">SMCC Social</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <?php if (isLoggedIn()): ?>
                    <a class="nav-link" href="index.php?page=home">Home</a>
                    <a class="nav-link" href="index.php?page=profile">Profile</a>
                    <a class="nav-link" href="index.php?page=profile_edit">Edit Profile</a>
                    <a class="nav-link text-danger" href="index.php?page=logout">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<div class="container pb-5">
