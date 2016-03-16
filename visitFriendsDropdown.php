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
             
            isFriendsWith,
            friendRequestFrom
        FROM users 
    "; 
     
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
    

$link = mysql_connect($host, $username, $password);
mysql_select_db($dbname);
$myUsername = $_SESSION['user']['username'];
$sql = "SELECT `friends` FROM mymuseum.`friends-".$myUsername."`";
$result1 = mysql_query("$sql");

$friends = array();
while ($row = mysql_fetch_assoc($result1)) {
    $friends[] = $row['friends'];
}

$link = mysql_connect($host, $username, $password);
mysql_select_db($dbname);
$sql = "SELECT COUNT(friends) FROM mymuseum.`friends-".$myUsername."`";
$friendTotal = mysql_query("$sql");

$friendCount = mysql_fetch_row($friendTotal);

if ($friendCount[0] != 0) {
echo'<td class="dropdown">
    <!-- Drop down menu -->
    <a class="dropdown-toggle btn btn-default btn-file" href="#" data-toggle="dropdown">Visit Museums <strong class="caret"></strong></a>
    <div class="dropdown-menu" style="padding: 15px 15px 0px; width: 200px;">
        <table>';
            foreach($rows as $row):
                $myId = $_SESSION['userid'];
                if (in_array($row['id'], $friends)) {
                    echo'<form action="visitFriends.php" method="post"/>';
                    echo'<tr>';

                    echo'<td>'.$row['username'].'</td>';
                    echo'<td>&nbsp;</td>
                         <td>&nbsp;</td>';
                    echo'<td>
                        <input type="hidden" name="id" value="'.$row['id'].'"/>
                    </td>
                    <td>
                        <input type="hidden" name="userName" value="'.$row['username'].'"/>
                    </td>';
                    
                    echo'<td>
                        <input type="submit" class="btn btn-sm btn-success btn-file" value="Visit">
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
                <a class="dropdown-toggle btn btn-default btn-file" href="#" data-toggle="dropdown">Visit Museums <strong class="caret"></strong></a>
                <div class="dropdown-menu" style="padding: 15px; width: 170px;">
                    <table>';
                echo'<tr>
                <a class="btn btn-sml btn-success btn-file" href="memberlist.php">Request Tickets</a>
                </tr>';
            }
            echo'</table>  
                </div>        
            </td>';

/*<tr>
    <td><input type="text" id="Friend" class="form-control" name="Friend" placeholder="Username" /></td>
    <td>&nbsp;</td>
    <td><input type="submit" class="btn btn-default btn-file" value="Visit"></td>                                              
</tr>*/
?>