<?php
session_start();
include('db/db_connect.php');

if (!isset($_SESSION['user_id'])) {
  echo "Please log in.";
  exit;
}

$user_id = intval($_SESSION['user_id']);
$result = $conn->query("SELECT * FROM skills WHERE user_id = $user_id ORDER BY id DESC");

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $skill_name = htmlspecialchars($row['skill_name'], ENT_QUOTES);

    echo "
      <div id='skill-$id' style=\"
        background: #f8f8f8;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 10px;
        text-align: center;
      \">
        <strong style='color: #333;'>$skill_name</strong><br>

        <div style='margin-top: 8px;'>
          <button onclick=\"editSkill($id, '$skill_name')\" style=\"
            background-color: #008080;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 10px;
            cursor: pointer;
            margin-right: 5px;
          \">
            <i class='fas fa-pen'>✏️</i>
          </button>
          
          <button onclick=\"deleteSkill($id)\" style=\"
            background-color: #008080;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 10px;
            cursor: pointer;
          \">
            <i class='fas fa-trash'>🗑️</i>
          </button>
        </div>
      </div>
    ";
  }
} else {
  echo "<p style='text-align:center; color:#777;'>No skills added yet.</p>";
}
?>
