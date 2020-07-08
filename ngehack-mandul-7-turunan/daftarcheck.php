<?php
include_once "koneksi.php";

	class usr{}

    $fuid = $conn->real_escape_string($_GET['id']);

		if ($fuid == "") {
		   die("Data Tidak Valid");
		}
    //

  $sql = "SELECT id FROM `user` WHERE `fuid` = '$fuid'";
  $result = $conn->query($sql);




  if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        die("registered");
      }
  } else if ($result->num_rows == 0) {
    die("notregistered");
  }

  if ($conn->query($sql) !== TRUE) {
    die("Database Autis :" . $conn->error);
}
  $conn->close();
  ?>
