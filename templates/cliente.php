<?php $this->layout('layout', []) ?>


<div class="container-fluid py-2">
    <div class="col-lg-9 pb-3 mx-auto bg-white rounded shadow">
        <table id="dtTabCliente" class="table">
            <thead>  
                <td><h5>Clientes: <button type="button" title="Adicionar" class="btn btn-default btn-sm add add_data">
                    <i class="fas fa-plus-circle text-success" style="font-size:36px;"></i>
                    </button></h5> 
                    
                </td>
                <td></td>
                <td></td>
                <td></td>
                <tr>
                    <th>ID:</th>
                    <th>NOME:</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaclientes as $cliente){ ?>
                <tr>
                    <td><?=$this->e($cliente->ID_CLI)?></td>
                    <td><?=$this->e($cliente->NOME)?></td>
                    <td></td>
                    <td>
                        <button type="button" 
                            class="btn btn-default btn-sm edit edit_data"
                            title="Edit" 
                            data-toggle="tooltip"
                            data-sel_id="<?=$this->e($cliente->ID_CLI)?>"
                            data-sel_nome="<?=$this->e($cliente->NOME)?>">                            
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        
                        <button type="button" 
                            class="btn btn-default btn-sm delete"
                            title="Delete" 
                            data-toggle="tooltip"
                            data-sel_id="<?=$this->e($cliente->ID_CLI)?>"
                            data-sel_nome="<?=$this->e($cliente->NOME)?>">
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
<div id="add_data_Modal" class="modal"  role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="modal-title" class="modal-title">Editar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
            <input type = "hidden" id="sel_id" name="id" value = "">
            <div id="div_edit" class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nome</span>
                </div>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="nome" id="sel_nome" autocomplete="off" value="">
            </div>
      </div>
      <div id="div_btn" class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button id="edt" type="button" class="btn btn-primary">Salvar mudanças</button>
      </div>
    </div>
  </div>
</div>




<?php $this->push('scripts') ?>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script> 

    <script id="codigoJs" type="text/javascript">
        // ###       
        // ###------> tabela
        // ###
        $(document).ready(function () {
            $('#dtTabCliente').DataTable({
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
        // $('.dataTables_length').addClass('bs-select');
        });
        // ###
        // ###------> botão edit (abre Modal)
        // ###
        $(document).on('click', '.edit_data', function(){
            var tex = $(this).data('sel_id');            
            var tex2 = $(this).data('sel_nome');
            document.getElementById("modal-title").innerHTML =
                "Edite Cliente!";
            document.getElementById("div_edit").innerHTML = 
                '<div class="input-group-prepend">'+
                '<span class="input-group-text" id="inputGroup-sizing-sm">Nome</span>'+
                '</div>'+
                '<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="nome" id="sel_nome" autocomplete="off" value="">';
            document.getElementById("div_btn").innerHTML = 
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>'+
                '<button id="edt" type="button" class="btn btn-primary">Salvar mudanças</button>';

            $('#sel_nome').val(tex2);
            $('#sel_id').val(tex);                
            $('#add_data_Modal').modal();
            document.getElementById("sel_nome").focus();
            // ###
            // ###------>  Botão salva alteração
            // ###
            $("#edt").on('click',function() {                    
                let dados = {
                    "btn-editar": true,
                    "id": document.getElementById('sel_id').value,
                    "nome": document.getElementById('sel_nome').value
                };                    
                $.ajax({
                    data: dados,
                    url: 'cliente/edt',
                    method: 'POST', // or GET
                    success: function(msg) {
                        // console.log(msg);
                        $('#add_data_Modal').modal('hide');
                        window.location.href = 'cliente'
                    },
                    error: function (msg) {
                        // console.log(msg);
                        $('#add_data_Modal').modal('hide');
                        window.location.href = 'cliente'
                    }
                });
            });
                
        });
        // ###
        // ###------> Button del
        // ###
        $(".delete").on('click',function() {
            var tex = $(this).data('sel_id');
            var tex2 = $(this).data('sel_nome');
            document.getElementById("modal-title").innerHTML =
                "Deletar Cliente!";
            document.getElementById("div_edit").innerHTML =
                tex2;
            document.getElementById("div_btn").innerHTML =
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>'+
                '<button id="del" type="button" class="btn btn-danger">Deletar</button>';
           
            $('#sel_id').val(tex);  
            $('#add_data_Modal').modal();
            // ###
            // ###------> Button acept del
            // ###
            $("#del").on('click',function() {
                $.ajax({
                    data: 'id=' + tex,
                    url: 'cliente/delete',
                    method: 'POST', // or GET
                    success: function(msg) {
                        $('#add_data_Modal').modal('hide');
                        window.location.href = 'cliente'
                    }
                });
            });
        });
        // ###
        // ###------> botão add (abre Modal)
        // ###
        $(document).on('click', '.add_data', function(){
            // var tex = $(this).data('sel_id');            
            // var tex2 = $(this).data('sel_nome');
            document.getElementById("modal-title").innerHTML =
                "Adiciona Cliente!";
            document.getElementById("div_edit").innerHTML = 
                '<div class="input-group-prepend">'+
                '<span class="input-group-text" id="inputGroup-sizing-sm">Nome</span>'+
                '</div>'+
                '<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="nome" id="sel_nome" autocomplete="off" value="">';
            document.getElementById("div_btn").innerHTML = 
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>'+
                '<button id="edt" type="button" class="btn btn-primary">Adicionar</button>';

            // $('#sel_nome').val(tex2);
            // $('#sel_id').val(tex);                
            $('#add_data_Modal').modal();
            document.getElementById("sel_nome").focus();
            // ###
            // ###------>  Botão salva alteração
            // ###
            $("#edt").on('click',function() {                    
                let dados = {
                    "btn-editar": true,
                    "nome": document.getElementById('sel_nome').value
                };
                // console.log(dados);
                $.ajax({
                    data: dados,
                    url: 'cliente/add',
                    method: 'POST', // or GET
                    success: function(msg) {
                        // console.log(msg);
                        $('#add_data_Modal').modal('hide');
                        window.location.href = 'cliente'
                    },
                    error: function (msg) {
                        // console.log(msg);
                        $('#add_data_Modal').modal('hide');
                        window.location.href = 'cliente'
                    }
                });
            });
                
        });
    </script>
<?php $this->end() ?>

<?php $this->push('stylesheets') ?>
    <!-- stylesheets -->
    
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    
    
    
<?php $this->end() ?>
