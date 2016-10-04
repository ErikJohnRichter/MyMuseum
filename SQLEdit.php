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
$Artifact = strip_tags(htmlspecialchars_decode($_POST['id2'], ENT_QUOTES));
$About = strip_tags(htmlspecialchars_decode($_POST['id3'], ENT_QUOTES));
$photo = $_POST['id4'];
echo '<div class="container">
    <div class="text-center">
        <h3>'.$Artifact.'</h3>
    </div>
    
        
        <br>
        <br>

        <div class="col-md-8 col-md-offset-4">
        <img style="max-width: 150px;" src="data:image/jpeg;base64,'. $photo .'" alt="Picture" />
        <br>
        <br>
        <form action="edit_artifact.php" method="post" enctype="multipart/form-data"/>
            <table>
                <tr>
                    <td><span class="btn btn-default btn-file btn-info">Get New Photo<input type="file" name="Photo" id="files" accept="image/*" /> </span> (optional)
                                                <output id="list"></output>'; ?>

                                                <script>
                                                  function handleFileSelect(evt) {
                                                    var files = evt.target.files; // FileList object

                                                    // files is a FileList of File objects. List some properties.
                                                    var output = [];
                                                    for (var i = 0, f; f = files[i]; i++) {
                                                      output.push('<li><strong>Image Attached</strong> ',
                                                                  '</li>');
                                                    }
                                                    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
                                                  }

                                                  document.getElementById('files').addEventListener('change', handleFileSelect, false);
                                                </script>
                                                <?php
                                                echo '</td>
                                                
                </tr>
                <tr>
                    <td><input type="text" id="Title" class="form-control" size="35" name="Title" Value="'.$Artifact.'" style="margin-bottom: 5px;" /></td>
                </tr>
                <tr>
                    <td><textarea type="text" rows="10" class="form-control" id="About" name="About" style="margin-bottom: 5px;" />'.$About.'</textarea></td>
                    <input type="hidden" name="id" id="id" value="'.$id.'"/>
                </tr>
                
                <td>&nbsp;</td>

                <tr>
                    <td><input type="submit" class="btn btn-success btn-file" value="Save Edit" onclick="this.disabled=true;this.form.submit();"></td>
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