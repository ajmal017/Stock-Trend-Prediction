<!DOCTYPE html>
<html>
<head>
	<title>Capy | Stock Buddy</title>
	<!--jQuery UI for Autocomplete-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!--Custom CSS & jQuery-->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script>
		$(function() 
		{
		    var availableScripts = <?php include('autocomplete.php'); ?>;
		    $(".search").autocomplete(
		    {
		        source: availableScripts,
		        autoFocus:true
		    });
		});
	</script>

</head>
<body>
<form method="post" action="main.php">
<table align="center">
	<tr>
		<td><input type="text" name="search" size="100" class="search" required></td>
	</tr>
	<tr>
		<td align="center"><input type="submit" value="Call Api" name="submit" class="search button"></td>
	</tr>
</table>
</form>
</body>
</html>