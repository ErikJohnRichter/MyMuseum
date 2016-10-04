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
    if ($_POST['id'] == 51) {
        echo '<title>'.$_POST['userName'].' Museum</title>';
    }
    else {
        echo '<title>'.$_POST['userName'].'&#39;s Museum</title>';
    }
    ?>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="shortcut icon" href="assets/myIcon6.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/myIcon6.png" />


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>

</head>

<body>
    <div id="page-loader"><span class="page-loader-gif">Loading...</span></div>

<nav class="navbar navbar-default navbar-fixed-top mainPc">
    <div class="container">
        <?php
        $userName = $_POST['userName'];
        $userNameLower = strtolower ( $userName );
        $id = $_POST['id'];
        echo '<div class="two">
            <table>
                <tr>';
                if ($id == 51) { /*51 in QA*/
                    echo '<td><h4>'.$userNameLower.' museum</h4></td>';
                }
                else {
                    echo '<td><h4>'.$userNameLower.'&#39;s museum</h4></td>';
                }
                echo '</tr>
            </table>
        </div>';
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
                            <td class="dropdown">
                                <!-- Drop down menu -->
                                <a class="dropdown-toggle btn btn-default btn-file" href="#" data-toggle="dropdown">About this museum <strong class="caret"></strong></a>
                                <div class="dropdown-menu dropdown-menu-right" style="padding: 15px; width: 50px;">
                                        <table>
                                            <tr>
                                                <td>
                                                    <?php
                                           
                                                        $link = mysql_connect($host, $username, $password);
                                                        mysql_select_db($dbname);

                                                        $sql1 = "SELECT * FROM mymuseum.`profile-".$userName."` WHERE id=1";
                                                        $result2 = mysql_query("$sql1");
                                                        while($row2 = mysql_fetch_assoc($result2)) {
                                                            $bio = $row2['museum'];
                                                            if ($bio == "" || $bio == " ") {
                                                                echo 'This museum doesn\'t have a description yet';
                                                            }
                                                            else {
                                                                echo $bio;
                                                            }
                                                        }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>  
                                </div>        
                            </td>
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
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-ticket"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="padding: 15px; width: 50px;">
                                        <table align="center">
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo '<form action="deleteFriendsConfirm.php" method="post" enctype="multipart/form-data"/>                  
                                                        <input type="hidden" name="id" value="'.$id.'"/>
                                                        <input type="hidden" name="user-Name" value="'.$userName.'"/>
                                                        <input type="submit" class="btn btn-danger btn-sm delete" value="Give Up Ticket">
                                                    </form>';
                                                    ?>
                                                </td>
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

<nav class="navbar navbar-default navbar-fixed-top mainMobile">
    
    <div class="container">

        <div class="text-center">
            <?php
            $userName = $_POST['userName'];
            $userName = strtolower ( $userName );
            $id = $_POST['id'];
           echo '<table align="center">
                <tr>
                    <td><h4>'.$userName.'</h4></td>
                    
                </tr>
            </table>
                
        <div class="one">
            <table>
                <tr>
                    <td class="dropdown">
                        <!-- Drop down menu -->
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown" style="color: lightgrey;"><i class="fa fa-plus"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" style="padding: 15px; width: 100px;">
                            
                                <table align="center">
                                <tr>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm delete" data-toggle="modal" data-target="#aboutMuseum" style="width: 110px;">About</button>
                                            
                                            </td>
                                            </tr>
                                    </table>
                                    <br>
                                    <table align="center">
                                    <tr>
                                    <td>
                                            <form action="deleteFriendsConfirm.php" method="post" enctype="multipart/form-data"/>                  
                                                <input type="hidden" name="id" value="'.$id.'"/>
                                                <input type="hidden" name="user-Name" value="'.$userName.'"/>
                                                <input type="submit" class="btn btn-danger btn-sm delete" style="width: 110px;" value="Give Up Ticket">
                                            </form>
                                            </td>
                                            </tr>
                                            </table>

                                        
                                  
                            
                        </div>        
                    </td>
        

                </tr>
            </table>
            ';
            ?>
        </div>
                    
        </div>
    </div>
        
    </div>


</nav>

<nav class="navbar navbar-default navbar-fixed-bottom mainMobile">
    <div class="nav navbar-nav" style="margin: 10px 5px;">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-3"><a href="private.php" style="color: grey;"><i class="fa fa-university fa-2x"></i></a></div>
                <div class="col-xs-3"><a href="memberlist.php" style="color: grey;"><i class="fa fa-search fa-2x"></i></a></div>
                <div class="col-xs-3"><a href="visitFriendsDropdownMobile.php" style="color: red;"><i class="fa fa-sign-in fa-2x"></i></a></div>
                <div class="col-xs-3"><a href="accountSettingsMobile.php" style="color: grey;"><i class="fa fa-gear fa-2x"></i></a></div>
            </div>
        </div>   
    </div>
</nav>

<div class="modal fade modal-center" id="aboutMuseum" role="dialog" >
                    <div class="modal-content" >
                        <div class="container">
                        <div class="modal-body">
                            <?php
                                           
                                                        $link2 = mysql_connect($host, $username, $password);
                                                        mysql_select_db($dbname);
                                                        $userName2 = $_POST['userName'];
                                                        $sql2 = "SELECT * FROM mymuseum.`profile-".$userName2."` WHERE id=1";
                                                        $result3 = mysql_query("$sql2");

                                                        while($row3 = mysql_fetch_assoc($result3)) {
                                                            $bio2 = $row3['museum'];
                                                            if ($bio2 == "" || $bio2 == NULL) {
                                                                echo 'This museum doesn\'t have a description yet';
                                                            }
                                                            else {
                                                                echo $bio;
                                                            }
                                                        }
                                                    ?>
                        </div>
                        <div class="text-center" style="padding-bottom: 10px;">
                            
                            <button type="button" class="btn btn-sm btn-default btn-primary" data-dismiss="modal" >Back</button>

                        </div>
                        </div>
                    </div>
                    </div>

<br class="mainPc">
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

$result2 = mysql_query("$sql");
$total = mysql_fetch_assoc($result2);

if ($total['Photo'] == NULL) {
        echo '<div class="text-center"><br><br><br><h3>'.$userNameLower.'&#39;s museum hasn\'t been curated yet.</h3></div>';
    }

echo '<div class="grid" id="grid">';
$count = 0;
while($row = mysql_fetch_assoc($result)) {
    echo '<a href="#exhibitModal'.$count.'" class="exhibit-link" data-toggle="modal">';
    echo '<div class="item grow"><img src="data:image/jpeg;base64,'. base64_encode($row['Photo']) .'" /></div>';
    echo '</a>';
    echo '<div class="exhibit-modal modal fade" id="exhibitModal'.$count.'" tabindex="-1" role="dialog" aria-hidden="true">
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
<br>
<br>
<br>
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
