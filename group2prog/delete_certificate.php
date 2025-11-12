<?php
session_start();
include('db/db_connect.php');

if (!isset($_SESSION['user_id'])) {
  echo json_encode(["status" => "error", "message" => "User not logged in."]);
  exit;
}

$user_id = intval($_SESSION['user_id']);
$id = intval($_POST['id'] ?? 0);

if ($id <= 0) {
  echo json_encode(["status" => "error", "message" => "Invalid certificate ID."]);
  exit;
}

$stmt = $conn->prepare("DELETE FROM certificates WHERE id=? AND user_id=?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$stmt->close();

echo json_encode(["status" => "success", "message" => "Certificate deleted successfully."]);

$conn->close();
?>
