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
		<link href="https://fonts.googleapis.com/css2?family=Kanit&family=Playfair+Display:wght@500&family=Prompt&family=Taviraj&family=Trirong&display=swap" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
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
			h2 { font-family: 'Playfair Display', serif; text-align: center;}
			h3 { font-family: 'Prompt', sans-serif;}
			li { 
				font-family: 'Playfair Display', sans-serif;
				text-align: center;
			}
			form { 
				font-family: 'Prompt', sans-serif;;
				text-align: right;
				margin: 0px auto;
				padding-right : 58px;
			}
			html {
				font-family: Arial;
				display: inline-block;
				margin: 0px auto;
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
			.table {
				margin: auto;
				width: 90%; 
			}		
			thead {color: #FFFFFF;}
		</style>		
		<title>Inspection History : RFID THESIS</title>
	</head>	
	<body>
		<h2>Inspection System for Overhead Communication Cable on Utility Pole</h2>
		<ul class="topnav">
			<li><a href="home.php"> <i class="fa fa-fw fa-home"></i> Home</a></li>
			<li><a href="cable_data.php"> <i class="fas fa-book"></i> Cable Data</a></li>
			<li><a class="active" href="insp_his.php"> <i class="fa fa-file-text"></i> Inspection History </a></li>
			<li><a href="read tag.php"> <i class="fa fa-fw fa-search"></i> Read Tag ID</a></li>
			<li><a class="text-right" href="home.php?logout='1'" style="color: red;">Logout</a></li>
		</ul>
		<br>
		<div class="container-fluid">
            <div class="row">
                <h2>Inspection History</h2>
            </div>
		<!-- Search/add data form -->
		<form class="form-inline" action='search_his.php' method='post'>
  			<div >
  					<input class="form-control form-control-mx ml-3 w-75" name="search" type="text" placeholder="Search" aria-label="Search"/>
					<button class="btn btn-default" type="submit" ><i class="fas fa-search" aria-hidden="true"></i></button>
					<button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-danger"> <i class="far fa-times-circle"></i>&nbsp;Report</button>
					<button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-info"> <i class="fas fa-search"></i></button>
        	</div> <br/>

 		</form>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr bgcolor="#7f7f7f" color="#FFFFFF">
					  <th>Location</th>
                      <th>ID</th>
					  <th>Classification</th>
					  <th>Type</th>
                      <th>Description</th>
					  <th>Company</th>
					  <th>Phone</th>
					  <th>Note</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'insp_db.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM table_insp_his ORDER BY name ASC';
                   foreach ($pdo->query($sql) as $row) {
					echo '<tr>';
					echo '<td>'. $row['name'] . '</td>';
					echo '<td>'. $row['id'] . '</td>';
					echo '<td>'. $row['classification'] . '</td>';
					echo '<td>'. $row['type'] . '</td>';
					echo '<td>'. $row['description'] . '</td>';
					echo '<td>'. $row['company'] . '</td>';
					echo '<td>'. $row['phone'] . '</td>';
					echo '<td>'. $row['note'] . '</td>';
					echo '<td><a class="btn btn-success" href="edit_insp_his.php?id='.$row['id'].'">Edit</a>';
					echo ' ';
					echo '<a class="btn btn-danger" href="del_insp_his.php?id='.$row['id'].'">Delete</a>';
					echo '</td>';
					echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
				</table>
			</div>
		</div>
		<!-- Modal Registration System -->
		<div id="add_data_Modal" class="modal fade">  
			<div class="modal-dialog">  
				<div class="modal-content">  
						<div class="modal-header">  
							<button type="button" class="close" data-dismiss="modal">&times;</button>  
							<h2 class="modal-title">Report Form</h2>  
						</div>  
						
						<div class="modal-body"> <br/><br/>
							<!-- Add file -->
							<div class="row" >							
								<table class="table-borderless " >
								<form action="add_db_insp.php" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data" >
								<div><tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
									<td><label>อัพโหลดไฟล์ </label> </td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
									<td><input type="file" required name="fileCSV" id="fileCSV" accept=".csv" ></td>
									<td><button type="submit" id="submit" name="import" class=" btn-submit" accept=".csv">upload</button></td>
								</tr></div>
								</form>
								</table><br/>
						
						<form class="form-horizontal" action="insert_db_insp.php" method="post" >
							<div class="control-group">
								<label class="col-sm-3 col-form-label">ID</label>
								<div class="col-sm-9">
									<textarea class ="form-control" name="id" id="getUID" placeholder="Please Tag to display ID" rows="1" cols="1" required></textarea>
								</div><br/><br/>
							</div>	
							<div class="control-group">
								<label class="col-sm-3 col-form-label"> Location</label>
								<div class="col-sm-9">
									<input class ="form-control" id="div_refresh" name="name" type="text"  placeholder="" required>
								</div><br/><br/>
							</div>
							<div class="control-group">
								<label class=" col-sm-3 col-form-label">Classification</label>
								<div class="col-sm-9">
								<select class ="form-control" required name="classification">
									<option  value="">กรุณาเลือก</option>
									<option value="Coaxial">Coaxail</option>
									<option value="Fiber optic">Fiber optic</option>
									<option value="UTP">UTP</option>
								</select>
								</div><br/><br/>
							</div>
							<div class="control-group">
								<label class=" col-sm-3 col-form-label">Type</label>
								<div class="col-sm-9">
								<select class ="form-control" required name="type" >
									<option value="">กรุณาเลือก</option>
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
								</div> <br/><br/>
							</div>
							<div class="control-group">
								<label class=" col-sm-3 col-form-label">Description</label>
								<div class="col-sm-9">
								<select class ="form-control" required name="description">
									<option value="">กรุณาเลือก</option>
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
							</div><br/><br/>
							<div class="control-group">
								<label class=" col-sm-3 col-form-label">Company</label>
								<div class="col-sm-9">
									<input class ="form-control" id="div_refresh" name="company" type="text"  placeholder="" required>
								</div><br/><br/>
							</div>
							<div class="control-group">
								<label class=" col-sm-3 col-form-label">Phone</label>
								<div class="col-sm-9">
									<input class ="form-control" name="phone" type="text" placeholder="" required>
								</div><br/><br/>
							</div>					
							<div class="control-group">
								<label class=" col-sm-3 col-form-label">Note</label>
								<div class="col-sm-9">
									<input class ="form-control" name="note" type="text"  placeholder="" >
								</div>
							</div><br/><br/>					
						
						</div>  
						<div class="modal-footer">
							<div class="form-actions"></div>
								<button type="submit" class="btn btn-success">Save</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
							</div>
						</form>	  
				</div>  
			</div>  
		</div>  
	</body>
</html>

<div id="data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">PHP Ajax Update MySQL Data Through Bootstrap Modal</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Enter Employee Name</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />  
                          <label>Enter Employee Address</label>  
                          <textarea name="address" id="address" class="form-control"></textarea>  
                          <br />  
                          <label>Select Gender</label>  
                          <select name="gender" id="gender" class="form-control">  
                               <option value="Male">Male</option>  
                               <option value="Female">Female</option>  
                          </select>  
                          <br />  
                          <label>Enter Designation</label>  
                          <input type="text" name="designation" id="designation" class="form-control" />  
                          <br />  
                          <label>Enter Age</label>  
                          <input type="text" name="age" id="age" class="form-control" />  
                          <br />  
                          <input type="hidden" name="employee_id" id="employee_id" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  




 
 