<div class="php-result">
  <div class="text-center">SERVER DATA </div>
  <pre>
    <?php
    print_r($_SERVER);
    ?>
  </pre>
  <hr>
  <div class="text-center">FORM REQUEST RESULT </div>
 
  <pre>
    <!-- Funziona sia per il get che il post -->
    
    <?php
    print_r($_REQUEST);
    ?>
  </pre>
  <hr>
  <div class="text-center">FORM POST RESULT </div>
  <pre>
    <?php
    print_r($_POST);
    ?>
  </pre>
  <div class="text-center">SESSION </div>
  <pre>
    <?php
    print_r($_SESSION);
    ?>
  </pre>
  <div class="text-center">COOKIE </div>
  <pre>
    <?php
    print_r($_COOKIE);
    ?>
  </pre>
  
</div>