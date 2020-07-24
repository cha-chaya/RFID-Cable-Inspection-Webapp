<?php  include 'insp_db.php' ;
$search = $_POST['search'];
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql= "SELECT * FROM `table_insp_his` WHERE name LIKE  '%".$search."%' OR id LIKE  '%".$search."%' OR 
classification LIKE '%".$search."%' OR type LIKE '%$search%'  OR description LIKE '%$search%' OR note LIKE '%$search%'
 OR company LIKE '%$search%' OR phone LIKE '%$search%'";
	Database::disconnect();
if(isset($_POST['search'])){  
?>
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
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<script src="js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<link href="https://fonts.googleapis.com/css?family=Kanit|Playfair+Display|Prompt&display=swap" rel="stylesheet">
		<style>
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
		a { 
				font-family: 'Prompt', sans-serif;;
				text-align: right;
				margin: 0px auto;
				padding-right : 58px;
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
		<title>Cable Data : RFID THESIS</title>
	</head>
	<body>
		<br />  
		<div class="container-fluid">
            <div class="row">
                <h2>Inspection History Table</h2>
		<br/>
            </div>
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
                  ?>
                  </tbody>
				</table>
			</div>
		</div> <!-- /container -->
		<br />
		<a class="btn" href="insp_his.php">Back</a>
    <?php } ?>
	</body>
</html>