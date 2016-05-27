<!-- This page shows the list of members of the system. Only the Administrators can access this page. It allows them to add, edit and delete users. -->

<?php  
    session_start();  
  
    if(!$_SESSION['username']){  
  
        header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
    }  
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
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        
        <!-- data-tables -->
        <link href="media/css/jquery.dataTables.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="media/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="media/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet" media="screen,projection">
         <!-- jQuery Library -->
        <script type="text/javascript" src="media/js/jquery.js"></script>
        <script type="text/javascript" src="media/jquery-2.2.0.min.js"></script>  
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
        
        <script type="text/javascript" src="media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="media/js/dataTables.bootstrap.js"></script>
        <script type="text/javascript" src="media/js/jquery.dataTables.js"></script>
<!--         <script type="text/javascript" src="media/js/jquery.js"></script> -->
        <!--materialize js-->
        <script type="text/javascript" src="css/materialize/js/materialize.js"></script>
        <script src="css/materialize/js/init.js"></script>

        
        <script type="text/javascript" src="js/plugins/dataTables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="js/plugins/dataTables/dataTables.bootstrap.js"> </script>
        <script type="text/javascript" src="js/plugins/metisMenu/metisMenu.min.js"></script>
        <script type="text/javascript" src="js/plugins/metisMenu/metisMenu.js"></script>
        
        <script> 
            $(document).ready( function () {
                $('#data-table').DataTable();
            } );
        </script>

</head>  
    
    <body>  
    
        <div class="body">
        <?php
        include("header.php");  
        ?>
           
            <div class="main container">
                 
             
                <h1 align="center">Users</h1>  
            
            
            
                <div id="table-datatables">
                <div class="row">
                <table id="data-table" class="responsive-table display bordered stripped" cellspacing="0">  
                    <thead>  
                        <tr>
                            <th>Id</th>  
                            <th>Username</th>  
                            <th>First Name</th>  
                            <th>Middle Name</th>  
                            <th>Last Name</th>  
                            <th>Email</th>  
                            <th>User Type</th> 
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>  
                    </thead>  
                    <tbody>
                    <?php  
                    $dbcon=mysqli_connect("localhost","root","dash","SP");  
                    $view_users_query="select * from Users";//select query for viewing users.  
                    $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.  
            
                    while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
                    {  
                    if($row[8]=='0'){
                        $user_id=$row[0];  
                        $user_name=$row[1]; 
                        $user_fname=$row[3];  
                        $user_mname=$row[4]; 
                        $user_lname=$row[5];  
                        $user_email=$row[6];  
                        $user_type=$row[7];  
//                         $user_deldate=$row[9];
                    ?>  
            
                    <tr>  
            <!--here showing results in the table -->  
                        <td data-title="Id"><?php echo $user_id;  ?></td>  
                        <td data-title="Username"><?php echo $user_name;  ?></td>  
                        <td data-title="First Name"><?php echo $user_fname;  ?></td>  
                        <td data-title="Middle Name"><?php echo $user_mname;  ?></td>  
                        <td data-title="Last Name"><?php echo $user_lname;  ?></td> 
                        <td data-title="Email"><?php echo $user_email;  ?></td> 
                        <td data-title="User Type"><?php 
                            if($user_type==1){
                                echo "Administrator";
                            }
                            else{
                                echo "Member";   
                            }
                        
                        ?></td> 
                       <?php if($user_id != $login_id){?>
                        
                       <?php} else {?>
                       
                            <td data-title="Edit"><a href="editUser.php?edit=<?php echo $user_id ?>"  onclick="return confirm('Are you sure you want to edit this user?');"><button class="btn amber darken-1 waves-effect waves-block waves-light">Edit</button></a></td> 
                            <td data-title="Delete"><a href="deleteUser.php?del=<?php echo $user_id ?>"  onclick="return confirm('Are you sure you want to delete this user?');"> <button class="btn red darken-2 waves-effect waves-block waves-light">Delete</button></a></td>
                      <?php } ?>
                      
                    </tr>  
            
                    <?php }} ?>  
                    </tbody>
                </table> 
                </div> <!--end of div row-->
              </div>    <!--end of div table-->
             
               <button class="btn waves-effect waves-block waves-light " onclick="location.href='registration.php'">Add User</button>
             
            </div> <!--end of main-->
        </div>
           
           
        
    </body>  
    
    
  
</html>  