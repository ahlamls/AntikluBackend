<?php
	/* ===== www.dedykunbocor.com ===== */
	$servername		= "localhost"; //sesuaikan dengan nama server
	$username		= "budisetiawan"; //sesuaikan username
	$password	= "binomotradingpro42069!"; //sesuaikan password
	$dbname	= "kadaljne"; //sesuaikan target databese

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("database autis : " . $conn->connect_error);
  }

	function startsWith ($string, $startString)
{
    $len = strlen($startString);
    return (substr($string, 0, $len) === $startString);
}

?>
