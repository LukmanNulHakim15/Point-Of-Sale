<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            @import url(https://fonts.googleapis.com/css?family=Roboto:300);

            .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
            }
            .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            }
            .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
            }
            .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
            }
            .form button:hover,.form button:active,.form button:focus {
            background: #43A047;
            }
            .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
            }
            .form .message a {
            color: #4CAF50;
            text-decoration: none;
            }
            .form .register-form {
            display: none;
            }
            .container {
            position: relative;
            z-index: 1;
            max-width: 300px;
            margin: 0 auto;
            }
            .container:before, .container:after {
            content: "";
            display: block;
            clear: both;
            }
            .container .info {
            margin: 50px auto;
            text-align: center;
            }
            .container .info h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
            }
            .container .info span {
            color: #4d4d4d;
            font-size: 12px;
            }
            .container .info span a {
            color: #000000;
            text-decoration: none;
            }
            .container .info span .fa {
            color: #EF3B3A;
            }
            body {
            background: #76b852; /* fallback for old browsers */
            background: rgb(141,194,111);
            background: linear-gradient(90deg, rgba(141,194,111,1) 0%, rgba(118,184,82,1) 50%);
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;      
            }
    </style>
    <script src="">
        $('.message a').click(function(){
            $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        });
    </script>
</head>
<body>
    <div class="login-page">
        <div class="form">
            <form action="login.php" method="post" name="form1">
            
            <input type="text" name="username" id="username" class="form control" placeholder="Username" >
            <br>
            <input type="password" name="password" id="password" class="form control" placeholder="Password" >
            <br>
            <br>
             <td><input type="submit" name="submit"></td>
        </form>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST['submit'])) {
   
    $username   = $_POST['username'];
    if(empty($username)){
      echo '<script type ="text/JavaScript">';  
        echo 'alert("Username tidak boleh kosong")';  
        echo '</script>';  
        die();
      // echo $error_nama;
    }else{
        if(!preg_match("/^[a-zA-Z ]*$/",$username))
        {
            $nameErr = "Inputan Hanya boleh huruf dan spasi"; 
            // echo $nameErr;
        }
    }
    
    $password   = $_POST['password'];
    if(empty($password)){
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Password tidak boleh kosong")';  
        echo '</script>';  
        die();
    }else{
        if(!preg_match("/^[a-zA-Z ]*$/",$password))
        {
            $nameErr = "Inputan Hanya boleh huruf dan spasi"; 
            // echo $nameErr;
        }
    }

     //Konek dengan database
    include_once('config.php');

    //query
    
    //$username perlu di-escape menggunakan mysqli_real_escape_string untuk mencegah serangan SQL injection.
    $username = mysqli_real_escape_string($mysqli, $username); 
    $query = mysqli_query($mysqli, "SELECT id, username, password, name FROM login WHERE username = '$username'");
    if (!$query) {
    die('Query error: ' . mysqli_error($mysqli));
    }
    if(mysqli_num_rows($query) > 0){
        while ($row = mysqli_fetch_assoc($query)) {
            $id = $row['id'];
            $name = $row['name'];
            $username = $row['username'];
            $checkPass = $row['password'];
        }

        if(password_verify($password, $checkPass)){
            session_start();
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;
                $_SESSION['username'] = $username;
                print_r($_SESSION);
        }else{
            echo '<script type ="text/JavaScript">';  
            echo 'alert("Username atau password tidak cocok")';  
            echo '</script>';  
            die();
        }

    }else{
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Akun tidak terdaftar")';  
        echo '</script>';  
        die();
    }
    
    
     
}
     



?>