<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) : "Carbound" ?></title>
  <link rel="stylesheet" href="/carbound/assets/css/style.css" />
</head>
<body>
  <header class="site-header">
    <div class="container header-row">
      <a class="brand" href="/carbound/public/index.php">Carbound</a>
      <nav class="nav">
        <a href="/carbound/public/index.php">Home</a>
        <a href="/carbound/public/contact.php">Contact</a>
        <a href="/carbound/admin/login.php">Admin</a>
      </nav>
    </div>
  </header>

  <main class="container">
