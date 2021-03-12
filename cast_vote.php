<?php if(!isset($_SESSION)){
        echo '<a href="index.php"><h1 style:"color: red;">Please Login To Continue</h1></a>';
        die();
    }
    include 'settings.php' ?>
<!-- fbUKo1L6GvuMK3Ng -->
<h1 style="padding-top: 50px;">Cast a Vote</h1>
<div style="padding-top: 30px;" class="row justify-content-center">
    <form method="POST">
        <div class="form-group">
            <input type="text" style="text-align: center;" name="ballotid" class="form-control" id="ballot-id" placeholder="Enter Ballot ID">
            <button type="submit" style="margin-top: 25px;" name="viewpos" class="form-control btn btn-success">View Positions & Candidates</button>
        </div>
    </form>
</div>

<?php
    $ARRAY=array();
    if(empty($_SESSION['array'])) {
        $_SESSION['array'] = $ARRAY;
    }
    if($conn) {
        if(isset($_POST['viewpos'])){
            $ballotid = $_POST['ballotid'];
            $query = "SELECT Stage FROM Ballot WHERE Ballot_ID = $ballotid";
            $result = mysqli_query($conn,$query);
            $stage = mysqli_fetch_all($result,MYSQLI_ASSOC);
            $stage = $stage[0]['Stage'] ;
            if($stage=='V'){
            $query = "SELECT Position_Name,Position_ID FROM Position WHERE Ballot_ID = $ballotid";
            $result = mysqli_query($conn,$query);
            $positions = mysqli_fetch_all($result,MYSQLI_ASSOC);
            if($positions){
                echo'<table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" class="text-center">Position Name</th>
                    <th scope="col" class="text-center">Candidates</th>
                    </tr>
                </thead>
                <tbody>';
                for($i=0;$i<count($positions);$i++) {
                    global $ARRAY;
                    $n = $positions[$i]["Position_ID"];
                    $n1=$positions[$i]["Position_Name"];
                    array_push($ARRAY,$n);
                    $_SESSION['array'] = $ARRAY;
                    $newquery = "SELECT First_Name,Last_Name,Username FROM Person WHERE Username IN (SELECT Candidate_Username FROM Applies WHERE Position_ID = $n);";
                    $newresult = mysqli_query($conn,$newquery);
                    $candidates = mysqli_fetch_all($newresult,MYSQLI_ASSOC);
                    echo"<tr>
                    <td class=\"align-middle text-center\">$n1</td>
                    <td>
                    <form action=\"cast_vote.php\" method=\"POST\">";
                    for($j=0;$j<count($candidates);$j++){
                        $m=$candidates[$j]["First_Name"];
                        $m1=$candidates[$j]["Last_Name"];
                        $m2=$candidates[$j]["Username"];
                        echo"<div class=\"form-check row align-items-center\">
                        <label class=\"form-check-label col-8\">
                        <input type=\"radio\" id= \"$m2\" value=\"$m2\" class=\"form-check-input \" name=\"$n\">$m $m1
                        </label>
                        </div><br>";
                    }
                    echo "
                    <button name=$n onclick=\"k=document.getElementsByName('$n'); for(i=0;i<k.length;i++) k[i].disabled=true; for(i=0;i<k.length;i++){if(k[i].checked){ k=k[i]; break;}} document.cookie = escape($n)+'='+escape(k.value)+'; path=/';\" type=\"button\" class=\"btn nav-item-cast-ud\">Confirm</button>
                    </form>
                    </td>
                    </tr>";
                }
                echo '
                </tbody>
                </table><br>
                <div class="row justify-content-center"><form action="#" method="POST"><button id="votebtn" name="appbtn" type="submit" class="btn nav-item-cast-ud ">Vote</button></form></div>  ';
                
                //mysqli_free_result($newresult);
            }
            else
            echo 'No ballot exists';
        }
        else if($stage=='R'){
            echo "<h2 style='color:red; padding-left:450px;'>This ballot is not yet accepting votes.<h2>";
        }
        else {
            echo "<h2 style='color:red; padding-left:450px;'>The ballot is no longer accepting votes.<h2>";
        }
    }
}
if(isset($_POST['appbtn'])) {
    echo 'VOTED SUCCESSFULLY';
    $positions1 = $_SESSION['array'];
    $date = date("Y-m-d");
    $username = $_SESSION['username'];
    for($i=0;$i<count($positions1);$i++){
        $id=$positions1[$i];
        $n=$_COOKIE[$id];
        if($n!=NULL){
            $newquery2 = "INSERT INTO Votes(Position_ID,Voter_Username,Candidate_Username,Voting_Time) VALUES ($id,'$username','$n','$date');";
            $newresult2 = mysqli_query($conn,$newquery2);
        }
    }
}
?>