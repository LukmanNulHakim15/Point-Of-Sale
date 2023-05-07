
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>transaksi.id</title>
  </head>
  <body>
    <div class="container">
        <h2>Registrasi</h2>
        <form action="registrasi.php" method="post" name="form1">
            <label for="">Name</label>
            <br>
            <input type="text" name="name" id="name" class="form control" >
            <br>
            <label for="">Username</label>
            <br>
            <input type="text" name="username" id="username" class="form control" >
            <br>
            <label for="">Password</label>
            <br>
            <input type="password" name="password" id="password" class="form control" >
            <br>
            <br>
             <td><input type="submit" name="submit" value="add">Registrasi</td>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<?php
if(isset($_POST['submit'])) {
    $name       = $_POST['name'];
    if(empty($name)){
        // $error_nama = "Nama tidak boleh kosong";
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Nama tidak boleh kosong")';  
        echo '</script>';  
        die();
    }
    // else{
    //     $c = cek_input($name);
    //     if(!preg_match("/^[a-zA-Z ]*$/",$c))
    //     {
    //         $nameErr = "Inputan Hanya boleh huruf dan spasi"; 
    //         // echo $nameErr;
    //     }
    // }
    $username   = $_POST['username'];
    if(empty($username)){
      echo '<script type ="text/JavaScript">';  
        echo 'alert("Username tidak boleh kosong")';  
        echo '</script>';  
        die();
      // echo $error_nama;
    }
    // else{
    //   $a = cek_input($username);
    //     if(!preg_match("/^[a-zA-Z ]*$/",$a))
    //     {
    //         $nameErr = "Inputan Hanya boleh huruf dan spasi"; 
    //         // echo $nameErr;
    //     }
    // }
    
    $password   = $_POST['password'];
    if(empty($password)){
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Password tidak boleh kosong")';  
        echo '</script>';  
        die();
    }
    // else{
    //   $b = cek_input($password);
    //     if(!preg_match("/^[a-zA-Z ]*$/",$b))
    //     {
    //         $nameErr = "Inputan Hanya boleh huruf dan spasi"; 
    //         // echo $nameErr;
    //     }
    // }

    //password hassing adalah password yang paling aman dalam tingkat perpasswordan
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // var_dump($password_hash);

     //Konek dengan database
      include_once('config.php');

      //insert data 
      $save = mysqli_query($mysqli, "INSERT INTO login(name,username, password,created_by) VALUES ('$name','$username','$password_hash','$name')");
      if($save){
        echo "Registrasi anda berhasil";
      }

      // function cek_input($data) {
      //   $data = trim($data);
      //   $data = stripslashes($data);
      //   $data = htmlspecialchars($data);
      //   return $data;
      // }

}
     
?>