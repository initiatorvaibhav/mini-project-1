<?php 
	
	session_start();
	require "includes/db.php";
    require "includes/functions.php";
    if(isset($_SESSION['user'])) {
        header("location: food_list.php");
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['submit'])) {
            $user = escape($_POST['username']);
            $pass = md5($_POST['password']);
            
            if($user != "" && $pass != "") {
				
				$verify = $db->query("SELECT * FROM admin WHERE username='$user' AND password='$pass' LIMIT 1");
				
				if($verify->num_rows) {
					
					$row = $verify->fetch_assoc();
					
					$_SESSION['user'] = $row['username'];
                    header("location: food_list.php");
					
					//echo "LOGGED IN";
					
				}else{
					
					echo "<script>alert('Invalid login credentials. Please try again')</script>";
					
                }
            }
            else{
				
                echo "<script>alert('Some fields are empty. All fields required!')</script>";
                
        }
        }
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Foodires</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	
	<link href="assets/css/style.css" rel="stylesheet" />
    </head>
    <body>
    <form method="post" action="index.php">
    <div class="header">
				<h4 style="border-bottom: 1px solid #FF5722;" class="title">Login Form</h4>
			</div>
            <div class="form-group" method="post" action="#">
				<label>Username</label>
				<input type="text" name="username" class="form-control" placeholder="Enter Username" autofocus>
			</div>
            <div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control" placeholder="Enter your password">
			</div>
            <input type="submit" name="submit" value="Login" class="btn btn-info btn-fill pull-right" style="background: #FF5722; border-color: #FF5722;" />
			<div class="clearfix"></div>
    </form>
        
    </body>
    </html>