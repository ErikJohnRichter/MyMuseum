<?php ini_set('memory_limit', '-1');?>
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
require("common.php"); 

$link = mysql_connect($host, $username, $password);

if (!$link) {
  echo '<div class="text-center">Sorry, there was an error connecting to the host. Please try again.</div>';
    /*die('Error: ' . mysql_error()); */
    /*dir('There was a problem when trying to connect to the host. Please contact Tech Support. Error: ' . mysql_error()); */   
}

$db_selected = mysql_select_db($dbname, $link);

if (!$link) {
  echo '<div class="text-center">Sorry, there was an error trying to connect to the database. Please try again.</div>';
    
    /*dir('There was a problem when trying to connect to the database. Please contact Tech Support. Error: ' . mysql_error()); */   
}

$id = $_POST['id'];
$About = nl2br(htmlspecialchars($_POST['About'], ENT_QUOTES));
$Title = nl2br(htmlspecialchars($_POST['Title'], ENT_QUOTES));



$file=$_FILES['Photo']['tmp_name'];
$fname=$_FILES['Photo']['name'];
     
  $exif = exif_read_data($file); 


  if (strpos($fname,'.jpg')>0) $im=ImageCreateFromJPEG($file);
  elseif (strpos($fname,'.jpeg')>0) $im=ImageCreateFromJPEG($file);
  elseif (strpos($fname,'.gif')>0) $im=ImageCreateFromGIF($file);
  elseif (strpos($fname,'.png')>0) $im=ImageCreateFromPNG($file);
  else echo " ";

  if(!empty($exif['Orientation'])) {
    switch($exif['Orientation']) {
        case 8:
            $file2 = imagerotate($im,90,0);
            $size = getimagesize($file);
            $width = $size[1];
            $height = $size[0];
            $ratio =  $height/$width;
            $maxWidth = 600;
            $newHeight = $maxWidth*$ratio;
            break;
        case 3:
            $file2 = imagerotate($im,180,0);
            $size = getimagesize($file);
            $width = $size[0];
            $height = $size[1];
            $ratio =  $height/$width;
            $maxWidth = 600;
            $newHeight = $maxWidth*$ratio;
            break;
        case 6:
            $file2 = imagerotate($im,-90,0);
            $size = getimagesize($file);
            $width = $size[1];
            $height = $size[0];
            $ratio =  $height/$width;
            $maxWidth = 600;
            $newHeight = $maxWidth*$ratio;
            break;
    }
  }
  else {
    $file2 = imagerotate($im,0,0);
    $size = getimagesize($file);
    $width = $size[0];
    $height = $size[1];
    $ratio =  $height/$width;
    $maxWidth = 600;
    $newHeight = $maxWidth*$ratio;
  }
  
  $thumb = ImageCreateTrueColor($maxWidth, $newHeight);  
  ImageCopyResampled ($thumb, $file2, 0, 0, 0, 0, $maxWidth, $newHeight, $width, $height);
  
  if (strpos($fname,'.jpg')>0) imagejpeg($thumb,$fname);
  elseif (strpos($fname,'.jpeg')>0) imagejpeg($thumb,$fname);
  elseif (strpos($fname,'.gif')>0) imagegif($thumb,$fname);
  elseif (strpos($fname,'.png')>0) imagepng($thumb,$fname); 

  $newImage = addslashes(file_get_contents($fname)); 


if ($fname != NULL) {
    if ($newImage != NULL) {
        $sql = "UPDATE mymuseum.Museum SET Title='$Title', About='$About', Photo='$newImage', date_time=now() WHERE id=$id";
        echo '<div class="col-lg-12 edit">';
        
        if ($Title != NULL) {
            echo '<h3>'.$Title.' has been edited in your Museum!</h3>';
        }
        else {
            echo '<h3>This article has been edited in your Museum!</h3>';
        }
        
        echo '<br>';
        echo '<br>';
        echo '<FORM METHOD="LINK" ACTION="private.php">
        <INPUT TYPE="submit" class="btn btn-primary" VALUE="Return to your Exhibit">
        </FORM>';
        echo '</div>';
    }
    else {
        echo '<div class="col-lg-12 edit">';
        echo '<h3>We are SO sorry!</h3><br><p>Either there is no picture attached or the picture format you have selected does not upload properly (<a href="help.php">See Release Notes</a>).<br>Please try selecting/taking a new picture and uploading again.</p>';
        echo '<br>';
        echo '<br>';
        echo '<button class="btn btn-primary" onclick="goBack()">Go Back</button>';

?>
        <script>
          function goBack() {
            window.history.back();
          }
        </script>
<?php
        
    }
}
else {
    $sql = "UPDATE mymuseum.Museum SET Title='$Title', About='$About', date_time=now() WHERE id=$id";
    echo '<div class="col-lg-12 edit">';
    if ($Title != NULL) {
        echo '<h3>'.$Title.' has been edited in your Museum!</h3>';
    }
    else {
        echo '<h3>This article has been edited in your Museum!</h3>';
    }
    echo '<br>';
    echo '<br>';
    echo '<FORM METHOD="LINK" ACTION="private.php">
    <INPUT TYPE="submit" class="btn btn-primary" VALUE="Return to your Exhibit">
    </FORM>';
    echo '</div>';
}


if (!mysql_query($sql)) {
    die(" ");
    
    /*die('Error: ' . mysql_error()); */
}

?>

</body>
</html>