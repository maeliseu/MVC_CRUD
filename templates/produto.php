<?php $this->layout('layout', []) ?>


<div class="container-fluid py-2">
    <div class="col-lg-9 pb-3 mx-auto bg-white rounded shadow">
        <table id="dtTabProduto" class="table">
            <thead>
                <td><h5>Produtos: <button type="button" title="Adicionar" class="btn btn-default btn-sm add add_data">
                    <i class="fas fa-plus-circle" style="font-size:36px;"></i></h5></td>
                <td></td>
                <td></td>
                <td></td>
                <tr>
                    <th>ID:</th>
                    <th>DESCRIÇÃO:</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaprodutos as $produto){ ?>
                <tr>
                    <td><?=$this->e($produto->ID_PROD)?></td>
                    <td><?=$this->e($produto->DESCRICAO)?></td>
                    <td></td>
                    <td>
                        <button type="button" 
                            class="btn btn-default btn-sm edit edit_data"
                            title="Edit"
                            data-toggle="tooltip"
                            data-sel_id="<?=$this->e($produto->ID_PROD)?>"
                            data-sel_descricao="<?=$this->e($produto->DESCRICAO)?>">
                            <i class="fas fa-pencil-alt"></i>   
                        </button>
                        <button type="button" 
                            class="btn btn-default btn-sm delete" 
                            title="Delete" 
                            data-toggle="tooltip"
                            data-sel_id="<?=$this->e($produto->ID_PROD)?>"
                            data-sel_descricao="<?=$this->e($produto->DESCRICAO)?>">
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
        <h5 id="modal-title" class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
            <input type = "hidden" id="sel_id" name="id" value = "">
            <div id="div_edit" class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Nome</span>
                </div>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="nome" id="sel_descricao" autocomplete="off" value="">
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
    <script>
        // ###       
        // ###------> tabela
        // ###
        $(document).ready(function () {
            $('#dtTabProduto').DataTable({
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
            var tex2 = $(this).data('sel_descricao');
            document.getElementById("modal-title").innerHTML =
                "Edite Produto!";
            document.getElementById("div_edit").innerHTML = 
                '<div class="input-group-prepend">'+
                '<span class="input-group-text" id="inputGroup-sizing-sm">Descrição</span>'+
                '</div>'+
                '<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="descricao" id="sel_descricao" autocomplete="off" value="">';
            document.getElementById("div_btn").innerHTML = 
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>'+
                '<button id="edt" type="button" class="btn btn-primary">Salvar mudanças</button>';

            $('#sel_descricao').val(tex2);
            $('#sel_id').val(tex);                
            $('#add_data_Modal').modal();
            document.getElementById("sel_descricao").focus();
            // ###
            // ###------>  Botão salva alteração
            // ###
            $("#edt").on('click',function() {                    
                let dados = {
                    "btn-editar": true,
                    "id": document.getElementById('sel_id').value,
                    "descricao": document.getElementById('sel_descricao').value
                };                    
                $.ajax({
                    data: dados,
                    url: 'produto/edt',
                    method: 'POST', // or GET
                    success: function(msg) {
                        // console.log(msg);
                        $('#add_data_Modal').modal('hide');
                        window.location.href = 'produto'
                    },
                    error: function (msg) {
                        // console.log(msg);
                        $('#add_data_Modal').modal('hide');
                        window.location.href = 'produto'
                    }
                });
            });
                
        });
        // ###
        // ###------> Button del
        // ###
        $(".delete").on('click',function() {
            var tex = $(this).data('sel_id');
            var tex2 = $(this).data('sel_descricao');
            document.getElementById("modal-title").innerHTML =
                "Deletar Produto!";
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
                    url: 'produto/delete',
                    method: 'POST', // or GET
                    success: function(msg) {
                        $('#add_data_Modal').modal('hide');
                        window.location.href = 'produto'
                    }
                });
            });
        });
        // ###
        // ###------> botão Add (abre Modal)
        // ###
        $(document).on('click', '.add_data', function(){
            // var tex = $(this).data('sel_id');            
            // var tex2 = $(this).data('sel_descricao');
            document.getElementById("modal-title").innerHTML =
                "Adiciona Produto!";
            document.getElementById("div_edit").innerHTML = 
                '<div class="input-group-prepend">'+
                '<span class="input-group-text" id="inputGroup-sizing-sm">Descrição</span>'+
                '</div>'+
                '<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" name="descricao" id="sel_descricao" autocomplete="off" value="">';
            document.getElementById("div_btn").innerHTML = 
                '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>'+
                '<button id="edt" type="button" class="btn btn-primary">Adicionar</button>';

            // $('#sel_descricao').val(tex2);
            // $('#sel_id').val(tex);                
            $('#add_data_Modal').modal();
            document.getElementById("sel_descricao").focus();
            // ###
            // ###------>  Botão salva alteração
            // ###
            $("#edt").on('click',function() {                    
                let dados = {
                    "btn-editar": true,                    
                    "descricao": document.getElementById('sel_descricao').value
                };                    
                $.ajax({
                    data: dados,
                    url: 'produto/add',
                    method: 'POST', // or GET
                    success: function(msg) {
                        // console.log(msg);
                        $('#add_data_Modal').modal('hide');
                        window.location.href = 'produto'
                    },
                    error: function (msg) {
                        // console.log(msg);
                        $('#add_data_Modal').modal('hide');
                        window.location.href = 'produto'
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
