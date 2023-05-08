<?php
	include 'includes/session.php';

	$id = $_POST['id'];

	$conn = $pdo->open();

	$output = array('list'=>'');

	$stmt = $conn->prepare("SELECT *, sum(totalPrice) as total,  orders.id AS ordersid FROM orders LEFT JOIN users ON orders.user_id=users.id GROUP BY");
	$stmt->execute(['id'=>$id]);

	$total = 0;
	foreach($stmt as $row){
		$output['placed_on'] = date('M d, Y', strtotime($row['placed_on']));
		// $subtotal = $row['totalPrice'];
		// $total += $subtotal;
		$output['list'] .= "
			<tr class='prepend_items'>
				<td>".$row['name']."</td>
				<td>RM ".number_format($row['totalPrice'], 2)."</td>
				<td>".$row['total_quantity']."</td>
			</tr>
		";
	}
	
	$output['total'] = '<b>RM '.$row['totalPrice'], 2.'<b>';
	$pdo->close();
	echo json_encode($output);

?>