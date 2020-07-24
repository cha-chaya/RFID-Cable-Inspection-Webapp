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
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
		<link href="https://fonts.googleapis.com/css2?family=Kanit&family=Playfair+Display:wght@500&family=Prompt&family=Taviraj&family=Trirong&display=swap" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<script src="jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<script>
			$(document).ready(function(){
				$("#getUID").load("UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("UIDContainer.php");	
				}, 500);
			});
		</script>
		<style>
		body {
			font-family: 'Kanit', sans-serif;
			font-size: 15px;
				}
		h1 { font-family: 'Kanit', sans-serif}
		h2 { font-family: 'Playfair Display', serif;}
		h3 { font-family: 'Prompt', sans-serif;}
		li { font-family: 'Playfair Display', sans-serif;}
		html {
			font-family: Arial;
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
		td.lf {
			padding-left: 15px;
			padding-top: 12px;
			padding-bottom: 12px;
		}
		</style>		
		<title>Read Tag : RFID THESIS</title>
	</head>	
		<body>
				<h2 align="center">Inspection System for Overhead Communication Cable on Utility Pole</h2>
					<ul class="topnav">
						<li><a href="home.php"> <i class="fa fa-fw fa-home"></i> Home</a></li>
						<li><a href="cable_data.php"> <i class="fas fa-book"></i> Cable Data</a></li>
						<li><a href="insp_his.php"> <i class="fa fa-file-text"></i> Inspection History </a></li>
						<li><a class="active" href="read tag.php"> <i class="fa fa-fw fa-search"></i> Read Tag ID</a></li>
						<li><a class="text-right" href="home.php?logout='1'" style="color: red;">Logout</a></li>
					</ul>		
				<br>		
					<h2 align="center" id="blink">Please Tag to Display ID And Cable Data</h2>		
					<p id="getUID" hidden></p>		
				<br>
			<div id="show_user_data">
				<form>
					<table  width="452" border="1" bordercolor="#7f7f7f" align="center"  cellpadding="0" cellspacing="1"  bgcolor="#000" style="padding: 2px">
						<tr>
							<td  height="40" align="center"  bgcolor="#7f7f7f"><font  color="#FFFFFF">
								<h2> <i class="far fa-eye"></i> Cable Data</h2>
								</font>
							</td>
						</tr>
						<tr>
							<td  bgcolor="#f9f9f9">
								<table width="452"  border="0" align="center" cellpadding="5"  cellspacing="0">
								<tr>
										<td width="113" align="left" class="lf">ID</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr bgcolor="#f2f2f2">
										<td align="left" class="lf">Location</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>								
										<td align="left" class="lf">Classification</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr>
									<tr bgcolor="#f2f2f2">
										<td align="left" class="lf">Type</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>								
										<td align="left" class="lf">Description</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr>
									<tr bgcolor="#f2f2f2">
										<td align="left" class="lf">Company</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
										<td align="left" class="lf">Phone</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
									<tr>
									<tr bgcolor="#f2f2f2">
										<td align="left" class="lf">Note</td>
										<td style="font-weight:bold">:</td>
										<td align="left">--------</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<script>
				var myVar = setInterval(myTimer, 1000);
				var myVar1 = setInterval(myTimer1, 1000);
				var oldID="";
				clearInterval(myVar1);
				function myTimer() {
					var getID=document.getElementById("getUID").innerHTML;
					oldID=getID;
					if(getID!="") {
						myVar1 = setInterval(myTimer1, 500);
						showUser(getID);
						clearInterval(myVar);
					}
				}
				function myTimer1() {
					var getID=document.getElementById("getUID").innerHTML;
					if(oldID!=getID) {
						myVar = setInterval(myTimer, 500);
						clearInterval(myVar1);
					}
				}
				function showUser(str) {
					if (str == "") {
						document.getElementById("show_user_data").innerHTML = "";
						return;
					} else {
						if (window.XMLHttpRequest) {
							// code for IE7+, Firefox, Chrome, Opera, Safari
							xmlhttp = new XMLHttpRequest();
						} else {
							// code for IE6, IE5
							xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.onreadystatechange = function() {
							if (this.readyState == 4 && this.status == 200) {
								document.getElementById("show_user_data").innerHTML = this.responseText;
							}
						};
						xmlhttp.open("GET","read_tag_cable.php?id="+str,true);
						xmlhttp.send();
					}
				}
				var blink = document.getElementById('blink');
				setInterval(function() {
					blink.style.opacity = (blink.style.opacity == 0 ? 1 : 0);
				}, 750); 
			</script>
		</body>
</html>