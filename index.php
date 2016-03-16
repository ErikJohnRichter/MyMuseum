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

    <link rel="shortcut icon" href="assets/myIcon.png">


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top mainPc">
    <div class="container">
        <div class="two">
            <table>
                <tr>
                    <td><h4>my museum</h4></td>
                </tr>
            </table>
            <br>
        </div>
        <?php 

        require("common.php"); 
         
        $submitted_username = ''; 
         
        if(!empty($_POST)) 
        { 
            $query = " 
                SELECT 
                    id, 
                    username, 
                    password, 
                    salt, 
                    email 
                FROM users 
                WHERE 
                    username = :username 
            "; 
             
            $query_params = array( 
                ':username' => $_POST['username'] 
            ); 
             
            try 
            { 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            { 
                die("Failed to run query: " . $ex->getMessage()); 
            } 
             
            $login_ok = false; 
             
            $row = $stmt->fetch(); 
            if($row) 
            { 
                $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
                for($round = 0; $round < 65536; $round++) 
                { 
                    $check_password = hash('sha256', $check_password . $row['salt']); 
                } 
                 
                if($check_password === $row['password']) 
                { 
                    $login_ok = true; 
                } 
            } 
             
            if($login_ok) 
            { 
                unset($row['salt']); 
                unset($row['password']); 
                 
                $_SESSION['user'] = $row;
                $_SESSION['userid'] = $row['id'];
            
                 
                header("Location: private.php"); 
                die("Redirecting to: private.php"); 
            } 
            else 
            { 
                print("Login Failed."); 
                
                $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
            } 
        } 
        echo '<div class="form-group one">
                <table>
                    <br>
                    <tr>
                        <form action="login.php" method="post"> 
                        <td><input type="text" name="username" placeholder=" Username" value="'.$submitted_username.'" /></td>' 
                        ?>
                        <td>&nbsp;&nbsp;</td>
                        <td><input type="password" placeholder=" Password" name="password" value="" /></td> 
                        <td>&nbsp;&nbsp;</td>
                        <td><input type="submit" class="btn btn-default btn-file" value="Login" />&nbsp;or&nbsp;</td>
                    </form>
                </div>
                    <td class="dropdown">
                                <!-- Drop down menu -->
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown" style="text-decoration: none;">Sign Up</a>
                                <div class="dropdown-menu dropdown-menu-right" style="padding: 15px; width: 200px;">
                                
                                <?php 

                                    require("common.php"); 
                                     
                                    if(!empty($_POST)) 
                                    { 
                                        if(empty($_POST['username'])) 
                                        { 
                                            die("Please enter a username."); 
                                        } 
                                         
                                        if(empty($_POST['password'])) 
                                        { 
                                            die("Please enter a password."); 
                                        } 
                                         
                                        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
                                        { 
                                            die("Invalid E-Mail Address"); 
                                        } 
                                         
                                        $query = " 
                                            SELECT 
                                                1 
                                            FROM users 
                                            WHERE 
                                                username = :username 
                                        "; 
                                       
                                        $query_params = array( 
                                            ':username' => $_POST['username'] 
                                        ); 
                                         
                                        try 
                                        { 
                                            $stmt = $db->prepare($query); 
                                            $result = $stmt->execute($query_params); 
                                        } 
                                        catch(PDOException $ex) 
                                        { 
                                            die("Failed to run query: " . $ex->getMessage()); 
                                        } 
                                         
                                        $row = $stmt->fetch(); 
                                         
                                        if($row) 
                                        { 
                                            die("This username is already in use"); 
                                        } 
                                         
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
                                            die("Failed to run query: " . $ex->getMessage()); 
                                        } 
                                         
                                        $row = $stmt->fetch(); 
                                         
                                        if($row) 
                                        { 
                                            die("This email address is already registered"); 
                                        } 
                                         
                                        $query = " 
                                            INSERT INTO users ( 
                                                username, 
                                                password, 
                                                salt, 
                                                email 
                                            ) VALUES ( 
                                                :username, 
                                                :password, 
                                                :salt, 
                                                :email 
                                            ) 
                                        "; 
                                         
                                        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
                                         
                                        $password = hash('sha256', $_POST['password'] . $salt); 
                                         
                                        for($round = 0; $round < 65536; $round++) 
                                        { 
                                            $password = hash('sha256', $password . $salt); 
                                        } 
                                         
                                        $query_params = array( 
                                            ':username' => $_POST['username'], 
                                            ':password' => $password, 
                                            ':salt' => $salt, 
                                            ':email' => $_POST['email'] 
                                        ); 
                                         
                                        try 
                                        { 
                                            $stmt = $db->prepare($query); 
                                            $result = $stmt->execute($query_params); 
                                        } 
                                        catch(PDOException $ex) 
                                        { 
                                            die("Failed to run query: " . $ex->getMessage()); 
                                        } 
                                         
                                        header("Location: index.php"); 
                                         
                                        die("Redirecting to index.php"); 
                                    } 
                                     
                                     echo '<form action="register.php" method="post"> 
                                            Username:<br /> 
                                            <input type="text" name="username" value="" /> 
                                            <br /><br /> 
                                            E-Mail:<br /> 
                                            <input type="text" name="email" value="" /> 
                                            <br /><br /> 
                                            Password:<br /> 
                                            <input type="password" name="password" value="" /> 
                                            <br /><br /> 
                                            <input type="submit" class="btn btn-default btn-file" value="Register" />&nbsp; then Login 
                                        </form>'
                                ?>     


                                </div>        
                            </td>
                    </tr>
                </table>
            </div>
         
     
    </div>
</nav>

<br>

<nav class="navbar navbar-default navbar-fixed-top mainMobile">
    <div class="container">
        <div class="two">
           
                    <h4 style="text-align: center;">my museum</h4>
             
            <br>
        </div>
    </div>
</nav>
<div class="col-md-8 col-md-offset-2 mainMobile">
    <h3 style="text-align: center;">we're sorry!</h3>
    <br>
    <br>
    <p>At this time, this app is not yet optimized for a mobile experience...but will be soon!</p>
    <p>In the meantime, to curate your own museum of personal treasures, sign up below and visit us from a Mac, PC, or Tablet to login and start sharing!</p>
    <br>
    <div class="text-center">
    

    <div class="dropup">
        <!-- Drop down menu -->
        <button type="button" class="btn btn-default btn-file dropdown-toggle" data-toggle="dropdown">Sign Up!</button>
        
        <div class="dropdown-menu" style="padding: 15px; width: 210px; left: 50%; right: auto; transform: translate(-50%, 0);">
        
        <?php 

            require("common.php"); 
             
            if(!empty($_POST)) 
            { 
                if(empty($_POST['username'])) 
                { 
                    die("Please enter a username."); 
                } 
                 
                if(empty($_POST['password'])) 
                { 
                    die("Please enter a password."); 
                } 
                 
                if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
                { 
                    die("Invalid E-Mail Address"); 
                } 
                 
                $query = " 
                    SELECT 
                        1 
                    FROM users 
                    WHERE 
                        username = :username 
                "; 
               
                $query_params = array( 
                    ':username' => $_POST['username'] 
                ); 
                 
                try 
                { 
                    $stmt = $db->prepare($query); 
                    $result = $stmt->execute($query_params); 
                } 
                catch(PDOException $ex) 
                { 
                    die("Failed to run query: " . $ex->getMessage()); 
                } 
                 
                $row = $stmt->fetch(); 
                 
                if($row) 
                { 
                    die("This username is already in use"); 
                } 
                 
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
                    die("Failed to run query: " . $ex->getMessage()); 
                } 
                 
                $row = $stmt->fetch(); 
                 
                if($row) 
                { 
                    die("This email address is already registered"); 
                } 
                 
                $query = " 
                    INSERT INTO users ( 
                        username, 
                        password, 
                        salt, 
                        email 
                    ) VALUES ( 
                        :username, 
                        :password, 
                        :salt, 
                        :email 
                    ) 
                "; 
                 
                $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
                 
                $password = hash('sha256', $_POST['password'] . $salt); 
                 
                for($round = 0; $round < 65536; $round++) 
                { 
                    $password = hash('sha256', $password . $salt); 
                } 
                 
                $query_params = array( 
                    ':username' => $_POST['username'], 
                    ':password' => $password, 
                    ':salt' => $salt, 
                    ':email' => $_POST['email'] 
                ); 
                 
                try 
                { 
                    $stmt = $db->prepare($query); 
                    $result = $stmt->execute($query_params); 
                } 
                catch(PDOException $ex) 
                { 
                    die("Failed to run query: " . $ex->getMessage()); 
                } 
                 
                header("Location: index.php"); 
                 
                die("Redirecting to index.php"); 
            } 
             
             echo '<form action="register.php" method="post"> 
                    Username:<br /> 
                    <input type="text" name="username" value="" /> 
                    <br /><br /> 
                    E-Mail:<br /> 
                    <input type="text" name="email" value="" /> 
                    <br /><br /> 
                    Password:<br /> 
                    <input type="password" name="password" value="" /> 
                    <br /><br /> 
                    <input type="submit" class="btn btn-default btn-file" value="Register" />
                    
                </form>'
        ?>  
        
    
        
        </div>        
    </div>
        <br>   
        <a href="#about" class="exhibit-link" data-toggle="modal" style="text-decoration: none;">
            <button type="button" class="btn btn-default btn-file" data-dismiss="modal">Wait, what is this?</button>
        </a>

    <div class="exhibit-modal modal fade" id="about" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <h3>what is this?</h3>
                        <br>
                        <br>
                        <p>Remember as a kid when you would find something really cool? ...a rock...a bug...a small toy...
                            but to you, this "something" was worth more than <i>anything</i>. 
                            To keep it safe and available for future viewing, you'd bring it home 
                            and place it in a special treasure chest reserved only for those things most important to you... 
                            and, in essence, curated your own mini museum of curiosities.</p>

                        <p>As adults, we still have treasure chests filled with our most prized possessions. 
                            Completely worthless to others, these intrinsic-valued items are worth more to us than gold...
                            family heirlooms, personal memories, things our children have made...and while each of these items 
                            are safe in our homes, sometimes we'd like to have access to them all the time.</p>

                        <p>With this web app, it is a hope to allow you to have access to those treasures all the time. Use it
                            to create a museum. A museum of exhibits and pictures and descriptions of all those items you hold 
                            most dear. And unlike a physical musem, you can visit this one anytime.</p>

                        <br>
                        <p>This is an online curation of that museum...YOUR Museum.</p>
                        <br>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cool!</button>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</div>

<br>
<br>
<br>

<div class="col-md-8 col-md-offset-2 mainPc">
    <h3>what is this?</h3>
    <br>
    <br>
    <br>
    <p>Remember as a kid when you would find something really cool? ...a rock...a bug...a small toy...
        but to you, this "something" was worth more than <i>anything</i>. 
        To keep it safe and available for future viewing, you'd bring it home 
        and place it in a special treasure chest reserved only for those things most important to you... 
        and, in essence, curated your own mini museum of curiosities.</p>

    <p>As adults, we still have treasure chests filled with our most prized possessions. 
        Completely worthless to others, these intrinsic-valued items are worth more to us than gold...
        family heirlooms, personal memories, things our children have made...and while each of these items 
        are safe in our homes, sometimes we'd like to have access to them all the time.</p>

    <p>With this web app, it is a hope to allow you to have access to those treasures all the time. Use it
        to create a museum. A museum of exhibits and pictures and descriptions of all those items you hold 
        most dear. And unlike a physical musem, you can visit this one anytime.</p>

    <br>
    <p>This is an online curation of that museum...YOUR Museum.</p>
</div>
<div class="clearfix">
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