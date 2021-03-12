<?php if(!isset($_SESSION)){
        echo '<a href="index.php"><h1 style:"color: red;">Please Login To Continue</h1></a>';
        die();
    }
    include 'settings.php'; ?>

<!-- fbUKo1L6GvuMK3Ng -->

<h1 style="padding-top: 50px;">Manage Your Ballots</h1>

<?php

function updateStage($id,$stage,$positions) {
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $newquery2 = "UPDATE Ballot SET Stage='$stage' WHERE Ballot_ID=$id;";
    $newresult2 = mysqli_query($conn,$newquery2);
    if($stage == 'D'){
        for($i=0;$i<count($positions);$i++){
        
            $p_id = $positions[$i]['Position_Id'];  
            $query = "SELECT * FROM Applies WHERE Position_ID = $p_id";
            $result = mysqli_query($conn,$query);
            $cand = mysqli_fetch_all($result,MYSQLI_ASSOC);
    
            // print_r($cand);
            for($j=0;$j<count($cand);$j++){
    
                $cnaame = $cand[$j]['Candidate_Username'];
                $query = "SELECT COUNT(*) FROM Votes WHERE Position_ID = $p_id AND Candidate_Username = '$cnaame';";
                $result = mysqli_query($conn,$query);
                $cnt = mysqli_fetch_all($result,MYSQLI_ASSOC);
                $cnt = $cnt[0]['COUNT(*)'];
                $query = "UPDATE Applies SET Vote_Count = $cnt WHERE Candidate_Username = '$cnaame' AND Position_ID = $p_id;";
                $result = mysqli_query($conn,$query);
            }
        }
    }
}

if($conn){
    $username = $_SESSION['username'];
    $query = "SELECT * FROM Ballot WHERE Username = '$username';";
    $result = mysqli_query($conn,$query);
    $ballots = mysqli_fetch_all($result,MYSQLI_ASSOC);
    // print_r($ballots);
    echo'<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
        <th scope="col" class="text-center">Ballot ID</th>
        <th scope="col" class="text-center">Ballot Name</th>
        <th scope="col" class="text-center">Positions & Candidates</th>
        <th scope="col" class="text-center">Ballot Status</th>
        </tr>
    </thead>
    <tbody>';
    for($i=0;$i<count($ballots);$i++){
        $id = $ballots[$i]['Ballot_ID'];
        $name = $ballots[$i]['Ballot_Name'];
        $stage = $ballots[$i]['Stage'];
        echo "<tr>
        <td class=\"align-middle text-center\">$id</td>
        <td class=\"align-middle text-center\">$name</td>";

        $query = "SELECT Position_Name,Position_Id FROM Position WHERE Ballot_ID = $id;";
        $result = mysqli_query($conn,$query);
        $positions = mysqli_fetch_all($result,MYSQLI_ASSOC);
        //print_r($positions);
        echo "<td >";
        for($j=0;$j<count($positions);$j++){
            $p_name = $positions[$j]['Position_Name'];
            echo "<b>$p_name</b>";
            $p_id = $positions[$j]['Position_Id'];
            $query = "SELECT First_Name, Last_Name FROM Person WHERE Username IN (SELECT Candidate_Username FROM Applies WHERE Position_ID = $p_id)";
            $result = mysqli_query($conn,$query);
            $c_name = mysqli_fetch_all($result,MYSQLI_ASSOC);
            echo "<ul>";
            for($k=0;$k<count($c_name);$k++){
                echo "<li>";
                $f_name = $c_name[$k]['First_Name'];
                $l_name = $c_name[$k]['Last_Name'];
                echo "$f_name $l_name</li>";
                // echo "<br>";
            }
            echo "</ul>";
            // if($j!=count($positions)-1){
            // echo "<span><hr style=\"width:100px;height:2px;border-width:0;color:gray;background-color:gray\"><span>";
            // }
        }        
        echo "</td>";
        echo "<td class=\"align-middle text-center\">";
        if($stage == 'R'){
            echo "<form method=\"POST\">
            <button id=\"$id\" type=\"submit\" name=\"$id\" class=\"btn nav-item-cast-ud\">Progress To Voting</button>
            </form>";
            if (isset($_POST[$id])){
                updateStage($id,'V',$positions);
            }
        }
        else if($stage == 'V'){
            echo "<form method=\"POST\">
            <button id=\"$id\" type=\"submit\" name=\"$id\" class=\"btn nav-item-cast-ud\">Declare Results</button>
            </form>";
            if (isset($_POST[$id])){
                updateStage($id,'D',$positions);
            }
        }
        else{
            echo "Results Declared";
        }
        echo"</td></tbody></table>";
    }
}

?>