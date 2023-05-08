<?php
	include 'includes/session.php';


	function generateRow($id, $conn){
		$contents = '';

//$id = isset($_GET['id']);
$id = $_GET['id'];
		$stmt = $conn->prepare("SELECT * FROM orders where id=:id ");

		$stmt->execute(['id'=>$id]);
		$total = 0;
		foreach($stmt as $row){
			// $stmt = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE sales_id=:id");
			// $stmt->execute(['id'=>$row['salesid']]);
			// $amount = 0;
			// $amount += $row['total'];
			// foreach($stmt as $details){
			// 	$subtotal = $details['price']*$details['quantity'];
			// 	$amount += $subtotal;
			// }
			// $total += $amount;
			$contents .= '
			<tr>
				<td>'.$row['id'].'</td>
				<td>'.$row['placed_on'].'</td>

				<td>'.$row['name'].'</td>
				<td>'.$row['address'].'</td>
				<td>'.$row['trackingNum'].'</td>


			</tr>
			';


		}

$contents .= '
			<tr>
				<td colspan="1" align="left"><b>Postcode</b></td>
				<td align="right">'.$row['postcode'].'</td>
				<td colspan="1" align="center"><b>No Tel</b></td>
				<td align="right">0'.$row['telno'].'</td>
			</tr>

			


		';

		return $contents;
	}

	if(isset($_POST['print'])){

		// $from = date('Y-m-d', strtotime($ex[0]));
		// $to = date('Y-m-d', strtotime($ex[1]));
		// $from_title = date('M d, Y', strtotime($ex[0]));
		$id = isset($_GET['id']);

		$conn = $pdo->open();

		require_once('../tcpdf/tcpdf.php');  
	    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
	    $pdf->SetCreator(PDF_CREATOR);  
	    $pdf->SetTitle('Shipping Info');  
	    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
	    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
	    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	    $pdf->SetDefaultMonospacedFont('helvetica');  
	    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
	    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
	    $pdf->setPrintHeader(false);  
	    $pdf->setPrintFooter(false);  
	    $pdf->SetAutoPageBreak(TRUE, 10);  
	    $pdf->SetFont('helvetica', '', 11);  
	    $pdf->AddPage();  
	    $content = '';  
	    $content .= '
	      	<h2 align="center">HomeGallery</h2>
	      	<h4 align="center">SHIPPING INFORMATION(RECEIVER)</h4>
	      	<h4 align="center"></h4>
	      	<table border="1" cellspacing="0" cellpadding="3">  
	           <tr>  
	           		<th width="12%" align="center"><b>Order ID</b></th>
	                <th width="13%" align="center"><b>Placed On</b></th>

	           		<th width="20%" align="center"><b>Name</b></th>
					<th width="40%" align="center"><b>Address</b></th>
					<th width="17%" align="center"><b>Tracking Number</b></th>  

	           </tr>  



	      ';  




	    $content .= generateRow($id, $conn);  
	    $content .= '</table>';  

	     $content .= '
	      	<h4 align="center">SHIPPING INFORMATION(SENDER)</h4>
	      	<h4 align="center"></h4>
	      	<table border="1" cellspacing="0" cellpadding="3">  
	           <tr>  

	           		<th width="20%" align="center"><b>Name</b></th>
	                <th width="20%" align="center"><b>Phone</b></th>
					<th width="40%" align="center"><b>Address</b></th>
					<th width="20%" align="center"><b>Postcode</b></th>  

	           </tr>  



	      ';  



	    $content .= '
			<tr>

				<td>HomeGallery Sdn. Bhd.</td>
				<td>04-4529911</td>
				<td>N0 14782, Jalan Amanjaya 2/24 Amarin, 08000 Sungai Petani, Kedah</td>
				<td>08000</td>

												<td></td>


                            <td></td>
			</tr>
			'; 

	    $content .= '</table>';

	    $pdf->writeHTML($content);  
	    $pdf->Output('shipping.pdf', 'I');

	    $pdo->close();

	}
	else{
		$_SESSION['error'] = 'Need date range to provide sales print';
		header('location: shipping.php');
	}
?>