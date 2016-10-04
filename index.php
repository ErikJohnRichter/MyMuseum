<?php

require("common.php"); 

if ($_SESSION['user'] != NULL){
    header("Location: private.php"); 
    die("Redirecting to: private.php"); 
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href="css/animate.css" rel="stylesheet">

    <link rel="shortcut icon" href="assets/myIcon6.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/myIcon7.png" />


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>

</head>

<body id="indexBody">
    <div id="page-loader"><span class="page-loader-gif"></span></div>

<div class="animated fadeIn">
<nav class="navbar navbar-login navbar-default navbar-fixed-top mainPc" style="padding-top: 40px;">
    <div class="container">
        <!--<div class="two">
            <table>
                <tr>
                    <td><h4><img src="assets/myIcon.png" style="margin: 3px 3px; width: 50px; height 50px;"></h4></td>
                    <td><h4>museum</h4></td>
                </tr>
            </table>
            <br>
        </div>-->
        <div class="two" style="margin-top: -8px;">
            <table>
                <tr>
                    <td><h4><img src="assets/myIcon6.png" style="margin: 3px 3px; width: 60px; height 60px; padding-top:5px; padding-right:8px;"></h4></td>
                    <td><h4><span style="color:red;">my</span>museum</h4></td>
                </tr>
            </table>
            <br>
        </div>
        <?php 

        
         
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
                die("Failed to run query: Please click Back Button"); 
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
                        <td><input id="desktopInput" type="text" name="username" placeholder=" Username" value="'.$submitted_username.'" /></td>' 
                        ?>
                        <td>&nbsp;&nbsp;</td>
                        <td><input id="desktopInput" type="password" placeholder=" Password" name="password" value="" /></td> 
                        <td>&nbsp;&nbsp;</td>
                        <td><input id="desktopInputButton" type="submit" class="btn btn-default btn-file" value="Login" /></td>
                    </form>
                </div>
                    
                    </tr>
                </table>
            </div>
         
     
    </div>
</nav>

</div>



<div class="text-center">
<div class="col-md-8 col-md-offset-2 mainMobile" style="margin-top: -20px;">


    <img src="assets/myIcon6.png" style="width: 60px; height 60px;">
  <h4>my museum</h4>      
<br>   
<br>
    <form action="login.php" method="post"> 
        <input id="mobileInput" type="text" name="username" placeholder=" Username" value=""/>
        <br>
        <br>
        <input id="mobileInput" type="password" placeholder=" Password" name="password" value="" />
        <br>
        <br>
        <input type="submit" class="btn btn-default btn-lg btn-file" style="width: 222px; height: 39px; line-height: 5px;" value="Login" />
        <br>
        <br>
    </form>
<hr style="border-color: lightgrey;">
<br>
<br>
    <!--<h3 style="text-align: center;">we're sorry!</h3>
    <br>
    <br>
    <p>At this time, this app is not yet optimized for a mobile experience...but will be soon!</p>
    <p>In the meantime, to curate your own museum of personal treasures, sign up below and visit us from a Mac, PC, or Tablet to login and start sharing!</p>
    <br>-->



<!--<div class="dropdown">
       
        <button type="button" class="btn btn-default btn-file dropdown-toggle" data-toggle="dropdown">Login</button>
        
        <div class="dropdown-menu" style="padding: 15px; width: 210px; left: 50%; right: auto; transform: translate(-50%, 0);">
        
            <form action="login.php" method="post"> 
                <input type="text" name="username" placeholder=" Username" value=""/>
                <br>
                <br>
                <input type="password" placeholder=" Password" name="password" value="" />
                <br>
                <br>
                <input type="submit" class="btn btn-default btn-file" value="Login" />
                <br>
                <br>
            </form>
        </div>        
    </div>-->












    

    <div class="dropup">
        <!-- Drop down menu -->
        <button type="button" class="btn btn-default btn-file btn-info dropdown-toggle" data-toggle="dropdown">Sign Up</button>
        <br>
        <div class="dropdown-menu" style="padding: 25px; width: 230px; left: 50%; right: auto; transform: translate(-50%, 0); background-color: #efefef;">
        
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
                    die("Failed to run query: Please click Back Button"); 
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
                    die("Failed to run query: Please click Back Button");
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
                    die("Failed to run query: Please click Back Button"); 
                } 
                 
                header("Location: index.php"); 
                 
                die("Redirecting to index.php"); 
            } 

            echo '<div style="padding: 0px 0px 10px 0px; margin-top: -20px;">
                                     
                    <h3>sign up!</h3>
                    <br>
                
                    <form action="register.php" method="post"> 
                    Username:<br /> 
                    <input type="text" name="username" value="" /> 
                    <br /><br /> 
                    E-Mail:<br /> 
                    <input type="text" name="email" value="" /> 
                    <br /><br /> 
                    Password:<br /> 
                    <input type="password" name="password" value="" /> 
                    <br /><br /> 
                    <input type="checkbox" name="agree" value=""> I agree to <a href="terms.php">MyMuseum\'s Terms</a><br>
                    <br />
                    <input type="submit" class="btn btn-default btn-success" value="Register" />&nbsp; then Login 
                </form>
                
                </div>
                ';
             
             
        ?>  
        
    
        
        </div>        
    </div>
        <br>   
        <a href="#about" class="exhibit-link" data-toggle="modal" style="text-decoration: none; color: whitesmoke;">
           Wait, what is this?
        </a>
    <br>
    <br>

        
       
    <!--<p>My Museum 2016</p>-->

    <div class="exhibit-modal modal fade" id="about" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content" style="margin-top: -100px;">

            
            <div class="container">
               
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <div class="close-modal text-right" data-dismiss="modal"> 
                                <i class="fa fa-times"></i>
                            </div>
                            <br>
                            <h3>what is this?</h3>
                            <br>
                            <br>
                            <p style="font-family: sans-serif; text-align: left;">Remember as a kid when you would find something really cool? ...a rock...a bug...a small toy...
                                but to you, this "something" was worth more than <i>anything</i>. 
                                To keep it safe and available for future viewing, you'd bring it home 
                                and place it in a special treasure chest reserved only for those things most important to you... 
                                and, in essence, curated your own mini museum of curiosities.</p>

                            <p style="font-family: sans-serif; text-align: left;">As adults, we still have treasure chests filled with our most prized possessions. 
                                Completely worthless to others, these intrinsic-valued items are worth more to us than gold...
                                family heirlooms, personal memories, things our children have made...and while each of these items 
                                are safe in our homes, sometimes we'd like to have access to them all the time.</p>

                            <p style="font-family: sans-serif; text-align: left;">With this web app, it is a hope to allow you to have access to those treasures all the time. Use it
                                to create a museum. A museum of the pictures and descriptions of all those items you hold 
                                most dear. And unlike your physical musem, this one can be visited anytime...by you and others!</p>

                            <br>
                            <p style="font-family: sans-serif; text-align: left;">This is an online curation of that museum...YOUR Museum.</p>
                            <br>
                            <button type="button" class="btn btn-lg btn-default btn-file" data-dismiss="modal" style="border: 1px solid lightgrey;">Cool!</button>
                            <br>
                        </div>
                    </div>
          
            </div>
        </div>
</div>

    <div class="exhibit-modal modal fade" id="privacyMobile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content" style="margin-top: -100px;">

            
            <div class="container">
               
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <div class="close-modal text-right" data-dismiss="modal"> 
                                <i class="fa fa-times"></i>
                            </div>
                            <br>
                            
                            <h3>MyMuseum <i>greatly</i> values your privacy.</h3>
                            
                            <br><br>
                            <p style="font-family: sans-serif;">Everything you curate, every picture and every description, can only be seen by you. If you choose, you may share your museum
                                with others by requesting a ticket exchange with friends. If that friend accepts the exchange and gives you a ticket to visit
                                their museum, they will also be given a ticket to your museum as well. At any time after this exchange, you may revoke their
                                access to your museum and, in turn, your access to their's.</p>

                            <br>
                            <p style="font-family: sans-serif;">At no time will MyMuseum ever share your email or personal information with anyone. Any information required for signing up
                                is deemed necessary for the use of the app. Additionally, on creation, login credentials are encrypted and stored with
                                military-grade encryption protocols...not even MyMuseum is able to see them. If you forget your password, you will receive
                                a unique link to reset it.</p>

                            
                            </div>
                            <div class="text-center">
                            <br>
                            <button type="button" class="btn btn-lg btn-default btn-success" data-dismiss="modal">Great!</button>
                            <br>
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

<div class="mainPc">
    <div class="animated fadeIn">
    <div class="text-center" style="padding-top: 7%; padding-bottom: 10px;">
        <h5>Let's Curate!</h5>
    </div>
    

    <hr style="width: 500px; border: 4px solid whitesmoke; border-radius: 10px;">  
    <div class="text-center indexButtonDiv" style="margin: 0 auto; padding-top: 30px;">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#aboutDesktop" style="outline: none; vertical-align: middle; width: 150px;">What Is This?</button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#signUpDesktop" style="outline: none; vertical-align: middle; width: 150px;">Sign Up!</button>
    </div>
    </div>

    <!--<div class="text-center" style="padding-top: 8%; width: 220px; margin: 0 auto;"> 
    <div class="text-center indexButtonDiv" style="padding: 30px; width: 220px; border-radius: 10px;">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#aboutDesktop" style="outline: none; vertical-align: middle; width: 150px;">What Is This?</button>
        <br>
        <br>
        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#signUpDesktop" style="outline: none; vertical-align: middle; width: 150px;">Sign Up!</button>
    </div>
    </div>-->
    <br>
    <br>
    <!--<p>My Museum 2016</p>-->

    <div class="modal fade modal-center" id="aboutDesktop" role="dialog" style="width: 1200px; margin: 0 auto;">
        <div class="modal-content" >

            
            <div class="container">
               
                    
                        <div class="modal-body">
                                             <br>
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
                                to create a museum. A museum of the pictures and descriptions of all those items you hold 
                                most dear. And unlike your physical musem, this one can be visited anytime...by you and others!</p>

                            <br>
                            <p>This is an online curation of that museum...YOUR Museum.</p>
                            </div>
                            <div class="text-center">
                            <br>
                            <button type="button" class="btn btn-lg btn-default btn-success" data-dismiss="modal">Cool!</button>
                            <br>
                            <br>
                            <br>
                        </div>
                    
          
            </div>
        </div>
    </div>
 
    
    <br>
    <br>
    <!--<p>My Museum 2016</p>-->

    <div class="modal fade modal-center" id="signUpDesktop" role="dialog" style="width: 340px; margin: 0 auto; ">
        <div class="modal-content" style="background-color: #efefef;" >

            
            <div class="container">
               
                    
                                         
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
                                            die("Failed to run query: Please click Back Button");
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
                                            die("Failed to run query: Please click Back Button"); 
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
                                            die("Failed to run query: Please click Back Button"); 
                                        } 
                                         
                                        header("Location: index.php"); 
                                         
                                        die("Redirecting to index.php"); 
                                    } 
                                     
                                     echo '<div style="padding: 10px 40px 40px 40px;">
                                     
                                            <h3>sign up!</h3>
                                            <br>
                                            <br>
                                            <form action="register.php" method="post"> 
                                            Username:<br /> 
                                            <input id="desktopSignUpInput" type="text" name="username" value="" /> 
                                            <br /><br /> 
                                            E-Mail:<br /> 
                                            <input id="desktopSignUpInput" type="text" name="email" value="" /> 
                                            <br /><br /> 
                                            Password:<br /> 
                                            <input id="desktopSignUpInput" type="password" name="password" value="" /> 
                                            <br /><br /> 
                                            <input type="checkbox" name="agree" value=""> I agree to <a href="terms.php">MyMuseum\'s Terms</a><br>
                                            <br />
                                            <input type="submit" class="btn btn-lg btn-default btn-success" value="Register" />&nbsp; then Login 
                                        </form>';

                                ?>   
                                <br>
                                <br>
                            <button type="button" class="btn btn-default btn-warning" data-dismiss="modal">Not Today</button>
                            <br>  
                          
                        </div>
                        </div>
                    
          
            </div>
        </div>
</div>

</div>


<div class="clearfix">
</div>
    
    <br>
    <br>
    <br>
    <br>
    <br>
    <br class="mainPc">
    <footer class="mobile">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-12" style="color: grey;">
                    <a href="#privacyMobile" class="exhibit-link mobile" data-toggle="modal" style="text-decoration: none; color: whitesmoke;">
           Privacy
        </a>
        <br><br>
                    <span class="copyright">Made with <i class="fa fa-heart" style="color:red;"></i> in Milwaukee<br>&copy <a href="http://codingerik.com" style="color: darkgrey;">CodingErik</a> 2016</span>
                </div>
                <br>
            </div>
        </div>
    </footer>
    <nav class="navbar navbar-login navbar-default navbar-fixed-bottom mainPc">
        <div class="container animated fadeIn">
            <br>
            
            <div class="row text-center">
                <div class="col-md-2">

                     </div>
                <div class="col-md-8" style="color: grey;">
                    <span class="copyright">Made with <i class="fa fa-heart" style="color:red;"></i> in Milwaukee&nbsp&nbsp|&nbsp&nbsp&copy <a href="http://codingerik.com" style="color: darkgrey;">CodingErik</a> 2016</span>
                </div>
                <div class="col-md-2">
                <span class="copyright"><a href="#privacy" class="exhibit-link" data-toggle="modal" style="text-decoration: none; color: darkgrey;">
                                               Privacy
                                            </a></span>
                                        </div>
            </div>
            <br>
        </div>
    </nav>
    <div class="modal fade modal-center" id="privacy" role="dialog" style="width: 1200px; margin: 0 auto;">
        <div class="modal-content" >

            
            <div class="container">
               
                    
                        <div class="modal-body">
                                             <br>
                            <h3>will i need to hire security guards?</h3>
                            <br>
                            <br>
                            <p>MyMuseum <i>greatly</i> values your privacy.</p>
                            
                            <br>
                            <p>Everything you curate, every picture and every description, can only be seen by you. If you choose, you may share your museum
                                with others by requesting a ticket exchange with friends. If that friend accepts the exchange and gives you a ticket to visit
                                their museum, they will also be given a ticket to your museum as well. At any time after this exchange, you may revoke their
                                access to your museum and, in turn, your access to their's.</p>

                            <br>
                            <p>At no time will MyMuseum ever share your email or personal information with anyone. Any information required for signing up
                                is deemed necessary for the use of the app. Additionally, on creation, login credentials are encrypted and stored with
                                military-grade encryption protocols...not even MyMuseum is able to see them. If you forget your password, you will receive
                                a unique link to reset it.</p>

                            
                            </div>
                            <div class="text-center">
                            <br>
                            <button type="button" class="btn btn-lg btn-default btn-success" data-dismiss="modal">Great!</button>
                            <br>
                            <br>
                            <br>
                        </div>
                    
          
            </div>
        </div>
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