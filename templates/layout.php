<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$this->e($title)?> | <?=$this->e($company)?></title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <?=$this->section('stylesheets')?>
    <link rel="stylesheet" type="text/css" href="<?= asset("/css/style2.css"); ?>">
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="<?=$this->e($url)?>"><img src="<?= asset("/img/icone_carrinho.png"); ?>" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                    <li class="nav-item<?=$this->e($activevenda)?>"><a class="nav-link" href="<?=$this->e($url)?>/venda">Vendas</a></li>
                    <li class="nav-item<?=$this->e($acticliente)?>"><a class="nav-link" href="<?=$this->e($url)?>/cliente">Cadastro Clietne</a></li>
                    <li class="nav-item<?=$this->e($actiproduto)?>"><a class="nav-link" href="<?=$this->e($url)?>/produto">Cadastro Produto</a></li>
              </ul>
            </div>
    </nav>
</header>
<body>
<?=$this->section('content')?>

  <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?=$this->section('scripts')?>
    <script >
       M.AutoInit();

      <?php
      //iniciando a sessão
        if (isset($_SESSION ['mensagem'])):
      ?>          
            window.onload = function () {
                M.toast ({html: '<?php echo $_SESSION ['mensagem']; ?>'})
            };
      <?php
          session_unset();
        //$_SESSION ['mensagem']="";
        endif;        
      ?>
    </script>
</body>
</html>