<!DOCTYPE html>
<html>
<head>
	<title>Quaterly Data</title>
</head>
<body>
<table align="center">
<th>Date</th>
<th>Open</th>
<th>High</th>
<th>Low</th>
<th>Close</th>

<?php

	include('Quandl.php');

	//if($_POST['search'])

	$api_key = "QLheaxy14mKGL1ycD_Cg";
	$symbol  = "BSE/BOM508814";
	$array = array();
	function getdata($api_key, $symbol) 
	{
		$quandl = new Quandl($api_key);
		//$quandl -> format = "json";
		return $quandl->getSymbol($symbol, [
			"sort_order"      => "desc", // asc|desc
			"exclude_headers" => true,
			"rows"            => 5 // 4 = close price
		]);
	}
	// Modify this call to any `exampleN` to check different samples
	$data = getdata($api_key, $symbol);
	$jsondata = json_decode(json_encode($data),true);
	//echo gettype($jsondata);
	//print_r($jsondata);
	foreach($jsondata['dataset']['data'] as $key)
	{
		echo "<tr>";
		echo "<td>".$key[0]."</td>";
		echo "<td>".$key[1]."</td>";
		echo "<td>".$key[2]."</td>";
		echo "<td>".$key[3]."</td>";
		echo "<td>".$key[4]."</td>";
		array_push($array, $key[4]);
		echo "</tr>";
	}
	
	$timegap = 2;
	$res = trader_sma($array,$timegap);
	var_dump($res);
	
?>
</table>
</body>
</html>