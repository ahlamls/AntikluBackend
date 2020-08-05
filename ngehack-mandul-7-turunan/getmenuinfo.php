<?php
//SELECT name,exp FROM `user` WHERE `exp` != 0 ORDER BY exp LIMIT 0,25
include_once "koneksi.php";

	class usr{}

  class asede{}

      $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
      $mid = $conn->real_escape_string(base64_decode($_GET['mid']));

      if ($fuid == "" OR $mid == "") {
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
  }
} else {
  $response = new usr();
  $response->success = 0;
  $response->message = "User tidak ditemukan";
  die(json_encode($response));
}

$sqlxnxx = "SELECT * FROM `resto_item` WHERE `id` = '$mid' AND `open` = '1'";
$result = $conn->query($sqlxnxx);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$menudesc = $row['deskripsi'];
$menuprice = $row['price'];
$menuname = $row['name'];
if ($row['promoprice'] != NULL ) {
  $menuprice = $row['promoprice'];
}

}

} else {
$response = new usr();
$response->success = 0;
$response->message = "Menu tidak ditemukan";
die(json_encode($response));
}

$info = "";
$quantity = 1;
$alreadyAdded = FALSE;
//cari tau udah ada di cart belum . kalau udah ambil quantity nya
$sqlxvideos = "SELECT * FROM `user_cart` WHERE `user_id` = '$uaidi' AND `menu_id` = '$mid'";
$result = $conn->query($sqlxvideos);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
$quantity = $row['quantity'];
$info = $row['info'];
$alreadyAdded = TRUE;
}

}

$response = new usr();
$response->success = 1;
$response->id = $mid;
$response->name = $menuname;
$response->desc = $menudesc;
$response->added = $alreadyAdded;
$response->quantity = $quantity;
$response->info = $info;
$response->price = $menuprice;
$response->message = "sukses";
die(json_encode($response));


?>
