<!DOCTYPE html>
<html>
<?php include 'insp_db.php';
$fileupload = $_FILES['fileCSV']['tmp_name'];
$fileupload_name = $_FILES['fileCSV']['name'];
if(isset($_POST['import'])){
if($fileupload){
    $arrayfile = explode(".",$fileupload_name);
   // $lastname = strtolower($arrayfile);
    $filename = $arrayfile[0];//ชื่อไฟล์
    $filetype = $arrayfile[1];//นามสกุลไฟล์
    if($filetype=="csv"){
    move_uploaded_file($_FILES["fileCSV"]["tmp_name"],$_FILES["fileCSV"]["name"]);
    $pdo = Database::connect();
    $objCSV = fopen($_FILES["fileCSV"]["name"], "r");
        while (($objArr = fgetcsv($objCSV, 1000,",")) !== FALSE) {
	    $strSQL = "INSERT INTO table_insp_his ";
	    $strSQL .="(name,id,classification,type,description,company,phone,note) ";
	    $strSQL .="VALUES ";
	    $strSQL .="('".$objArr[0]."','".$objArr[1]."','".$objArr[2]."' ,'".$objArr[3]."'";
        $strSQL .=",'".$objArr[4]."','".$objArr[5]."','".$objArr[6]."','".$objArr[7]."') ";
        $objQuery = $pdo->query($strSQL);
        }   
        fclose($objCSV);
        header('location: insp_his.php');
    }
    else{             
    }
}
}
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<script src="jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<link href="https://fonts.googleapis.com/css?family=Kanit|Playfair+Display|Prompt&display=swap" rel="stylesheet">
		<script>
			$(document).ready(function(){
				 $("#getUID").load("UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("UIDContainer.php");
				}, 500);
			});
		</script>
		<style>
		h1 { font-family: 'Kanit', sans-serif}
		h2 { font-family: 'Playfair Display', serif;}
		h3 { font-family: 'Prompt', sans-serif;}
		li { font-family: 'Playfair Display', sans-serif;}
		html {
			font-family: Arial;
			display: inline-block;
			margin: 0px auto;
		}
		textarea {
			resize: none;
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
		</style>
    <title>Cable Data : RFID THESIS</title>
</head>
<body>
<br><br><br>
<center><img src="errorpic.png" class="img-rounded" alt="Cinque Terre" style="width:5%"></center>
<br><br>
<center> <h1>เกิดข้อผิดพลาด</h1> </center>
<center> <h2>กรุณาอัพโหลดไฟล์ที่เป็นนามสกุลไฟล์ .csv</h2> </center><br>
<center><a class="btn" href="insp_his.php">Back</a> </center>
</body>
</html>