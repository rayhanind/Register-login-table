<!-- <?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
require('db.php');
$data = mysqli_query($conn, "SELECT * FROM mahasiswa");
?> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome!</h1>
    <a href="logout.php">Logout</a>
    <table
                                id="example"
                                class="table table-striped data-table"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>NIM</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                                        <tr>
                                            <td><?php echo $row["golongan"] ?></td>
                                            <td><?php echo $row["nim"] ?></td>
                                            <td><?php echo $row["name"] ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                                
                            </table>
</body>
</html>
