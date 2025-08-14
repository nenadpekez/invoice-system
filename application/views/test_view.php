<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
echo $this->data['start_tpl'];
?>



<style>

</style>

    <div id="help">
        
        <div class="container">

            <br>
            <!-- Here goes main/test content page - test page -->

            <h2>Test content</h2>

            <?php
            echo "page=".$this->data['page'];
            ?>
            
        </div>
        
    </div>

<?php
echo $this->data['end_tpl'];
?>