<?php
    require 'cable_db.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }   
    $pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM table_cable_data where id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($id));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();	
	$msg = null;
	if (null==$data['name']) {
		$msg = "The ID of this Cable is not registered !!!";
		$data['id']=$id;
		$data['name']="&nbsp;";
		$data['classification']="&nbsp;";
		$data['type']="&nbsp;";
		$data['description']="&nbsp;";
		$data['company']="&nbsp;";
		$data['phone']="&nbsp;";
		$data['note']="&nbsp;";
	} else {
		$msg = null;
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
		<link href="https://fonts.googleapis.com/css2?family=Kanit&family=Playfair+Display:wght@500&family=Prompt&family=Taviraj&family=Trirong&display=swap" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
			td.lf {
				padding-left: 15px;
				padding-top: 12px;
				padding-bottom: 12px;
			}
		</style>
	</head>
		<body>	
			<div>
				<form>
					<table  width="452" border="1" bordercolor="#ff6535" align="center"  cellpadding="0" cellspacing="1"  bgcolor="#000" style="padding: 2px">
						<tr>
							<td  height="40" align="center"  bgcolor="#ff6535"><font  color="#FFFFFF">
							<h2> <i class="far fa-eye"></i> Cable Data</h2></font>
						</tr>
						<tr>
							<td bgcolor="#f9f9f9">
								<table width="452"  border="0" align="center" cellpadding="5"  cellspacing="0">
								<tr>
										<td width="113" align="left" class="lf">ID</td>
										<td style="font-weight:bold">:</td>
										<td align="left"><?php echo $data['id'];?></td>
									</tr>
									<tr bgcolor="#f2f2f2">
										<td align="left" class="lf">Location</td>
										<td style="font-weight:bold">:</td>
										<td align="left"><?php echo $data['name'];?></td>
									</tr>
									<tr>
										<td align="left" class="lf">Classification</td>
										<td style="font-weight:bold">:</td>
										<td align="left"><?php echo $data['classification'];?></td>
									</tr>
									<tr bgcolor="#f2f2f2">
										<td align="left" class="lf">Type</td>
										<td style="font-weight:bold">:</td>
										<td align="left"><?php echo $data['type'];?></td>
									</tr>
									<tr>
										<td align="left" class="lf">Description</td>
										<td style="font-weight:bold">:</td>
										<td align="left"><?php echo $data['description'];?></td>
									</tr>
									<tr bgcolor="#f2f2f2">
										<td align="left" class="lf">Company</td>
										<td style="font-weight:bold">:</td>
										<td align="left"><?php echo $data['company'];?></td>
									</tr>
									<tr>
										<td align="left" class="lf">Phone</td>
										<td style="font-weight:bold">:</td>
										<td align="left"><?php echo $data['phone'];?></td>
									</tr>
									<tr bgcolor="#f2f2f2">
										<td align="left" class="lf">Note</td>
										<td style="font-weight:bold">:</td>
										<td align="left"><?php echo $data['note'];?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<p style="color:red;"><?php echo $msg;?></p>
		</body>
</html>