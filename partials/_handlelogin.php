<?php
include '_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email = $_POST['email'];
    $password = $_POST['password'];
    $existUser = "Select *from users where user_email = '$user_email'";
    $result=mysqli_query($conn,$existUser);
    $num=mysqli_num_rows($result);
    if ($num==0) {
        $showError=" <strong>Error!!</strong> Invalid Credentials!!";
        $error=true;
        header("location: /FORUMPROJECT/index.php?error='.$showError.'");
    }
    else{
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password,$row['password'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $user_email;
                header("location: /FORUMPROJECT/index.php?login=true");
              
            } else {
                $err = false;
                $showerr = "Invalid credentials";
                header("location: /FORUMPROJECT/index.php?error='.$showerr.'");
            }
            
        }
      
    }
}



?>