<?php
session_start();

// Make sure user is logged in
if (!isset($_SESSION['email'])) {
    // Optionally redirect to login page
    header("Location: login.php");
    exit();
}

// Define the variable
$email = $_SESSION['email'];
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Job Feed | KM Services</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background: #fff;
      color: #000;
    }

    /* Header */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 50px;
      border-bottom: 1px solid #ccc;
      background: #fff; /* ✅ White header */
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .logo {
      font-weight: bold;
      font-size: 20px;
      color: #000000ff; /* ✅ Teal logo */
    }

    nav a {
      margin-left: 25px;
      text-decoration: none;
      color: #000; /* ✅ Black text */
      font-weight: 500;
      transition: color 0.2s ease;
    }

    nav a:hover {
      color: gray; /* ✅ Hover turns gray */
    }

    /* Feed Layout */
    .feed-container {
      display: flex;
      gap: 30px;
      padding: 40px 50px;
    }

    /* Sidebar */
    .sidebar {
      width: 30%;
    }

    .sidebar h3 {
      margin-bottom: 15px;
    }

    .search-bar input {
      width: 100%;
      padding: 12px;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
    }

    .sort-buttons {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
    }

    .sort-buttons button {
      background: #e0f2f2;
      border: 1px solid #008080;
      color: #008080;
      padding: 8px 15px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .sort-buttons button.active {
      background: #008080;
      color: white;
    }

    .sort-buttons button:hover {
      background: #006666;
      color: white;
    }

    .job-card {
      border: 1px solid #ddd;
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 15px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .job-card:hover {
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .job-card h4 {
      margin-bottom: 5px;
      font-size: 16px;
    }

    .job-card p {
      margin: 3px 0;
      color: #555;
      font-size: 14px;
    }

    .easy-apply {
      margin-top: 10px;
      background: #008080;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 13px;
    }

    .easy-apply:hover {
      background: #006666;
    }

    /* Main Content */
    .main-content {
      flex: 1;
      background: #f9fafb;
      border-radius: 10px;
      padding: 30px;
      min-height: 400px;
    }

    .empty-message {
      text-align: center;
      color: #999;
      font-size: 18px;
      margin-top: 50px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      header {
        flex-direction: column;
        padding: 15px 0;
      }
      nav {
        margin-top: 10px;
      }
      .feed-container {
        flex-direction: column;
        padding: 20px;
      }
    }
/* User Menu */
.user-menu {
  position: relative;
  display: inline-block;
}

.user-icon {
  font-size: 22px;
  cursor: pointer;
  margin-left: 25px;
  transition: opacity 0.2s;
}

.user-icon:hover {
  opacity: 0.6;
}

 /* ✅ UPDATED NAVBAR SECTION */
.navbar {
    display: flex;
    align-items: center;
    padding-right: 50px; /* <-- adds gap before the profile icon */
}

.navbar a {
    text-decoration: none;
    color: #333;
    font-size: 15px;
    padding: 0 15px; /* space between Home and About Us */
}
.navbar a:hover {
    color: #0078d7;
}
/* ✅ END UPDATED NAVBAR SECTION */


    /* User icon top right corner */
 .user-menu {
    position: absolute;
    top: 50%;
    right: 20px; /* large gap */
    transform: translateY(-50%);
}


    .user-icon img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        padding-right: 50px;
    }

    /* Dropdown */
    .dropdown-menu {
        display: none;
        position: absolute;
        right: 50px;
        top: 45px;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        width: 220px;
        z-index: 1000;
        padding: 10px 0;
        font-size: 14px;
    }

    .dropdown-menu::before {
        content: "";
        position: absolute;
        top: -8px;
        right: 15px;
        border-width: 8px;
        border-style: solid;
        border-color: transparent transparent #fff transparent;
    }

    .dropdown-menu .user-email {
        padding: 10px 15px;
        font-weight: bold;
        border-bottom: 1px solid #eee;
        color: #333;
        font-size: 13px;
        word-break: break-all;
    }

    .dropdown-menu a {
        display: block;
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
        transition: background 0.2s;
    }

    .dropdown-menu a:hover {
        background: #f3f3f3;
    }

    .dropdown-menu .signout {
        color: #0073e6;
        font-weight: bold;
        border-top: 1px solid #eee;
    }
  
  </style>
</head>


<body>
 <header>
    <div class="logo">KM Services</div>

    <!-- ✅ UPDATED NAVBAR HTML -->
    <nav class="navbar">
        <a href="index.php">Home</a>
        <a href="about.php">About Us</a>
    </nav>
    <!-- ✅ END UPDATED NAVBAR HTML -->

    <!-- User icon on the top right -->
    <div class="user-menu">
        <div class="user-icon" onclick="toggleMenu()">
            <img src="img/icon.jpg" alt="User Icon">
        </div>
        <div class="dropdown-menu" id="dropdownMenu">
            <div class="user-email"><?php echo htmlspecialchars($email); ?></div>
            <a href="profile.php">📄 Profile</a>
            <a href="letsconnect.php">❓ Help</a>
           <a href="javascript:void(0)" class="signout" onclick="logout(event)">Sign out</a>
        </div>
    </div>
</header>

  <!-- Job Feed -->
  <div class="feed-container">
    <!-- Left Sidebar -->
    <div class="sidebar">
      <h3>Find Jobs</h3>
      <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Search...">
      </div>

      <h3>Sort by</h3>
      <div class="sort-buttons">
        <button id="sortRelevance" class="active">Relevance</button>
        <button id="sortDate">Date</button>
        <button id="sortSalary">Salary</button>
      </div>

      <div id="jobList"></div>
    </div>

    <!-- Right Content -->
    <div class="main-content" id="jobDetails">
      <p class="empty-message">No job selected. Admin will post soon.</p>
    </div>
  </div>

  <script>

let allJobs = [];

// Fetch jobs
fetch("jobs.json")
  .then(response => response.json())
  .then(jobs => {
    allJobs = jobs;
    renderJobs(jobs);
  })
  .catch(() => {
    document.getElementById("jobList").innerHTML =
      "";
  });

function renderJobs(jobs) {
  const jobList = document.getElementById("jobList");
  jobList.innerHTML = "";

  jobs.forEach(job => {
    const card = document.createElement("div");
    card.className = "job-card";
    card.innerHTML = `
      <h4>${job.title}</h4>
      <p>${job.location}</p>
      <p>${job.salary}</p>
      <button class="easy-apply">View</button>
    `;
    card.addEventListener("click", () => showDetails(job));
    jobList.appendChild(card);
  });
}

function showDetails(job) {
  const jobDetails = document.getElementById("jobDetails");
  jobDetails.innerHTML = `
    <h2>${job.title}</h2>
    <p><strong>Location:</strong> ${job.location}</p>
    <p><strong>Salary:</strong> ${job.salary}</p>
    <p><strong>Description:</strong> ${job.description}</p>
  `;
}

// ✅ Sorting logic (fixed)
const sortButtons = document.querySelectorAll(".sort-buttons button");
sortButtons.forEach(btn => {
  btn.addEventListener("click", () => {
    sortButtons.forEach(b => b.classList.remove("active"));
    btn.classList.add("active");
  });
});

// ✅ Dropdown logic (works now)
function toggleMenu() {
  const menu = document.getElementById("dropdownMenu");
  menu.style.display = menu.style.display === "block" ? "none" : "block";
}

window.onclick = function (e) {
  if (!e.target.closest(".user-menu")) {
    document.getElementById("dropdownMenu").style.display = "none";
  }
};

function logout(event) {
  event.preventDefault(); // block any link behavior
  const confirmLogout = confirm('Are you sure you want to sign out?');
  if (confirmLogout) {
    window.location.href = 'logout.php';
  }
  // if canceled, do nothing — the page stays as is
}

  
</script>
