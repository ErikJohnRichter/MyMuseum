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
$Artifact = $_POST['id2'];
echo '<div class="container">
    <div class="text-center">
        <h3>'.$Artifact.'</h3>
    </div>
    <div class="col-md-8 col-md-offset-4">
        
        <br>
        <br>
        <form action="edit_artifact.php" method="post" enctype="multipart/form-data"/>
            <table>
                <tr>
                    <td><input type="text" id="Title" class="form-control" size="35" name="Title" placeholder="New Name" style="margin-bottom: 5px;" /></td>
                </tr>
                <tr>
                    <td><textarea type="text" rows="10" class="form-control" id="About" name="About" placeholder="New Description" style="margin-bottom: 5px;" /></textarea></td>
                    <input type="hidden" name="id" id="id" value="'.$id.'"/>
                </tr>
                
                <td>&nbsp;</td>

                <tr>
                    <td><input type="submit" class="btn btn-default btn-file" value="Edit"></td>
                </tr>
            </table>  
        </form>
        <br>
        <br>
        <div class="container">
            <div class="row">
                <form action="private.php" method="post" enctype="multipart/form-data"/>                  
                    <input type="submit" class="btn btn-primary btn-sm" value="Back to Exhibit">
                </form>
            </div>
        </div>
    </div>
</div>';
?>
</body>
</html>