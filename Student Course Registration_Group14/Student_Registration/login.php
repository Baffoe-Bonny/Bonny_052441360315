<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Student Course Registration System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <h1>Student Course Registration System</h1>
    <nav>
        <a href="index.html">Home</a> |
        <a href="register.php">Register</a> |
        <a href="login.php">Login</a>
        <?php if(isset($_SESSION['username'])): ?>
            | <a href="dashboard.php">Dashboard</a>
            | <a href="logout.php">Logout</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <section>
        <h2>Student Login</h2>

        <form action="login.php" method="POST">
            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <input type="submit" name="login" value="Login">
        </form>

        <?php
        if(isset($_POST['login'])){
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if(file_exists('students.json')){
                $students = json_decode(file_get_contents('students.json'), true);

                $found = false;
                foreach($students as $student){
                    if($student['email'] === $email && password_verify($password, $student['password'])){
                        $_SESSION['username'] = $student['fullname'];
                        $_SESSION['profile'] = $student['profile'];
                        header("Location: dashboard.php");
                        exit;
                    }
                }

                if(!$found){
                    echo "<p style='color:red; text-align:center;'>Invalid email or password.</p>";
                }
            } else {
                echo "<p style='color:red; text-align:center;'>No registered students found. Please register first.</p>";
            }
        }
        ?>
    </section>
</main>

<footer>
    &copy; Group14 Student Course Registration System
</footer>

</body>
</html>