<?php if(!isset($_SESSION)){
        echo '<a href="index.php"><h1 style:"color: red;">Please Login To Continue</h1></a>';
        die();
    }
    include 'settings.php' ?>

<!-- fbUKo1L6GvuMK3Ng -->

<h1 style="padding-top: 50px;">Apply for a Position</h1>
<div style="padding-top: 30px;" class="row justify-content-center">
    <form method="POST">
        <div class="form-group">
            <input type="text" style="text-align: center;" class="form-control" id="ballot-id" name="ballotid" placeholder="Enter Ballot ID">
            <button type="submit" style="margin-top: 25px;" class="form-control btn btn-success" name="viewpos">View Positions</button>
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
            $stage = $stage[0]['Stage'];
            if($stage == 'R'){
                $query = "SELECT Position_Name,Position_ID FROM Position WHERE Ballot_ID = $ballotid";
                $result = mysqli_query($conn,$query);
                $positions = mysqli_fetch_all($result,MYSQLI_ASSOC);
                if($positions){
                    echo'<table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                    <th scope="col" class="text-center">Position Name</th>
                    </tr>
                    </thead>
                    <tbody>';
                    for($i=0;$i<count($positions);$i++) {
                        global $ARRAY;
                        $n = $positions[$i]["Position_ID"];
                        $n1=$positions[$i]["Position_Name"];
                        array_push($ARRAY,$n);
                        $_SESSION['array'] = $ARRAY;
                        echo"<tr>
                        <td>
                        <form action=\"cast_vote.php\" method=\"POST\">";
                            echo"<div class=\"form-check row align-items-center\">
                            <label class=\"form-check-label col-8\">
                            <input type=\"radio\" id= \"$n\" value=\"$n\" class=\"form-check-input \" name=\"$n\">$n1
                            </label>
                            
                        <button name=$n onclick=\"k=document.getElementsByName('$n'); for(i=0;i<k.length;i++) k[i].disabled=true; for(i=0;i<k.length;i++){if(k[i].checked){ k=k[i]; break;}} document.cookie = escape($n)+'='+escape(k.value)+'; path=/';\" type=\"button\" class=\"btn nav-item-cast-ud\">Confirm</button>
                        </div><br>
                        </form>
                        </td>
                        </tr>";
                    }
                    echo "
                    </tbody>
                    </table><br>
                    <div class=\"row justify-content-center\">
                    <form method=\"POST\"><button id=\"votebtn\" name=\"votebtn\" type=\"submit\" class=\"btn nav-item-cast-ud \">Apply</button></form>
                    </div>  ";
                    
                }
                else
                echo 'No ballot exists';
            }
            else {
                echo "<h2 style='color:red; padding-left:250px;'>This ballot is no longer accepting registrations.</h2>";
            }
        }
        
        if(array_key_exists('votebtn', $_POST)) {
            $positions1 = $_SESSION['array'];
            $date = date("Y-m-d");
            $username = $_SESSION['username'];
            $newquery = "INSERT INTO Candidate(Username, Organization_ID) VALUES ('$username',NULL);";
            $newresult = mysqli_query($conn,$newquery);
            for($i=0;$i<count($positions1);$i++){
                $id=$positions1[$i];
                $n=$_COOKIE[$id];
                if($n!=NULL){
                    $newquery2 = "INSERT INTO Applies(Position_ID,Candidate_Username,Vote_Count,Application_Time) VALUES ($id,'$username',0,'$date');";
                    $newresult2 = mysqli_query($conn,$newquery2);
                }
            }
        }
    }

?>