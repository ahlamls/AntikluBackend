<?php
//SELECT name,exp FROM `user` WHERE `exp` != 0 ORDER BY exp LIMIT 0,25
include_once "koneksi.php";

	class usr{}

  class asede{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
      $rid = $conn->real_escape_string(base64_decode($_GET['rid']));

      if ($fuid == "" OR $rid == "") {
        $response = new usr();
        $response->success = 0;
        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }

      $sqlx = "SELECT * FROM `user` WHERE `fuid` = '$fuid'";
      $result = $conn->query($sqlx);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $uaidi = $row['id'];
    $lat = $row['latitude'];
    $long = $row['longitude'];
  }
} else {
  $response = new usr();
  $response->success = 0;
  $response->message = "User tidak ditemukan";
  die(json_encode($response));
}



$restoname = "Resto Tidak Ditemukan";
$restogambar = "";
  $sqlx = "SELECT * FROM `resto` WHERE `id` = '$rid'";


$result = $conn->query($sqlx);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$restoname = $row['name'];
$restodesc = $row['deskripsi'];
$restogambar = $row['image_url'];
$restolat = $row['latitude'];
$restolong = $row['longitude'];
}
} else {
$response = new usr();
$response->success = 0;
$response->message = "Resto tidak ditemukan";
die(json_encode($response));
}



$sql = "SELECT * FROM `resto_item` WHERE `resto_id` = '$rid' AND `open` = '1'";

      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row

          $response = new usr();
          $response->success = 1;
          $response->id = $rid;
          $response->name = $restoname;
          $response->desc = $restodesc;
          $response->gambar = $restogambar;
          $response->latitude = $restolat;
          $response->longitude = $restolong;
          $jarak = distance($lat, $long, $row['latitude'], $row['longitude'], "K");
          $restojarak  = truncate_number($jarak);
          $response->jarak = $restojarak;
          $restoongkir = truncate_number($jarak,0) * $ongkirprice;
          if ($restoongkir == 0 ) {
            $restoongkir = $ongkirprice;
          }
          $response->ongkir = $restoongkir;


          $arraylist = [];

          while($row = $result->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
              $myObj = new asede();
              $myObj->id = $row['id'];
              $aidi = $myObj->id;
              $myObj->name = $row['name'];
              $myObj->desc = $row['deskripsi'];
              $myObj->price = $row['price'];
              if ($row['promoprice'] !== NULL) {
                  $myObj->promoprice = $row['promoprice'];
              } else {
                  $myObj->promoprice = 0;
              }
              $myObj->gambar = $row['image_url'];




              //$myJSON = json_encode($myObj);
              array_push($arraylist,$myObj);
          }

        $response->list = $arraylist;
        $response->message = "sukses";
        die(json_encode($response));

      } else {
        $response = new usr();
        $response->success = 0;
        $response->message = "Tidak ada Resto";
        die(json_encode($response));
      }

      function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);

          if ($unit == "K") {
            return ($miles * 1.609344);
          } else if ($unit == "N") {
            return ($miles * 0.8684);
          } else {
            return $miles;
          }
        }
      }

      function truncate_number( $number, $precision = 2) {
    // Zero causes issues, and no need to truncate
    if ( 0 == (int)$number ) {
        return $number;
    }
    // Are we negative?
    $negative = $number / abs($number);
    // Cast the number to a positive to solve rounding
    $number = abs($number);
    // Calculate precision number for dividing / multiplying
    $precision = pow(10, $precision);
    // Run the math, re-applying the negative value to ensure returns correctly negative / positive
    return floor( $number * $precision ) / $precision * $negative;
}

 ?>
