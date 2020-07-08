<?php
include_once "koneksi.php";

	class usr{}

    // $response = new usr();
    // $response->success = 0;
    // $response->message = "Username sudah ada";
    // die(json_encode($response));
    //

  $fuid = $conn->real_escape_string(base64_decode($_GET['id']));
  $email = $conn->real_escape_string(base64_decode($_GET['email']));
  $name = $conn->real_escape_string(base64_decode($_GET['name']));
  $photo = $conn->real_escape_string(base64_decode($_GET['photo']));

  if ($fuid == "" OR $email == "" OR $name == "") {
    $response = new usr();
    $response->success = 0;
    $response->message = "Data tidak lengkap";
    die(json_encode($response));
  }

	$sqlx = "SELECT * FROM `user` WHERE `fuid` = '$fuid'";
	$resultx = $conn->query($sqlx);

	if ($conn->query($sqlx) === TRUE AND $conn->num_rows > 0 ) {
		$response = new usr();
    $response->success = 0;
    $response->message = "Sudah Terdaftar";
    die(json_encode($response));
	}

  $reffcode = strtoupper(substr($email,0,3)  . substr(md5($fuid . $email),0,5));

  $sql = "INSERT INTO `user` (`id`, `time`, `fuid`, `name`, `email`, `nohp`, `saldo`, `point`, `photo`, `banned`, `banned_reason`) VALUES (NULL, NOW(), '$fuid', '$name', '$email', '', '0', '10', '$photo', '0', NULL);";
  $result = $conn->query($sql);

  if ($conn->query($sql) === TRUE) {
    $response = new usr();
    $response->success = 1;
    $response->message = "success";
    die(json_encode($response));
  } else {
    $response = new usr();
    $response->success = 1;
    $response->message = "Database Autis . " . $conn->error;
    die(json_encode($response));
  }
  $conn->close();
  ?>
