<?php
include_once "koneksi.php";

	class usr{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));

      if ($fuid == "") {
        $response = new usr();
        $response->success = 0;
        $response->registered = 0;
        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }

      $sql = "SELECT * FROM `user` WHERE `fuid` = '$fuid' AND `nohp` = ''";
			$result = $conn->query($sql);



      if ($result->num_rows > 0 ) {
        $response = new usr();
        $response->success = 1;
        $response->registered = 0;
        $response->message = "Belum Post-registration";
        die(json_encode($response));
      } else if ($result->num_rows == 0) {
        $response = new usr();
        $response->success = 1;
        $response->registered = 1;
        $response->message = "Sudah Post-registration";
        die(json_encode($response));
      }

			if ($result !== TRUE) {
        $response = new usr();
        $response->success = 0;
        $response->registered = 0;
        $response->message = "Database Autis . " . $conn->error;
        die(json_encode($response));
      }

    ?>
