<?php   
    $dbcon=mysqli_connect("localhost","root","dash","SP");  
    $delete_id=$_GET['del'];  


    $timestamp = date('Y-m-d G:i:s');
    $delete_query="Update Users SET delete_flag='1', delete_date='$timestamp' WHERE user_id='$delete_id'";//delete query  
    $run=$dbcon->query($delete_query);
    if($run)  
    {  
    //javascript function to open in the same window   
        echo "<script>window.open('members.php','_self')</script>";  
    }  
    else{
        echo "<script>alert('ERROR!')</script>";  
    }
  
?>  
