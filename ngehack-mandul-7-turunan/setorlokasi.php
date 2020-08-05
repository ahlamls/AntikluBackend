<?php
include_once "koneksi.php";
//SELECT * FROM `user_items` WHERE `user_id` = '2' ORDER BY `user_items`.`time` DESC
	class usr{}
  class asede{}
  class samalo{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));

      $latitude = $conn->real_escape_string(base64_decode($_GET['latitude']));
			$longitude = $conn->real_escape_string(base64_decode($_GET['longitude']));


      if ($fuid == "" OR $latitude == "" OR $longitude == "") {
        $response = new usr();
        $response->success = 0;
        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }




$sqlxz3 = "UPDATE `user` SET `latitude` = '$latitude' , `longitude` = '$longitude' WHERE `fuid` = '$fuid'";
if ($conn->query($sqlxz3) === TRUE) {
  $response = new usr();
  $response->success = 1;
  $response->message = "sukses";
  die(json_encode($response));
} else {
  $response = new usr();
  $response->success = 0;
  $response->message = "Database Autis 4. " . $conn->error;
  die(json_encode($response));
}



//

?>
