<?php
$column = pusharray($stockcode);
statssma($column);
statsema($column);
statswma($column);
function statssma($column)
	{
		$real = $column;
		$stt = 2;
		$mtt = 12;
		$lgt = 22;
		$datast = trader_sma($real,$stt);
		$datamt = trader_sma($real,$mtt);
		$datalt = trader_sma($real,$lgt);
		$short = array();
		$mid = array();
		$long = array();
		foreach($datast as $row)
		{
			$short[] = $row;
		}
		foreach($datamt as $row)
		{
			$mid[] = $row;
		}
		foreach($datalt as $row)
		{
			$long[] = $row;
		}
		$list = end($short);
		$limt = end($mid);
		$lilt = end($long);
		$limd = end($real);
		echo "<table border='1' class='sma'>";
		echo "<caption>Simple Moving Average</caption>";
		echo ($list>$limd)?"<tr><td><b>Short Term Trend</b></td><td class='green'>Up</td></tr>":"<tr><td><b>Short Term Trend</b></td><td class='red'>Down</td></tr>";
		echo ($limt>$limd)?"<tr><td><b>Mid Term Trend</b></td><td class='green'>Up</span></td></tr>":"<tr><td><b>Mid Term Trend</b></td><td class='red'>Down</</td></tr>";
		echo ($lilt>$limd)?"<tr><td><b>Long Term Trend</b></td><td class='green'>Up</span></td></tr>":"<tr><td><b>Long Term Trend</b></td><td class='red'>Down</td></tr>";
		echo "</table>";
	}

	function statsema($column)
	{
		$real = $column;
		$stt = 2;
		$mtt = 12;
		$lgt = 22;
		$datast = trader_ema($real,$stt);
		$datamt = trader_ema($real,$mtt);
		$datalt = trader_ema($real,$lgt);
		$short = array();
		$mid = array();
		$long = array();
		foreach($datast as $row)
		{
			$short[] = $row;
		}
		foreach($datamt as $row)
		{
			$mid[] = $row;
		}
		foreach($datalt as $row)
		{
			$long[] = $row;
		}
		$list = end($short);
		$limt = end($mid);
		$lilt = end($long);
		$limd = end($real);
		echo "<table border='1' class='sma'>";
		echo "<caption>Exponential Moving Average</caption>";
		echo ($list>$limd)?"<tr><td><b>Short Term Trend</b></td><td class='green'>Up</td></tr>":"<tr><td><b>Short Term Trend</b></td><td class='red'>Down</td></tr>";
		echo ($limt>$limd)?"<tr><td><b>Mid Term Trend</b></td><td class='green'>Up</span></td></tr>":"<tr><td><b>Mid Term Trend</b></td><td class='red'>Down</</td></tr>";
		echo ($lilt>$limd)?"<tr><td><b>Long Term Trend</b></td><td class='green'>Up</span></td></tr>":"<tr><td><b>Long Term Trend</b></td><td class='red'>Down</td></tr>";
		echo "</table>";
	}

	function statswma($column)
	{
		$real = $column;
		$stt = 2;
		$mtt = 12;
		$lgt = 22;
		$datast = trader_ema($real,$stt);
		$datamt = trader_ema($real,$mtt);
		$datalt = trader_ema($real,$lgt);
		$short = array();
		$mid = array();
		$long = array();
		foreach($datast as $row)
		{
			$short[] = $row;
		}
		foreach($datamt as $row)
		{
			$mid[] = $row;
		}
		foreach($datalt as $row)
		{
			$long[] = $row;
		}
		$list = end($short);
		$limt = end($mid);
		$lilt = end($long);
		$limd = end($real);
		echo "<table border='1' class='sma'>";
		echo "<caption>Weighted Moving Average</caption>";
		echo ($list>$limd)?"<tr><td><b>Short Term Trend</b></td><td class='green'>Up</td></tr>":"<tr><td><b>Short Term Trend</b></td><td class='red'>Down</td></tr>";
		echo ($limt>$limd)?"<tr><td><b>Mid Term Trend</b></td><td class='green'>Up</span></td></tr>":"<tr><td><b>Mid Term Trend</b></td><td class='red'>Down</</td></tr>";
		echo ($lilt>$limd)?"<tr><td><b>Long Term Trend</b></td><td class='green'>Up</span></td></tr>":"<tr><td><b>Long Term Trend</b></td><td class='red'>Down</td></tr>";
		echo "</table>";
	}


	function pusharray($stockcode)
	{
		$column = array();
		include('config.php');
		$sql5="SELECT * FROM `$stockcode`";
		$result5=mysqli_query($con,$sql5);
		while($row5=@mysqli_fetch_row($result5))
		{
			$column[] = (float)$row5[4];
		}
		return $column;
	}
?>