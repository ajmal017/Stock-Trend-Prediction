<!DOCTYPE html>
<html>
<head>
	<title>Quaterly Data</title>
	<style type="text/css">
		html,body{margin: 0;padding: 0;}
		table{border-collapse: collapse;}
		table.quater{margin-top: 3em;}
		.data{width: 49%;float: left;}
		.output{width: 49%;float: left;}
		.text{font-weight: bold;}
		table.sma{margin-top: 8em;}
		table tr td.green{background-color: lightgreen;width: 8em;text-align: center;}
		table tr td.red{background-color: lightcoral;width:8em;text-align: center;}
	</style>
</head>
<body>
<div class="data">
<table align="center" border="1" class="quater">
<th>Date</th>
<th>Open</th>
<th>High</th>
<th>Low</th>
<th>Close</th>

<?php
	include('Quandl.php');
	include('config.php');
	include('functions.php');
	if($_POST['submit'])
	{
		$stockname=$_POST['search'];
		echo "<span class='text'><center>Stock Name:".$stockname."</center></span>";
		$start = microtime(true);
		$sql1="SELECT `Stock Code`,`Bitindex`,`Last Updated` from callapi where `Stock Name`='$stockname'";
		$result1=mysqli_query($con,$sql1);
		$op = microtime(true) - $start;
		echo "<span class='text'><center>Find Stockcode from Stockname:".$op." seconds</center></span>";
		$row1=mysqli_fetch_row($result1);
		$stockcode = $row1[0];

		if($row1[1]==1)
		{
			//EDITED
			$date = date('Y-m-d');
			echo "<span class='text'><center>Table Status:Already Exist</center></span>";
			if($row1[2]==$date)
			{
				echo "<span class='text'><center>Table Is UP-TO DATE. Last Updated On ".$row1[2]."</center></span>";
				display($stockcode);
			}
			else
			{
				
				echo "<span class='text'><center>Table Is Not Up-To Date. Last Updated On ".$row1[2]."</center></span>";
				
				$sqlu1="DELETE FROM `$stockcode` WHERE 1";
				;
				//repeat
				if(mysqli_query($con,$sqlu1))
				{
					$data = getdata($api_key, $stockcode);
					$jsondata = json_decode(json_encode($data),true);
					foreach($jsondata['dataset']['data'] as $key)
					{
						$sqlu3="INSERT INTO `$stockcode` (`Date`,`Open`,`High`,`Low`,`Close`) VALUES ('$key[0]','$key[1]','$key[2]','$key[3]','$key[4]')";
						mysqli_query($con,$sqlu3);
					}
					$sqlu4="UPDATE `callapi` SET `Last Updated`='$date' WHERE `Stock Code`='$stockcode'";
					if(mysqli_query($con,$sqlu4))
					{
						display($stockcode);
					}
				}
			}
			
		}
		else
		{
			$date = date('Y-m-d');
			$start = microtime(true);
			$sql3="UPDATE `callapi` SET `BitIndex`=1,`Last Updated`='$date' WHERE `Stock Code`='$stockcode'";
			$result3=mysqli_query($con,$sql3);
			if($result3)
			{
				echo "<span class='text'><center>Record inserted in Database</center></span>";
				$sql4="CREATE TABLE `$stockcode` (`Date` DATE,`Open` VARCHAR(10),`High` VARCHAR(10),`Low` VARCHAR(10),`Close` VARCHAR(10))";
				if(mysqli_query($con,$sql4))
				{
					$op = microtime(true) - $start;
					echo "<span class='text'><center>Table Creation:".$op." seconds</center></span>";
					echo "<span class='text'><center>Table Status:Created</center></span>";
					$data = getdata($api_key, $stockcode);
					$jsondata = json_decode(json_encode($data),true);
					foreach($jsondata['dataset']['data'] as $key)
					{
						
						$sqli="INSERT INTO `$stockcode` (`Date`,`Open`,`High`,`Low`,`Close`) VALUES ('$key[0]','$key[1]','$key[2]','$key[3]','$key[4]')";
						mysqli_query($con,$sqli);
					}
					display($stockcode);
				}

			}
			else
			{
				die(mysqli_error($con));
			}

		}


	}

	function getdata($api_key, $stockcode) {
		$quandl = new Quandl($api_key);
		return $quandl->getSymbol($stockcode, [
			"sort_order"      => "desc", // asc|desc
			"exclude_headers" => true,
			"rows"            => 90,
			
		]);
	}
	
?>
</table>
</div>
<div class="output">
<?php include('sma.php'); ?>
</div>
</body>
</html>