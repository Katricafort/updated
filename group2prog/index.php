<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KM Services</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>
  
    <header>
        <div class="logo">KM Services</div>
        <nav>
            <a href="register.php">Sign Up</a>
        </nav>
    </header>

    
    <div class="search-bar">
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="Job title, keywords, company" required>
            <button type="submit">Find Jobs</button>
        </form>
    </div>

   
    <main>
        <img src="img/job.jpg" alt="Professionals Illustration" class="hero-image">

        <h1>Welcome to KM Services</h1>
        <p>Create an account or sign in to see your personalized job recommendations.</p>
        <a href="login.php" class="get-started-link">
            <button type="button" class="get-started-btn">Get Started</button>
        </a>
    </main>
</body>
</html>
