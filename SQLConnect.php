<?php
require("common.php");


// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    
    die("Sorry, there was an error. Please try again.");
} 

$sql = "SELECT Title, About FROM Museum WHERE userNumber='".$_SESSION['userid']."' ";
$result = $conn->query($sql);

/*if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<p>Title: " . $row["Title"]. " - About: " . $row["About"]. "</p>";
    }
} else {
    echo "0 results";
}*/
$conn->close();


$link = mysql_connect($host, $username, $password);
mysql_select_db($dbname);
$sql = "SELECT * FROM Museum WHERE userNumber='".$_SESSION['userid']."' ";
$result = mysql_query("$sql");

echo '<div class="grid" id="grid">';
$count = 0;
while($row = mysql_fetch_assoc($result)) {
    echo '<a href="#exhibitModal'.$count.'" class="exhibit-link" data-toggle="modal">';
    echo '<div class="item grow"><img src="data:image/jpeg;base64,'. base64_encode($row['Photo']) .'" /></div>';
    echo '</a>';
    echo '<div class="exhibit-modal modal fade" id="exhibitModal'.$count.'" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-content">

        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>'.$row["Title"].'</h2>
                        <img class="img-responsive" src="data:image/jpeg;base64,'. base64_encode($row['Photo']) .'" alt="Picture" />
                        <p style="font-family: sans-serif;">'.$row["About"].'</p>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Back to Exhibit</button>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                 
               <div>
                    <table align="center">
                        <tr>
                            <td>
                                <form action="SQLEdit.php" method="post" enctype="multipart/form-data"/>                  
                                    <input type="hidden" name="id" value="'.$row["id"].'"/>
                                    <input type="hidden" name="id2" value="'.$row["Title"].'"/>
                                    <input type="hidden" name="id3" value="'.$row["About"].'"/>
                                    <input type="hidden" name="id4" value="'.base64_encode($row["Photo"]).'"/>
                                    <input type="submit" class="btn btn-success btn-sm" value="Edit Artifact">
                                </form>
                            </td>
                        
                            <td>&nbsp;</td>
                        
                            <td>
                                <form action="SQLDeleteConfirm.php" method="post" enctype="multipart/form-data"/>                  
                                    <input type="hidden" name="id" value="'.$row["id"].'"/>
                                    <input type="hidden" name="id2" value="'.$row["Title"].'"/>
                                    <input type="submit" class="btn btn-danger btn-sm delete" value="Delete Artifact">
                                </form>
                            </td>
                        </tr>
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>';
$count++;
}
echo '</div>';
if ($count == 0){
    echo '<div class="text-center mainPc">
           
            <img class="cta" src="assets/clickCurate.png"/>
            <br>
            <br>
            <br>
            <br>
            
            <p style="font-size: 36px;">Looks like you just built your museum!</p>
          
            <p>We just finished sweeping the dust off your floor!</c>
              <br>  <br>
            <p>Click "Curate" above to start adding artifacts,<br>or visit the Public Museum for some inspiration!</p>
            <p>You may also click "Find Museums" to request tickets<br>to visit your friends\' museums!</p>
            <br>
            <p>Hope you enjoy!</p>
            <br>
            <br>
            <br>
            
            <br>
            </div>';
    echo '<div class="text-center mobile">
           
            <img class="cta" src="assets/clickCurateMobile.png"/>
            <br>
            <br>
            <br>
            <p style="font-size: 28px;">Welcome!</p>
           
            <p>Click "+" above to start<br>curating your new museum,<br>or use your ticket to visit<br>the Public Museum for<br>some inspiration!</p>
            <p>You may also click the<br>magnifying glass to search<br>for friends\' museums and<br>request tickets!</p>
            <br>
            <br>
            
            
            

            </div>';
        }
            

mysql_close($link);
?>