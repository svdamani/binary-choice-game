<?php
    //$db_hostname = 'localhost';
    //$db_database = 'binary_choice_game';
    //$db_username = 'root';
    //$db_password = 'root';
	include_once "server.php";
	//echo DB_HOST . DB_USER . DB_PASS ;
    $db_server = mysql_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$db_server)  die("Unable to connect to MYSQL:".  mysql_error());
    
    mysql_select_db(DB_NAME) or die("Unable to select database");
    
    $num_of_prob=6;
    $num_of_cond=5;
    
    for($i=0; $i<$num_of_prob; $i++)
    {
        $prob_data[] = array($i+1, (float)rand()/(float)getrandmax(), rand()%10, $i+1, min(1-(float)rand()/(float)getrandmax(), 
                (float)rand()/(float)getrandmax()), rand()%10, rand()%10-10, rand()%10+10);
    }
    $mysql_query = "DELETE  FROM sg_conditions";
    $result = mysql_query($mysql_query);
    if(!$result) die("Database access failed: wefwef".mysql_error());
    $mysql_query = "DELETE from sg_trials";
    $result = mysql_query($mysql_query);
    if(!$result) die("Database access failed: xvcbfg".mysql_error());
    
    for($j=0; $j<$num_of_prob; $j++)
    {
        $mysql_query = "INSERT INTO sg_conditions VALUES(";
        for($k=0; $k<=6; $k++)	{
            $mysql_query = $mysql_query.$prob_data[$j][$k];
			if($k!=6)	$mysql_query = $mysql_query.",";
		}
        $mysql_query = $mysql_query.")";
		//echo "\n".$mysql_query."\n" ;
        $result = mysql_query($mysql_query);
        if(!$result) die("Database access failed: ".mysql_error());
    }
    
    for($i=0; $i<$num_of_cond; $i++)
    {
        shuffle($prob_data);
        $mysql_query = "INSERT INTO sg_trials VALUES($i+1, ";
        for($j=0; $j<$num_of_prob; $j++)
        {
            $mysql_query = $mysql_query.$prob_data[$j][0];
        }
        $mysql_query = $mysql_query.")";
        $result = mysql_query($mysql_query);
        if(!$result) die("Database access failed: ".mysql_error());
    }
?>
