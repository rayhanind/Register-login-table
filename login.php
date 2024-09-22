<!-- <?php
// session_start();
// require('db.php');

// if (isset($_POST['login'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];
    
//     // Query untuk mencari pengguna berdasarkan username
//     $sql = "SELECT * FROM users WHERE username = '$username'";
//     // $stmt = $conn->prepare($sql);
//     // $stmt->bind_param("s", $username);
//     // $stmt->execute();
//     // $result = $stmt->get_result();
//     $result = $conn->query($sql);
    
//     if (mysqli_num_rows($result) === 1) {
//         $user_data = mysqli_fetch_assoc($result);
//         // Verifikasi password
//         if (password_verify($password, $user_data['password'])) {
//             // Jika password cocok, login berhasil
//             // $_SESSION['username'] = true;
//             header("Location: welcome.php");
//             exit();
//         } else {
//             echo "Password salah!";
//         }
//     } else {
//         echo "Username tidak ditemukan!";
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit" value="login">Login</button>
    </form>
</body>
</html> -->

<?php
session_start();
require('db.php');

if (isset($_SESSION["login"])) {
    header("Location: welcome.php");
    exit();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if (mysqli_num_rows($result) === 1) {
        $user_data = mysqli_fetch_assoc($result);

        if (password_verify($password, $user_data["password"])) {
            $_SESSION['login'] = true;
            header("Location: welcome.php");
            exit;
        }
    }
    $error = true;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body>
    <div class="container">
        <div class="row margin-top">

            <div class="col-md-6 side-image">
                <img src="../images/login.png" class="img-fluid" alt="login-image">
            </div>

            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                Username atau password salah!
                            </div>
                        <?php endif; ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter your username" oninput="filterInput(this)" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="form-group">
                                <div class="text-center">
                                    <a href="#">Forgot Password?</a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                            <div class="form-group mt-4">
                                <div class="text-center">
                                    <span>Don't have an account?</span>
                                    <a href="../auth/register.php">Register Here</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>