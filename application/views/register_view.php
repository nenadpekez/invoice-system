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
                                    <h4 class="text-right">Registracija</h4>

                                </div>

                                <!-- BEGIN CARD-BODY -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <a href="#" class="btn btn-block">
                                                    <img src="<?php echo $this->logo_url; ?>"
                                                        alt="HEALTH DOCS REGISTRATION" style="margin-top:-15px">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <form method="POST"
                                                action="<?php echo base_url(); ?>register/register_validation"
                                                id="register-form" class="needs-validation" novalidate=""
                                                oninput="confirmPassword.setCustomValidity(cpassword.value != password.value ? true : false)">

                                                <input type="hidden" name="2af" value="">
                                                <input type="hidden" name="level" id="level" value="2">
                                                <input type="hidden" name="title" id="title" value="">

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label control-label"
                                                        for="firstname">Ime: </label>
                                                    <div class="col-sm-8">
                                                        <input id="firstname" type="text"
                                                            class="form-control form-control-sm" name="firstname"
                                                            tabindex="1" placeholder="Unesite ime" required autofocus
                                                            value="<?php echo $this->input->post('firstname');?>">
                                                        <div class="invalid-feedback">Please fill in your firstname
                                                        </div>
                                                        <?php echo form_error('firstname', '<div class="error text-right">', '</div>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label control-label"
                                                        for="lastname">Prezime</label>
                                                    <div class="col-sm-8">
                                                        <input id="lastname" type="text"
                                                            class="form-control form-control-sm" name="lastname"
                                                            tabindex="1" placeholder="Unesite prezime" required
                                                            autofocus
                                                            value="<?php echo $this->input->post('lastname');?>">
                                                        <div class="invalid-feedback">Please fill in your lastname</div>
                                                        <?php echo form_error('lastname', '<div class="error text-right">', '</div>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label control-label"
                                                        for="email">E-adresa</label>
                                                    <div class="col-sm-8">
                                                        <input id="email" type="email"
                                                            class="form-control form-control-sm" name="email"
                                                            tabindex="1" placeholder="E-mail" required autofocus
                                                            value="<?php echo $this->input->post('email');?>">
                                                        <div class="invalid-feedback">Please fill in your email</div>
                                                        <?php echo form_error('email', '<div class="error text-right">', '</div>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label control-label"
                                                        for="username">Korisničko ime</label>
                                                    <div class="col-sm-8">
                                                        <input id="username" type="text"
                                                            class="form-control form-control-sm" name="username"
                                                            tabindex="1" placeholder="Korisničko ime" required autofocus
                                                            value="<?php echo $this->input->post('username');?>">
                                                        <div class="invalid-feedback">Please fill in your username</div>
                                                        <?php echo form_error('username', '<div class="error text-right">', '</div>'); ?>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label control-label"
                                                        for="password">Lozinka</label>
                                                    <div class="col-sm-8 input-group" id="show_hide_password">
                                                        <input id="password" type="password"
                                                            class="form-control form-control-sm" name="password"
                                                            tabindex="2" placeholder="Lozinka" required>
                                                        <div class="input-group-addon">
                                                            <button id="eye-btn" class="btn btn-small btn-outline"><i
                                                                    class="fa fa-eye-slash" aria-hidden="true"
                                                                    title="Prikaži lozinku" data-hide="Sakri lozinku"
                                                                    data-show="Prikaži lozinku"></i></button>
                                                        </div>
                                                        <div class="invalid-feedback">Please fill in your password</div>
                                                        <?php echo form_error('password', '<div class="error text-right">', '</div>'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label control-label"
                                                        for="cpassword">Ponovi lozinku</label>
                                                    <div class="col-sm-8 input-group" id="show_hide_password">
                                                        <input id="cpassword" type="password"
                                                            class="form-control form-control-sm" name="cpassword"
                                                            tabindex="2" placeholder="Ponovi lozinku"
                                                            data-match="#password" required>
                                                        <div class="invalid-feedback">Please fill in your confirm
                                                            password</div>

                                                    </div>
                                                </div>
                                                <?php echo form_error('cpassword', '<div class="form-group row"><div class="col-sm-12 error text-right">', '</div></div>'); ?>

                                                <div class="form-group">
                                                    <button type="submit" id="btnSubmit"
                                                        class="btn btn-block btn-primary"
                                                        tabindex="3">REGISTRACIJA</button>
                                                    <a href="<?php echo base_url('login'); ?>" id="btnRegistration"
                                                        class="btn btn-sm btn-block btn-warning" tabindex="4">PRIJAVI
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