<?php $this->layout('layout', []) ?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-lg-5 pb-3 mx-auto bg-white rounded shadow">
            <?=var_dump($itens);?> 
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
                    <?php foreach ($itens as $iten){ ?>
                <tr>
                    <td><?=$this->e($iten["descricao"])?></td>
                    <td><?=$this->e($iten["quantidade"])?></td>
                    <td></td>
                    <td>
                        <button type="button" 
                            class="btn btn-default btn-sm edit edit_data"
                            title="Edit" 
                            data-toggle="tooltip"
                            data-sel_id="<?=$this->e($iten["ID"])?>"
                            data-FK_PRODUTO_ID_PROD="<?=$this->e($iten["FK_PRODUTO_ID_PROD"])?>">                            
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        
                        <button type="button" 
                            class="btn btn-default btn-sm delete"
                            title="Delete" 
                            data-toggle="tooltip"
                            data-sel_id="<?=$this->e($iten["ID"])?>"
                            data-FK_PRODUTO_ID_PROD="<?=$this->e($iten["FK_PRODUTO_ID_PROD"])?>"> 
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
        <?php   } ?> 
                
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
        $('.dataTables_length').addClass('bs-select');
        });
        
    
    </script>
<?php $this->end() ?>

<?php $this->push('stylesheets') ?>
    <!-- stylesheets -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<?php $this->end() ?>
