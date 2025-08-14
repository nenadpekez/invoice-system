<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
echo $this->data['start_tpl'];
?>



<style>

</style>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profil korisnika: <?php echo (isset($this->data['user'])) ? $this->data['user'] : 'none'; ?></h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Podaci</h4>
                    </div>
                    <div class="card-body">
                        <p>Ime:
                            <?php echo (isset($this->data['user_data']->firstname)) ? $this->data['user_data']->firstname : 'none'; ?>
                        </p>
                        <p>Prezime:
                            <?php echo (isset($this->data['user_data']->lastname)) ? $this->data['user_data']->lastname : 'none'; ?>
                        </p>
                        <p>Korisničko ime:
                            <?php echo (isset($this->data['user_data']->username)) ? $this->data['user_data']->username : 'none'; ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </section>
</div>

<?php
echo $this->data['end_tpl'];
?>