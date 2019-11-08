<?php $this->layout('layout', []) ?>

<div class="container-fluid py-2">
        <div class="col-lg-9 pb-3 mx-auto bg-white rounded shadow">
            <table id="dtTabVenda" class="table">
                <thead>
                    <tr>
                        <td>
                            <h5>Vendas: <button type="button" 
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
                        <th>ID:</th>
                        <th>CLIENTE:</th>
                        <th>DATA</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            <?php foreach ($listavendas as $venda){ ?>
                    <tr>
                        <td><?=$this->e($venda["ID_VEND"])?></td>
                        <td><?=$this->e($venda["NOME"])?></td>
                        <td><?=$this->e($venda["DATA"])?></td>
                        <td>
                            <button type="button" 
                                class="btn btn-default btn-sm edit edit_data"
                                title="Edit" 
                                data-toggle="tooltip"
                                data-sel_ID_VENDA="<?=$this->e($venda["ID_VEND"])?>"
                                data-sel_NOME="<?=$this->e($venda["NOME"])?>"
                                data-sel_DATA="<?=$this->e($venda["DATA"])?>"
                                data-sel_FK_CLIENTE_ID_CLI="<?=$this->e($venda["FK_CLIENTE_ID_CLI"])?>">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <!-- <button type="button" 
                                class="btn btn-default btn-sm delete"
                                title="Delete" 
                                data-toggle="tooltip"
                                data-sel_ID_VENDA="<?=$this->e($venda["ID_VEND"])?>"
                                data-sel_NOME="<?=$this->e($venda["NOME"])?>"
                                data-sel_DATA="<?=$this->e($venda["DATA"])?>"
                                data-sel_FK_CLIENTE_ID_CLI="<?=$this->e($venda["FK_CLIENTE_ID_CLI"])?>">
                                <i class="fas fa-trash-alt"></i>
                            </button> -->
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

<?php $this->push('scripts') ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

    <script>
        // Some JavaScript
        $(document).ready(function () {
            $('#dtTabVenda').DataTable({
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
        // ###
        // ###------> botão add (abre form_venda)
        // ###
        $(document).on('click', '.add_data', function(){
            let form = document.createElement('form');
            form.action = "venda/formulario";
            form.method = 'POST';

            my_tb=document.createElement('INPUT');
            my_tb.type='TEXT';
            my_tb.name='comando';
            my_tb.value='new';
            form.appendChild(my_tb);

            my_tb=document.createElement('INPUT');
            my_tb.type='TEXT';
            my_tb.name='id';
            my_tb.value='2';
            form.appendChild(my_tb);
            
            // the form must be in the document to submit it
            document.body.append(form);

            form.submit();
            
        });
    </script>
<?php $this->end() ?>

<?php $this->push('stylesheets') ?>
    <!-- stylesheets -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<?php $this->end() ?>
