<?php
    include('config.php');

    if($con)
    {

        //fetch stock names from the callapi table
        $sql = "SELECT `Stock Name` FROM `callapi`";
        $result = mysqli_query($con, $sql) or die(mysqli_error($connection));

        $sname_list = array();
        while($row = mysqli_fetch_array($result))
        {
            $sname_list[] = htmlspecialchars_decode($row['Stock Name']);
        }
        //htmlspecialchars_decode($row['Security Name']);
        //$row['Security Name'];
        echo json_encode($sname_list);
    
    }
    else
    {
        die(mysqli_error($con));
    }
?>