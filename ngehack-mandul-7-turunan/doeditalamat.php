<?php
include_once "koneksi.php";
//SELECT * FROM `user_items` WHERE `user_id` = '2' ORDER BY `user_items`.`time` DESC
	class usr{}
  class asede{}
  class samalo{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
			$aid = $conn->real_escape_string($_GET['aid']);

      $nama = $conn->real_escape_string(base64_decode($_GET['nama']));
			$alamat = $conn->real_escape_string(base64_decode($_GET['alamat']));


      if ($fuid == "" OR !isset($aid) OR $nama == "" OR $alamat == "") {
        $response = new usr();
        $response->success = 0;
        $response->message = "Data tidak lengkap";
        die(json_encode($response));
      }



//cek fuid buat ambil aidi
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

//SELECT * FROM `alamat` WHERE `uid` = '9' AND `id` = '2'


//SELECT * FROM `user` WHERE `userreffcode` = "HIL6883F"
//if refferal gak kosong


$sqlxz3 = "UPDATE `alamat` SET `nama` = '$nama', `alamat` = '$alamat' WHERE `uid` = '$aidi'  AND `id` = $aid;";
if ($conn->query($sqlxz3) === TRUE) {
	$response = new usr();
  $response->success = 1;
  $response->message = "sukses";
  die(json_encode($response));
} else {
  $response = new usr();
  $response->success = 0;
  $response->message = "Database Autis 2. " . $conn->error;
  die(json_encode($response));
}



//

?>
