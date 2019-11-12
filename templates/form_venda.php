<?php $this->layout('layout', []) ?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-lg-5 pb-3 mx-auto bg-white rounded shadow">
            <div class="form-group">
                <label for="formGroupInput">ID venda:</label>
                <label for="formGroupInput"><?=$this->e($ID_VEND);?></label>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputname">Nome</label>
                </div>
                <select class="browser-default selectpicker show-tick inputname" data-style="btn-outline-primary" data-size="5" data-live-search="true" id="inputname">
        <?PHP       foreach ($clientes as $cliente) {
						if ($cliente->ID_CLI == $FK_CLIENTE_ID_CLI) {
							echo "<option value='".$cliente->ID_CLI."' selected>".$cliente->NOME."</option>";
						}else{
							echo "<option value='".$cliente->ID_CLI."' >".$cliente->NOME."</option>";
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
                                                <i class="fas fa-plus-circle text-success" style="font-size:36px;"></i>
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
                                        data-quantidade=<?=$this->e($iten["quantidade"]);?>
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
<!-- ####  Modal  -->
<div id="add_data_Modal" class="modal"  role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="modal-title" class="modal-title">Edit compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
            <div class="input-group mb-3">
                <!-- <div class="input-group-prepend"> -->
                    <label class="input-group-text" for="inputproduto">Nome</label>
                <!-- </div> -->
                <select class="browser-default selectpicker inputproduto" data-style="btn-outline-primary" data-live-search="true" data-size="5" name="inputproduto" id="inputproduto">
        <?PHP       foreach ($produtos as $value) {
                        echo "<option value='".$value->ID_PROD."' >".$value->DESCRICAO."</option>";                        			
                    }
        ?>
                </select>
            </div>
            <div class="input-group mb-3">                
                <label class="input-group-text" for="inputquantidade">Quantidade</label>
                <input type="text"  class="form-control" id="inputquantidade">
            </div>
                

      </div>
      <div id="div_btn" class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button id="edt" type="button" class="btn btn-primary">Salvar mudanças</button>
      </div>
    </div>
  </div>
</div>
<!-- ####  Modal  -->

<?php $this->push('scripts') ?>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/js/bootstrap-select.min.js"></script> -->
<script src="<?=URL_BASE?>/public/js/bootstrap-select.js"></script>

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
            $('.inputnamet').selectpicker('render');           
            // $('.dataTables_length').addClass('bs-select');
            
        });
        
        $("#btn_fechar").on('click',function() {
            window.location.href = '<?=URL_BASE?>/venda';
        });
        $(document).on('click', '.edit_data', function(){
            document.getElementById("modal-title").innerHTML =
                "Edite produto comprado!";
            var id = $(this).data('sel_id');
            var fk_id_prod = $(this).attr('data-FK_PRODUTO_ID_PROD'); 
            var quantidade = $(this).attr('data-quantidade');
            // console.log(id+' - '+fk_id_prod+' - '+quantidade);
            $('#inputquantidade').val(quantidade);
            
            
            
            $('#add_data_Modal').modal();

            $('.inputproduto').selectpicker('val', fk_id_prod);
                       
            
            
            
        });
        
        
        
    
    </script>
<?php $this->end() ?>

<?php $this->push('stylesheets') ?>
    <!-- stylesheets -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.12/dist/css/bootstrap-select.min.css"> -->
    <link rel="stylesheet" href="<?=URL_BASE?>/public/css/bootstrap-select.css">
<?php $this->end() ?>