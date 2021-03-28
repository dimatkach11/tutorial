<?php

  $file = fopen("./file/file.txt", "r") or die("Non posso aprire il file");
  echo fread($file, filesize('./file/file.txt'));
  fclose($file);

?>
<hr>
<div class="text-center">LEGGERE FILE RIGA PER RIGA </div>
<?php

  $file = fopen("./file/file.txt", "r") or die("Non posso aprire il file");
  while(!feof($file)) {
    $row = fgets($file);
    if (strpos($row, '-') == 2) {
      echo "<li class='px-4 py-2' style='list-style-type: none;'>$row</li>";
    } else {
      echo "<b>$row</b><br>";
    }
  }
  fclose($file);