
        <div class="table table-responsive table-sm">
            <table class="table table-hover table-bordered ">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="text-center">RB</th>
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col" class="text-center">NAZIV</th>
                        <th scope="col" class="text-center">AKTIVNO</th>
                        <th scope="col" class="text-center">OPCIJE</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $rb=0;
                foreach($this->data['data'] as $row){
                    $rb++;
                ?>
                    <tr>
                        <td scope="row" class="text-center">
                            <?php echo $rb; ?>
                        </td>
                        <td class="text-center">
                            <?php echo $row->idOj; ?>
                            </td>
                        <td class="text-center">
                            <?php echo $row->naziv; ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if($row->active == 1) {
                                $aktivan = "Deaktivacija";
                                $color = "green";
                            } else {
                                $aktivan = "Aktivacija";
                                $color = "red";
                            }
                            ?>
                            <a href='<?php echo $this->url . "/activate/" . $row->id; ?>' title='<?php echo $aktivan;?>'><i class='fas fa-circle' style='color: <?php echo $color;?>;'></i></a>
                        </td>
                        <td class="text-center">
                            <?php 
                                //echo "opcije" 
                                echo "<a href='" . $this->url . "/edit/" . $row->id . "' title='Izmena'><i class='fas fa-edit'></i></a>";
                                echo " ";
                                echo "<a href='".$this->url . "/delete/" . $row->id . "' title='Brisanje'><i class='fas fa-minus-square'></i></a>";
                                echo " ";
                                echo "<a href='".$this->url . "/sendWS" . $row->id . "' title='Slanje u RFZO'><i class='fas fa-share-square'></i></a>";
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    