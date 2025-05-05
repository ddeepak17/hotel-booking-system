<?php

function getRoomsByFilters($roomType = '', $minPrice = '', $maxPrice = '') {
  $rooms = [];

  if (($handle = fopen(__DIR__ . "/../data/rooms.csv", "r")) !== FALSE) {
    fgetcsv($handle);
    while (($data = fgetcsv($handle)) !== FALSE) {
      $roomPrice = (int)$data[2];

      if ((!empty($roomType) && strcasecmp($data[1], $roomType) !== 0)) {
        continue;
      }
      if (!empty($minPrice) && $roomPrice < (int)$minPrice) {
        continue;
      }
      if (!empty($maxPrice) && $roomPrice > (int)$maxPrice) {
        continue;
      }
        $rooms[] = [
          'number' => $data[0],
          'type' => $data[1],
          'price' => $data[2]
        ];
    }
    fclose($handle);
  }
  return $rooms;
}

function saveBooking($name, $roomType, $checkIn, $checkOut) {
  $filePath = __DIR__ . "/../data/bookings.csv";

  $fileExists = file_exists($filePath);
  $file = fopen($filePath, "a");

  if ($file) {
    if (!$fileExists) {
      fputcsv($file, ["Name", "Room Type", "Check-in Date", "Check-out Date"]);
    }
    fputcsv($file, [$name, $roomType, $checkIn, $checkOut]);
    fclose($file);
  }
}
?>