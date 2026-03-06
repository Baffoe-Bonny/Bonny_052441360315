<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Student Course Registration System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <h1>Student Dashboard</h1>
    <nav>
        <a href="index.html">Home</a> |
        <a href="dashboard.php">Dashboard</a> |
        <a href="logout.php">Logout</a>
    </nav>
</header>

<main>
    <section class="profile-card">
        <img src="<?php echo $_SESSION['profile']; ?>" alt="Profile Image" class="profile-img">
        <div>
            <h3>Welcome, <?php echo $_SESSION['username']; ?>!</h3>
            <p>You can now manage your courses here.</p>
        </div>
    </section>
</main>

<footer>
    &copy; Group14 Student Course Registration System
</footer>

</body>
</html>