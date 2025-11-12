<?php
session_start();
include('db/db_connect.php');

if (!isset($_SESSION['user_id'])) {
  echo "<p style='color:red;'>Error: Not logged in.</p>";
  exit;
}

$user_id = intval($_SESSION['user_id']);
$sql = "SELECT * FROM certificates WHERE user_id = $user_id ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "
      <div style='margin-bottom:10px; padding:8px; background:#f5f5f5; border-radius:6px;'>
        <strong>{$row['certificate_name']}</strong><br>
        <small>Issued by: {$row['issued_by']}</small><br>
        <button onclick=\"editCertificate({$row['id']}, '{$row['certificate_name']}', '{$row['issued_by']}')\">✏️</button>
        <button onclick=\"deleteCertificate({$row['id']})\">🗑️</button>
      </div>
    ";
  }
} else {
  echo "<p>📜 No certificates added yet</p>";
}

$conn->close();
?>
