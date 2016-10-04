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

    <link rel="shortcut icon" href="assets/myIcon.png">


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>

</head>
<body>
<?php
$id = $_POST['id'];
$UserName = $_POST['user-Name'];
$myUserId = $_SESSION['userid'];

echo '<div class="col-lg-12 edit">';
echo '<h3>Are you sure you want to give up your ticket to '.$UserName.'&#39;s museum?<br><br>Doing so will also deny '.$UserName.' access to your&#39;s</h3>';
echo '<br><br><br>';

echo '<div class="container">
                    <div class="row">
                         
                        
                            
                                        <form action="visitFriends.php" method="post" enctype="multipart/form-data"/> 
                                            <input type="hidden" name="id" value="'.$id.'"/>
                                            <input type="hidden" name="userName" value="'.$UserName.'"/>                 
                                            <input type="submit" class="btn btn-success" style="width: 150px;" value="No! Go Back!">
                                        </form>
                                        
                                        <form action="deleteFriends.php" method="post" enctype="multipart/form-data"/>                  
                                            <input type="hidden" name="id" value="'.$id.'"/>
                                            <input type="hidden" name="user-Name" value="'.$UserName.'"/>
                                            <input type="submit" class="btn btn-danger delete" style="width: 150px;" value="Yes">
                                        </form>
                                
                        
                    </div>
                </div>';
echo '</div> <br><br><br>';

?>
</body>
</html>