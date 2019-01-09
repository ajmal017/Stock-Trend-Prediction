<?php
	function display($stockcode)
	{
		$a = array();
		include('config.php');
		$start = microtime(true);
		$sql5="SELECT * FROM `$stockcode`";
		$result5=mysqli_query($con,$sql5);
		$op = microtime(true) - $start;
		echo "<span class='text'><center>Data Retrieval:".$op." seconds</center></span>";
		while($row5=mysqli_fetch_row($result5))
		{
			echo "<tr>";
			echo "<td>".$row5[0]."</td>";
			echo "<td>".$row5[1]."</td>";
			echo "<td>".$row5[2]."</td>";
			echo "<td>".$row5[3]."</td>";
			echo "<td>".$row5[4]."</td>";
			array_push($a, (float)$row5[4]);
			echo "</tr>";
		}
		return $a;
	}	
?>