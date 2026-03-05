<?php
$pageTitle = "Admin Login";
require_once __DIR__ . "/../includes/header.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST["username"] ?? "";
  $password = $_POST["password"] ?? "";

  if ($username === "admin" && $password === "password123") {
    $_SESSION["is_admin"] = true;
    header("Location: /carbound/admin/dashboard.php");
    exit;
  } else {
    $error = "Invalid credentials.";
  }
}
?>

<section class="section narrow">
  <h1>Admin Login</h1>
  <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

  <form method="POST" class="form">
    <label>
      Username
      <input type="text" name="username" required>
    </label>

    <label>
      Password
      <input type="password" name="password" required>
    </label>

    <button class="btn" type="submit">Login</button>
  </form>

  <p class="hint">Credentials: <b>admin</b> / <b>password123</b></p>
</section>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
