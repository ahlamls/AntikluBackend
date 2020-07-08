<?php
include_once "koneksi.php";

	class usr{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
      $lid = $conn->real_escape_string(base64_decode($_GET['lid']));

      $date = date("Y-m-d");

      if ($fuid == "" AND $lid == "") {
        $response = new usr();
        $response->success = 0;
        $response->logged_in = 0;

        $response->title = "";
        $response->description = "";
        $response->image_url = "";

        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }

      $sqlx = "SELECT * FROM `loginplace` WHERE `id` = '$lid'";
			$resultx = $conn->query($sqlx);

      if ($resultx->num_rows > 0) {
          // output data of each row


          while($row = $resultx->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
              $title = $row['title'];
              $description = $row['description'];
              $image_url = $row['image_url'];
              $open = $row['open'];
              //$myJSON = json_encode($myObj);
          }

          if ($open !== "1") {
            $response = new usr();
            $response->success = 0;
            $response->logged_in = 0;
            $response->message = "Tempat Login ditutup";
            die(json_encode($response));
          }


      } else {
        $response = new usr();
        $response->success = 0;
        $response->logged_in = 0;
        $response->message = "Tempat Login tidak ditemukan";
        die(json_encode($response));
      }

      $sql = "SELECT id FROM `user` WHERE `fuid` = '$fuid'";
			$result = $conn->query($sql);
      $aidi = 0;

      if ($result->num_rows > 0) {
          // output data of each row


          while($row = $result->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
              $aidi = $row['id'];
              //$myJSON = json_encode($myObj);
          }


      } else {
        $response = new usr();
        $response->success = 0;
        $response->logged_in = 0;
        $response->message = "User Tidak Ditemukan";
        die(json_encode($response));
      }

      $sql2 = "SELECT id FROM `user_login` WHERE `user_id` = '$aidi' AND `login_id` = '$lid' AND `date` = '$date'";
    $result2 = $conn->query($sql2);
      $udahlogin = 0;

                if ($result2->num_rows > 0) {
          // output data of each row
          while($row = $result2->fetch_assoc()) {
              $udahlogin = 1;
            }
      } else {
        $udahlogin = 0;
        }

        $sql2e1 = "SELECT id FROM `user_login` WHERE `date` = '$date'";
        $result2e1 = $conn->query($sql2e1);
        //gak ada 3 sampe dajjal datang

        $dlog = $result2e1->num_rows;

        $response = new usr();
        $response->success = 1;
        $response->logged_in = $udahlogin;

        $response->title = $title;
        $response->description = $description;
        $response->image_url = $image_url;
        $response->daily_login = $dlog;

        $response->message = "sukses";
        die(json_encode($response));


    ?>
