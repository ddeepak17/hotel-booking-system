<?php
include 'includes/fileHandler.php';
include 'templates/header.php';


$roomNumber = isset($_GET['room']) ? $_GET['room'] : '';
$roomDetails = null;

if ($roomNumber) {
  if(($handle = fopen(__DIR__ . "/data/rooms.csv", "r")) !== FALSE) {
    fgetcsv($handle);
    while (($data = fgetcsv($handle)) !== FALSE) {
      if ($data[0] == $roomNumber) {
        $roomDetails = [
          'number' => $data[0],
          'type' => $data[1],
          'price' => $data[2],
          'description' => "A comfortable {$data[1]} room for your stay."
        ];
        break;
      }
    }
    fclose($handle);
  }
}

if (!$roomDetails) {
  echo "Room not found!";
  exit;
}
?>

<h2>Room Details</h2>
<p><strong>Room Number:</strong> <?php echo $roomDetails['number']; ?></p>
<p><strong>Type:</strong> <?php echo $roomDetails['type']; ?></p>
<p><strong>Price:</strong> $<?php echo $roomDetails['price']; ?> per night</p>
<p><strong>Description:</strong> <?php echo $roomDetails['description']; ?></p>
<a href="public/index.php">Back to Search</a>

<?php include 'templates/footer.php'; ?>