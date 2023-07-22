<?php
include '_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email = $_POST['signupEmail'];
    $password = $_POST['SignUpPassword'];
    $cpassword = $_POST['SignUpcPassword'];
    $existUser = "Select *from users where user_email = '$user_email'";
    $result=mysqli_query($conn,$existUser);
    $row=mysqli_num_rows($result);
    if ($row>0) {
        $showError=" <strong>Error!!</strong> UserEmail already exists. Login to continue!!";
        $error=true;
        header("location: /FORUMPROJECT/index.php?error='.$showError.'");
    }
    else{
        
        if ($password == $cpassword) {
            $hash=password_hash($password,PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO `users` ( `user_email`, `password`, `time`) VALUES ( '$user_email', '$hash', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            if($result){
               $showAlert="signUp succesfully";
               $error=false;
                header("location: /FORUMPROJECT/index.php?signup=true");
            }
           
        } else {
            $showError="password do not match";
            $error=true;
            header("location: /FORUMPROJECT/index.php?error='.$showError.'");
        }
    }
}



?>