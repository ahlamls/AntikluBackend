<?php
include_once "koneksi.php";
//SELECT * FROM `user_items` WHERE `user_id` = '2' ORDER BY `user_items`.`time` DESC
	class usr{}
  class asede{}
  class samalo{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
      $itid = $conn->real_escape_string(base64_decode($_GET['itid']));
      $info = $conn->real_escape_string(base64_decode($_GET['info']));


      if ($fuid == "" OR $itid == "") {
        $response = new usr();
        $response->success = 0;
        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }

      $sql = "SELECT id ,`point` FROM `user` WHERE `fuid` = '$fuid'";
			$result = $conn->query($sql);
      $aidi = 0;
      $userpoint = 0;

      if ($result->num_rows > 0) {
          // output data of each row


          while($row = $result->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
              $aidi = $row['id'];
              $userpoint = $row['point'];
              //$myJSON = json_encode($myObj);
          }


      } else {
        $response = new usr();
        $response->success = 0;
        $response->message = "User Tidak Ditemukan";
        die(json_encode($response));
      }



      $sql2 = "SELECT * FROM `items` WHERE `id` = '$itid'";
      $result2 = $conn->query($sql2);
      $price = 1;
      $type = 0;
      $open = 0;
      $exp = 0;

      if ($result2->num_rows > 0) {
          // output data of each row



          while($row = $result2->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";


              $price = $row['price'];
              $type = $row['type'];
              $exp = $row['exp'];
              if ($type == 2 AND $info == "") {
                $response = new usr();
                $response->success = 0;
                $response->message = "Informasi tidak boleh kosong";
                die(json_encode($response));
              }
              $open = $row['open'];
              if ($open == 0) {
                $response = new usr();
                $response->success = 0;
                $response->message = "Barang tidak tersedia";
                die(json_encode($response));
              }

              //$myJSON = json_encode($myObj);
            //  array_push($arraylist,$myObj);
          }



      } else {
        $response = new usr();
        $response->success = 0;
        $response->message = "Tidak ada barang yang dijual";
        die(json_encode($response));
      }

      if ($userpoint < $price) {
        $response = new usr();
        $response->success = 0;
        $response->message = "Point tidak cukup";
        die(json_encode($response));
      } else {

        $sql3 = "UPDATE `user` SET `exp` = `exp` + '$exp' , `point` = `point` - '$price' WHERE `user`.`id` = '$aidi';";
        if ($conn->query($sql3) !== TRUE) {
          $response = new usr();
          $response->success = 0;
          $response->message = "Database Autis 0" . $conn->error;
          die(json_encode($response));
        }

        if ($type == 1) {
          $status = "Dimiliki";
        } else {
          $status = "Permintaan Diterima";
        }
        $sql4 = "INSERT INTO `user_items` (`id`, `user_id`, `item_id`, `time`, `info`, `status`) VALUES (NULL, '$aidi', '$itid', NOW(), '$info', '$status');";
        if ($conn->query($sql4) !== TRUE) {
          $response = new usr();
          $response->success = 0;
          $response->message = "Database Autis 1" . $conn->error;
          die(json_encode($response));
        } else {
          $response = new usr();
          $response->success = 1;
          $response->message = "Pembelian Sukses! . Silahkan cek barang anda di menu item";
          die(json_encode($response));
        }

      }



 ?>
