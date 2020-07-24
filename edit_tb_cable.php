<?php
    require 'cable_db.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }  
    if ( !empty($_POST)) {
        // keep track post values
        $name = $_POST['name'];
        $id = $_POST['id'];
        $classification = $_POST['classification'];
        $type = $_POST['type'];
		$description = $_POST['description'];
        $company = $_POST['company'];
        $phone = $_POST['phone'];
        $note= $_POST['note'];
  
        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE table_cable_data  set name = ?, classification =?, type =?, description =?, company =?, phone =?, note =? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($name,$classification,$type,$description,$company,$phone,$note,$id));
		Database::disconnect();
		header("Location: cable_data.php");
    }
?>