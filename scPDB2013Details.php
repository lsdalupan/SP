<!-- This shows the details of the selected protein and visualizes its structures.  -->

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
    $protein_id=$_GET['protein'];  
   
    $checkFile="Select * from proteinFiles where proteinID ='$protein_id'";
    $runquery=mysqli_query($dbcon,$checkFile);
    while($row=mysqli_fetch_array($runquery)){ //while look to fetch the result and store in a array $row.    
        if (is_null($row)){
            $withFiles='0';
            
        }
        else{
            $withFiles='1';
            
            
        }
    }
    
    $getInfo_query="Select * from scPDB2013 where PDB_ID='$protein_id'";
    $run=mysqli_query($dbcon,$getInfo_query);//here run the sql query.  
    if($run){
        while($info=mysqli_fetch_array($run)){

            $p_id=$protein_id; 
            $p_siteNumber=$info[1];  
            $p_depositionDAte=$info[2]; 
            $p_chimericEntry=$info[3];  
            $p_experimentalMethod=$info[4];  
            $p_chains=$info[5];
            $p_chainPercentSite=$info[6]; 
            $p_uniprotName=$info[7];  
            $p_uniprotAC=$info[8]; 
            $p_uniprotId=$info[9];  
            $p_species=$info[10];  
            $p_reign=$info[11];
            $p_taxId=$info[12]; 
            $p_ecNumber=$info[13];  
            $p_ion=$info[14]; 
            $p_cofactor=$info[15];  
            $p_hetCode=$info[16];  
            $p_formula=$info[17];
            $p_smile=$info[18]; 
            $p_inchl=$info[19];  
            $p_molWeight=$info[20]; 
            $p_polarSurfaceArea=$info[21];  
            $p_nHbondAcceptor=$info[22];  
            $p_nHbondDonor=$info[23];
            $p_rotatableBond=$info[24]; 
            $p_nRing=$info[25];  
            $p_ro5Violation=$info[26]; 
            $p_aLogP=$info[27];  
            $p_solubility=$info[28];  
            $p_nAtoms=$info[29];
            $p_nBonds=$info[30]; 
            $p_nPositiveAtom=$info[31];  
            $p_nNegativeAtom=$info[32]; 
            $p_nAromatic=$info[33];  
            $p_type=$info[34];  
            $p_bFactor=$info[35];
            $p_buriedSurfaceArea=$info[36]; 
            $p_waterInSite=$info[37];  
            $p_druggability=$info[38]; 
            $p_siteSize=$info[39];  
            $p_stdaa=$info[40];  
            $p_nonStdaa=$info[41];
            $p_ifpLength=$info[42]; 
            $p_x=$info[43];  
            $p_y=$info[44]; 
            $p_z=$info[45]; 
            $p_ifpb1=$info[46]; 
            $p_ifpb2=$info[47];  
            $p_ifpb3=$info[48]; 
            $p_ifpb4=$info[49];  
            $p_ifpb5=$info[50];  
            $p_ifpb6=$info[51];
            $p_ifpb7=$info[52]; 
            $p_ifpb8=$info[53];  
            $p_clusterID=$info[54]; 
            $p_clusterName=$info[55];  
            $p_cavityVolume=$info[56];  
            $p_cavityHydrophobicity=$info[57];
            $p_cavityPolar=$info[58]; 
            $p_cavityDummy=$info[59];  
            $p_cavityLigandRecovery=$info[60]; 
            $p_ligandCAvityRecovery=$info[61]; 
        }
    }
    else{
         echo "<script>window.open('scPDB2013proteins.php','_self')</script>";  
        
         
    }
  
?>

<html>  
    <head>  
    
        <title>  
            Protein Data Warehouse  
        </title>  
        
         <link href="css/style.css" type="text/css" rel="stylesheet"/>
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
        
      
        
        <script type="text/javascript" src="jsmol/js/JSmoljQuery.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolCore.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolApplet.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolApi.js"></script>
        <script type="text/javascript" src="jsmol/js/j2sjmol.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmol.js"></script>
       <!-- <script type="text/javascript" src="jsmol/js/JSmolControl.js"></script>-->
        <script type="text/javascript" src="jsmol/js/Jmol2.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmol.full.js"></script>
        <script type="text/javascript" src="JSmol.min.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolMenu.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolConsole.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolJSV.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolTM.js"></script>
        <script type="text/javascript" src="jsmol/js/SwingJS.js"></script>
        
        <!-- // following two only necessary for WebGL version: -->
        <script type="text/javascript" src="jsmol/js/JSmolThree.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolGLmol.js"></script>
        
          <script> 
            $(document).ready( function () {
                $('#data-table').DataTable();           
            
            } );
            
            
        </script>
        

        <script type="text/javascript">
            var Info = {
            width:550,
            height: 500,
            //  serverURL: "http://chemapps.stolaf.edu/jmol/jsmol/jsmol.php ",
            //   serverURL: "http://propka.ki.ku.dk/~jhjensen/jsmol/jsmol.php ",
            use: "HTML5",
            j2sPath: "jsmol/j2s",
            console: "jmolApplet0_infodiv"
            }
            Jmol.getApplet("appletCheck", Info, true);
            var isApplet = (appletCheck._jmolType.indexOf("_Applet") >= 0);
        </script>
        
<!--         get parameters of URL -->

        <script>
            function getParam(name){
            name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
            var regexS = "[\\?&]"+name+"=([^&#]*)";
            var regex = new RegExp( regexS );
            var results = regex.exec (window.location.href);
            if (results == null)
                return "";
                else
                return results[1];  
            }

            var folderName = getParam("protein");
            alert(first);
        </script>

</head>  
    
    <body>  
    
        <div class="body">
        <?php
        include("header.php");  
        ?>
           
           
             
                    <script>
                    $(document).ready(function(){	
                     $("#middlepanel").html(Jmol.getAppletHtml("jmol", Info));

  // alternatively, you can use
  //
  //   jmol = "jmol"
  //
  // and then create the buttons before the applet itself. 
  // Just make sure if you do that to use the name of the applet you are
  // actually going to be using. So, perhaps:
  //
  //   jmolApplet0 = "jmolApplet0"
  //

	var use = (Info.use != "JAVA" ? Info.use : Info.isSigned ? "SIGNED" : "JAVA");  
    var radios = [
		["set background white", "white"],
		["set background black", "black", true]
		];
	var dragRadios = [
		["set picking dragMinimize", "on"],
		["set picking ident", "off", true]
		];
    var modelRadios = [
		["set modelkitmode", "on"],
		["set modelkitmode off", "off", true]
		];
    var mmffRadios = [
		["set minimizationSteps 200;set loadstructcallback 'minimize energy';set minimizationcallback '';set echo top left;echo @{'' + _minimizationEnergy + ' ' + energyUnits + '/mol'};minimize energy", "on"],
		["echo @{''};set minimizationCallback '';set loadstructcallback ''", "off", true]
		];
    var unitRadios = [
		["set energyunits kcal;minimize energy", "kcal/mol"],
		["set energyunits kJ;minimize energy", "kJ/mol", true]
		];
    var spinRadios = [
		["spin on", "on"],
		["spin off", "off", true]
		];
//     var hbondRadios = [
//         ["hbond on", "on"],
//         ["hbond off", "off", true]
//         ];
    

		$("#leftpanel").html(
            "Spin "
			+ Jmol.jmolRadioGroup(jmolApplet0, spinRadios)
			+(true || isApplet ? 
			'<br>Drag-Minimize '
			+ Jmol.jmolRadioGroup(jmolApplet0, dragRadios)  
			: "")
			+ "<br>Model Kit Mode "
			+ Jmol.jmolRadioGroup(jmolApplet0, modelRadios)  
// 			+ "<br>Show Hbonds "
// 			+ Jmol.jmolRadioGroup(jmolApplet0, hbondRadios)  
			+ "<br>Display calculated MMFF94 energy "
			+"<br>"
			+ Jmol.jmolRadioGroup(jmolApplet0, mmffRadios)  
			+ "<br>Energy Units "
			+"<br>"
			+ Jmol.jmolRadioGroup(jmolApplet0, unitRadios) 
			+ "<br>Background: "
			+ Jmol.jmolRadioGroup(jmolApplet0, radios)
			
		);

  // right panel
  
	Jmol.setButtonCss(null, "class='btn add5-margin'");	
	$("#rightpanel").html(
        Jmol.jmolButton(jmolApplet0,"if (!molname) { molname = 'tylenol'};var x = prompt('Enter the name of a compound',molname);if (!x) { quit }; molname = x; load @{':' + molname} #alt:LOAD :??Enter a model name","Load MOL (PubChem)")
		+ (isApplet ? 
		"<br>"
		+ Jmol.jmolButton(jmolApplet0,(isApplet ? "minimize" : "set forceField UFF;minimize"),"Minimize (MMFF94)")
		: "")
 		+ (isApplet ?
		"<br>"
		+ Jmol.jmolButton(jmolApplet0,"load ? ","Load FILE")
		+ "<br>"
		: "")

		+ Jmol.jmolButton(jmolApplet0,"select *;if ($s1) {isosurface s1 delete} else {calculate partialcharge;isosurface s1 vdw map MEP translucent}","show/hide MEP")
		+"<br>"
		+ Jmol.jmolButton(jmolApplet0,"write PNGJ ?.png","Save PNG")
        + Jmol.jmolButton(jmolApplet0, "JSCONSOLE", "show info")
		
    
	);
	
	// lower panel:
			
	Jmol.setButtonCss(null,"class='btn add5-margin'");

	var s =Jmol.jmolButton(jmolApplet0,"wireframe -0.1 #alt:SETTING Line", "wireframe")
		+ Jmol.jmolButton(jmolApplet0,"spacefill only;spacefill 23%;wireframe 0.15 #alt:SETTING Ball and Stick","ball&stick");
		s += Jmol.jmolButton(jmolApplet0,"spacefill #alt:SETTING van der Waals Spheres", "spacefill");	
		
	
		s += "<br>"

    s += Jmol.jmolButton(jmolApplet0,"console");
		
    s += Jmol.jmolCommandInput(jmolApplet0);
    
    
	$("#lowerpanel").html(s);
	})
                    </script>
            <div class="main container col-md-6 col-sm-12">
                 
             <center>
                <div>
                   
                   
                    <h4 align="center"><?php echo $p_id ?></h4>  
                     
                    <div>
                        *right click to show menu
                        
                    </div>
                    <small>visualized by: Jsmol</small>
                </div>
<!--                 visualize protein -->

               <div class="row">
                     <div class="col s4">
                        <?php if($withFiles=='1') { ?>
                        <div class="collection center-block col-md-4 col-sm-12 " id="table-datatable">
                            
                            <table id="data-table" class="responsive-table center">
                                <tbody>
                                <tr class="center"> <td colspan="2" class="center"> <button class="btn waves-effect waves-block waves-light" onclick="location.href='scPDB2013proteins.php'">back</button>
                                <tr><td> <a value="ligand" id="ligand">ligand</a> </td>
                                <td> <a value="protein" id="protein">protein</a></td></tr> 
                                <tr><td> <a value="cavity6" id="cavity6">cavity6</a></td>
                                <td> <a value="cavityALL" id="cavityALL">cavityALL</a></td></tr>
                                <tr><td> <a value="ints_M" id="ints_M">ints_M</a></td>
                                <td> <a value="site" id="site">site</a></td></tr>
                       
                                <tbody>
                            </table>
                        </div> <!--end of table-->

                        <div class="collection center col-md-4 col-sm-12">
                            
                                     <div id="leftpanel"></div>
                                     <div id="rightpanel"></div>
                                     
                        </div> <!--end of left and right panel collection-->
                    </div> <!--end of "left"-->
                    <?php } else{ ?>
                        <button class="btn waves-effect waves-block waves-light" onclick="location.href='scPDB2013proteins.php'">back</button>
                        <?php }?>
                    
                
                  
                   
                   
                   <div class=" collection col-md-4 col-sm-12 add10-margin">
                   
                   
                        <script type="text/javascript">
                            var checkfiles= "<?php echo $withFiles; ?>";
                            
                            if(checkfiles==0){ 
                                 document.write("<h3 class='header light wide'>There are no mol2 or pdb files stored in the server. </h3>");
                                
                            }
                            else{
                            
                                jmolApplet0 = Jmol.getApplet("jmolApplet0", Info);
                                var file="scPDB_2013/2013/";
                                file=file.concat(folderName);
                                file=file.concat("/"); 
                                file1=file
                                fileName="ligand.mol2";
                                renderFile=file.concat(fileName);
                                Jmol.script(jmolApplet0,"background black;load '" + renderFile + "'");
                                
                                
                                ligand.onclick= function(){
                                    file=file1          
                                    fileName="ligand.mol2";
                                    renderFile=file.concat(fileName);
                                    Jmol.script(jmolApplet0,"background black;load '" + renderFile + "'");
                                };
                                protein.onclick= function(){
                                    file=file1           
                                    fileName="protein.mol2";
                                    renderFile=file.concat(fileName);
                                    Jmol.script(jmolApplet0,"background black;load '" + renderFile + "'");
                                };    
                                cavity6.onclick= function(){
                                    file=file1           
                                    fileName="cavity6.mol2";
                                    renderFile=file.concat(fileName);
                                    Jmol.script(jmolApplet0,"background black;load '" + renderFile + "'");
                                };
                                cavityALL.onclick= function(){
                                    file=file1           
                                    fileName="cavityALL.mol2";
                                    renderFile=file.concat(fileName);
                                    Jmol.script(jmolApplet0,"background black;load '" + renderFile + "'");
                                };
                                ints_M.onclick= function(){
                                    file=file1           
                                    fileName="ints_M.mol2";
                                    renderFile=file.concat(fileName);
                                    Jmol.script(jmolApplet0,"background black;load '" + renderFile + "'");
                                };
                                
                                site.onclick= function(){
                                    file=file1           
                                    fileName="site.mol2";
                                    renderFile=file.concat(fileName);
                                    Jmol.script(jmolApplet0,"background black;load '" + renderFile + "'");
                                };
                            }
                        </script>
                         <div id="lowerpanel"><br></div>
                    </div>
                  
                </div>

                
               
                
                
               <div id="table-datatables col-md-4 col-sm-12 ">
                <div class="row">
                <table id="data-table" class="display bordered " cellspacing="0">  
                    <tbody>
                        <tr class="">
                            <td colspan="2" class="cell-left"><strong>PDB_ID</strong></td>
                            <td colspan="2" class="cell-right"> <?php echo $p_id; if($p_id==null)echo "-";?></td>
                        </tr>
                        <tr >
                            <td colspan="2" class="cell-left"><strong>Uniprot Name</strong></td>
                            <td colspan="2" class="cell-right"> <?php echo $p_uniprotName; if($p_uniprotName==null)echo "-";?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Site Number</strong></td>
                            <td  class="cell-right"> <?php echo $p_siteNumber; if($p_siteNumber==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>Chimeric Entry</strong></td>
                            <td class="cell-right"> <?php echo $p_chimericEntry; if($p_chimericEntry==null)echo "-"; ?> </td>
                        </tr>
                        <tr >
                            
                            <td class="cell-left"><strong>Experimental Method</strong></td>
                            <td class="cell-right"> <?php echo $p_experimentalMethod; if($p_experimentalMethod==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>Chains</strong></td>
                            <td class="cell-right"> <?php echo $p_chains; if($p_chains==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td  class="cell-left"><strong>Chain Percentage in Site</strong></td>
                            <td  class="cell-right"> <?php echo $p_chainPercentSite; if($p_chainPercentSite==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>Uniprot AC</strong></td>
                            <td class="cell-right"> <?php echo $p_uniprotAC; if($p_uniprotAC==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Uniprot ID</strong></td>
                            <td clas s="cell-right"> <?php echo $p_uniprotId; if($p_uniprotId==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>Species</strong></td>
                            <td class="cell-right"> <?php echo $p_species; if($p_species==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Reign</strong></td>
                            <td class="cell-right"> <?php echo $p_reign; if($p_reign==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>Tax ID</strong></td>
                            <td class="cell-right"> <?php echo $p_taxId; if($p_taxId==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>EC Number</strong></td>
                            <td class="cell-right"> <?php echo $p_ecNumber; if($p_ecNumber==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>Ion</strong></td>
                            <td class="cell-right"> <?php echo $p_ion; if($p_ion==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Cofactor</strong></td>
                            <td class="cell-right"> <?php echo $p_cofactor; if($p_cofactor==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>HET Code</strong></td>
                            <td class="cell-right"> <?php echo $p_hetCode; if($p_hetCode==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Formula</strong></td>
                            <td class="cell-right"> <?php echo $p_formula; if($p_formula==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>SMILE</strong></td>
                            <td class="cell-right"> <?php echo $p_smile; if($p_smile==null)echo "-"; ?> </td>
                            
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>InCHL</strong></td>
                            <td class="cell-right"> <?php echo $p_inchl; if($p_inchl==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>Molecular Weight</strong></td>
                            <td class="cell-right"> <?php echo $p_molWeight; if($p_molWeight==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Polar Surface Area</strong></td>
                            <td class="cell-right"> <?php echo $p_polarSurfaceArea; if($p_polarSurfaceArea==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>N_HBond Acceptor</strong></td>
                            <td class="cell-right"> <?php echo $p_nHbondAcceptor; if($p_nHbondAcceptor==null)echo "-"; ?> </td>
                            
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>N_HBond Donor</strong></td>
                            <td class="cell-right"> <?php echo $p_nHbondDonor; if($p_nHbondDonor==null)echo "-"; ?> </td>
                            <td  class="cell-left"><strong>Rotatable Bond</strong></td>
                            <td class="cell-right"> <?php echo $p_rotatableBond; if($p_rotatableBond==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td  class="cell-left"><strong>N Ring/strong></td>
                            <td class="cell-right"> <?php echo $p_nRing; if($p_nRing==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>RO% Violation</strong></td>
                            <td class="cell-right"> <?php echo $p_ro5Violation; if($p_ro5Violation==null)echo "-"; ?> </td>
                            
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>aLogP</strong></td>
                            <td class="cell-right"> <?php echo $p_aLogP; if($p_aLogP==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>Solubility</strong></td>
                            <td class="cell-right"> <?php echo $p_solubility; if($p_solubility==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Number of Atoms</strong></td>
                            <td class="cell-right"> <?php echo $p_nAtoms; if($p_nAtoms==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>Number of Bonds</strong></td>
                            <td class="cell-right"> <?php echo $p_nBonds; if($p_nBonds==null)echo "-"; ?> </td>
                            
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Positive Atom</strong></td>
                            <td  class="cell-right"> <?php echo $p_nPositiveAtom; if($p_nPositiveAtom==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>Negative Atom</strong></td>
                            <td class="cell-right"> <?php echo $p_nNegativeAtom; if($p_nNegativeAtom==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Aromatic</strong></td>
                            <td class="cell-right"> <?php echo $p_nAromatic; if($p_nAromatic==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>Type</strong></td>
                            <td class="cell-right"> <?php echo $p_type; if($p_type==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>B Factor</strong></td>
                            <td class="cell-right"> <?php echo $p_bFactor; if($p_bFactor==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>Burried Surface Area</strong></td>
                            <td class="cell-right"> <?php echo $p_buriedSurfaceArea; if($p_buriedSurfaceArea==null)echo "-"; ?> </td>
                            
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Water in Site</strong></td>
                            <td class="cell-right"> <?php echo $p_waterInSite; if($p_waterInSite==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>Druggability</strong></td>
                            <td class="cell-right"> <?php echo $p_druggability; if($p_druggability==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Site Size</strong></td>
                            <td class="cell-right"> <?php echo $p_siteSize; if($p_siteSize==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>STDAA</strong></td>
                            <td class="cell-right"> <?php echo $p_stdaa; if($p_stdaa==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Non STDAA</strong></td>
                            <td class="cell-right"> <?php echo $p_nonStdaa; if($p_nonStdaa==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>IFP Lenght</strong></td>
                            <td class="cell-right"> <?php echo $p_ifpLength; if($p_ifpLength==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>X</strong></td>
                            <td class="cell-right"> <?php echo $p_x; if($p_x==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>Y</strong></td>
                            <td class="cell-right"> <?php echo $p_y; if($p_y==null)echo "-"; ?> </td>
                            
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Z</strong></td>
                            <td class="cell-right"> <?php echo $p_z; if($p_z==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>IFP Bit1</strong></td>
                            <td class="cell-right"> <?php echo $p_ifpb1; if($p_ifpb1==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>IFP Bit 2</strong></td>
                            <td class="cell-right"> <?php echo $p_ifpb2; if($p_ifpb2==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>IFP Bit 3</strong></td>
                            <td class="cell-right"> <?php echo $p_ifpb3; if($p_ifpb3==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>IFP Bit 4</strong></td>
                            <td class="cell-right"> <?php echo $p_ifpb4; if($p_ifpb4==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>IFP Bit 5</strong></td>
                            <td class="cell-right"> <?php echo $p_ifpb5; if($p_ifpb5==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>IFP Bit 6</strong></td>
                            <td class="cell-right"> <?php echo $p_ifpb6; if($p_ifpb6==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>IFP Bit 7</strong></td>
                            <td class="cell-right"> <?php echo $p_ifpb7; if($p_ifpb7==null)echo "-"; ?> </td>
                            
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>IFP Bit 8</strong></td>
                            <td class="cell-right"> <?php echo $p_ifpb8; if($p_ifpb8==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>Cluster ID</strong></td>
                            <td class="cell-right"> <?php echo $p_clusterID; if($p_clusterID==null)echo "-"; ?> </td>
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Cluster Name</strong></td>
                            <td class="cell-right"> <?php echo $p_clusterName; if($p_clusterName==null)echo "-";?> </td>
                        
                            <td class="cell-left"><strong>Cavity Volume</strong></td>
                            <td class="cell-right"> <?php echo $p_cavityVolume; if($p_cavityVolume==null)echo "-"; ?> </td>
                            
                        </tr>
                        <tr>
                            <td class="cell-left"><strong>Cavity Hydrophobicity</strong></td>
                            <td class="cell-right"> <?php echo $p_cavityHydrophobicity; if($p_cavityHydrophobicity==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>CavityPolar</strong></td>
                            <td class="cell-right"> <?php echo $p_cavityPolar; if($p_cavityPolar==null)echo "-"; ?> </td>
                        </tr>
                         <tr>
                            <td class="cell-left"><strong>Depostition Date</strong></td>
                            <td class="cell-right"> <?php echo $p_depositionDAte; if($p_depositionDAte==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>Cavity Dummy</strong></td>
                            <td class="cell-right"> <?php echo $p_cavityDummy; if($p_cavityDummy==null)echo "-"; ?> </td>
                        </tr>
                         <tr>
                            <td class="cell-left"><strong>Cavity Ligand Recovery</strong></td>
                            <td class="cell-right"> <?php echo $p_cavityLigandRecovery; if($p_cavityLigandRecovery==null)echo "-"; ?> </td>
                            <td class="cell-left"><strong>Ligand Cavity Recovery</strong></td>
                            <td class="cell-right"> <?php echo $p_ligandCAvityRecovery; if($p_ligandCAvityRecovery==null)echo "-"; ?> </td>
                        </tr>
                        
                    </tbody>
                </table>

            <center>
            </div>
            
        
        </div>
    </body>
</html>