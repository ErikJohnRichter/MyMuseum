//read EXIF header from uploaded file
$exif = exif_read_data($file);

//fix the Orientation if EXIF data exist
if(!empty($exif['Orientation'])) {
    switch($exif['Orientation']) {
        case 8:
        echo '1';
            $file = imagerotate($file,90,0);
            break;
        case 3:
        echo '2';
            $file = imagerotate($file,180,0);
            break;
        case 6:
        echo '3';
            $file = imagerotate($file,-90,0);
            break;
    }
}



<br>
<p>By using this site, you accept that, at anytime, MyMuseum may discontinue its service. If that happens, you will no longer have
    access to the app or your's or your friends' museums. You will receive notice, by email, not less than 30 days prior to this
    happening, if it ever does. Additionally, until out of beta release, this app may contain bugs contrary to expected performance.
    By using this site, you are aware of this and acknowledge these bugs may affect your user-experience.<p>

Fatal error: Allowed memory size of 67108864 bytes exhausted (tried to allocate 9792 bytes) in /home/erikrichter/public_html/mymuseum/SQLWrite.php on line 113

[01-Apr-2016 17:37:08 UTC] PHP Fatal error:  Allowed memory size of 67108864 bytes exhausted (tried to allocate 9792 bytes) in /home/erikrichter/public_html/mymuseum/SQLWrite.php on line 113