<!-- This serves as the header of every page of the web application -->

<?php  
    session_start();  
    
    $dbcon=mysqli_connect("localhost","root","dash","SP");  
    $username= $_SESSION['username'];
    $getUser_query="Select * from Users where username='$username'";
    $run=mysqli_query($dbcon,$getUser_query);// run the sql query.  
    if($run){
    while($info=mysqli_fetch_array($run)){
        $login_id=$info[0];
        $login_name=$info[1]; 
        $login_fname=$info[3];  
        $login_mname=$info[4]; 
        $login_lname=$info[5];  
        $login_email=$info[6];  
        $login_type=$info[7];  
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
        <link href="css/style.css" type="text/css" rel="stylesheet"/>
        <link href="media/css/jquery.dataTables.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="media/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="media/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet" media="screen,projection">
        <!-- jQuery Library -->
        <script type="text/javascript" src="media/js/jquery.js"></script>
        <script type="text/javascript" src="media/jquery-2.2.0.min.js"></script>     
        <!-- data-tables -->
        <script type="text/javascript" src="media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="media/js/dataTables.bootstrap.js"></script>
 
        <!--materialize js-->
        <script type="text/javascript" src="css/materialize/js/materialize.js"></script>
        <script src="css/materialize/js/init.js"></script>
        
</head>  
    
    <header id="header" class="page-topbar">
        <nav class="teal navbar-fixed">
            <div class=" nav-left brand-logo">
                <a href="welcome.php">Protein Data Warehouse</a>
            </div>
            <div class="nav-wrapper nav-right">   
                <a href="#" data-activates="mobile-demo" class="button-collapse">
                    <i class="material-icons"><i class="mdi-navigation-apps"></i></i>
                </a>
                <ul id="nav-mobile" class="nav-choices hide-on-med-and-down">
                    <li><a href="welcome.php" class="waves-effect waves-block waves-light">Home</a></li>
                    <li><a href="visualize.php" class="waves-effect waves-block waves-light">Visualization</a></li>
                    <li><a href="scPDB2013proteins.php" class="waves-effect waves-block waves-light">scPDB2013</a></li>
                    <?php 
                        if($login_type==1) {
                            echo '<li><a href="import.php" class="waves-effect waves-block waves-light">Database</a></li>';
                            echo '<li><a href="members.php" class="waves-effect waves-block waves-light">Users</a></li>';
                        }
                        
                            
                    ?>
                   
                    <span class="right">
                    <li><i class="mdi-action-account-box"></i></li>
                    <li class=""><a href="profile.php" class="waves-effect waves-block waves-light"><?php echo  $_SESSION['username']; ?></a></li>
                    <li><a href="logout.php" class="waves-effect waves-block waves-light"><i class="mdi-action-exit-to-app"></i></a></li> 
                    </span>
                </ul>
<!--                 when mininized -->
                <ul class="side-nav" id="mobile-demo">
                    <li><a href="welcome.php" class="waves-effect waves-block waves-light">Home</a></li>
                    <li><a href="visualize.php" class="waves-effect waves-block waves-light">Visualization</a></li>
                    <li><a href="scPDB2013proteins.php" class="waves-effect waves-block waves-light">scPDB2013</a></li>
                    <?php 
                        if($login_type==1) {
                            echo '<li><a href="import.php" class="waves-effect waves-block waves-light">Database</a></li>';
                            echo '<li><a href="members.php" class="waves-effect waves-block waves-light">Users</a></li>';
                        }
                        
                            
                    ?>
                    <li><a href="profile.php" class="waves-effect waves-block waves-light"><?php echo  $_SESSION['username']; ?></a></li>
                    <li><a href="logout.php" class="waves-effect waves-block waves-light"><i class="mdi-action-exit-to-app"></i></a></li> 
                </ul>
            </div>
        </nav> <!--end of navigation header-->
    </header>
    
    <script>
        $( document ).ready(function(){
            $(".button-collapse").sideNav();
        })
    </script>
</html>