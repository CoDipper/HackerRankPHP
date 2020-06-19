<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" type="text/css" href="StyleT.css">
<?php 
	// required db class
	require_once('classDataConnection.php');
	require_once('ArrToTable.php');
	
	// new instance
	$database = new Database();
	// get connection
	$connection = $database->getConnection();
	
	// select query
	$query = "SELECT instr_tools.Id, instr_tool_det.DetId, instr_tool_det.MatGr, instr_tools.ToolCode
		FROM instr_tool_det
		JOIN instr_tools ON instr_tool_det.ToolId=instr_tools.Id";

	$stmt = $connection->prepare($query);

	//$stmt->bindValue(1, "13%");
	//$stmt->bindValue(2, "14%");

	$stmt->execute();
	$arr= new TableModel();
	$arr ->set_data($stmt->fetchAll(\PDO::FETCH_OBJ));
	echo $arr ->html_table();
	//echo "<pre>";
		//var_dump($stmt->fetchAll(\PDO::FETCH_OBJ));
	//echo "</pre>";
?>
</body>
</html>