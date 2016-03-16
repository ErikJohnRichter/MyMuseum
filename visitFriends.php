<?php 

    require("common.php"); 
     
   
    if(empty($_SESSION['user'])) 
    { 
        
        header("Location: login.php"); 
         
        
        die("Redirecting to login.php"); 
    } 
     
    
?> 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
    echo '<title>'.$_POST['userName'].'s Museum</title>'
    ?>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="shortcut icon" href="assets/myIcon.png">


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <?php
        $userName = $_POST['userName'];
        $userName = strtolower ( $userName );
        echo '<div class="two">
            <table>
                <tr>
                    <td><h4>'.$userName.'&#39;s museum</h4></td>
                </tr>
            </table>
        </div>'
        ?>
        <div class="navbar-inner form-group">
            <div class="container"><!-- Collapsable nav bar -->
                <div class="one">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"></a>
                <!-- Start of the nav bar content -->
                <div class="nav-collapse"><!-- Other nav bar content -->
                    <table>
                        <tr class="nav">
                            
                            
                            <form action="private.php">
                                <td><input type="submit" class="btn btn-default btn-file" value="Back to My Museum"></td>
                            </form>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td> Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>!</td>
                            <td>&nbsp;</td>
                            <form action="logout.php">
                                <td><input type="submit" class="btn btn-default btn-file" value="Logout"></td>
                            </form>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td class="dropdown">
                                <!-- Drop down menu -->
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="padding: 15px; width: 50px;">
                                        <table>
                                            <tr>
                                                <td><a href="edit_account.php">Edit Account</a><br /></td>
                                            </tr>
                                        </table>  
                                </div>        
                            </td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<br>
<div class="grid-container">
<?php
require("common.php");



$link = mysql_connect($host, $username, $password);
mysql_select_db($dbname);

/*$sql = "SELECT * FROM users WHERE id='".$_POST['id']."'";
$list = mysql_query($sql) or die (mysql_error()); 
$lst = mysql_fetch_array($list); 
$FriendID = $lst[0];
mysql_free_result($list);

if ($FriendID != null){*/

$sql = "SELECT * FROM Museum WHERE userNumber='".$_POST['id']."'";
$result = mysql_query("$sql");

echo '<div class="grid" id="grid">';
$count = 0;
while($row = mysql_fetch_assoc($result)) {
    echo '<a href="#exhibitModal'.$count.'" class="exhibit-link" data-toggle="modal">';
    echo '<div class="item grow"><img src="data:image/jpeg;base64,'. base64_encode($row['Photo']) .'" /></div>';
    echo '</a>';
    echo '<div class="exhibit-modal modal fade" id="exhibitModal'.$count.'" tabindex="-1" role="dialog" aria-hidden="true" style="padding-left: 0;">
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
                        <p>'.$row["About"].'</p>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Back to Exhibit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
$count++;
}
echo '</div>';
/*}
else {
    echo '<div class="container">
            <div class="col-md-8 col-md-offset-4">
            <h3>Sorry, there is no friend with that name. Please search again.</h3>
            </div>
            </div>';
}*/
mysql_close($link);
?>
</div>
</body>
</html>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.3.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/main.js"></script>
    <script src="js/masonry-docs.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/sweetalert.min.js"></script>


    <script>
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });
  </script>

</body>

</html> 
