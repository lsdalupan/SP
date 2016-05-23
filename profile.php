<?php
     session_start();  
  
    if(!$_SESSION['username']){  
  
        header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
    }  
    
    $dbcon=mysqli_connect("localhost","root","dash","SP");  
    if (!$dbcon) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
    }
    
    $update_id=$_SESSION['username'];    
    $getInfo_query="Select * from Users where username='$update_id'";
    $run=mysqli_query($dbcon,$getInfo_query);//here run the sql query.  
    if($run){
    while($info=mysqli_fetch_array($run)){
//     $info=mysqli_query($dbcon,$getInfo_query);//here run the sql query.  
        $update_name=$info[1]; 
        $update_fname=$info[3];  
        $update_mname=$info[4]; 
        $update_lname=$info[5];  
        $update_email=$info[6];  
        $update_type=$info[7];  
    }
    }
    else{
         echo "<script>alert('ERROR!')</script>";  
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
            
           <h4 class="header light center"> User Information </h4>
            <div class="reg-form basic-form container">
                <form role="form" method="post" class="col s12" action="">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="username" name="username" type="text" value="<?php echo $update_name; ?>" required>
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
                            <input id="fname" name="fname" type="text" value="<?php echo $update_fname; ?>" required> 
                            <label for="fname">First Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="mname" name="mname" type="text" value="<?php echo $update_mname; ?>" required> 
                            <label for="mname">Middle Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="lname" name="lname" type="text" value="<?php echo $update_lname; ?>" required> 
                            <label for="lname">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" name="email" type="email" value="<?php echo $update_email; ?>" required> 
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
                            <!--<select id="type" name="type">
                                <option value="" disabled selected>Choose User Type</option>
                                <option value="1">Administrator</option>
                                <option value="2">Member</option>
                            </select>-->
                            
                            <select name="type" id="type" required >
                                <option value="" disabled selected>Choose User Type</option>
                                <option value="1" <?php if($update_type == "1") echo "Selected"; ?> >Administrator</option>
                                <option value="2" <?php if($update_type == "2") echo "Selected"; ?> >Member</option>
                            </select>
                            <label>User Type</label>
                        </div>
                    </div>   
                    <div class="row right">
                            
                            <!--<button class="btn orange darken-1  waves-effect waves-light " type="submit" name="cancel" value="cancel">Cancel
                            <i class="mdi-content-remove-circle-outline right"></i>
                            </button>-->
                            
                            
                            
                            <button class="btn blue waves-effect waves-light  " type="submit" name="update" value="update">Edit Profile
                            <i class="mdi-content-send right"></i>
                            </button>
                             
                    </div>
                </form>
                
               
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
    
    
    if(isset($_POST['update'])){
        $user_name=$_POST['username'];
        $user_pass=md5($_POST['password']);
        $user_fname=$_POST['fname'];
        $user_mname=$_POST['mname'];
        $user_lname=$_POST['lname'];
        $user_email=$_POST['email'];
        $user_type=$_POST['type'];
        
//             UPDATE players SET firstname='$firstname', lastname='$lastname' WHERE id='$id'
//             user_id,username,password,fname,mname,lname,email,user_type
        $update_query="UPDATE Users SET username='$user_name', password='$user_pass', fname= '$user_fname', mname='$user_mname', lname='$user_lname', email='$user_email', user_type='$user_type' WHERE user_id='$update_id'";//update query  
//         $run=$dbcon->query($update_query);
        
        if($dbcon->query($update_query))  
        {  
            echo "<script>window.open('members.php','_self')</script>";  
        }
        else{
            echo "<script>alert('ERROR!')</script>";  
        }
    }
    
    if(isset($_POST['cancel'])){
         echo "<script>window.open('members.php','_self')</script>";  
    }
  
?>  
    
    