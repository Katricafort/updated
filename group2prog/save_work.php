<?php
session_start();
include('db/db_connect.php');

if (!isset($_SESSION['user_id'])) {
  echo json_encode(["status" => "error", "message" => "User not logged in"]);
  exit;
}

$user_id = $_SESSION['user_id'];
$job_title = $_POST['job_title'] ?? '';
$company = $_POST['company'] ?? '';
$duration = $_POST['duration'] ?? '';
$work_id = $_POST['id'] ?? '';

if (empty($job_title) || empty($company)) {
  echo json_encode(["status" => "error", "message" => "Please fill in all fields"]);
  exit;
}

if ($work_id) {
  // Update existing
  $stmt = $conn->prepare("UPDATE work_experience SET job_title=?, company=?, duration=? WHERE id=? AND user_id=?");
  $stmt->bind_param("sssii", $job_title, $company, $duration, $work_id, $user_id);
  $stmt->execute();
  echo json_encode(["status" => "success", "message" => "Updated successfully"]);
} else {
  // Insert new
  $stmt = $conn->prepare("INSERT INTO work_experience (user_id, job_title, company, duration) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("isss", $user_id, $job_title, $company, $duration);
  $stmt->execute();
  echo json_encode(["status" => "success", "message" => "Saved successfully"]);
}
?>
