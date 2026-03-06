<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Student Course Registration System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <h1>Student Course Registration System</h1>
    <nav>
        <a href="index.html">Home</a> |
        <a href="register.php">Register</a> |
        <a href="login.php">Login</a>
    </nav>
</header>

<main>
    <section>
        <h2>Student Registration</h2>

        <form action="register.php" method="POST" enctype="multipart/form-data">
            <label>Full Name:</label>
            <input type="text" name="fullname" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <label>Upload Profile Image:</label>
            <input type="file" name="profile" required>

            <input type="submit" name="register" value="Register">
        </form>

        <?php
        if(isset($_POST['register'])){
            $fullname = htmlspecialchars($_POST['fullname']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $target_dir = "profiles/";
            $profile_name = basename($_FILES["profile"]["name"]);
            $target_file = $target_dir . $profile_name;

            if(move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)){
                $student = [
                    'fullname' => $fullname,
                    'email' => $email,
                    'password' => $password,
                    'profile' => $target_file
                ];

                $students = [];
                if(file_exists('students.json')){
                    $students = json_decode(file_get_contents('students.json'), true);
                }
                $students[] = $student;
                file_put_contents('students.json', json_encode($students, JSON_PRETTY_PRINT));

                echo "<p style='color:green;'>Registration Successful! <a href='login.php'>Login here</a></p>";
            } else {
                echo "<p style='color:red;'>Failed to upload profile image.</p>";
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