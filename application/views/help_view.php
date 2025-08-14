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
            <!-- Here goes main/help content page - help page -->

            <h2>Help content</h2>

            <?php
            echo "page=".$this->data['page'];
            ?>
            
        </div>
        
    </div>

<?php
echo $this->data['end_tpl'];
?>