<?php
	include 'includes/session.php';

	$output = '';

	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM products");
	$stmt->execute();
	foreach($stmt as $row){
		$output .= "
			<option value='".$row['product_id']."' class='append_items'>".$row['product_name']."</option>
		";
	}

	$pdo->close();
	echo json_encode($output);

?>