<?php
session_start();
if (empty($_SESSION["is_admin"])) {
  header("Location: /carbound/admin/login.php");
  exit;
}

$pageTitle = "Admin Dashboard";
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../includes/header.php";

$result = $conn->query("SELECT * FROM cars ORDER BY created_at DESC");
?>

<section class="section">
  <div class="row">
    <h1>Dashboard</h1>
    <div class="row-actions">
      <a class="btn" href="/carbound/admin/add_car.php">+ Add Car</a>
    </div>
  </div>

  <?php if ($result && $result->num_rows > 0): ?>
    <table class="table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Year</th>
          <th>Make/Model</th>
          <th>Created</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while($car = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($car["title"]) ?></td>
            <td><?= htmlspecialchars($car["year"] ?? "") ?></td>
            <td><?= htmlspecialchars(($car["make"] ?? "") . " " . ($car["model"] ?? "")) ?></td>
            <td><?= htmlspecialchars($car["created_at"]) ?></td>
            <td class="td-right">
              <a class="danger"
                 href="/carbound/admin/delete_car.php?id=<?= (int)$car["id"] ?>"
                 onclick="return confirm('Delete this car?');">
                 Delete
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p>No cars yet. Add the first one.</p>
  <?php endif; ?>
</section>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
