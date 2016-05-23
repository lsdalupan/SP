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
                 $('#data-table1').DataTable();
                  $('#data-table2').DataTable();
            } );
        </script>

</head>  
    
    <body>  
    
        <div class="body">
        <?php
        include("header.php");  
        
        $dbcon=mysqli_connect("localhost","root","dash","SP");  
                    $view_protein_query="SELECT proteinFiles.proteinID, scPDB2013.PDB_ID, scPDB2013.Uniprot_Name, scPDB2013.Type,  scPDB2013.Uniprot_ID, scPDB2013.Species, scPDB2013.Reign, scPDB2013.Molecular_Weight FROM proteinFiles LEFT JOIN scPDB2013 ON proteinFiles.proteinID = scPDB2013.PDB_ID UNION SELECT proteinFiles.proteinID, scPDB2013.PDB_ID, scPDB2013.Uniprot_Name, scPDB2013.Type,  scPDB2013.Uniprot_ID, scPDB2013.Species, scPDB2013.Reign, scPDB2013.Molecular_Weight FROM proteinFiles RIGHT JOIN scPDB2013 ON proteinFiles.proteinID= scPDB2013.PDB_ID";//select query for viewing proteins. 
                    
                    $view_withStuctures="SELECT proteinFiles.proteinID, scPDB2013.PDB_ID, scPDB2013.Uniprot_Name, scPDB2013.Type,  scPDB2013.Uniprot_ID, scPDB2013.Species, scPDB2013.Reign, scPDB2013.Molecular_Weight FROM proteinFiles LEFT JOIN scPDB2013 ON proteinFiles.proteinID=scPDB2013.PDB_ID";
                    
                    $view_withoutStructure="SELECT proteinFiles.proteinID, scPDB2013.PDB_ID, scPDB2013.Uniprot_Name, scPDB2013.Type,  scPDB2013.Uniprot_ID, scPDB2013.Species, scPDB2013.Reign, scPDB2013.Molecular_Weight FROM proteinFiles RIGHT JOIN scPDB2013 ON proteinFiles.proteinID=scPDB2013.PDB_ID where proteinID IS NULL";
        ?>
           
            <div class="main side-margin">
                <h4 align="center">scPDB 2013</h4>  
                <div class="row">
                    <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s3"><a class="active"  href="#all">ALL</a></li>
                        <li class="tab col s3"><a href="#withStructures">With  3D Structures</a></li>
                        <li class="tab col s3"><a href="#withoutStructures">Without 3d Structures</a></li>
                    </ul>
                    </div>
                    <div id="all" class="col s12 ">
                        <div id="table-datatables">
                                <div class="row ">
                                    <table id="data-table" class="responsive-table display" cellspacing="0">  
                                        <thead>  
                                            <tr>
                                                <th>PDB_ID</th>  
                                                <th>Uniprot Name</th>   
                                                <th>Type</th>  
                                                <th>Uniprot ID</th> 
                                                <th>Species</th> 
                                                <th>Reign</th> 
                                                <th>Molecular Weight</th> 
                                            </tr>  
                                        </thead>  
                                        <?php                              
                                            $run=mysqli_query($dbcon,$view_protein_query);//here run the sql query.  
                                            while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
                                            {  
                                                if($row[1]==NULL){
                                                    $p_id=$row[0];  
                                                    $p_name="-"; 
                                                    $p_type="-"; 
                                                    $p_uniprotID="-"; 
                                                    $p_species="-"; 
                                                    $p_reign="-"; 
                                                    $p_molweight="-";
                                                }
                                                else{
                                                    $p_id=$row[1];  
                                                    $p_name=$row[2]; 
                                                    $p_type=$row[3]; 
                                                    $p_uniprotID=$row[4]; 
                                                    $p_species=$row[5]; 
                                                    $p_reign=$row[6]; 
                                                    $p_molweight=$row[7];
                                                }
                                        ?>  
                                        <tr>
                                            <td><a href="scPDB2013Details.php?protein=<?php echo $p_id ?>"> <?php echo $p_id;  ?> </a></td> 
                                            <td><?php echo $p_name;  ?></td>  
                                            <td><?php echo $p_type;  ?></td>  
                                            <td><?php echo $p_uniprotID;  ?></td> 
                                            <td><?php echo $p_species;  ?></td> 
                                            <td><?php echo $p_reign;  ?></td> 
                                            <td><?php echo $p_molweight;  ?></td> 
                                        </tr>  
                                        <?php } ?>  
                                    </table> 
                                </div> <!--end of div row-->
                            </div>    <!--end of div table-->
                    </div> <!--end of ALL-->
                    <div id="withStructures" class="col s12">
                        <div id="table-datatables">
                                <div class="row">
                                    <table id="data-table1" class="responsive-table display" cellspacing="0">  
                                        <thead>  
                                            <tr>
                                                <th>PDB_ID</th>  
                                                <th>Uniprot Name</th>   
                                                <th>Type</th>  
                                                <th>Uniprot ID</th> 
                                                <th>Species</th> 
                                                <th>Reign</th> 
                                                <th>Molecular Weight</th> 
                                            </tr>  
                                        </thead>  
                                        <?php                              
                                            $run=mysqli_query($dbcon,$view_withStuctures);//here run the sql query.  
                                            while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
                                            {  
                                                if($row[1]==NULL){
                                                    $p_id=$row[0];  
                                                    $p_name="-"; 
                                                    $p_type="-"; 
                                                    $p_uniprotID="-"; 
                                                    $p_species="-"; 
                                                    $p_reign="-"; 
                                                    $p_molweight="-";
                                                }
                                                else{
                                                    $p_id=$row[1];  
                                                    $p_name=$row[2]; 
                                                    $p_type=$row[3]; 
                                                    $p_uniprotID=$row[4]; 
                                                    $p_species=$row[5]; 
                                                    $p_reign=$row[6]; 
                                                    $p_molweight=$row[7];
                                                }
                                        ?>  
                                        <tr>
                                            <td><a href="scPDB2013Details.php?protein=<?php echo $p_id ?>"> <?php echo $p_id;  ?> </a></td> 
                                            <td><?php echo $p_name;  ?></td>  
                                            <td><?php echo $p_type;  ?></td>  
                                            <td><?php echo $p_uniprotID;  ?></td> 
                                            <td><?php echo $p_species;  ?></td> 
                                            <td><?php echo $p_reign;  ?></td> 
                                            <td><?php echo $p_molweight;  ?></td> 
                                        </tr>  
                                        <?php } ?>  
                                    </table> 
                                </div> <!--end of div row-->
                            </div>    <!--end of div table-->
                    </div> <!--end of withSturctures-->
                    <div id="withoutStructures" class="col s12">
                        <div id="table-datatables">
                                <div class="row">
                                    <table id="data-table2" class="responsive-table display" cellspacing="0">  
                                        <thead>  
                                            <tr>
                                                <th>PDB_ID</th>  
                                                <th>Uniprot Name</th>   
                                                <th>Type</th>  
                                                <th>Uniprot ID</th> 
                                                <th>Species</th> 
                                                <th>Reign</th> 
                                                <th>Molecular Weight</th> 
                                            </tr>  
                                        </thead>  
                                        <?php                              
                                            $run=mysqli_query($dbcon,$view_withoutStructure);//here run the sql query.  
                                            while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
                                            {  
                                                if($row[1]==NULL){
                                                    $p_id=$row[0];  
                                                    $p_name="-"; 
                                                    $p_type="-"; 
                                                    $p_uniprotID="-"; 
                                                    $p_species="-"; 
                                                    $p_reign="-"; 
                                                    $p_molweight="-";
                                                }
                                                else{
                                                    $p_id=$row[1];  
                                                    $p_name=$row[2]; 
                                                    $p_type=$row[3]; 
                                                    $p_uniprotID=$row[4]; 
                                                    $p_species=$row[5]; 
                                                    $p_reign=$row[6]; 
                                                    $p_molweight=$row[7];
                                                }
                                        ?>  
                                        <tr>
                                            <td><a href="scPDB2013Details.php?protein=<?php echo $p_id ?>"> <?php echo $p_id;  ?> </a></td> 
                                            <td><?php echo $p_name;  ?></td>  
                                            <td><?php echo $p_type;  ?></td>  
                                            <td><?php echo $p_uniprotID;  ?></td> 
                                            <td><?php echo $p_species;  ?></td> 
                                            <td><?php echo $p_reign;  ?></td> 
                                            <td><?php echo $p_molweight;  ?></td> 
                                        </tr>  
                                        <?php } ?>  
                                    </table> 
                                </div> <!--end of div row-->
                            </div>    <!--end of div table-->
                    
                    </div> <!--end of withoutStructures-->
                </div> <!--end of row-->
              
            </div> <!--end of main-->
        </div>
        
          
        
    </body>  
    
    
  
</html>  