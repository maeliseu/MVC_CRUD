<?php $this->layout('layout', []) ?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-lg-5 pb-3 mx-auto bg-white rounded shadow">
            <div class="form-group">
                <label for="formGroupInput">ID venda:</label>
                <label for="formGroupInput"><?=$this->e($ID_VEND);?></label>
            </div>
            <div class="input-group mb-3">
                <!-- <div class="input-group-prepend"> -->
                    <label class="input-group-text" for="inputname">Nome</label>
                <!-- </div> -->
                <select class="browser-default selectpicker" data-style="btn-outline-primary" data-live-search="true" data-size="5" id="inputname">
        <?PHP       foreach ($clientes as $value) {
                        if ($value->ID_CLI == $FK_CLIENTE_ID_CLI) {
                            echo "<option value='".$value->ID_CLI."' selected>".$value->NOME."</option>";
                        }else{
                            echo "<option value='".$value->ID_CLI."' >".$value->NOME."</option>";
                        } 			
                    }
        ?>
                </select>
            </div>



            <button id="btn_fechar" type="button" class="btn btn-secondary">Fechar</button>
            <button id="edt_salve" type="button" class="btn btn-success">Salvar mudanças</button>
               
                
                
        </div>
    
        <div class="col-lg-5 pb-3 mx-auto bg-white rounded shadow">
            <table id="dtTabitens" class="table">
                    <thead>
                        <tr>
                            <td>
                                <h5>Itens: <button type="button" 
                                                    title="Adicionar" 
                                                    class="btn btn-default btn-sm add add_data">
                                                <i class="fas fa-plus-circle" style="font-size:36px;"></i>
                                            </button>
                                </h5>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Descrição:</th>
                            <th>Quantidade:</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
            <?php 
                    if (isset($itens)) {
                        foreach ($itens as $iten){
            ?>         
                        <tr>
                            <td><?=$this->e($iten['descricao']);?></td>
                            <td><?=$this->e($iten["quantidade"]);?></td>
                            <td></td>
                            <td><button type="button" 
                                        class="btn btn-default btn-sm edit edit_data"
                                        title="Edit" 
                                        data-toggle="tooltip"
                                        data-sel_id=<?=$this->e($iten["ID"]);?>
                                        data-FK_PRODUTO_ID_PROD=<?=$this->e($iten["FK_PRODUTO_ID_PROD"]);?>>                            
                                <i class="fas fa-pencil-alt"></i>
                            </button>                        
                            <button     type="button" 
                                        class="btn btn-default btn-sm delete"
                                        title="Delete" 
                                        data-toggle="tooltip"
                                        data-sel_id=<?=$this->e($iten["ID"]);?>
                                        data-FK_PRODUTO_ID_PROD=<?=$this->e($iten["FK_PRODUTO_ID_PROD"]);?>> 
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            </td>
                        </tr>
            <?php       }
                    }
            ?> 
                
                    </tbody>
                    <tfoot>
                        
                    </tfoot>
                </table>
        </div>
    </div>
    </div>
</div>

<?php $this->push('scripts') ?>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.min.js"></script>
    <script>
        // Some JavaScript
        $(document).ready(function () {
            $('#dtTabitens').DataTable({
                "scrollY": 320,
                "searching": false,
                "lengthChange": false,
                "pageLength": 7,
                "info": true,
                "ordering": false,
                "language": {
                    "paginate": {
                        "next": "<i class='material-icons'>skip_next</i>",
                        "previous": "<i class='material-icons'>skip_previous</i>"
                    }
                }
            }); 



            $('select').selectpicker();


            
        $('.dataTables_length').addClass('bs-select');
        });
        
        $("#btn_fechar").on('click',function() {
            window.location.href = '<?=URL_BASE?>/venda';
        });
        
    
    </script>
<?php $this->end() ?>

<?php $this->push('stylesheets') ?>
    <!-- stylesheets -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.min.css">
<?php $this->end() ?>
