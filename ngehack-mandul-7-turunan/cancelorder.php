<?php
include_once "koneksi.php";
//SELECT * FROM `user_items` WHERE `user_id` = '2' ORDER BY `user_items`.`time` DESC
	class usr{}
  class asede{}
  class samalo{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
  $oid = $conn->real_escape_string(base64_decode($_GET['oid']));

      if ($fuid == "" OR $oid == "" ) {
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




$sqlxz3 = "UPDATE `orderlist` SET `status` = 'Dibatalkan' , `done` = '2' , `cancelable` = 0 WHERE `id` = '$oid' AND `cancelable` = 1 AND `user_id` = '$aidi';";
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
