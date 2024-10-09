<?php
session_start();
require_once "../dbcontroller.php";
$db = new DB;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <title>Login Restoran</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4 mx-auto mt-4 ">
                <div>

                    <h3>LogIn Restoran</h3>

                </div>
                <div class="form-group">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" required class="form-control">
                        </div>
                        <div>
                            <input type="submit" name="login" value="Login" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);

    $sql = "SELECT * FROM tbluser WHERE email = '$email' AND password = '$password'";

    $count = $db->rowCount($sql);

    if ($count == 0) {
        echo '<h3 style = "text-align : center;">Email / Password Salah</h3>';
    } else {
        $sql = "SELECT * FROM tbluser WHERE email = '$email' AND password = '$password'";
        $row = $db->getItem($sql);

        $_SESSION['user'] = $row['email'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['iduser'] = $row['iduser'];

        header("location:index.php");
    }
}

?>