<?php
function e($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function requireLogin()
{
    if (!isLoggedIn()) {
        header('Location: index.php?page=login');
        exit;
    }
}

function currentUserId()
{
    return $_SESSION['user_id'] ?? null;
}

function redirect($page)
{
    header("Location: index.php?page=$page");
    exit;
}
