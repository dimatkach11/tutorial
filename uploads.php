<?php
$upload_path = "./uploads/";
$file_name = basename($_FILES['file']['name']);
$target_file = $upload_path . $file_name;
$check = true;
$uotput = '';

if (file_exists($target_file)) {
  $check = false;
  $uotput = 'il file con questo nome esiste già!';
}
if ($_FILES['file']['size'] > 2000000) {
  $check = false;
  $uotput = 'la dimensione del tuo file è troppo grande';
}

$ext = strtoupper(pathinfo($target_file, PATHINFO_EXTENSION));

if ($ext != "CSV") {
  $check = false;
  $uotput = 'puoi caricare solo file csv!';
  $contents = file_get_contents($_FILES['file']['tmp_name']);
  print_r(strpos($_FILES['file']['type'], 'image') == true);

  if (strpos($_FILES['file']['type'], 'image') !== false) {
    echo sprintf('<img src="data:image/png;base64,%s" width="600px" style="display:block; margin: 0 auto;" />', base64_encode($contents));
  }

  ?>
  
  <?php
}

if ($check == true) {
  if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
    $uotput = "File caricato con successo";
  } else {
    $uotput = "Upload fallito";
  }
}
include "csv_data.php";
?>
