<?php $this->layout('layout', []) ?>

<div class="container-fluid py-2">
        <div class="col-lg-6 pb-3 mx-auto bg-white rounded shadow">
            <table id="dtTabVenda" class="table">
                <thead>
                    <td><h5>Vendas: <a title="Adicionar" class="add add_data"><i class="material-icons add">add</i></a></h5></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
                        <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                        <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
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
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script>
        // Some JavaScript
        $(document).ready(function () {
        $('#dtTabVenda').DataTable({
            "scrollY": 300,
            "searching": false,
            "lengthChange": false,
            "pageLength": 8,
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
