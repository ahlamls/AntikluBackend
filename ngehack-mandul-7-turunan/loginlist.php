<?php
include_once "koneksi.php";

	class usr{}
		  class asede{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
  $date = date("Y-m-d");

      if ($fuid == "") {
        $response = new usr();
        $response->success = 0;
        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }

			$sql2e1 = "SELECT id FROM `user_login` WHERE `date` = '$date'";
			$result2e1 = $conn->query($sql2e1);
			//gak ada 3 sampe dajjal datang

			$dlog = $result2e1->num_rows;

      $sql = "SELECT * FROM `loginplace` WHERE `open` = 1 ORDER BY total_login";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row

					$response = new usr();
					$response->success = 1;

					$arraylist = [];

					while($row = $result->fetch_assoc()) {
			        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    $myObj = new asede();
							$myObj->id= $row['id'];
							$myObj->judul = $row['title'];
							$myObj->daily = $dlog;
							$myObj->total = $row['total_login'];
							$myObj->image = $row['image_url'];
							//$myJSON = json_encode($myObj);
							array_push($arraylist,$myObj);
					}

				$response->list = $arraylist;
				$response->message = "sukses";
				die(json_encode($response));

			} else {
				$response = new usr();
				$response->success = 0;
				$response->message = "Tidak ada login yang tersedia";
				die(json_encode($response));
			}
			$conn->close();



      ?>
