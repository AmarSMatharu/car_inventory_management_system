<?php
session_start();
if (empty($_SESSION["is_admin"])) {
  header("Location: /carbound/admin/login.php");
  exit;
}

$pageTitle = "Add Car";
require_once __DIR__ . "/../config/db.php";
require_once __DIR__ . "/../includes/header.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = trim($_POST["title"] ?? "");
  $make = trim($_POST["make"] ?? "");
  $model = trim($_POST["model"] ?? "");
  $year = $_POST["year"] ?? null;
  $description = trim($_POST["description"] ?? "");
  $image = trim($_POST["image"] ?? "");

  if ($title === "") {
    $error = "Title is required.";
  } else {
    $stmt = $conn->prepare("INSERT INTO cars (title, make, model, year, description, image) VALUES (?, ?, ?, ?, ?, ?)");
    $yearVal = ($year === "" ? null : (int)$year);
    $stmt->bind_param("sssiss", $title, $make, $model, $yearVal, $description, $image);

    if ($stmt->execute()) {
      $success = "Car added successfully.";
    } else {
      $error = "Could not add car.";
    }
    $stmt->close();
  }
}
?>

<section class="section narrow">
  <div class="row">
    <h1>Add Car</h1>
    <a class="btn btn-ghost" href="/carbound/admin/dashboard.php">Back</a>
  </div>

  <?php if ($success): ?><div class="alert success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
  <?php if ($error): ?><div class="alert error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

  <form method="POST" class="form">
    <label>
      Title (required)
      <input type="text" name="title" required>
    </label>

    <label>
      Make
      <input type="text" name="make">
    </label>

    <label>
      Model
      <input type="text" name="model">
    </label>

    <label>
      Year
      <input type="number" name="year" min="1900" max="2100">
    </label>

    <label>
      Description
      <textarea name="description" rows="6"></textarea>
    </label>

    <label>
      Image (URL or path, e.g. /carbound/assets/uploads/skyline.jpg)
      <input type="text" name="image">
    </label>

    <button class="btn" type="submit">Save</button>
  </form>
</section>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
