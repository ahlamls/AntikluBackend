<?php
//SELECT name,exp FROM `user` WHERE `exp` != 0 ORDER BY exp LIMIT 0,25
include_once "koneksi.php";

	class usr{}

  class asede{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
      $type = $conn->real_escape_string(base64_decode($_GET['type']));

      if ($fuid == "" OR $type == "") {
        $response = new usr();
        $response->success = 0;
        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }

      $sqlx = "SELECT id FROM `user` WHERE `fuid` = '$fuid'";
      $result = $conn->query($sqlx);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $uaidi = $row['id'];
  }
} else {
  $response = new usr();
  $response->success = 0;
  $response->message = "User tidak ditemukan";
  die(json_encode($response));
}

      if ($type == "micro") {
        $sql = "SELECT * FROM `orderlist` WHERE `done` = 0 AND `user_id` = '$uaidi' ORDER BY `id` DESC";
      } else if ($type == "c") {
        $sql = "SELECT * FROM `orderlist` WHERE `user_id` = '$uaidi' ORDER BY `id` DESC LIMIT 0,25";
      } else {
        $response = new usr();
        $response->success = 0;
        $response->message = "Type tidak valid";
        die(json_encode($response));
      }

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row

          $response = new usr();
          $response->success = 1;

          $arraylist = [];

          while($row = $result->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
              $myObj = new asede();
              $myObj->id = $row['id'];
              $aidi = $myObj->id;


                  $sqlx1 = "SELECT name FROM `kadaljne`.`resto` WHERE `id` = $aidi";
                  $resultx1 = $conn->query($sqlx1);

                  if ($resultx1->num_rows > 0) {
                    // output data of each row
                    while($rowx1 = $resultx1->fetch_assoc()) {
                        $myObj->name = $rowx1['name'];
                    }
                  } else {
                    $myObj->name = "Tidak Diketahui";
                  }

                    $sqlx10 = "SELECT * FROM `order_item` WHERE `order_id` = 1";
                    $resultx10 = $conn->query($sqlx1);
                    $myObj->desc = $resultx10->num_rows . " Item | Rp " . number_format($row['price']);


              $myObj->time = $row['time'];
              $myObj->status = $row['status'];

              //$myJSON = json_encode($myObj);
              array_push($arraylist,$myObj);
          }

        $response->list = $arraylist;
        $response->message = "sukses";
        die(json_encode($response));

      } else {
        $response = new usr();
        $response->success = 0;
        $response->message = "Tidak ada Order";
        die(json_encode($response));
      }


 ?>
