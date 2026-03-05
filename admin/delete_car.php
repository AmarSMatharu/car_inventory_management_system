<?php
session_start();
if (empty($_SESSION["is_admin"])) {
  header("Location: /carbound/admin/login.php");
  exit;
}

require_once __DIR__ . "/../config/db.php";

$id = (int)($_GET["id"] ?? 0);
if ($id > 0) {
  $stmt = $conn->prepare("DELETE FROM cars WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();
}

header("Location: /carbound/admin/dashboard.php");
exit;
