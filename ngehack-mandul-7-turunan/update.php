<?php
include_once "koneksi.php";
$curver = "1";
$dlurl = "http://antiklu.com";

	class usr{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
      $v = $conn->real_escape_string(base64_decode($_GET['v']));

      if ($fuid == "" OR $v == "") {
        $response = new usr();
        $response->success = 0;
        $response->uptodate = 0;
        $response->url = "";
        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }

      $sql = "SELECT banned,banned_reason FROM `user` WHERE `fuid` = '$fuid'";
      $result = $conn->query($sql);



						if ($result->num_rows > 0) {
		    // output data of each row
		    				while($row = $result->fetch_assoc()) {
		        		if ($row['banned'] == 1) {
									$response = new usr();
									$response->success = 1;
									$response->uptodate = 0;
									$response->url = "https://i.redd.it/yfzdfqc4wo741.jpg";
									$response->message = "Akun anda telah di Banned . Alasan : " . $row['banned_reason'];
									die(json_encode($response));
								} else {

									if ($curver !== $v) {
										$response = new usr();
										$response->success = 1;
										$response->uptodate = 0;
										$response->url = $dlurl;
										$response->message = "Aplikasi sudah lawas . Silahkan Perbarui Aplikasi dengan versi terbaru untuk menggunakan aplikasi ini";
										die(json_encode($response));
									} else {
										$response = new usr();
										$response->success = 1;
										$response->uptodate = 1;
										$response->url = $dlurl;
										$response->message = "Terupdate";
										die(json_encode($response));
									}
								}

								}
						} else if ($result->num_rows == 0) {
							$response = new usr();
							$response->success = 0;
							$response->uptodate = 0;
							$response->url = "https://i.redd.it/yfzdfqc4wo741.jpg";
							$response->message = "User Tidak terdaftar . " . $conn->error;
							die(json_encode($response));
						}

									if ($result !== TRUE) {
										$response = new usr();
										$response->success = 0;
										$response->uptodate = 0;
										$response->url = "";
										$response->message = "Database Autis . " . $conn->error;
										die(json_encode($response));
									}


      ?>
