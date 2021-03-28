<!-- Accordion -->
<div class="accordion my-5" id="fileUploadedData">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingUploadedData">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUploadedData" aria-expanded="false" aria-controls="collapseUploadedData" onclick="scrollFunction()">
      FILE UPLOADED DATA</a>
      </button>
    </h2>
    <div id="collapseUploadedData" class="accordion-collapse collapse" aria-labelledby="headingUploadedData" data-bs-parent="#fileUploadedData">
      <div class="accordion-body">

        <div class="text-center">$_FILES</div>
        <?php
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
        ?>
      </div>

      <hr>
      <div class="text-center">
        OUTPUT
        <?php echo "<p>-> $uotput</p>" ?>
      </div>

      <hr>
      <!-- Table of csv file data -->
      <div class="mw-100 overflow-scroll" style="height: 500px;">
        <table class="table table-striped">
        
          <thead>
            <tr>
              <?php
              $file_csv = fopen("./uploads/donazioni_paypal_ok_20210315 (2).CSV", "r");
              $th = fgetcsv($file_csv);
              foreach ($th as $key => $value) {
              ?>
                <th scope="col"><?php echo $value ?></th>
              <?php
              }
              ?>
            </tr>
          </thead>
        
          <tbody>
            <?php
            while(!feof($file_csv)){
              $tr = fgetcsv($file_csv);
              ?>
              <tr>
                <?php
                foreach ($tr as $key => $value) {
                ?>
                  <td ><?php echo $value ?></td>
                <?php
                }
                ?>
              </tr>
              <?php
            }
            ?>
          </tbody>
        
        </table>
      </div>
      <!--End of Table of csv file data -->
      <div id="endFileCsvTable"></div>
    </div>
  </div>
</div>
<!-- End Accordion -->

<script>
  let count = 1;
  function scrollFunction() {
    count = count + 1;
    if (count % 2 == 0 ) {
      setTimeout(
        () => {
          document.getElementById('endFileCsvTable').scrollIntoView();
        },
        10
      );
    }
  }
</script>
