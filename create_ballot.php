<?php if(!isset($_SESSION)){
        echo '<a href="index.php"><h1 style:"color: red;">Please Login To Continue</h1></a>';
        die();
    }
    include 'settings.php'; ?>

<!-- fbUKo1L6GvuMK3Ng -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script >
        $(function(){
            var count = 1;
            var id = 'i'+count;
            $('#append').click(function(){
                $('#parent').append('<div id="a'+count+'" class="form-group row"><label for="i'+count+'" class="col-5">Position Name : </label><input type="text" class="col-6" style="text-align: center; height: 32px;" name="'+count+'" class="form-control" id="i'+count+'" placeholder="Enter Position Name"><button id="'+count+'" type="button" onclick="l = document.getElementById(&quot;i'+count+'&quot;); var id=&quot;i&quot;+this.id; document.getElementById(id).value=l.value; let l1 = document.getElementById(&quot;a'+count+'&quot;).remove();" name="create" class="form-control btn remove col-1"><i class="fa fa-minus-circle" style="font-size:20px; color: red;" aria-hidden="true"></i></button></div>');
                count++;
            });
            $(".remove").click(function() {  
                $("#parent").children().last().remove();  
            }); 
            $('#addpos').click(function(){
                document.cookie = escape('count')+'='+escape(count)+'; path=/';
            });
        });
</script>

<h1 style="padding-top: 50px;">Create a Ballot</h1>
<div style="padding-top: 30px;" class="row justify-content-center">
    <form method="POST">
        <div class="form-group">
            <input type="text" style="text-align: center;" name="ballotname" class="form-control" id="ballot-name" placeholder="Enter Ballot Name">
            <button type="submit" style="margin-top: 25px;" name="create" class="form-control btn btn-success">Create Ballot</button>
        </div>
    </form>
</div>

<?php 
    if($conn)
    {
        if(isset($_POST['create']))
        {
            $username = $_SESSION['username'];
            $ballotname = $_POST['ballotname'];
            $query = " SELECT MAX(Ballot_ID) FROM Ballot; ";
            $result = mysqli_query($conn,$query);
            $maxballot = mysqli_fetch_all($result,MYSQLI_ASSOC);
            // print_r ($maxballot);
            $maxballot = $maxballot[0]['MAX(Ballot_ID)']+1;
            // echo "$maxballot";
            echo "<h3 style='color: purple; padding-left: 500px;'>Ballot ID: $maxballot</h3>";
            $query = " INSERT INTO Ballot(Ballot_ID,Ballot_Name,Stage,Username) VALUES ($maxballot,'$ballotname','R','$username'); ";
            $result = mysqli_query($conn,$query);

            echo '<h4 style="padding-top: 50px;">Add Positions</h4>
            <div style="padding-top: 30px;" class="row justify-content-center">
                <form method="POST">
                    <div class="form-group row">
                        <label for="0" class="col-5">Position Name : </label><input type="text" class="col-6" style="text-align: center;" name="0" class="form-control" id="0" placeholder="Enter Position Name">
                        <span class="col-1"> &nbsp;</span>
                    </div>
                    <div id="parent">
                        
                    </div>
                    <button type="button" id="append" style="margin-top: 15px;"  name="create" class="form-control btn">
                    <i class="fa fa-plus-circle" style="font-size:30px;" aria-hidden="true"></i>
                    </button>
                    <div class="row">
                        <button type="submit" id="addpos" style="margin-top: 25px;" name="addpos" class="form-control btn btn-success">Add Positions</button>
                    </div>
                </form>
            </div>';
        }
        if(isset($_POST['addpos'])){
            $query = "SELECT MAX(Ballot_ID) FROM Ballot;";
            $result = mysqli_query($conn,$query);
            $maxballot = mysqli_fetch_all($result,MYSQLI_ASSOC);
            $maxballot = $maxballot[0]['MAX(Ballot_ID)'];
            $count = $_COOKIE['count'];
        $query = " SELECT MAX(Position_ID) FROM Position; ";
        $result = mysqli_query($conn,$query);
        $maxpositionid = mysqli_fetch_all($result,MYSQLI_ASSOC);
        $maxpositionid = $maxpositionid[0]['MAX(Position_ID)']+1;
        for($i=0;$i<$count;$i++){
            $k=strval($i);
            // echo $k;
            if(isset($_POST[$k]))
                $pn = $_POST[$k];
            else{
                $maxpositionid -= 1;
                continue;
            }
            $pid=$maxpositionid+$i;
            // echo $pid;
            // echo $pn;
            $query = "INSERT INTO `Position`(`Position_ID`,`Position_Name`,`Ballot_ID`) VALUES ($pid,'$pn',$maxballot);";
            $result = mysqli_query($conn,$query);
            }
        }
    }
?>