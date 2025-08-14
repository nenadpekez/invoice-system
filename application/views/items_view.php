<div class="container">
    <br>
    <div class="row">
        <div class="col">
            <h4>Spisak organizacionih jedinica</h4>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                </div>
                <input type="text" id="search" class="form-control" placeholder="Pretraga..." aria-label="Search" aria-describedby="basic-addon1">
            </div>
            
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!-- <h5>Paginacija</h5> -->
            <?php 
                if(isset($this->pagination['pagination'])){
                    echo $this->pagination['pagination'];
                }

            ?>
        </div>
        <div class="col text-right">
            <a href="<?php echo base_url() . 'orgJed/insert'?>" class="btn btn-primary">NOVI UNOS</a>
        </div>
    </div>
    <br>

    <div id="result">
        
    </div>
</div>