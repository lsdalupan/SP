<!-- This deletes the user with the delete_id in the url -->

<?php   
    $dbcon=mysqli_connect("localhost","root","dash","SP");  //connect db
    $delete_id=$_GET['del'];  //user_id


    $timestamp = date('Y-m-d G:i:s');
    $delete_query="Update Users SET delete_flag='1', delete_date='$timestamp' WHERE user_id='$delete_id'";//delete query  
    $run=$dbcon->query($delete_query);
    if($run)  
    {  
    //if success->return to members page   
        echo "<script>window.open('members.php','_self')</script>";  
    }  
    else{
        echo "<script>alert('ERROR!')</script>";  
    }
  
?>  
