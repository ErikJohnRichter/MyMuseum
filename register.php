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

        if(!isset($_POST['agree'])) 
        {
            die("Please check that you agree to MyMuseum's Terms."); 
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
            die("Sorry, there was an error. Please try again."); 
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
            die("Sorry, there was an error. Please try again."); 
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
            die("Sorry, there was an error. Please try again.");
        } 

        $userName = $_POST['username'];

        $query = " 
            CREATE TABLE `mymuseum`.`friendrequest-".$userName."` (
                id INT NOT NULL AUTO_INCREMENT,
                requestsFrom INT,
                PRIMARY KEY (id)
        )"; 

        /*$query_params = array( 

            ':request' => 'friendrequest'.$userName.''
        );*/ 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Sorry, there was an error. Please try again.");
        } 

        $userName = $_POST['username'];
        
        $query = " 
            CREATE TABLE `mymuseum`.`friends-".$userName."` (
                id INT NOT NULL AUTO_INCREMENT,
                friends INT,
                PRIMARY KEY (id)
        )"; 

        /*$query_params = array( 

            ':request' => 'friendrequest'.$userName.''
        );*/ 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Sorry, there was an error. Please try again.");
        } 

        $userName = $_POST['username'];
        
        $query = " 
            CREATE TABLE `mymuseum`.`requestedfriends-".$userName."` (
                id INT NOT NULL AUTO_INCREMENT,
                requestsTo INT,
                PRIMARY KEY (id)
        )"; 

        /*$query_params = array( 

            ':request' => 'friendrequest'.$userName.''
        );*/ 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Sorry, there was an error. Please try again.");
        } 


        $userName = $_POST['username'];
        
        $query = " 
            CREATE TABLE `mymuseum`.`profile-".$userName."` (
                id INT NOT NULL AUTO_INCREMENT,
                picture LONGBLOB,
                bio MEDIUMTEXT,
                museum MEDIUMTEXT,
                PRIMARY KEY (id)
        )"; 

        /*$query_params = array( 

            ':request' => 'friendrequest'.$userName.''
        );*/ 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
           die("Sorry, there was an error. Please try again.");
        } 


        $userName = $_POST['username'];
        
        $query = "INSERT INTO mymuseum.`profile-".$userName."`(bio) VALUES (' ')";

        /*$query_params = array( 

            ':request' => 'friendrequest'.$userName.''
        );*/ 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Sorry, there was an error. Please try again."); 
        } 

        

        $userName = $_POST['username'];
        
        $query = "INSERT INTO mymuseum.`friends-".$userName."`(friends) VALUES ('51')"; /*51 in QA*/ 

        /*$query_params = array( 

            ':request' => 'friendrequest'.$userName.''
        );*/ 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Sorry, there was an error. Please try again."); 
        } 

        /*$query = " 
            CREATE TABLE `test`.`:friends` (
                id INT NOT NULL,
                friends INT,
                PRIMARY KEY (id)
        )"; 



        $userName = $_POST['username'];
         
        $query_params = array( 

            ':friends' => 'friends'.$userName.''
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        }*/ 
         
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


    <title>Mini Museum</title>

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
<br>
<br>
<br>

<div class="container">
<div class="form-group text-center">
<h4>Register</h4> 
<br>
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
    <input type="submit" class="btn btn-default btn-file" style="border: 1px solid lightgrey;" value="Register" /> 
</form>


</div>
</div>
</body>
</html>