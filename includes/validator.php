<?php
function validateBooking($name, $roomType, $checkIn, $checkOut) {
  $errors = [];

  if (empty($name)) {
    $errors[] = "Name is required.";
  }

  $validRoomTypes = ["Single", "Double", "Suite"];
  if (!in_array($roomType, $validRoomTypes)) {
    $errors[] = "Invalid room type selected.";
  }

  if (empty($checkIn) || empty($checkOut)) {
    $errors[] = "Both check-in and check-out dates are required.";
  } elseif (strtotime($checkIn) >= strtotime($checkOut)) {
    $errors[] = "Check-in date must be before check-out date.";
  }

  return $errors;
}
?>