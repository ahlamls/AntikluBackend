<?php
include_once "koneksi.php";
//SELECT * FROM `user_items` WHERE `user_id` = '2' ORDER BY `user_items`.`time` DESC
	class usr{}
  class asede{}
  class samalo{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
      $oid = $conn->real_escape_string(base64_decode($_GET['oid']));

      if ($fuid == "" OR $oid == "") {
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
              $aidi = $row['id'];

          }


      } else {
        $response = new usr();
        $response->success = 0;
        $response->message = "User Tidak Ditemukan";
        die(json_encode($response));
      }

      $sql = "SELECT * FROM `orderlist` WHERE `id` = '$oid' AND `user_id` = '$aidi'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row


          while($row = $result->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
              $response = new usr();

              $oid = $row['id'];
							$response->id = $oid;
              $response->waktu = $row['time'];
              $did = $row['driver_id'];
              $sqlx = "SELECT name FROM `driver` WHERE `id` = $did";
              $resultx = $conn->query($sqlx);

              if ($resultx->num_rows > 0) {
                  // output data of each row
                  while($rowx = $resultx->fetch_assoc()) {
                    $response->driver = $rowx['name'];
                  }
              } else {
								$response->driver = "Tidak Diketahui";
							}

              $response->price = number_format($row['price']);
              $response->ongkir = number_format($row['ongkir']);
              $response->jarak = $row['jarak'];
							$response->alamat = $row['alamat'];

              $response->paymentmethod = $row['paymentmethod'];
              $response->status = $row['status'];
              $response->done = $row['done'];
              $response->cancelable = $row['cancelable'];



              $sqlx = "SELECT * FROM `order_item` WHERE `order_id` = '$oid'";
              $resultx = $conn->query($sqlx);

              if ($resultx->num_rows > 0) {

                $response->success = 1;
                $response->message = "misyen sukses. duarr nmax gamemax";

                          $arraylist = [];
                  while($rowx = $resultx->fetch_assoc()) {
                      $myObj = new asede();
												$myObj->id = $rowx['id'];
                        $myObj->name = $rowx['name'];
                        $myObj->info = $rowx['info'];
                        $myObj->count = $rowx['count'];
                        $myObj->price = $rowx['price'];
                        array_push($arraylist,$myObj);
                  }

              }  else {

                  $response->success = 0;
                  $response->message = "Tidak ada Item";

                }


                $response->list = $arraylist;
              //$myJSON = json_encode($myObj);

              die(json_encode($response));
          }


      } else {
        $response = new usr();
        $response->success = 0;
        $response->message = "Order Tidak Ditemukan";
        die(json_encode($response));
      }

    ?>
