<?php
include '../includes/fileHandler.php';
include '../includes/validator.php';
include '../templates/header.php';

$errors = [];
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $roomType = $_POST['room_type'];
    $checkIn = $_POST['check_in'];
    $checkOut = $_POST['check_out'];

    $errors = validateBooking($name, $roomType, $checkIn, $checkOut);

    if (empty($errors)) {
        saveBooking($name, $roomType, $checkIn, $checkOut);
        header("Location: confirmation.php?success=true");
        exit;
    }
}
?>

<h2>Book a Room</h2>

<?php if (!empty($errors)): ?>
  <div style="color: red;">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?php echo htmlspecialchars($error); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<form method="post" action="">
  <label for="name">Full Name:</label>
  <input type="text" name="name" id="name" required>

  <label for="room_type">Select Room Type:</label>
  <select name="room_type" id="room_type">
    <option value="Single">Single</option>
    <option value="Double">Double</option>
    <option value="Suite">Suite</option>
  </select>

  <label for="check_in">Check-in Date:</label>
  <input type="date" name="check_in" id="check_in" required>

  <label for="check_out">Check-out Date:</label>
  <input type="date" name="check_out" id="check_out" required>

  <button type="submit">Book Now</button>
</form>

<a href="index.php">Back to Home</a>

<?php include '../templates/footer.php'; ?>




