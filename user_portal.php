<?php
    session_start();
    if(!isset($_SESSION['username'])){
        echo '<a href="index.php"><h1 style:"color: red;">Please Login To Continue</h1></a>';
        die();
    }
    if(isset($_POST['signout'])){
        session_destroy();
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friendly Ballot</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/6192da6b8f.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Grenze+Gotisch:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="portal.css?v=1" />
</head>

<body>
    <nav class="navbar navbar-light" >
        <a class="navbar-brand">
            <img src="logo.png" class="d-inline-block align-top" width="50" height="50" alt="">
                Friendly Ballot
        </a>
        <span class="logo_user">
            <span class="dropdown show mr-3">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </a>
                <span class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <form method="POST"><button type="submit" class="nav-item-cast-ud" style="width: 150px;" name="signout">Sign Out</button></form>
                </span>
            </span>
            <span class="mr-1 username"><?php echo $_SESSION['username'] ?></span>
            <span><i class="fa fa-user-circle fa-lg" aria-hidden="true"></i></span>
        </span>
    </nav>
    <div class="row">
        <div class="side-nav-ud col-2">
            <a href="?link=1">
                <div id="create" class="nav-item-ud">
                    Create a Ballot
                </div>
            </a>
            <hr>
            <a href="?link=2">
                <div id="manage" class="nav-item-ud">
                    Manage Ballots
                </div>
            </a>
            <hr>
            <a href="?link=3">
                <div id="cast" class="nav-item-ud">
                    Cast a Vote
                </div>
            </a>
            <hr>
            <a href="?link=4">
                <div id="apply" class="nav-item-ud">
                    Apply for a Position
                </div>
            </a>
            <hr>
            <a href="?link=5">
                <div id="view" class="nav-item-ud">
                    View Results
                </div>
            </a>
            <hr>
        </div>
        <div class="col-9">
            <?php
                if(isset($_GET['link'])) {
                    $link=$_GET['link'];
                    if ($link == '1') {
                        include 'create_ballot.php';
                    }
                    if ($link == '2') {
                        include 'manage_ballots.php';
                    }
                    if ($link == '3') {
                        include 'cast_vote.php';
                    }
                    if ($link == '4') {
                        include 'apply_position.php';
                    }
                    if ($link == '5') {
                        include 'view_result.php';
                    }
                }
                else {
                    echo '<div style="padding-top: 200px;" class="row"><div class="col-12"><h1>Welcome to Your Portal</h1>';
                    echo '<h4>Select an option from the side menu to avail the required functionality</h4></div></div>';
                }
            ?>
        </div>
    </div>
    <script src="portal.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>

</body>

</html>