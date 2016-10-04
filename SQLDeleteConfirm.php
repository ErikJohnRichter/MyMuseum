<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Mini Museum</title>

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
$artifact = strip_tags(htmlspecialchars_decode($_POST['id2'], ENT_QUOTES));

echo '<div class="col-lg-12 edit">';
if ($artifact != NULL) {
    echo '<h3>Are you sure you want to delete '.$artifact.'?</h3>';
}
else {
    echo '<h3>Are you sure you want to delete this?</h3>';
}
echo '<br><br>';

echo '<div class="container">
                    <div class="row">
                         
                       
                            
                                        <form action="private.php" method="post" enctype="multipart/form-data"/>                  
                                            <input type="submit" class="btn btn-success" value="No! Go Back!">
                                        </form>
                                    
                                        <form action="SQLDelete.php" method="post" enctype="multipart/form-data"/>                  
                                            <input type="hidden" name="id" value="'.$id.'"/>
                                            <input type="hidden" name="id2" value="'.$artifact.'"/>
                                            <input type="submit" class="btn btn-danger delete" value="Delete Artifact">
                                        </form>
                                
                        
                    </div>
                </div>';
echo '</div>';

?>
</body>
</html>