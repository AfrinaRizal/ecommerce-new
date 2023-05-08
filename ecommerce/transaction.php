<?php
	include 'includes/session.php';

	$id = $_POST['id'];

	$conn = $pdo->open();

	$output = array('list'=>'');

	$stmt = $conn->prepare("SELECT * FROM orders LEFT JOIN products ON products.id=orders.product_id  WHERE user_id=:user_id");
	$stmt->execute(['user_id'=>$user['id']]);

	$total = 0;
	foreach($stmt as $row){
		$output['transaction'] = $row['pay_id'];
		$output['date'] = date('M d, Y', strtotime($row['sales_date']));
		$subtotal = $row['price']*$row['quantity'];
		$total += $subtotal;
		$output['list'] .= "
			<tr class='prepend_items'>
				<td>".$row['name']."</td>
				<td>RM ".number_format($row['price'], 2)."</td>
				<td>".$row['total_quantity']."</td>
				<td>RM ".number_format($subtotal, 2)."</td>
			</tr>
		";
	}
	
	$output['total'] = '<b>RM '.number_format($total, 2).'<b>';
	$pdo->close();
	echo json_encode($output);

?>