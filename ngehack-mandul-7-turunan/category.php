<?php
//SELECT name,exp FROM `user` WHERE `exp` != 0 ORDER BY exp LIMIT 0,25
include_once "koneksi.php";

	class usr{}

  class asede{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));


      if ($fuid == "") {
        $response = new usr();
        $response->success = 0;
        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }

      $sql = "SELECT * FROM `category`  WHERE `open` != 0  LIMIT 0,10";
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
              $myObj->text = $row['title'];
              //$myJSON = json_encode($myObj);
              array_push($arraylist,$myObj);
          }

        $response->list = $arraylist;
        $response->message = "sukses";
        die(json_encode($response));

      } else {
        $response = new usr();
        $response->success = 0;
        $response->message = "Tidak ada kategori";
        die(json_encode($response));
      }


 ?>
