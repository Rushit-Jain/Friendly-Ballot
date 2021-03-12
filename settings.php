<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'id16363680_friendly_ballot');
    define('DB_PASSWORD', 'k7h@r@KqkQFK8nk');
    define('DB_NAME', 'id16363680_friendlyballot');

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>