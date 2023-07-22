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
    <!-- corousal -->
    <div id="carouselExampleControls" class="carousel slide my-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/2400x700/?coding" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?coding,computer" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/2400x700/?coding,program" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- container -->
    <div class="container my-3">
        <h2 class="text-center">iDiscuss Categories</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $sql);
            // loop
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $cat = $row['name'];
                echo ' <div class="col-md-4 my-2">
                <div class=" card my-2" style="width: 18rem;">
                    <img src="https://source.unsplash.com/500x400/?coding,' . $cat . '" class="card-img-top" alt="...">
                    <div class="card-body ">
                        <h5 class="card-title"><a style="text-decoration:none; " class="text-dark" href="threads.php?catid=' . $id . '">' . $cat . '</a></h5>
                        <p class="card-text">' . substr($row['description'], 0, 90) . '....</p>
                        <a href="threads.php?catid=' . $id . '" class="btn btn-success">Read More</a>
                    </div>
                </div>
            </div>';

            }
            ?>


        </div>
    </div>
    <?php
    include 'partials/_footer.php';
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>