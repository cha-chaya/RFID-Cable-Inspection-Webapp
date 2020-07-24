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
?>
<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<link href="https://fonts.googleapis.com/css2?family=Kanit&family=Playfair+Display:wght@500&family=Prompt&family=Taviraj&family=Trirong&display=swap" rel="stylesheet">
		<style>
			body {
				font-family: 'Kanit', sans-serif;
				font-size: 15px;
			}
			h1 { font-family: 'Trirong', serif;}
			h2 { font-family: 'Playfair Display', serif;}
			h3 { font-family: 'Prompt', sans-serif;}
			li { font-family: 'Playfair Display', sans-serif;}
			html {
				font-family: Arial;
				display: inline-block;
				margin: 0px auto;
			}
			textarea {resize: none;}
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
		<title>RFID : THESIS</title>	
	</head>
	<body> <br /><br />
		<h1 align="center">แก้ไขข้อมูลสายสื่อสาร</h1>	
		<br />
		<div class="container">
			<div class="center" style="margin: 0 auto; width:495px; border-style: solid; border-color: #f2f2f2;">
				<div class="row">
					<p id="defaultGender" hidden><?php echo $data['gender'];?></p>
				</div>
				<form class="form-horizontal" action="edit_tb_cable.php?id=<?php echo $id?>" method="post">
				<div class="control-group">
				<br />
						<label class="control-label">Location</label>
						<div class="controls">
							<input name="name" type="text"  placeholder="" value="<?php echo $data['name'];?>" required>
						</div>
					</div>
				<div class="control-group">
						<label class="control-label">ID</label>
						<div class="controls">
							<input name="id" type="text"  placeholder="" value="<?php echo $data['id'];?>" readonly>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Classification</label>
						<div class="controls">
						<select required name="classification" class="form-control">
                        <option value="<?php echo $data['classification']; ?>"><?php echo $data['classification'];?></option>
                            <option value="Coaxial">Coaxail</option>
                            <option value="Fiber optic">Fiber optic</option>
                            <option value="UTP">UTP</option>
                        </select>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Type</label>
						<div class="controls">
						<select required name="type" class="form-control">
                            <option value="<?php echo $data['type'];?>"><?php echo $data['type'];?></option>
                            <optgroup label = "Coaxial">  <!--แบ่งสัดส่วน-->
                            <option value="RG6">RG6</option>
                            <option value="RG11">RG11</option>
                            <optgroup label = "Fiber optic">
                            <option value="ADSS">ADSS</option>  
							<option value="Drop Wire">Drop Wire</option>
              				<option value="FTTH Flat">FTTH Flat</option>
              				<option value="FTTH Round cable">FTTH Round cable</option>
              				<option value="FR-LSZH">FR-LSZH</option>
              				<option value="Figure-8">Figure-8</option>
                            <optgroup label = "UTP">
                            <option value="CAT5">CAT5</option>
                            <option value="CAT6">CAT6</option>
                        </select>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Description</label>
						<div class="controls">
						<select required name="description" class="form-control">
                            <option value="<?php echo $data['description'];?>"><?php echo $data['description'];?></option>
                            <optgroup label = "Coaxial และ UTP">
                            <option value="CCTV">CCTV</option>
                            <option value="CATV">CATV</option>
                            <option value="Internet">Internet</option>
                            <optgroup label = "Fiber optic">
                            <option value="SM 6 core">SM 6 core</option>
							<option value="SM 12 core">SM 12 core</option>
							<option value="SM 24 core">SM 24 core</option>
							<option value="MM 6 core">MM 6 core</option>
							<option value="MM 12 core">MM 12 core</option>
							<option value="MM 24 core">MM 24 core</option>
                            <option value="UNKNOW">UNKNOW</option>
                        </select>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Company</label>
						<div class="controls">
							<input name="company" type="text" placeholder="" value="<?php echo $data['company'];?>" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Phone</label>
						<div class="controls">
							<input name="phone" type="text"  placeholder="" value="<?php echo $data['phone'];?>" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Note</label>
						<div class="controls">
							<input name="note" type="text"  placeholder="" value="<?php echo $data['note'];?>" >
						</div>
					</div>
					
					<div class="form-actions">
						<button type="submit" class="btn btn-success">Update</button>
						<a class="btn" href="cable_data.php">Back</a>
					</div>
				</form>
			</div>               
		</div> <!-- /container -->	
		<script>
			var g = document.getElementById("defaultGender").innerHTML;
			if(g=="Male") {
				document.getElementById("mySelect").selectedIndex = "0";
			} else {
				document.getElementById("mySelect").selectedIndex = "1";
			}
		</script>
	</body>
</html>