<?php  
session_start();
include('db/db_connect.php');

if (!isset($_SESSION['user_id'])) {
  echo '<p style="color:red;">Please log in.</p>';
  exit;
}

$user_id = intval($_SESSION['user_id']);
$stmt = $conn->prepare("SELECT id, school, degree, year FROM education WHERE user_id = ? ORDER BY id DESC");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
  echo '<p style="text-align:center; color:#555;">🎓 No education added yet.</p>';
  exit;
}

while ($row = $res->fetch_assoc()) {
  $id = $row['id'];
  $school = htmlspecialchars($row['school']);
  $degree = htmlspecialchars($row['degree']);
  $year = htmlspecialchars($row['year']);

  echo "
    <div style='
      margin-bottom: 10px;
      padding: 10px;
      background: #f5f5f5;
      border-radius: 8px;
      text-align: center;
    '>
      <strong style='color:#333;'>{$degree}</strong> at {$school} <br>
      <small style='color:#777;'>{$year}</small>
      <div style='display:flex; justify-content:center; gap:8px; margin-top:6px;'>
        <button 
          onclick=\"editEducation({$id}, '{$school}', '{$degree}', '{$year}')\" 
          style='background-color:#008080; color:white; border:none; padding:6px 12px; border-radius:5px; cursor:pointer; font-size:16px;'>
          ✏️
        </button>
        <button 
          onclick=\"deleteEducation({$id})\" 
          style='background-color:#008080; color:white; border:none; padding:6px 12px; border-radius:5px; cursor:pointer; font-size:16px;'>
          🗑️
        </button>
      </div>
    </div>
  ";
}
$stmt->close();
?>
