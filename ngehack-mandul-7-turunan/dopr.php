<?php
include_once "koneksi.php";
//SELECT * FROM `user_items` WHERE `user_id` = '2' ORDER BY `user_items`.`time` DESC
	class usr{}
  class asede{}
  class samalo{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));

      $nohp = $conn->real_escape_string(base64_decode($_GET['nohp']));
			$alamat = $conn->real_escape_string(base64_decode($_GET['alamat']));


      $nohp = str_replace("+628","08",$nohp);

      if ($fuid == "" OR $nohp == "" OR $alamat == "") {
        $response = new usr();
        $response->success = 0;
        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }


      if (!startsWith($nohp,"08")) {
        $response = new usr();
        $response->success = 0;
        $response->message = "Nomor HP Dimulai dengan 08";
        die(json_encode($response));
      }

      if (strlen($nohp) <= 10 OR strlen($nohp) >= 14) {
        $response = new usr();
        $response->success = 0;
        $response->message = "Nomor HP Tidak Valid";
        die(json_encode($response));
      }





//cek fuid buat ambil aidi
$sql = "SELECT id,name,nohp FROM `user` WHERE `fuid` = '$fuid'";
$result = $conn->query($sql);
$aidi = 0;

if ($result->num_rows > 0) {
    // output data of each row


    while($row = $result->fetch_assoc()) {
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        $aidi = $row['id'];
        $nama = $row['name'];
        if ($row['nohp'] !== "") {
          $response = new usr();
          $response->success = 0;
          $response->message = "Sudah Post-registration";
          die(json_encode($response));
        }
        //$myJSON = json_encode($myObj);
    }


} else {
  $response = new usr();
  $response->success = 0;
  $response->message = "User Tidak Ditemukan";
  die(json_encode($response));
}



$sqlx = "SELECT * FROM `user` WHERE `nohp` = '$nohp'";
$resultx = $conn->query($sqlx);
if ($resultx->num_rows > 0) {
  $response = new usr();
  $response->success = 0;
  $response->message = "Nomor HP Sudah Terdaftar";
  die(json_encode($response));
}

//SELECT * FROM `user` WHERE `userreffcode` = "HIL6883F"
//if refferal gak kosong


$sqlxz3 = "UPDATE `user` SET `nohp` = '$nohp' WHERE `user`.`id` = '$aidi'";
if ($conn->query($sqlxz3) === TRUE) {

} else {
  $response = new usr();
  $response->success = 0;
  $response->message = "Database Autis 4. " . $conn->error;
  die(json_encode($response));
}

$sqlx1 = "INSERT INTO `alamat` (`id`, `uid`, `nama`, `alamat`) VALUES (NULL, $aidi, 'Alamat #1', '$alamat');";
if ($conn->query($sqlx1) === TRUE) {
  $response = new usr();
  $response->success = 1;
  $response->message = "sukses";
  die(json_encode($response));
} else {
  $response = new usr();
  $response->success = 0;
  $response->message = "Database Autis 5. " . $conn->error;
  die(json_encode($response));
}


//

?>
