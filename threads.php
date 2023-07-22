<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Idiscuss Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <?php
    session_start();
    include 'partials/_header.php';
    ?>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` where id=$id";
    $result = mysqli_query($conn, $sql);
    // loop
    while ($row = mysqli_fetch_assoc($result)) {
        $cat = $row['name'];
        $desc = $row['description'];
    }
    ?>
    <?php
    $showAlert = false;
    $method = $_SERVER["REQUEST_METHOD"];
    if ($method == 'POST') {
        $td_title = $_POST['title'];
        $td_desc = $_POST['desc'];
        $email=$_SESSION['email'];
        $sql = "INSERT INTO `thread` (`thread_title`, `thread_desc`, `cat_id`, `user_id`, `timestamp`) VALUES ('$td_title', '$td_desc','$id', '$email', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your thread has been added! Please wait for community to respond
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';

        }
    }


    ?>
    <div class="container">

        <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
            data-bs-smooth-scroll="true" class="scrollspy-example bg-light my-3 p-3 rounded-2" tabindex="0">
            <h2 id="scrollspyHeading1">Welcome to
                <?php echo $cat; ?> Forum
            </h2>
            <p>
                <?php echo $desc; ?>
            </p>
            <h3>Forum rules</h3>
            <p>Keep it friendly.</p>
            <p>Stay on topic. </p>
            <p> Refrain from demeaning, discriminatory, or harassing behaviour and speech.</p>
        </div>
    </div>

    <?php
    if ($loggedin) {
        echo '<div class="container my-4 ">
        <h2 class=" my-3">Enter the details to add the Question</h2>
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
    <div class=" mb-3">
        <label for="exampleInputEmail1" class="form-label">Problem title</label>
        <input type="text" class="form-control" id="title" name="title" aria-label="With textarea">
        <div id="emailHelp" class="form-text">Make the title crisp and simple.</div>
    </div>

    <div class="input-group">
        <span class="input-group-text">Problem description</span>
        <textarea class="form-control" aria-label="With textarea" id="desc" name="desc"></textarea>
    </div>
    <button type=" submit" class="btn btn-success my-2">Submit</button>
    </form>
    </div>';
    } else {
        echo "
        <h2 class='text-center'> Login to Post A Query!! </h2>";
    }
    ?>
    <div class="container my-3">
        <h2 class="my-2">Browse Questions</h2>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `thread` where cat_id=$id";
        $result = mysqli_query($conn, $sql);
        // loop
        $nores = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $nores = false;
            $user=$row['user_id'];
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $time = $row['timestamp'];
            echo '<div class="d-flex">
            <div class="flex-shrink-0">
                <img src="img/user.png" alt="user img" style="height:60px ;width:60px;">
            </div>
            <div class=" flex-grow-1 ms-3">
                <h4><a href="threadDes.php?threadid=' . $id . '" style="text-decoration:none; " class="text-dark">' . $user . '<br>' . $title . '</a></h4>
                ' . $desc . '<br>' . $time . '
            </div>
        </div><br>';
        }
        if ($nores) {
            echo "Be the first to raise a query";
        }

        ?>
    </div>

    <?php
    include 'partials/_footer.php';
    ?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>