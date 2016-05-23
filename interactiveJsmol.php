<!DOCTYPE html>
<html>
<head>
	<title>JSmol -- platform-aware Jmol using jQuery</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="jsmol/js/JSmol.full.js"></script>

<script type="text/javascript">

// simple2.htm: demonstration of using platform-aware Jmol with jQuery
// author: Bob Hanson hansonr@stolaf.edu 8/11/2012 8:21:03 AM

// ---------------------------------------------------------------------------------

////// special stuff just for this particular page

var s = unescape(document.location.search);
var xxxx = s.split("_USE=")[0]
if (xxxx.length < 2) {
	xxxx = "ethanol"
	script = 'set errorCallback "myCallback";'
	+'set zoomlarge false;set echo top left;echo loading XXXX...;refresh;'
	+'load ":XXXX";set echo top center;echo XXXX;'
	+''
	script = script.replace(/XXXX/g, xxxx)
} else {
	script = xxxx.substring(1)
}

// ---------------------------------------------------------------------------------

////// every page will need one variable and one Info object for each applet object

var Info = {
	width: 500,
	height: 300,
	script: script,
	use: "HTML5",
	jarPath: "java",
	j2sPath: "jsmol/j2s",
	jarFile: "JmolAppletSigned.jar",
	isSigned: false,
	addSelectionOptions: false,
// 	serverURL: "http://chemapps.stolaf.edu/jmol/jsmol/php/jsmol.php",
	readyFunction: null,
 	console: "jmol_infodiv",
	disableInitialConsole: true,
	defaultModel: null,
	debug: false
}

	// this next bit just allows us to see what platform we are on
	// based on our decisions indicated in Info

	// "true" here indicates just a check

	Jmol.getApplet("appletCheck", Info, true);
	var isApplet = (appletCheck._jmolType.indexOf("_Applet") >= 0);
	var is2D = appletCheck._is2D;

	if (!isApplet && !Info.script) {

		// JSmol or image

		Info.defaultModel = "$tylenol";
		Info.script = "#alt:LOAD :tylenol";
		
	

	}

// The actual applet will be jmol._applet (if it turns out to be an actual Applet),
// but we will never access that directly.

$(document).ready(function(){	
		
	// This demonstration shows that
	// what is put on the page can depend upon the platform.

	// Note that the use of $(document.ready()) is optional but preferred. 
	// You can do the traditional in-body coding if you want. See also simple2-nojq.htm.
	// But as Gusts Kaksis pointed out, if we are using jQuery for database lookups, we might
	// as well use it for more than that. 
  
  // note that we create the applet first, before the controls, because
  // we need window.jmol to be defined for those, and Jmol.getAppletHtml does that.
  
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
		["set background white", "white", true],
		["set background black", "black"]
		];

		$("#leftpanel").html(
		  '<a target="_blank" href="data/chairflip.png">images</a> '
			+ '<a target="_blank" href="simple2.htm?script%20data/cyclflip2.spt;//&_USE=' + use + '">cyclohexane ring flip</a> '
			+ '<a href="simple2.htm?_USE=' + use + '">back</a><br>'
			+ (true || isApplet ? 
			'Drag-Minimize '
			+ Jmol.jmolLink(jmol,"set picking dragMinimize", "on")  
			+ "    " + Jmol.jmolLink(jmol,"set picking ident", "off")
			: "")

			+ "<br>Model Kit Mode "
			+ Jmol.jmolLink(jmol,"set modelkitmode", "on")
			+ "    "
			+ Jmol.jmolLink(jmol,"set modelkitmode off", "off")
			+ "<br>Display calculated MMFF94 energy "
			+ Jmol.jmolLink(jmol,"set minimizationSteps 200;set loadstructcallback 'minimize energy';set minimizationcallback '';set echo top left;echo @{'' + _minimizationEnergy + ' ' + energyUnits + '/mol'};minimize energy", "on")
			+ "    "
			+ Jmol.jmolLink(jmol,"echo @{''};set minimizationCallback '';set loadstructcallback ''", "off")
			+ "<br>Energy Units "
			+ Jmol.jmolLink(jmol,"set energyunits kcal;minimize energy", "kcal/mol")
			+ "    "
			+ Jmol.jmolLink(jmol,"set energyunits kJ;minimize energy", "kJ/mol")
			+ "<br>Background: "
			+ Jmol.jmolRadioGroup(jmol, radios)
		);

  // right panel
  
	Jmol.setButtonCss(null, "style='width:160px'");	
	$("#rightpanel").html(
		Jmol.jmolButton(jmol,"if (!molname) { molname = 'tylenol'};var x = prompt('Enter the name or identifier (SMILES, InChI, CAS) of a molecule',molname);if (!x) { quit }; molname = x; load @{'$' + molname} #alt:LOAD $??Enter a model name","Load MOL (NCI)")
		+ "<br>"
		+ Jmol.jmolButton(jmol,"if (!molname) { molname = 'tylenol'};var x = prompt('Enter the name of a compound',molname);if (!x) { quit }; molname = x; load @{':' + molname} #alt:LOAD :??Enter a model name","Load MOL (PubChem)")
		+ (isApplet ? 
		"<br>"
		+ Jmol.jmolButton(jmol,(isApplet ? "minimize" : "set forceField UFF;minimize"),"Minimize (MMFF94)")
		: "")
 		+ (isApplet ?
		"<br>"
		+ Jmol.jmolButton(jmol,"load ? ","Load URL")
		+ "<br>"
		+ Jmol.jmolButton(jmol,"load ? ","Load FILE")
		+ "<br>"
		+ Jmol.jmolButton(jmol,"script ?.spt","Load SCRIPT")
		: "")
		+ "<br><br>"
		+ Jmol.jmolButton(jmol,"select *;if ($s1) {isosurface s1 delete} else {calculate partialcharge;isosurface s1 vdw map MEP translucent}","show/hide MEP")
		+ "<br><br>"
		+ (isApplet ?
// no longer works		Jmol.jmolButton(jmol,"show NMR","Predict NMR")
//		+ "<br><br>"
		Jmol.jmolButton(jmol,"write FILE ?","Save FILE")
		+ "<br>"
		+ Jmol.jmolButton(jmol,"write PNGJ ?.png","Save PNG")
		+ "<br><br><a href=simple2.htm?_USE=HTML5>HTML5 version</a>"
		+ "<br><br><a href=simple2.htm?_USE=SIGNED>(Signed) Java version</a>"
		+ "<br><br>" + Jmol.jmolLink(jmol, "JSCONSOLE", "show info")
		: 
		"<br><br>"
		+ Jmol.jmolButton(jmol,"write FILE ?","Save FILE")
		+ "<br>"
		+ Jmol.jmolButton(jmol,"write PNGJ ?.png","Save PNG")
		+ "<br><br><a href=simple2.htm?_USE=SIGNED>JAVA version</a>"
    + "<br><br><a href=javascript:Jmol.showInfo(jmol,true)>show info</a>"
    )
	);
	
	// lower panel:
			
	Jmol.setButtonCss(null,"style='width:120px'");
	var s = "<br>"
		+ Jmol.jmolButton(jmol,"wireframe -0.1 #alt:SETTING Line", "wireframe")
		+ Jmol.jmolButton(jmol,"spacefill only;spacefill 23%;wireframe 0.15 #alt:SETTING Ball and Stick","ball&stick");
		s += Jmol.jmolButton(jmol,"spacefill #alt:SETTING van der Waals Spheres", "spacefill");	
		Jmol.setButtonCss(null,"style='width:100px'");
	
		s += "<br>"

    s += Jmol.jmolButton(jmol,"console");
		
    s += Jmol.jmolCommandInput(jmol);
    
    
	$("#lowerpanel").html(s);
})

//]]>

</script>
</head>
<body>
<table style="margin-left:auto; margin-right:auto;">
	<tr>
		<td><div id="leftpanel"></div></td>
		<td><div id="middlepanel"></div></td>
		<td><div id="rightpanel"></div></td>
	</tr>
	<tr>
		<td></td>
		<td style="text-align:center"><div id="lowerpanel"></div></td>
		<td></td>
	</tr>
</table>
<div id="console"></div>
</body>
</html>