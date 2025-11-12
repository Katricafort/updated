<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KM Services - Add Work Experience</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
      color: #333;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 50px;
      background-color: #fff;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    header .logo {
      font-size: 16px;
      font-weight: bold;
      color: #000;
    }

    nav a {
      text-decoration: none;
      color: #999;
      margin-left: 25px;
      font-size: 14px;
    }

    nav a:hover {
      color: #000;
    }

    .container {
      max-width: 800px;
      margin: 50px auto;
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .back-btn {
      text-decoration: none;
      font-size: 20px;
      color: #000;
      margin-bottom: 10px;
      display: inline-block;
    }

    h2 {
      font-size: 22px;
      margin-top: 10px;
      margin-bottom: 10px;
    }

    p {
      color: #555;
      font-size: 14px;
      margin-bottom: 20px;
    }

    form label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
      font-size: 14px;
    }

    input[type="text"],
    select,
    textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    .checkbox {
      margin-top: 10px;
      font-size: 14px;
    }

    .row {
      display: flex;
      gap: 10px;
    }

    .row select {
      flex: 1;
    }

    textarea {
      height: 100px;
      resize: vertical;
    }

    .button-container {
      text-align: right;
      margin-top: 25px;
    }

    .save-btn {
      background-color: #91ad89;
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 10px 25px;
      font-size: 14px;
      font-weight: bold;
      cursor: pointer;
    }

    .save-btn:hover {
      opacity: 0.9;
    }

  </style>
</head>
<body>

<header>
  <div class="logo">KM Services</div>
  <nav>
    <a href="index.php">Home</a>
    <a href="about.php">About Us</a>
    <a href="profile.php" style="color:#000;">Profile</a>
  </nav>
</header>

<div class="container">
  <a href="profile.php" class="back-btn">&#8592;</a>
  <h2>Add Work Experience</h2>
  <p>Please fill out the form below. <span style="color:red">*</span> required</p>

  <form method="POST" action="">
    <label>Job title*</label>
    <input type="text" name="job_title" required>

    <label>Company*</label>
    <input type="text" name="company" required>

    <label>Country</label>
    <input type="text" name="country" value="Philippines">

    <label>City, State</label>
    <input type="text" name="city_state">

    <label class="checkbox">
      <input type="checkbox" name="current_work"> I currently work here
    </label>

    <label>From</label>
    <div class="row">
      <select name="from_month">
        <option value="">Month</option>
        <option>January</option><option>February</option><option>March</option>
        <option>April</option><option>May</option><option>June</option>
        <option>July</option><option>August</option><option>September</option>
        <option>October</option><option>November</option><option>December</option>
      </select>
      <select name="from_year">
        <option value="">Year</option>
        <?php for ($y = date('Y'); $y >= 1970; $y--) echo "<option>$y</option>"; ?>
      </select>
    </div>

    <label>To</label>
    <div class="row">
      <select name="to_month">
        <option value="">Month</option>
        <option>January</option><option>February</option><option>March</option>
        <option>April</option><option>May</option><option>June</option>
        <option>July</option><option>August</option><option>September</option>
        <option>October</option><option>November</option><option>December</option>
      </select>
      <select name="to_year">
        <option value="">Year</option>
        <?php for ($y = date('Y'); $y >= 1970; $y--) echo "<option>$y</option>"; ?>
      </select>
    </div>

    <label>Description (Recommended)</label>
    <textarea name="description"></textarea>

    <div class="button-container">
      <button type="submit" class="save-btn">SAVE</button>
    </div>
  </form>
</div>

</body>
</html>
