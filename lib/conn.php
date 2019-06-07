<?

	$host = "localhost";
	$user = "zenerifys";
	$passwd = "uranos2015";

	$connect = mysql_connect($host, $user, $passwd) or die("mysql Server Connection Error");
	mysql_select_db("zenerifys", $connect) or die("DB Connection Error");

	mysql_query("set session character_set_connection=utf8;");
	mysql_query("set session character_set_results=utf8;");
	mysql_query("set session character_set_client=utf8;");
?>