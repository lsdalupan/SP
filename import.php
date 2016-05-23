<?php  
    session_start();  
  
    if(!$_SESSION['username']){  
  
        header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
    }  
    
    
//connect to the database 
$connect = mysql_connect("localhost","root","dash"); 
mysql_select_db("SP",$connect); //select the table 
// $_FILES[csv][size] > 0

    if (isset($_POST['import'])) { 

        //get the csv file 
        $file = $_FILES[csv][tmp_name]; 
        $handle = fopen($file,"r"); 
        
        //loop through the csv file and insert into database 
        do { 
            if ($data[0]) { 
                mysql_query("INSERT INTO `scPDB2013`(`PDB_ID`, `Site_Number`, `Deposition_Date`, `Chimeric_entry`, `Experimental_Method`, `Chains`, `ChainPercentageInSite`, `Uniprot_Name`, `Uniprot_AC`, `Uniprot_ID`, `Species`, `Reign`, `TaxID`, `EC_Number`, `Ion`, `Cofactor`, `HET_CODE`, `Formula`, `SMILES`, `InchI`, `Molecular_Weight`, `Polar_Surface_Area`, `N_HBond_Acceptor`, `N_HBond_Donor`, `Rotatable_Bonds`, `N_Ring`, `RO5_Violation`, `ALogP`, `Solubility`, `N_Atoms`, `N_Bonds`, `N_PositiveAtom`, `N_NegativeAtom`, `N_Aromatic`, `Type`, `B_Factor`, `Buried_Surface_Area`, `Water_InSite`, `Druggability`, `SITE_Size`, `STD_AA`, `NON_STDAA`, `IFP_LENGTH`, `X`, `Y`, `Z`, `IF_bit_1`, `IF_bit_2`, `IF_bit_3`, `IF_bit_4`, `IF_bit_5`, `IF_bit_6`, `IF_bit_7`, `IF_bit_8`, `ClusterID`, `Cluster_Name`, `Cavity_Volume`, `Cavity_Hydrophobicity`, `Cavity_Polar`, `Cavity_Dummy`, `Cavity_Ligand_Recovery`, `Ligand_Cavity_Recovery`) VALUES 
                    ( 
                        '".addslashes($data[0])."', 
                        '".addslashes($data[1])."', 
                        '".addslashes($data[2])."', 
                        '".addslashes($data[3])."',
                        '".addslashes($data[4])."', 
                        '".addslashes($data[5])."', 
                        '".addslashes($data[6])."', 
                        '".addslashes($data[7])."',
                        '".addslashes($data[8])."', 
                        '".addslashes($data[9])."', 
                        '".addslashes($data[10])."', 
                        '".addslashes($data[11])."',
                        '".addslashes($data[12])."', 
                        '".addslashes($data[13])."', 
                        '".addslashes($data[14])."', 
                        '".addslashes($data[15])."',
                        '".addslashes($data[16])."', 
                        '".addslashes($data[17])."', 
                        '".addslashes($data[18])."', 
                        '".addslashes($data[19])."',
                        '".addslashes($data[20])."', 
                        '".addslashes($data[21])."', 
                        '".addslashes($data[22])."', 
                        '".addslashes($data[23])."',
                        '".addslashes($data[24])."', 
                        '".addslashes($data[25])."', 
                        '".addslashes($data[26])."', 
                        '".addslashes($data[27])."',
                        '".addslashes($data[28])."', 
                        '".addslashes($data[29])."', 
                        '".addslashes($data[30])."', 
                        '".addslashes($data[31])."',
                        '".addslashes($data[32])."', 
                        '".addslashes($data[33])."', 
                        '".addslashes($data[34])."', 
                        '".addslashes($data[35])."',
                        '".addslashes($data[36])."', 
                        '".addslashes($data[37])."', 
                        '".addslashes($data[38])."', 
                        '".addslashes($data[39])."',
                        '".addslashes($data[40])."', 
                        '".addslashes($data[41])."', 
                        '".addslashes($data[42])."', 
                        '".addslashes($data[43])."',
                        '".addslashes($data[44])."', 
                        '".addslashes($data[45])."',
                        '".addslashes($data[46])."', 
                        '".addslashes($data[47])."', 
                        '".addslashes($data[48])."',
                        '".addslashes($data[49])."', 
                        '".addslashes($data[50])."', 
                        '".addslashes($data[51])."', 
                        '".addslashes($data[52])."',
                        '".addslashes($data[53])."', 
                        '".addslashes($data[54])."', 
                        '".addslashes($data[55])."', 
                        '".addslashes($data[56])."',
                        '".addslashes($data[57])."', 
                        '".addslashes($data[58])."', 
                        '".addslashes($data[59])."', 
                        '".addslashes($data[60])."',
                        '".addslashes($data[61])."'
                    
                    ) 
                "); 
            } 
        } while ($data = fgetcsv($handle,1000,",","'")); 
        // 

        //redirect 
        echo "<script>alert('CSV file was successfully imported in the protein database.')</script>"; 
  
    } 
    
    if (isset($_POST['export'])) { 
        // output headers so that the file is downloaded rather than displayed
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=protein.csv');

        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        // output the column headings
        fputcsv($output);

        // fetch the data
        mysql_connect('localhost', 'root', 'dash');
        mysql_select_db('SP');
        $rows = mysql_query('SELECT * FROM scPDB2013');

        // loop over the rows, outputting them
        while ($row = mysql_fetch_assoc($rows)){ fputcsv($output, $row);}
        die;
    }
    
    
?>

<html>  
    <head>  
    
        <title>  
            Protein Data Warehouse  
        </title>  
    </head>
    <body>
        <div class="body">
            <?php
            include("header.php");  
            ?>
            
            <div class="main container col-md-4 col-sm-12 center">
               <div class="import">
                    <div>
                        <h3 class="header light"> Import Protein csv to scPDB2013 </h3>
                    </div>
                    <div class="import-form">
                        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>File</span>
                                    <input name="csv" type="file" id="csv" /> 
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" id="fileName">
                                </div>
                            </div>
                            <input type="submit" name="import" value="import" class="btn"/> 
                          
                        </form> 
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="export">
                    <div>
                         <h3 class="header light"> Export Protein csv from scPDB2013</h3>
                    </div>
                    <div>
                        <form method="post">
                             <input type="submit" name="export" value="export" class="btn"/> 
                        </form>
                    </div>
                </div>
               
            </div>
        </div>
    </body>
</html>

<?php  


?>