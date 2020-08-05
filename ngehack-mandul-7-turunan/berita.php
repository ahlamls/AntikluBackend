<?php
//SELECT * FROM `news` ORDER BY `id` DESC LIMIT 0,10
include "koneksi.php";
$sql = "SELECT * FROM `news` ORDER BY `id` DESC LIMIT 0,10";
$result = $conn->query($sql);
$content = "";
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $waktu = $row['time'];
    $title = $row['title'];
    $cont = $row['content'];
    $content .= "<div class='card'>
    <div class='card-header'>
    $waktu
    </div>
    <div class='card-body'>
    <h5 class='card-title'><b>$title</b></h5>
    <p class='card-text'>$cont</p>

    </div>
    </div>
    <br>";
  }
} else {
  $content = "<h3>Tidak ada berita saat ini . silahkan cek lain waktu</h3>";
}
$conn->close();

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Notifikasi Antiklu</title>
  </head>
  <body>
    <br>
    <div class="container">



<?= $content ?>

</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
