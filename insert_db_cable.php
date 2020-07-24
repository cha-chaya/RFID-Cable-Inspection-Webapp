<?php
    require 'cable_db.php';
    if ( !empty($_POST)) {
        //keep track post values
        $name = $_POST['name'];
        $id = $_POST['id'];
        $classification = $_POST['classification'];
        $type = $_POST['type'];
		$description = $_POST['description'];
        $company = $_POST['company'];
        $phone = $_POST['phone'];
        $note = $_POST['note'];
		//insert data
        $pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO table_cable_data (name,id,classification,type,description,company,phone,note) values(?, ?, ?, ?, ?,?,?,?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($name,$id,$classification,$type,$description,$company,$phone,$note));
		Database::disconnect();
		header("Location:cable_data.php");
    }
?>