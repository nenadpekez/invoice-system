<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php
echo $this->data['start_tpl'];
?>

<!-- 
<style>
.custom-col {
    visibility: visible;
    display: block;
}

@media screen and (max-width: 768px) {
    .custom-col {
        visibility: hidden;
        display: none !important;
    }
}
</style>

<div>
    <div id="content" class="container container-fluid">
        <br>


        <h2>Main content</h2>

        <?php
			if(ENVIRONMENT == 'development')
			{
				if(key_exists('debug_tpl', $this->data))
					print_r($this->data['debug_tpl']);
			}
		?>

        <div class='row'>
            <div class='custom-col col-4 '>
            </div>
            <div class='col'>

                <?php
			if(key_exists('param', $this->data))
			{
				if(isset($this->data['forms'][$this->data['param']['form_name']]['forms']))
					{
						foreach($this->data['forms'][$this->data['param']['form_name']]['forms'] as $data)
						{
							$this->customform->CustomFormOpen($data);
						}
					}

				if(isset($this->data['forms'][$this->data['param']['form_name']]['inputs']))
					{
						foreach($this->data['forms'][$this->data['param']['form_name']]['inputs'] as $data)
						{
							$this->customform->CustomInputType($data);
						}
					}

				if(isset($this->data['forms'][$this->data['param']['form_name']]['buttons']))
					{
						foreach($this->data['forms'][$this->data['param']['form_name']]['buttons'] as $data)
						{
							$this->customform->CustomButton($data);
						}
					}

				$this->customform->CustomFormClose();
			}
				?>
            </div>
            <div class='col-4 custom-col'>
            </div>
        </div>

    </div>
</div>

-->


<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Korisnik: <?php echo (isset($this->data['user'])) ? $this->data['user'] : 'none'; ?></h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Dobrodošli</h4>
                    </div>
                    <div class="card-body">
                        <p>Uspešno ste pristupili Vašem HEALTH DOCS korisničkom nalogu.<br>
                            U izboru sa desne strane odaberite akciju koju želite.<br>
                            Ukoliko imate autorizaciju u odeljku za korisnika možete upravljati nalozima ostalih
                            korisnika.<br>
                            Izborom odgovarajuće opcije možete vršiti i pretragu po željenim kriterijumima!
                        <p>

                        <p>Za sva dodatna pitanja molimo Vas da se obratite podršci.
                        <p>

                    </div>
                </div>

            </div>
        </div>

    </section>
</div>

<?php
echo $this->data['end_tpl'];
?>