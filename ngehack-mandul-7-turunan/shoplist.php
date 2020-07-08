<?php
include_once "koneksi.php";
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

      // $sql = "SELECT id FROM `user` WHERE `fuid` = '$fuid'";
			// $result = $conn->query($sql);
      // $aidi = 0;
      //
      // if ($result->num_rows > 0) {
      //     // output data of each row
      //
      //
      //     while($row = $result->fetch_assoc()) {
      //         //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      //         $aidi = $row['id'];
      //         //$myJSON = json_encode($myObj);
      //     }
      //
      //
      // } else {
      //   $response = new usr();
      //   $response->success = 0;
      //   $response->message = "User Tidak Ditemukan";
      //   die(json_encode($response));
      // }



      $sql2 = "SELECT * FROM `items` WHERE `open` = 1";
      $result2 = $conn->query($sql2);

      if ($result2->num_rows > 0) {
          // output data of each row

          $response = new usr();
          $response->success = 1;

          $arraylist = [];

          while($row = $result2->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
              $myObj = new asede();

              $myObj->nama = $row['name'];
              $myObj->harga = $row['price'];
              $myObj->type = $row['type'];
              $myObj->infotype = $row['infotype'];

              $myObj->gambar = $row['image_url'];

              $myObj->id = $row['id'];

              //$myJSON = json_encode($myObj);
              array_push($arraylist,$myObj);
          }

        $response->list = $arraylist;
        $response->message = "sukses";
        die(json_encode($response));

      } else {
        $response = new usr();
        $response->success = 0;
        $response->message = "Tidak ada barang yang dijual";
        die(json_encode($response));
      }


 ?>
