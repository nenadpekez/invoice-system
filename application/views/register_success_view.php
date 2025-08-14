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
                                    <h4 class="text-right">BRAVO</h4>

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
                                            <p>Uspesno ste se registrovali, LINK za aktivaciju vam je poslat na e-mail
                                                koji ste uneli, klikom na taj LINK aktivirate vas nalog!</p>

                                            <div class="form-group">
                                                <a href="<?php echo base_url('login'); ?>" id="btnRegistration"
                                                    class="btn btn-sm btn-block btn-warning" tabindex="4">PRIJAVI
                                                    SE</a>
                                            </div>
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