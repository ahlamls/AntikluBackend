<?php
include_once "koneksi.php";
//
//

	class usr{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
      $lid = $conn->real_escape_string(base64_decode($_GET['lid']));

      $date = date("Y-m-d");

      if ($fuid == "" AND $lid == "") {
        $response = new usr();
        $response->success = 0;
        $response->message = "Data tidak lengkap";
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
        $response->message = "User Tidak Ditemukan";
        die(json_encode($response));
      }

      $sql2 = "SELECT id FROM `user_login` WHERE `user_id` = '$aidi' AND `login_id` = '$lid' AND `date` = '$date'";
    $result2 = $conn->query($sql2);

                if ($result2->num_rows > 0) {
          // output data of each row
          while($row = $result2->fetch_assoc()) {
            $response = new usr();
            $response->success = 0;
            $response->message = "Sudah Login Sebelumnya";
            die(json_encode($response));
            }
          }

          $sql2e2 = "UPDATE `loginplace` SET `total_login` = total_login + '1' WHERE `loginplace`.`id` = '$lid';";

if ($conn->query($sql2e2) !== TRUE) {
  $response = new usr();
  $response->success = 0;
  $response->message = "Database Autis 0" . $conn->error;
  die(json_encode($response));
}

$sqlz = "INSERT INTO `user_login` (`id`, `user_id`, `login_id`, `time`, `date`) VALUES (NULL, '$aidi', '$lid', NOW(), NOW());";

if ($conn->query($sqlz) !== TRUE) {
  $response = new usr();
  $response->success = 0;
  $response->message = "Database Autis 1 " . $conn->error;
  die(json_encode($response));
}

$sqlz1 = "UPDATE `user` SET `exp` = `exp` + '10', `point` = `point` + '1' WHERE `user`.`id` = $aidi;";

if ($conn->query($sqlz1) !== TRUE) {
  $response = new usr();
  $response->success = 0;
  $response->message = "Database Autis 2" . $conn->error;
  die(json_encode($response));
} else {
  $response = new usr();
  $response->success = 1;
  $response->message = "Login Sukses";
  die(json_encode($response));
}


      ?>
