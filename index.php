<?php 
    // start session
    session_start();

    // set to null all session variable if any
    if(isset($_SESSION['firstName']) && isset($_SESSION['lastName'])) {
        $_SESSION['firstName'] = "";
        $_SESSION['lastName'] = "";
        $_SESSION['regNo'] = "";
    }
    // include connect script
    include('./includes/connect.php');

    // check if variables are set 
    if(isset($_POST['login'])) {
        $regNo = $_POST['regNo'];
        $password = $_POST['passwd'];

        $query = "SELECT first_name, last_name, reg_no, email, college, password FROM users WHERE reg_no='$regNo' AND password='$password'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if($result) {
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            if($count == 1) {
                $_SESSION['firstName'] = $row['first_name'];
                $_SESSION['lastName'] = $row['last_name'];
                $_SESSION['regNo'] = $row['reg_no'];
                $smsg = "login successfully";
            }else {
                $fmsg = "Invalid login credentials! Please try again";
            }
        } 
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/style.css">
    <title>College | Log in</title>
</head>
<body>
    <div class="container pt-5">
        <h1 class="text-center text-uppercase display-4">University of Dar Es Salaam</h1>
        <hr>
        <div class="wrapper">
            <form method="post">
                <div class="image-float">
                    <img src="./assets/img/logo_99_145.png">
                </div>
                
                <?php if(isset($smsg)) { ?>
                    <div class="alert alert-success">
                        <?php echo $smsg; ?>
                    </div>
                <?php }?>
                <?php if(isset($fmsg)) { ?>
                    <div class="alert alert-danger" id="fsmg">
                        <?php echo $fmsg; ?>
                    </div>
                <?php }?>

                <h2 class="font-weight-lighter">Student <b>Login</b></h2>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" class="form-control" name="regNo" id="regNo" placeholder="Registration Number" auto_complete="off" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <input type="password" class="form-control" name="passwd" id="passwd" placeholder="Password" auto_complete="off" required>
                    </div>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit" name="login">LOGIN</button>
                </div>

                <div class="form-group">
                    <label><input type="checkbox" name="remember" id="remember"> Remember me</label>
                    <span class="float-right"><a href="#">Forget Password?</a></span>
                </div>
            </form>
        </div>

        <div class="footer">
           <p class="text-center">Copyright &copy; 2018 - <span id="cprt"></span>, College of Information and Communication Technologies (CoICT).</p>
        </div>
    </div>

    <script>
        const cprt = document.querySelector('#cprt');
        // var fmsg = document.querySelector('#fmsg');

        var date = new Date();
        var year = date.getFullYear();
        cprt.innerText = `${year}`;
    </script>
</body>
</html>