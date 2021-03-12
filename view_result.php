<?php if(!isset($_SESSION)){
        echo '<a href="index.php"><h1 style:"color: red;">Please Login To Continue</h1></a>';
        die();
    }
    include 'settings.php' ?>
<!-- fbUKo1L6GvuMK3Ng -->
<h1 style="padding-top: 50px;">View Results</h1>
<div style="padding-top: 30px;" class="row justify-content-center">
    <form method="POST">
        <div class="form-group">
            <input type="text" style="text-align: center;" name="ballotid" class="form-control" id="ballot-id" placeholder="Enter Ballot ID">
            <button type="submit" style="margin-top: 25px;" name="viewres" class="form-control btn btn-success">View Result</button>
        </div>
    </form>
</div>

<?php
if($conn) {
    if(isset($_POST['ballotid'])) {
        $ballotid = $_POST['ballotid'];
        $query = "SELECT Stage FROM Ballot WHERE Ballot_ID = $ballotid;";
        $result = mysqli_query($conn,$query);
        $bllts = mysqli_fetch_all($result,MYSQLI_ASSOC);
        // print_r($bllts);
        $b_stage = $bllts[0]['Stage'];
        if($b_stage == 'D')
        {
            $query = "SELECT Position_Name,Position_Id FROM Position WHERE Ballot_ID = $ballotid;";
            $result = mysqli_query($conn,$query);
            $positions = mysqli_fetch_all($result,MYSQLI_ASSOC);
            echo'<table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
            <th scope="col" class="text-center">Position Name</th>
            <th scope="col" class="text-center">Winner(s)</th>
            <th scope="col" class="text-center">Vote Count</th>
            </tr>
            </thead>
            <tbody>';
            for($i=0;$i<count($positions);$i++){
                $p_id = $positions[$i]['Position_Id'];
                $p_name = $positions[$i]['Position_Name'];
                $query = "SELECT Candidate_Username,Vote_Count FROM Applies WHERE Vote_Count IN (SELECT MAX(Vote_Count) FROM Applies WHERE Position_Id = $p_id) AND Position_ID = $p_id;";
                $result = mysqli_query($conn,$query);
                $winners = mysqli_fetch_all($result,MYSQLI_ASSOC);
                $count = $winners[0]['Vote_Count'];
                echo '<tr>';
                echo "<td scope=\"col\" class=\"text-center\">$p_name</td>
                <td scope=\"col\" class=\"text-center\">";
                for($j=0;$j<count($winners);$j++){
                    $uname = $winners[$j]['Candidate_Username'];
                    $query = "SELECT First_Name,Last_Name FROM Person WHERE Username = '$uname';";
                    $result = mysqli_query($conn,$query);
                    $names = mysqli_fetch_all($result,MYSQLI_ASSOC);
                    $f_name = $names[0]['First_Name'];
                    $l_name = $names[0]['Last_Name'];
                    echo "$f_name $l_name ( $uname )<br>";
                    
                }
                echo " </td><td scope=\"col\" class=\"text-center\">$count</td></tr>";
            }
            echo '</tbody></table>';
        }
        else{
            echo "<h2 style='color:red; padding-left:450px;'>Results have not been declared.</h2>";
        }
    }
}
?>