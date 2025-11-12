<?php
session_start();
include('db/db_connect.php');

if (!isset($_SESSION['user_id'])) {
  echo json_encode(["status" => "error", "message" => "User not logged in"]);
  exit;
}

$user_id = $_SESSION['user_id'];
$id = $_POST['id'] ?? '';

if (!$id) {
  echo json_encode(["status" => "error", "message" => "Missing ID"]);
  exit;
}

$stmt = $conn->prepare("DELETE FROM work_experience WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();

echo json_encode(["status" => "success", "message" => "Deleted successfully"]);
?>
