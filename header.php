<?php include 'settings.php' ?>
<?php
if($conn) {
    if(isset($_POST['submitsignup'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $username = $_POST['username'];

        $query = "SELECT * FROM Person WHERE Username = '$username';";
        $result = mysqli_query($conn,$query);
        $chck = mysqli_fetch_all($result,MYSQLI_ASSOC);

        $existinguname = sizeof($chck);
        if($existinguname==0){
            $newquery2 = "INSERT INTO Person(Username,Email_ID,`Password`,First_Name,Last_Name) VALUES ('$username','$email','$password','$fname','$lname');";
            $newresult2 = mysqli_query($conn,$newquery2);

            $newquery2 = "INSERT INTO Voter(Username,Organization_ID) VALUES ('$username',NULL);";
            $newresult2 = mysqli_query($conn,$newquery2);
        }
        else{
            echo '<script>alert("Username Already Exists.\nPlease Choose Another Username.");</script>';
        }
                                    }
        
    if(isset($_POST['loginsubmit'])) {
         echo "<script>console.log(5)</script>";
        $uname = $_POST['loginuser'];
        $password = $_POST['loginpassword'];
        

        $query = "SELECT * FROM Person WHERE Username = '$uname' AND `Password`= '$password' ";
        $result = mysqli_query($conn,$query);
        $chck = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $existinguname = sizeof($chck);
        if($existinguname==1){
            
            session_start();
            $_SESSION['username']=$uname;
            header('Location: user_portal.php');
            
        }
        else{
            echo '<script>alert("Invalid Credentials");</script>';
        }
    }     
}
if(isset($_GET['link'])){
    $link = $_GET['link'];
    if($link=='home'){
        header('Location: index.php');
    }
    if($link=='about'){
        header('Location: aboutus.php');
    }
    if($link=='contact'){
        header('Location: contactus.php');
    }
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
    <!-- below for jquery UI  -->
    <!-- ggle cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <!-- below slick -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" />


</head>

<body>
    <!--below code for header-->
    <header>
        <div class="jumbotron1">
            <nav>
                <img id="logo1" src="logo.png" width="50px" height="50px">
                <a href="#"></a>
                </img>
                <ul>
                    <li><a id="home-link" href="?link=home"><i class="fa fa-home" aria-hidden="true"></i>HOME</a></li>
                    <li><a id="about-link" href="?link=about"><i class="fa fa-info" aria-hidden="true"></i>ABOUT US</a></li>
                    <!-- <li><a id="contact-link" href="?link=contact"><i class="fa fa-id-card-o" aria-hidden="true"></i>CONTACT US</a></li> -->
                </ul>
                <div class="nav-right1">
                    <button id="loginbtn" data-toggle="modal" data-target="#loginModal"><b>LOGIN</b></button>
                    <button id="signupbtn" data-toggle="modal" data-target="#signupModal"><b>SIGN UP</b></button>
                </div>
            </nav>
            <div id="titlename1">
                <img src="logo.png" width="150px" height="150px">
                <a href="#"></a>
                </img><br><br>
                <span id="titlehead-1">Friendly</span><span id="titlehead-2">Ballot</span> <br> <br>
                <p id="tagline">Build <b>secure</b> and <b>fair</b> cloud based ballots.</p>
            </div>
        </div>
    </header>

    <!-- Modal -->
    <div class="modal fade " id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title align-items-center" id="signupModalLabel">Sign Up</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="times">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="p-20 signup container">
                        <form method="POST">
                            <div class="row mt-4">
                                <div class="form-group offset-1 col-4 mr-4">
                                    <input type="text" name="fname" id="fname" class="form-control" oninput="onValid()" onblur="validateFirstName()"
                                        required>
                                    <label class="form-control-placeholder" for="fname">First Name</label>
                                    <p id="fnameerr"></p>
                                </div>
                                <div class="form-group ml-2 col-4">
                                    <input type="text" name="lname" id="lname" oninput="onValid()" onblur="validateLastName()" class="form-control"
                                        required>
                                    <label class="form-control-placeholder" for="lname">Last Name</label>
                                    <p id="lnameerr"></p>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group offset-1 col-9">
                                    <input type="text" name="username" id="username" oninput="onValid()" onblur = "validateUsername()" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Username</label>
                                    <p id="unameerr"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4 offset-1 mr-4">
                                    <input type="password" name="password" data-toggle="tooltip" title="Password must be at least 6 characters long and have at least one special character of these only [!,@,#,$,%,^,&,*] and one number" id="password" oninput="onValid()" onblur="validatePassword()"
                                        class="form-control" required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <p id="passworderr"></p>
                                </div>
                                <div class="form-group ml-2 col-4">
                                    <input type="password" id="cnfpwd" oninput="onValid();validateCnfPassword()"
                                        class="form-control" required>
                                    <label class="form-control-placeholder" for="cnfpwd">Confirm Password</label>
                                    <p id="cnfpwderr"></p>
                                </div>
                                <!-- </div> -->
                            </div>
                            <div class="row">
                                <div class="form-group offset-1 col-9">
                                    <input type="text" name="email" id="email" oninput="onValid()" onblur="validateEmail()" class="form-control"
                                        required>
                                    <label class="form-control-placeholder" for="email">E-mail</label>
                                    <p id="emailerr"></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger rounded-pill" data-dismiss="modal">Close</button>
                                <button id="submitsignup" name="submitsignup" type="submit" class="btn btn-success rounded-pill" disabled='true'>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade " id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header ">
                    <h3 class="modal-title " id="loginModalLabel">Login</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="times">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="container ">
                        <form action="" method="POST">
                            <div class="row offset-1 mt-4">
                                <div class="form-group col-9 ">
                                    <input type="text" name="loginuser" id="loginemail" class="form-control" required>
                                    <label class="form-control-placeholder" for="loginemail">Username</label>
                                </div>
                            </div>
                            <div class="row offset-1">
                                <div class="form-group col-9">
                                    <input type="password" name="loginpassword" id="loginpassword" class="form-control" required>
                                    <label class="form-control-placeholder" for="loginpassword">Password</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger rounded-pill" data-dismiss="modal">Close</button>
                                <button type="submit" name="loginsubmit" id="loginsubmit" class="btn btn-success rounded-pill">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>