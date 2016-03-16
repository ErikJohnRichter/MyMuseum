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
    dir('There was a problem when trying to connect to the host. Please contact Tech Support. Error: ' . mysql_error());    
}

$db_selected = mysql_select_db($dbname, $link);

if (!$link) {
    dir('There was a problem when trying to connect to the database. Please contact Tech Support. Error: ' . mysql_error());    
}

$Title = $_POST['Title'];
$About = $_POST['About'];
//$Photo = addslashes(file_get_contents($_FILES['Photo']['tmp_name']));


$file=$_FILES['Photo']['tmp_name'];
$fname=$_FILES['Photo']['name'];
     
  $size = getimagesize($file);
  $width = $size[0];
  $height = $size[1];
  $ratio =  $height/$width;
  $maxWidth = 600;
  $newHeight = $maxWidth*$ratio;

  if (strpos($fname,'.jpg')>0) $im=ImageCreateFromJPEG($file);
  elseif (strpos($fname,'.gif')>0) $im=ImageCreateFromGIF($file);
  elseif (strpos($fname,'.png')>0) $im=ImageCreateFromPNG($file);
  else echo "False";
  
  $thumb = ImageCreateTrueColor($maxWidth, $newHeight);  
  ImageCopyResampled ($thumb, $im, 0, 0, 0, 0, $maxWidth, $newHeight, $width, $height);
  
  if (strpos($fname,'.jpg')>0) imagejpeg($thumb,$fname);
  elseif (strpos($fname,'.gif')>0) imagegif($thumb,$fname);
  elseif (strpos($fname,'.png')>0) imagepng($thumb,$fname); 

  $newImage = addslashes(file_get_contents($fname)); 
  
  //$url = $fname;
  //echo '<img src="'.$fname.'"></img>';
$sql = "INSERT INTO Museum (Title,About,Photo,userNumber) VALUES ('$Title', '$About', '$newImage','".$_SESSION['userid']."')";
echo '<div class="col-lg-12 edit">';
echo '<h3>'.$Title.' has been added to your Museum!</h3>';
echo '<br>';
echo '<FORM METHOD="LINK" ACTION="private.php">
<INPUT TYPE="submit" class="btn btn-primary" VALUE="Return to your Exhibit">
</FORM>';
echo '</div>';

if (!mysql_query($sql)) {
    die('Error: ' . mysql_error()); 
}

?>
</body>
</html>
 
