<div class="container">
    <br>
    <div class="row">
        <div class="col">
            <h3>Izmena organizacione jedinice</h3>
        </div>
    </div>
    <br>

            <?php
            $row = $this->data['data'][0];
            echo form_open('orgJed/item_validation/' . $row->id, array('class' => 'inline', 'method' => 'post')); 
            ?>
                <div class="form-group">                
                    <label for="idOj">ID organizacione jedinice</label>
                    <input type="text" class="form-control" id="idOj" name="idOj" value="<?php echo $row->idOj; ?>" placeholder="ID jedinice">
                </div>

                <div class="form-group">                
                    <label for="naziv">Naziv organizacione jedinice</label>
                    <input type="text" class="form-control" id="naziv" name="naziv" value="<?php echo $row->naziv; ?>" placeholder="Naziv jedinice">
                </div>

                <div class="form-group text-right">
                    <input type="submit" class="btn btn-md btn-success" id="submit" name="submit" value="SAČUVAJ">
                    <a href="<?php echo base_url() . 'orgJed/items'; ?>" class="btn btn-md btn-danger" >ODUSTANI</a>
                </div>

            <?php
            echo form_close();
            ?>
            </tbody>
        </table>
    </div>
</div>