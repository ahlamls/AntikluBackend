<?php
include_once "koneksi.php";
$link_apk = "http://tiny.cc/sulfikar";
//SELECT * FROM `user_items` WHERE `user_id` = '2' ORDER BY `user_items`.`time` DESC
	class usr{}
  class asede{}
  class samalo{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));

      if ($fuid == "") {
        $response = new usr();
        $response->success = 0;
        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }

      $sql = "SELECT * FROM `user` WHERE `fuid` = '$fuid'";
      $result = $conn->query($sql);
      $aidi = 0;

      if ($result->num_rows > 0) {
          // output data of each row


          while($row = $result->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
              $response = new usr();
              $response->aidi = $row['id'];

              $response->nama = $row['name'];
              $response->nohp = $row['nohp'];
              $response->saldo = $row['saldo'];

              $response->email = $row['email'];
              $response->gambar = $row['photo'];

              //$myJSON = json_encode($myObj);
              $response->success = 1;
              $response->message = "misyen sukses. duarr";
              die(json_encode($response));
          }


      } else {
        $response = new usr();
        $response->success = 0;
        $response->message = "User Tidak Ditemukan";
        die(json_encode($response));
      }

    ?>
