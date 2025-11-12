<?php
session_start();
header('Content-Type: application/json');
include('db/db_connect.php');

if (!isset($_SESSION['user_id'])) {
  echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
  exit;
}

$user_id = intval($_SESSION['user_id']);
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$school = trim($_POST['school'] ?? '');
$degree = trim($_POST['degree'] ?? '');
$year = trim($_POST['year'] ?? '');

if ($school === '' || $degree === '') {
  echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields.']);
  exit;
}

if ($id > 0) {
  // Update existing record
  $stmt = $conn->prepare("UPDATE education SET school=?, degree=?, year=?, updated_at=NOW() WHERE id=? AND user_id=?");
  $stmt->bind_param('sssii', $school, $degree, $year, $id, $user_id);
  $ok = $stmt->execute();
  $stmt->close();
  echo json_encode(['status' => $ok ? 'success' : 'error', 'message' => $ok ? 'Education updated.' : 'Update failed.']);
} else {
  // Add new record
  $stmt = $conn->prepare("INSERT INTO education (user_id, school, degree, year) VALUES (?, ?, ?, ?)");
  $stmt->bind_param('isss', $user_id, $school, $degree, $year);
  $ok = $stmt->execute();
  $stmt->close();
  echo json_encode(['status' => $ok ? 'success' : 'error', 'message' => $ok ? 'Education added.' : 'Insert failed.']);
}
?>