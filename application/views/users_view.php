<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
echo $this->data['start_tpl'];
?>



<style>

</style>
<?php
//check if user has right to see this
if ($this->session->userdata('level') < 2) {
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>
                <?php
                echo (isset($this->data['card_title']))?$this->data['card_title']:'';
                ?>
            </h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>
                            <?php
                            echo (isset($this->data['card_subtitle']))?$this->data['card_subtitle']:'';
                            ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- table -->
                        <?php
                        echo (isset($this->data['table_data']))?$this->data['table_data']:'';
                        ?>

                    </div>
                </div>

            </div>
        </div>

    </section>
</div>

<?php
} else {
    //user has no privileges
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Nemate autorizaciju da vidite podatke o korisnicima!</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Pomoć</h4>
                    </div>
                    <div class="card-body">
                        <p>Za neke od opcija morate zatražiti pristup od administratora sistema!</p>
                    </div>
                </div>

            </div>
        </div>

    </section>
</div>

<?php
}
?>

<?php
echo $this->data['end_tpl'];
?>