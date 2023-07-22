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
    include 'partials/_dbconnect.php';
    ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `thread` where thread_id=$id";
    $result = mysqli_query($conn, $sql);
    // loop
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
    }
    ?>

    <div class="container">

        <div data-bs-spy=" scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
            data-bs-smooth-scroll="true" class="scrollspy-example bg-light my-3 p-3 rounded-2" tabindex="0"
            style="height:200px;">
            <h2 id="scrollspyHeading1">
                <?php echo $title; ?>
            </h2>
            <p>
                <?php echo $desc; ?>
            </p>
        </div>
    </div>
    <?php
    $showAlert = false;
    $method = $_SERVER["REQUEST_METHOD"];
    if ($method == 'POST') {
        $commentBy=$_SESSION['email'];
        $c_desc = $_POST['desc'];
        $id = $_GET['threadid'];

        $sql = "INSERT INTO `comment` ( `comment_content`, `comment_by`, `thread_id`, `comment_time`) VALUES ('$c_desc', '$commentBy', '$id', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }


    ?>
    <?php
    echo '<div class="container my-4 ">
        <h2 class=" my-3">Discussion</h2>
        ';
        if($loggedin){
          echo  '
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="post">
    <div class="input-group">
        <span class="input-group-text">Comment description</span>
        <textarea class="form-control" aria-label="With textarea" id="desc" name="desc"></textarea>
    </div>
    <button type=" submit" class="btn btn-success my-2">Submit</button>
    </form>
    </div>';
        }
        else{
            echo "<h2>Loggin to comment</h2>";
        }
        
    ?>
    <div class="container my-3">
        <h2 class="my-2">Comments</h2>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comment` where thread_id=$id";
        $result = mysqli_query($conn, $sql);
        // loop
        $nores = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $nores = false;
            $id = $row['comment_id'];
            $title = $row['comment_content'];
            $name = $row['comment_by'];
            $time = $row['comment_time'];
            echo '<div class="d-flex">
            <div class="flex-shrink-0">
                <img src="img/user.png" alt="user img" style="height:60px ;width:60px;">
            </div>
            <div class=" flex-grow-1 ms-3">
                <h4 class="font-weight";>' . $name . '</h4>
                ' . $title . '<br>' . $time . '
            </div>
        </div><br>';
        }
        if ($nores) {
            echo "Be the first to start the discussion";
        }

        ?>
    </div>
    <?php
    include 'partials/_footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>