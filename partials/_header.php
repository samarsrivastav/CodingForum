<?php
include 'partials/_login.php';
include 'partials/_signup.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  $loggedin = false;
} else {
  $loggedin = true;
}
echo '
<nav class="navbar navbar-dark navbar-expand-lg bg-dark ">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
          <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Python</a></li>
            <li><a class="dropdown-item" href="#">javascript</a></li>
            <li><a class="dropdown-item" href="#">C++</a></li>
            <li><a class="dropdown-item" href="#">Java</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="contact.php">Contact</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success mx-2" type="submit">Search</button>
      </form>
     
      ';
if (!$loggedin) {
  echo '<div>
        <button class="btn btn-outline-success ml-2 " data-bs-toggle="modal" data-bs-target="#loginModal"  type="submit">Login</button>
        <button class="btn btn-outline-success ml-2 "data-bs-toggle="modal" data-bs-target="#SignupModal"  type="submit">SignUp</button>
        </div>
        ';
} else {
  echo ' 
  <div>
  <button class="btn btn-outline-success ml-2 "  type="submit"><a style="text-decoration:none; color:white;" href="/FORUMPROJECT/partials/_logout.php">Logout</a></button>
  </div>
  ';
}
echo
  '
    </div>
  </div>
</nav>
';

if ($loggedin) {
  echo '<div class="alert alert-success my-0" role="alert">
  welcome <strong>' . $_SESSION['email'] . '!</strong> <br>You have been logedin <strong>Successfully!</strong> 
  </div>';
}
if (isset($_GET['signup']) && $_GET['signup'] == true) {
  echo '<div class="alert alert-success my-0" role="alert">
    Your Account has been created <strong>Successfully!</strong> 
    </div>';
}
if (isset($_GET['error'])) {
  echo '<div class="alert alert-danger my-0" role="alert">
    <strong>Error!</strong> ' . $_GET['error'] . '
    </div>';
}
?>