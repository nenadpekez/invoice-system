<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
.error {
    color: red;
}
</style>


<!-- BEGIN APP -->
<div id="app">

    <div class="main-wrapper main-wrapper-1">
        <div class="main-content-login mt-5">

            <!-- BEGIN SECTION -->
            <section class="section" id="login">

                <div class="container">
                    <div class="row">

                        <div
                            class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-4 col-xl-6 offset-xl-3">

                            <div class="card card-primary">
                                <div class="card-header">

                                    <h4 class="text-start 1text-primary text-info"><?php echo $this->app_title; ?></h4>
                                    <hr>
                                    <h4 class="text-right">Prijava commit</h4>

                                </div>

                                <!-- BEGIN CARD-BODY -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <a href="#" class="btn btn-block">
                                                    <img src="<?php echo $this->logo_url; ?>" alt="HEALTH DOCS LOGIN"
                                                        style="margin-top:-15px">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <form method="POST" action="<?php echo base_url(); ?>login/login_validation"
                                                id="frmLogin" class="needs-validation" novalidate="">

                                                <input type="hidden" name="2af" value="">

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label control-label"
                                                        for="username">Korisničko ime</label>
                                                    <div class="col-sm-8">
                                                        <input id="username" type="text"
                                                            class="form-control form-control-sm" name="username"
                                                            tabindex="1" placeholder="Korisničko ime" required
                                                            autofocus>
                                                        <div class="invalid-feedback">Please fill in your username</div>
                                                        <?php echo form_error('username', '<div class="error text-right">', '</div>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label control-label"
                                                        for="password">Lozinka</label>
                                                    <div class="col-sm-8">
                                                        <input id="password" type="password"
                                                            class="form-control form-control-sm" name="password"
                                                            tabindex="2" placeholder="Lozinka" required>
                                                        <div class="invalid-feedback">Please fill in your password</div>
                                                        <?php echo form_error('password', '<div class="error text-right">', '</div>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" id="btnSubmit"
                                                        class="btn btn-block btn-primary" tabindex="3">PRIJAVA</button>
                                                    <a href="<?php echo base_url('register'); ?>" id="btnRegistration"
                                                        class="btn btn-sm btn-block btn-warning" tabindex="4">REGISTRUJ
                                                        SE</a>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- END CARD-BODY -->

                            </div>
                        </div>
                    </div>
            </section>
            <!-- END SECTION -->

        </div>
    </div>
</div>

</div>
<!-- END APP -->