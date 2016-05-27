<!-- This allows the adminstrators to add new users in the system -->

<?php
     session_start();  
  
    if(!$_SESSION['username']){  
  
        header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
    }  
?>

<html>
    <head>  
    
        <title>  
            Protein Data Warehouse  
        </title>  
        <!-- css -->
        <link href="css/materialize/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="media/css/jquery.dataTables.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="media/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="media/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!-- jQuery Library -->
        <script type="text/javascript" src="media/js/jquery.js"></script>
        <script type="text/javascript" src="media/jquery-2.2.0.min.js"></script>     
        <!-- data-tables -->
        <script type="text/javascript" src="media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="media/js/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="media/js/jquery.js"></script>
        <!--materialize js-->
        <script type="text/javascript" src="css/materialize/js/materialize.js"></script>
        <script src="css/materialize/js/init.js"></script>
</head>  
    
    <body>
        <div class="body">
            <?php
                include("header.php");  
            ?>
            
             <h4 class="header light center"> Add User </h4>
            
            <div class="reg-form basic-form container">
                <form role="form" method="post" class="col s12" action="registration.php">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="username" name="username" type="text" required>
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input id="password" name="password" type="password" required minlength="6" >
                            <label for="password">Password <small>(minimum of 6 characters)</small></label>
                        </div>
                        <div class="input-field col s6">
                            <input id="confirm_password" name="password" type="password" required minlength="6" >
                            <label for="password">Confirm Password<small>(minimum of 6 characters)</small></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="fname" name="fname" type="text" required> 
                            <label for="fname">First Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="mname" name="mname" type="text" required> 
                            <label for="mname">Middle Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="lname" name="lname" type="text" required> 
                            <label for="lname">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" name="email" type="email"  required > 
                            <label for="email">Email Address</label>
                        </div>
                    </div>
                        <script>
                            $(document).ready(function() {
                                $('select').material_select();
                            });
                        </script>
                    <div class="row">
                      <div class="input-field col s12">
                            <select id="type" name="type" required>
                                <option value="" disabled selected>Choose User Type</option>
                                <option value="1">Administrator</option>
                                <option value="2">Member</option>
                            </select>
                            <label>User Type</label>
                        </div>
                    </div>   
                    <div class="row right">
                    <!--<button class="btn orange darken-1  waves-effect waves-light " type="submit" name="cancel" value="cancel">Cancel
                            <i class="mdi-content-remove-circle-outline right"></i>
                            </button>   -->
                        
                            <button class="btn cyan waves-effect waves-light " type="submit" name="register" value="register">Submit
                            <i class="mdi-content-send right"></i>
                            </button>
                             
                        
                    </div>
                </form>
                      <a href="members.php"><button class="btn amber darken-1 waves-effect waves-block waves-light">Cancel<i class="mdi-content-remove-circle-outline right"></i></button></a>
            </div>
        </div>
    </body>
    <script>
        var password = document.getElementById("password")
        var confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
</html>



<?php
 $dbcon=mysqli_connect("localhost","root","dash","SP"); 
    if (!$dbcon) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
    }
 
if(isset($_POST['register'])){
    
    $user_name=$_POST['username'];
    $user_pass=md5($_POST['password']);
    $user_fname=$_POST['fname'];
    $user_mname=$_POST['mname'];
    $user_lname=$_POST['lname'];
    $user_email=$_POST['email'];
    $user_type=$_POST['type'];
    //insert the user into the database.  
    
    $insert_user="insert into Users (user_id,username,password,fname,mname,lname,email,user_type) VALUES ('','$user_name','$user_pass','$user_fname','$user_mname','$user_lname','$user_email','$user_type')";  
    $check_username="Select * from Users where username='$user_name'";
//      check if username is already in the database
   if(!mysqli_num_rows($dbcon->query($check_username))){
        if($dbcon->query($insert_user)) {  
            echo "<script>window.open('members.php','_self')</script>";  
        }
        else{
             echo "<script>alert('ERROR!!')</script>";  
            echo "<script>window.open('members.php','_self')</script>";  
        }
    }
    else{
         echo "<script>alert('ERROR! Username is already used!!')</script>";  
    }
   
}

 if(isset($_POST['cancel'])){
         echo "<script>window.open('members.php','_self')</script>";  
    }



?>