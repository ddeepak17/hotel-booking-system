<?php
include '../includes/fileHandler.php';
include '../templates/header.php';
?>

<h2>Search for Available Rooms</h2>
<form method="post" action="">
    <label for="room_type">Select Room Type:</label>
    <select name="room_type" id="room_type">
      <option value="Single">Single</option>
      <option value="Double">Double</option>
      <option value="Suite">Suite</option>
    </select>

    <label for="min_price">Min Price:</label>
    <input type="number" name="min_price" id="min_price" min="0">

    <label for="max_price">Max Price:</label>
    <input type="number" name="max_price" id="max_price" min="0">

    <button type="submit">Search</button>
</form>

<?php
$roomType = isset($_POST['room_type']) ? $_POST['room_type'] : '';
$minPrice = isset($_POST['min_price']) ? $_POST['min_price'] : '';
$maxPrice = isset($_POST['max_price']) ? $_POST['max_price'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $rooms = getRoomsByFilters($roomType, $minPrice, $maxPrice);
?>
  <h3>Available Rooms</h3>
  <table border="1">
    <tr>
      <th>Room Number</th>
      <th>Type</th>
      <th>Price</th>
      <th>Details</th>
    </tr>
    <?php foreach ($rooms as $room): ?>
      <tr>
        <td><?php echo $room['number']; ?></td>
        <td><?php echo $room['type']; ?></td>
        <td><?php echo $room['price']; ?></td>
        <td><a href="../viewRoom.php?room=<?php echo urlencode($room['number']); ?>">View  Details</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php } ?>

<a hre="bookRoom.php">Book a Room</a>

<?php include '../templates/footer.php'; ?>


