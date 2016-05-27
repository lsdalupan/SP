<!-- This serves as the home page of the web application -->

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
            
            <div class="container main">
            <div class="row">
                
                <div class="col s6 center">
                    <h3 class="header light"> Welcome! </h3>
                    <div >
                        This website uses Jsmol, a javascript version of Jmol which displays interactive 3D molecular structure and scPDB,an annotated database of druggable binding sites from the Protein DataBank for its database. 
                    </div>       
                    <div>
                     <img src="media/JSmol_logo1.png" alt="" class="circle responsive-img jsmol"> 
                     <div class="light center">
                     JSmol is the name for the HTML5 canvas version of the Jmol applet. JSmol opens up the use of Jmol in PC, Mac, and Linux systems without Java installed or with Java disabled, as well as tablets and phones (both iOS and Android). No hardware-based graphics acceleration is used, allowing JSmol to run in any web browser that supports HTML5 standards. JSmol runs entirely in the client, needing no server technologies for most of its operation. (Reading binary files in some browsers and saving images and Jmol states in all browsers do require a server-side PHP script.)
                     </div>
                    </div>
                    
                </div>
            
            <div class="col s6 center">
                    <img src="media/logscpdb_min2.png" alt="" class="circle responsive-img scpdb"> 
                    <h4 class="light"> scPDB </h4>
                    <h5 class="light center"> An Annotated Database of Druggable Binding Sites from the Protein DataBank </h5>
                    <div class="light center">
                            The sc-PDB database (available at http://bioinfo-pharma.u-strasbg.fr/scPDB/) is a comprehensive and up-to-date selection of ligandable binding sites of the Protein Data Bank. Sites are defined from complexes between a protein and a pharmacological ligand. The database provides the all-atom description of the protein, its ligand, their binding site and their binding mode. Currently, the sc-PDB archive registers 9283 binding sites from 3678 unique proteins and 5608 unique ligands. The sc-PDB database was publicly launched in 2004 with the aim of providing structure files suitable for computational approaches to drug design, such as docking. During the last 10 years we have improved and standardized the processes for (i) identifying binding sites, (ii) correcting structures, (iii) annotating protein function and ligand properties and (iv) characterizing their binding mode. 
                        </div>               
                        
                    </div>
                </div>
                </div>
        </div>
        
        
        
      
    </body>  
  
</html>  