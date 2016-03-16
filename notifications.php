<?php

require("common.php"); 
     
   
    if(empty($_SESSION['user'])) 
    { 
        
        header("Location: index.php"); 
         
        
        die("Redirecting to index.php"); 
    } 

$query = " 
        SELECT 
            id, 
            username, 
             
            isFriendsWith
            
        FROM users 
    "; 
$link = mysql_connect($host, $username, $password);
mysql_select_db($dbname);
$myUsername = $_SESSION['user']['username'];
$sql = "SELECT `requestsFrom` FROM mymuseum.`friendrequest-".$myUsername."`";
$result3 = mysql_query("$sql");

$friendRequestsFrom = array();
while ($row = mysql_fetch_assoc($result3)) {
    $friendRequestsFrom[] = $row['requestsFrom'];
}

$link = mysql_connect($host, $username, $password);
mysql_select_db($dbname);
$sql = "SELECT COUNT(requestsFrom) FROM mymuseum.`friendrequest-".$myUsername."`";
$notifyCount = mysql_query("$sql");


     
    try 
    { 
        // These two statements run the query against your database table. 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    { 
        // Note: On a production website, you should not output $ex->getMessage(). 
        // It may provide an attacker with helpful information about your code.  
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
    // Finally, we can retrieve all of the found rows into an array using fetchAll 
    $rows = $stmt->fetchAll(); 
    

$count = mysql_fetch_row($notifyCount);

if ($count[0] != 0) {
echo'<td class="dropdown">
    <!-- Drop down menu -->
    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-exclamation-circle"></i><span class="label label-danger label-as-badge">'.$count[0].'</span></a>
    <div class="dropdown-menu" style="padding: 15px 15px 0px; width: 200px;">
            <table>';
                foreach($rows as $row):
                    $myId = $_SESSION['userid'];
                    if (in_array($row['id'], $friendRequestsFrom)) {
                    echo'<form action="acceptFriends.php" method="post"/>';
                    echo'<tr>';
                    echo'<td>'.$row['username'].'</td>';
                    echo'<td>&nbsp;</td>
                         <td>&nbsp;</td>';
                    echo'<td>
                        <input type="hidden" name="id" value="'.$row['id'].'"/>
                    </td>
                    <td>
                        <input type="hidden" name="user-Name" value="'.$row['username'].'"/>
                    </td>';
                    echo'<td>
                        <input type="submit" class="btn btn-sm btn-warning btn-file" value="Give Ticket">
                    </td>';
                    echo'</tr>';
                    echo'<tr><td>&nbsp;</td></tr>';
                    echo'</form>';
                    }
                endforeach;
                    }
                else {
                    echo'<td class="dropdown">
                    <!-- Drop down menu -->
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-exclamation-circle"></i></a>
                    <div class="dropdown-menu" style="padding: 15px; width: 200px;">
                            <table>';
                    echo'<td>You have no notifications</td>';
                }
            
                
            echo'</table>  
    </div>        
</td>';

?>