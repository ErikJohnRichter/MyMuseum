<?php 

    require("common.php"); 
     
    if(empty($_SESSION['user'])) 
    { 
        header("Location: login.php"); 
         
        die("Redirecting to login.php"); 
    } 
     
    if(!empty($_POST)) 
    { 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            die("Invalid E-Mail Address"); 
        } 
         
       
        if($_POST['email'] != $_SESSION['user']['email']) 
        { 
            $query = " 
                SELECT 
                    1 
                FROM users 
                WHERE 
                    email = :email 
            "; 
             
            $query_params = array( 
                ':email' => $_POST['email'] 
            ); 
             
            try 
            { 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            { 
        
                die("Sorry, there was an error. Please try again.");
            } 
             
            $row = $stmt->fetch(); 
            if($row) 
            { 
                die("This E-Mail address is already in use"); 
            } 
        } 
         
        if(!empty($_POST['password'])) 
        { 
            $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
            $password = hash('sha256', $_POST['password'] . $salt); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $password = hash('sha256', $password . $salt); 
            } 
        } 
        else 
        { 
            $password = null; 
            $salt = null; 
        } 
         
        $query_params = array( 
            /*':username' => $_POST['username'],*/
            ':email' => $_POST['email'], 
            ':user_id' => $_SESSION['user']['id'], 
        ); 
         
        if($password !== null) 
        { 
            $query_params[':password'] = $password; 
            $query_params[':salt'] = $salt; 
        } 
         
    
        $query = " 
            UPDATE users 
            SET 
                email = :email
                
        "; 
         
        if($password !== null) 
        { 
            $query .= " 
                , password = :password 
                , salt = :salt 
            "; 
        } 
         
        $query .= " 
            WHERE 
                id = :user_id 
        "; 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: Please click Back Button"); 
        } 
         
        $_SESSION['user']['email'] = $_POST['email']; 
         
        header("Location: index.php"); 
         
        die("Redirecting to index.php"); 
    } 
     
?> 

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>My Museum</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="shortcut icon" href="assets/myIcon.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/myIcon.png" />


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body style="background-color: #efefef;">
    <div id="page-loader"><span class="page-loader-gif">Loading...</span></div>

<nav class="navbar navbar-default navbar-fixed-top mainPc" style="border-color: darkgrey;">
    <div class="container">
        <div class="two" style="margin-top: -8px;">
            <table>
                <tr>
                    <td><h4><img src="assets/myIcon7.png" style="margin: 3px 3px; width: 55px; height 55px; padding-top:5px; padding-right:6px;"></h4></td>
                    <td><h4><span style="font-size: 35px;">mymuseum</span></h4></td>
                </tr>
            </table>
        </div>
        
        <div class="navbar-inner form-group">
            <div class="container"><!-- Collapsable nav bar -->
                <div class="one">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"></a>
                <!-- Start of the nav bar content -->
                <div class="nav-collapse"><!-- Other nav bar content -->
                    <table>
                        <tr class="nav">
                            
                            <td>
                                <form action="private.php">
                                <td><input type="submit" class="btn btn-default btn-file" value="Back to My Museum"></td>
                            </form>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>

                            <?php include 'visitFriendsDropdown.php';?>
                           
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>

                            <td class="dropdown">
                                <!-- Drop down menu -->
                                <a class="dropdown-toggle btn btn-default btn-file" href="#" data-toggle="dropdown">Curate <strong class="caret"></strong></a>
                                <div class="dropdown-menu" style="padding: 15px; width: 200px;">
                                    <form action="SQLWrite.php" method="post" enctype="multipart/form-data"/>
                                        <table>
                                            <tr>
                                                <td><input type="text" id="Title" class="form-control" name="Title" placeholder="Artifact Name" style="margin-bottom: 5px;" /></td>
                                            </tr>
                                            <tr>
                                                <td><textarea type="text" rows="10" class="form-control" name="About" placeholder="About" style="margin-bottom: 5px;" /></textarea></td>
                                            </tr>
                                            <tr>
                                                <td><span class="btn btn-default btn-file btn-info">Get Photo<input name="Photo" id="files" accept="image/jpeg" type="file" /></span>
                                                <output id="list"></output>

                                                <script>
                                                  function handleFileSelect(evt) {
                                                    var files = evt.target.files; // FileList object

                                                    // files is a FileList of File objects. List some properties.
                                                    var output = [];
                                                    for (var i = 0, f; f = files[i]; i++) {
                                                      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ')',
                                                                  '</li>');
                                                    }
                                                    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
                                                  }

                                                  document.getElementById('files').addEventListener('change', handleFileSelect, false);
                                                </script>
                                                </td>
                                            </tr>
                                            
                                            <td>&nbsp;</td>

                                            <tr>
                                                <td><input type="submit" class="btn btn-default btn-success btn-file" value="Add"></td>
                                            </tr>
                                        </table>  
                                    </form>
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
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-cog"></i></a>
                                <div class="dropdown-menu dropdown-menu-right" style="padding: 15px;">
                                        <table align="center">
                                            <tr>
                                                <td><a href="edit_account.php">Edit Account</a><br /></td>
                                            </tr>
                                        </table>
                                        
                                </div>        
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>|</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                                <?php include 'notifications.php';?>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
        </div>
        
        <!--<div class="form-group one">
            <table>
                <br>
                <tr>
                    <form action="SQLWrite.php" method="post" enctype="multipart/form-data"/>        
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="text" id="Title" class="form-control" name="Title" placeholder="Artifact Name" /></td>
                        <td>&nbsp;</td>
                        <td><textarea type="text" rows="1" class="form-control" name="About" placeholder="About" /></textarea></td>
                        <td>&nbsp;</td>
                        <td><span class="btn btn-default btn-file">Get Photo<input name="Photo" accept="image/jpeg" type="file" /></span></td>
                        <td>&nbsp;</td>
                        <td><input type="submit" class="btn btn-default btn-file" value="Add"></td>
                        <td>&nbsp;</td>
                        <td>| |</td>
                        <td>&nbsp;</td>
                            
                    </form>
                    <form action="logout.php">
                        <td><input type="submit" class="btn btn-default btn-file" value="Logout"></td>
                    </form>
                </tr>
            </table>
        </div>-->
    </div>
</nav>

<nav class="navbar navbar-default navbar-fixed-top mainMobile">
    
    <div class="container">

        <div class="text-center">
           <table align="center">
                <tr>
                    <td><h4>my museum</h4></td>
                    <?php include 'notifications.php';?>
                </tr>
            </table>
                
        <br>
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
                <div class="col-xs-3"><a href="visitFriendsDropdownMobile.php" style="color: grey;"><i class="fa fa-ticket fa-2x"></i></a></div>
                <div class="col-xs-3"><a href="accountSettingsMobile.php" style="color: red;"><i class="fa fa-gear fa-2x"></i></a></div>
            </div>
        </div>   
    </div>
</nav>

<br class="mainPc">

<!--Shell editable inside these lines-->


<div class="container">
<div class="text-center">
<br>
<h4>your info</h4> 
</div>
<div class="container">
<div class="form-group col-md-12 col-md-offset-4">
<br>
<br> 
<form action="edit_credentials.php" method="post"> 
    Username:<b> <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></b><br /> 
    <!--<input type="text" name="username" value="<?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>" /> -->
    <br />
    E-Mail Address:<br /> 
    <input type="text" name="email" value="<?php echo htmlentities($_SESSION['user']['email'], ENT_QUOTES, 'UTF-8'); ?>" /> 
    <br /><br /> 
    Password:<br /> 
    <input type="password" name="password" value="" /><br /> 
    <i>(leave blank if you do not want to change your password)</i> 
    <br /><br /> 
    <input type="submit" class="btn btn-success" value="Update Account" /> 
</form>
<br>
<FORM METHOD="LINK" ACTION="edit_account.php">
<INPUT TYPE="submit" class="btn btn-primary" VALUE="Sorry, go back">
</FORM>
</div>
</div>
<br>
<br>
<br>
<br>
</div>


<!--Shell editable inside these lines-->


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