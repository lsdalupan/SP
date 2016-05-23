<?php  
    session_start();  
  
    if(!$_SESSION['username']){  
  
        header("Location: login.php");//redirect to login page to secure the welcome page without login access.  
    }  
  
?>

<DOCTYPE html>
<html>
<!--<title>A simple Jsmol example</title>-->
<head>
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
        
       <script type="text/javascript" src="jsmol/js/JSmoljQuery.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolCore.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolApplet.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolApi.js"></script>
        <script type="text/javascript" src="jsmol/js/j2sjmol.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmol.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolControl.js"></script>
        <script type="text/javascript" src="jsmol/js/Jmol2.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmol.full.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolMenu.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolConsole.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolJSV.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolTM.js"></script>
        <script type="text/javascript" src="jsmol/js/SwingJS.js"></script>
        
        
        <!-- // following two only necessary for WebGL version: -->
        <script type="text/javascript" src="jsmol/js/JSmolThree.js"></script>
        <script type="text/javascript" src="jsmol/js/JSmolGLmol.js"></script>

<script type="text/javascript">
    var Info = {
    width:800,
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
</head>

<body>
    <div class="body">
            <?php
                include("header.php");  
            ?>
        <center>
        <h5>Protein</h5>
        <div class="main container">
        
           <!-- <form onSubmit="getFilePath();" >
                <div class="file-field input-field">
                <div class="btn">
                    <span>File</span>
                    <input type="file" id="fileName">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" id="fileName">
                </div>
                </div>
                <a value="show" id="show" class="btn">Visualize</a>
                   
                </button>
            </form>-->
             <div id="loadpanel" ></div>
             <br>
            <div class="col s8">
                <script type="text/javascript">
                    jmolApplet0 = Jmol.getApplet("jmolApplet0", Info);
                    Jmol.script(jmolApplet0,"background black");
                   
                   $(document).ready(function(){	
                        Jmol.setButtonCss(null, "class='btn'");	
                        $("#loadpanel").html(
                            Jmol.jmolButton(jmolApplet0,"load ? ","Load FILE")
                        )
                        
                        
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

                            $("#leftpanel").html(
                                "Spin "
                                + Jmol.jmolRadioGroup(jmolApplet0, spinRadios)
                                +(true || isApplet ? 
                                '<br>Drag-Minimize '
                                + Jmol.jmolRadioGroup(jmolApplet0, dragRadios)  
                                : "")
                                + "<br>Model Kit Mode "
                                + Jmol.jmolRadioGroup(jmolApplet0, modelRadios)  
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
                            Jmol.jmolButton(jmolApplet0,(isApplet ? "minimize" : "set forceField UFF;minimize"),"Minimize (MMFF94)")
                            +Jmol.jmolButton(jmolApplet0,"select *;if ($s1) {isosurface s1 delete} else {calculate partialcharge;isosurface s1 vdw map MEP translucent}","show/hide MEP")
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
                    });

                    
                </script>
            </div>
            <div id="lowerpanel"></div>
            <div class="row">
                <div class="collection col s6">
                    <div id="leftpanel"></div>
                </div>
                <div class="collection col s6">
                    <div id="rightpanel"></div>
                </div>
            </div>
            <br>
           <!-- <a href="javascript:Jmol.script(jmolApplet0,'spin on')"><button class="btn amber darken-1 waves-effect waves-block waves-light">spin</button></a>
            <a href="javascript:Jmol.script(jmolApplet0,'spin off')">off</a>
            -->
            
            <!-- Switch -->
           
        </center>
        </div>
    </div>
</body>