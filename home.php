<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must login first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy ();
		unset($_SESSION['username']);
		header('location: login.php');
	}
	$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
	file_put_contents('UIDContainer.php',$Write);
?>

<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<script src="js/bootstrap.min.js"></script>
		<!-- Load an icon library -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<link href="https://fonts.googleapis.com/css2?family=Kanit&family=Playfair+Display:wght@500&family=Prompt&family=Taviraj&family=Trirong&display=swap" rel="stylesheet">
		
		<style>
		
			h1 { font-family: 'Kanit', sans-serif}
			h2 { font-family: 'Playfair Display', serif;}
			h3 { font-family: 'Prompt', sans-serif;}
			li { font-family: 'Playfair Display', sans-serif;}

			html 
			{	
				font-family: 'Prompt', sans-serif;
				
				display: inline-block;
				margin: 0px auto;
				text-align: center;
			}

			ul.topnav {
				list-style-type: none;
				margin: auto;
				padding: 0;
				overflow: hidden;
				background-color: #333;
				width: 100%;
			}

			ul.topnav li {float: left;}

			ul.topnav li a {
				display: block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}

			ul.topnav li a:hover:not(.active) {background-color: #7f7f7f;}
			ul.topnav li a.active {background-color: #ff6535;}
			ul.topnav li.right {float: right;}

			@media screen and (max-width: 600px) {
				ul.topnav li.right, 
				ul.topnav li {float: none;}
			}

			img {
				display: block;
				margin-left: auto;
				margin-right: auto;
			}
		</style>
	
	<!--Map-->
	<style type="text/css">
                        body {
                            font-family: 'Kanit', sans-serif;
                            font-size: 15px;
                        }

                        #map {
                            top: 170px;
                            padding: 30px;
                            position: absolute;
                            width: 50%;
                            height: 470px;
							margin-left: 370px;
                            
                            
                        }
                /*
                        #show {
                            background-color: #ffffff;
                            border: 1px solid #2d2f37;
                            border-radius: 3px;
                            padding: 15px;
                            position: fixed;
                            right: 20px;
                            top: 20px;
                            vertical-align: middle;
                        }
                */
                        .labelTxt {
                            width: 60px;
                            display: inline-block;
                            padding-right: 5px;
                        }

                        .loadingWidget {
                            position: absolute;
                            width: 100%;
                            height: 100%;
                            background: White url('https://developer.nostramap.com/developer/V2/images/loader.gif') no-repeat fixed center center;
                            filter: alpha(opacity=60);
                            opacity: 0.6;
                            z-index: 10000;
                            vertical-align: middle;
                            top: 0px;
                            left: 0px;
                        }

                        .stage-value {
                            float: left;
                            background: #fff;
                            padding-top: 4px;
                            padding-bottom: 4px;
                            border: 1px solid #adadad;
                            margin-right: 10px;
						    width: 40px;
                            text-align: center;
                        }

                        #divLang label:hover, #divLang input:hover {
                            cursor: pointer;
                        }
    </style>

	<script type="text/javascript" src="//api.nostramap.com/nostraapi/v2.0?key=GOxQQtdmC5KMtuUxe(KnbpBxyLXlWIRuJU1e(Wz0nfHiBIeRipI)oKCFHvA)4d9asslulelApKSbw8i(CuGkqb0=====2"></script>

		<script type="text/javascript">
			var map;
			var baseMapCountry = "TH";
			var isFirstLoad = true;
			var menuName = null; // ST: street Map; OP: openStreetMap; IM: imagery; HY: hybrid; PM: PremimumMap

			nostra.onready = function () {
				nostra.config.Language.setLanguage(nostra.language.E);
				initialize();
			};

			function initialize() {
        map = new nostra.maps.Map("map", {
            id: "mapTest",
            logo: true,
            scalebar: true,
            basemap: "OpenStreetMap",
            slider: true,
            level: 17,
            lat: 13.650888,
            lon: 100.494130,
            country: baseMapCountry
        });

		var arrCallout =
		[
			{
				title: "KMUTT ประตู3",
				content: "จำนวนสายที่ลงทะเบียนทั้งหมด 12 สาย<br>ไม่พบสายไม่ลงทะเบียน",
				latitude: "13.649036",
				lontitude: " 100.492788"
				
			},
			{
				title: "KMUTT ประตู1", 
				content: "จำนวนสายที่ลงทะเบียนทั้งหมด 9 สาย<br>พบสายไม่ลงทะเบียน 10 สาย",
				latitude: "13.651098",
				lontitude: "100.496573"
			}
		];
		var calloutLayer = new nostra.maps.layers.GraphicsLayer(map, { id: "calloutLayer" });
		for (var i in arrCallout){
			nostraCallout = new nostra.maps.Callout({
				title: arrCallout[i], content: arrCallout[i] 
			});
			point = new nostra.maps.symbols.Marker({
				url: "", width: 60, height: 60,attributes: { title: arrCallout[i], content: arrCallout[i] }, 
				callout: nostraCallout
			});
			map.addLayer(calloutLayer);
			calloutLayer.addMarker(arrCallout[i].latitude, arrCallout[i].lontitude, point);
		};
				map.events.layerAddComplete = function (e) {
					if (!isFirstLoad) {
						hideLoading();
					}
				};
				map.events.load = function () {
					hideLoading();
					isFirstLoad = false;
				};
			}
			function switchStreetMap() {
				showLoading();
				menuName = "ST";

				document.getElementById('txtCountry').value = baseMapCountry;
				document.getElementById('divCountry').innerHTML = baseMapCountry;
				document.getElementById("divTextBox").style.display = "inline-block";
				document.getElementById("divCountry").style.display = "none";
				document.getElementById("divLang").style.display = "block";
				document.getElementById("divCountry").style.display = "block";
				document.getElementById("optCountry").style.display = "block";
				document.getElementById("optCountryPre").style.display = "none";

				map.removeAllLayers();
				map.country = baseMapCountry;
				var streetMapLayer = new nostra.maps.layers.StreetMap(map);
				map.addLayer(streetMapLayer);

				map.map.onExtentChange = null;
			}
			function switchOSM() {
				showLoading();
				menuName = "OP";

				document.getElementById('txtCountry').value = "TH";
				document.getElementById("divTextBox").style.display = "none";
				document.getElementById("divCountry").innerHTML = "ALL";
				document.getElementById("divCountry").style.display = "";
				document.getElementById("divLang").style.display = "none";
				document.getElementById("optCountry").style.display = "none";
				document.getElementById("optCountryPre").style.display = "none";

				map.removeAllLayers();

				setTimeout(function () {
					var basemapObj = new nostra.maps.layers.OpenStreetMap(map);
					map.addLayer(basemapObj);
				}, 100);

				map.map.onExtentChange = null;
			}
			function switchImagery() {
				showLoading();
				menuName = "IM";

				document.getElementById('txtCountry').value = "TH";
				document.getElementById("divTextBox").style.display = "none";
				document.getElementById("divCountry").innerHTML = "ALL";
				document.getElementById("divCountry").style.display = "";
				document.getElementById("divLang").style.display = "none";
				document.getElementById("optCountry").style.display = "none";
				document.getElementById("optCountryPre").style.display = "none";

				map.removeAllLayers();

				var imageryLayer = new nostra.maps.layers.Imagery(map);
				map.addLayer(imageryLayer);

				map.map.onExtentChange = null;
			}
			function switchHybrid() {
				showLoading();
				menuName = "HY";

				document.getElementById('txtCountry').value = "TH";
				document.getElementById("divTextBox").style.display = "none";
				document.getElementById("divCountry").innerHTML = "TH";
				document.getElementById("divCountry").style.display = "";
				document.getElementById("divLang").style.display = "none";
				document.getElementById("optCountry").style.display = "none";
				document.getElementById("optCountryPre").style.display = "none";

				map.removeAllLayers();
				map.country = "TH";

				var imageryLayer = new nostra.maps.layers.Imagery(map);
				map.addLayer(imageryLayer);
				var hybridLineLayer = new nostra.maps.layers.HybridLine(map);
				map.addLayer(hybridLineLayer);
				var hybridMaxExtent = {
					xmin: 11190801.096984113, ymin: 1544817.0653681569, xmax: 11191616.823395455, ymax: 1545198.056181068,
					spatialReference: { wkid: 102100 }
				};
				map.map.extent.update(hybridMaxExtent.xmin, hybridMaxExtent.ymin, hybridMaxExtent.xmax, hybridMaxExtent.ymax, map.map.spatialReference);
				map.map.setExtent(map.map.extent);
			}
			function switchPremiumMap() {
				showLoading();
				menuName = "PM";

				document.getElementById('txtCountry').value = "TH";
				document.getElementById("divTextBox").style.display = "none";
				document.getElementById("divCountry").innerHTML = "TH";
				document.getElementById("divCountry").style.display = "";
				document.getElementById("divLang").style.display = "block";
				document.getElementById("optCountry").style.display = "none";
				document.getElementById("optCountryPre").style.display = "block";

				map.removeAllLayers();
				map.country = "TH";

				var streetMapLayer = new nostra.maps.layers.StreetMap(map);
				map.addLayer(streetMapLayer);
				var premiumMapLayer = new nostra.maps.layers.PremiumMap(map);
				map.addLayer(premiumMapLayer);

				// Lock Level PremiumMap
				var lastExtent = null;

				var premiumMaxExtent = {
					xmin: 11190801.096984113, ymin: 1544817.0653681569, xmax: 11191616.823395455, ymax: 1545198.056181068,
					spatialReference: { wkid: 102100 }
				};

				var premiumMaxLods = 18;
				var premiumMinLods = 19;

				map.map.extent.update(premiumMaxExtent.xmin, premiumMaxExtent.ymin, premiumMaxExtent.xmax, premiumMaxExtent.ymax, map.map.spatialReference);
				map.map.setExtent(map.map.extent);

				map.map.onExtentChange = function (extent, delta, levelChange, lod) {
					if (levelChange) {
						if (lod.level < premiumMaxLods) {
							map.zoomLevel(18);
						} else if (lod.level > premiumMinLods) {
							map.zoomLevel(19);
						}
					}
					else {
						var condXmin = extent.xmin >= premiumMaxExtent.xmin;
						var condXmax = extent.xmax <= premiumMaxExtent.xmax;
						var condYmin = extent.ymin >= premiumMaxExtent.ymin;
						var condYmax = extent.ymax <= premiumMaxExtent.ymax;
						var condLarge = condXmin && condXmax && condYmin && condYmax;

						if (!condLarge) {
							map.map.extent.update(premiumMaxExtent.xmin, premiumMaxExtent.ymin, premiumMaxExtent.xmax, premiumMaxExtent.ymax, map.map.spatialReference);
							map.map.setExtent(map.map.extent);
						}
					}
				};
			}
			function switchCountry() {
				var id = document.getElementById('txtCountry').value;
				baseMapCountry = id;
				map.country = id;
				map.level = null;
				map.lat = null;
				map.lon = null;
				map.removeAllLayers();
				var streetMapLayer = new nostra.maps.layers.StreetMap(map);
				map.addLayer(streetMapLayer);

				document.getElementById('divCountry').innerHTML = document.getElementById('txtCountry').value;
			}
			function switchLang() {
				var rdoChk = document.getElementById("rdoSetE").checked;
				if (rdoChk) {
					nostra.config.Language.setLanguage(nostra.language.E);
				} else {
					nostra.config.Language.setLanguage(nostra.language.L);
				}
				if (menuName == "PM") { // Premium Map Menu
					document.getElementById("btnPremiumMap").click();
				}
			}
			function showLoading() {
				document.getElementById("dlgLoading").style.display = "block";
			}
			function hideLoading() {
				document.getElementById("dlgLoading").style.display = "none";
			}
	</script>


		
		<title>Home : RFID THESIS </title>
	</head>
	
	<body>
		<h2>Inspection System for Overhead Communication Cable on Utility Pole</h2>
		<ul class="topnav">
					<li><a class="active" href="home.php"> <i class="fa fa-fw fa-home"></i> Home</a></li>
					<li><a href="cable_data.php"> <i class="fas fa-book"></i> Cable Data</a></li>
					<li><a href="insp_his.php"> <i class="fa fa-file-text"></i> Inspection History </a></li>
					<li><a href="read tag.php"> <i class="fa fa-fw fa-search"></i> Read Tag ID</a></li>
					<li><a class="text-right" href="home.php?logout='1'" style="color: red;">Logout</a></li>
				</ul>	
		<br>
		
    	
		<div class="subtoppic" >
		<!-- <h2>Inspection System</h2> 
		<h3>(ระบบตรวจสอบสายสื่อสาร)</h3> -->
		<h2> <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p></h2>
    	
		</div>
		



		<!-- Map --> 
        <div id="map">
        </div> 
		

		




	</body>
</html>