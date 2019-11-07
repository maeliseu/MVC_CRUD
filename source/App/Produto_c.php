<?PHP

namespace Source\App;

use Source\Models\Produto;

class Produto_c
{
    protected $templates;
    protected $produtos;

    public function __construct(){
        session_start();
        $this->produtos = new Produto();
        // Create new Plates instance
        $this->templates = new \League\Plates\Engine('templates');
        // Preassign data to the layout
        $this->templates->addData([
            'company'       => 'Aula do Prof. Jaime',
            'activevenda'   => '',
            'acticliente'   => '',
            'actiproduto'   => ' active',
            'url'           => URL_BASE,
            'title'         => 'Carrinho'], 'layout');
    }

    public function produto($data)
    {
        // Render a template
        echo $this->templates->render('produto', [
            'listaprodutos' => $this->produtos->find()->fetch(true)
        ]);
    }

    public function form($data)
    {
        $activevenda = " ";
        $acticliente = " ";
        $actiproduto = "active z-depth-5";
        $url = URL_BASE;
        $produtos = new Produto();
        $descricaoproduto = "";
        $idproduto = "";
        $edtadd = "add";

        // Select
        if(isset($data['id'])):
            $selectproduto = $produtos->findById($data['id']);
            $descricaoproduto = $selectproduto->DESCRICAO;
            $idproduto = $selectproduto->ID_PROD;
            $edtadd = "edt";            
        endif;
                       
        require __DIR__ . "/../../views/produto_form.php";
    }
    
    public function edt($data)
    {
        session_start();
        $url = URL_BASE;
        $produtos = new Produto();
        // Select
        if(isset($data['btn-editar'])):
            $selectproduto = $produtos->findById($data['id']);
            $selectproduto->DESCRICAO = $data['descricao'];
            $selectproduto->save();
            if (!$selectproduto->fail()):
                $_SESSION['mensagem'] = "Alterado com sucesso!";
                //header ('Location: ../produto');
            else:
                $_SESSION['mensagem'] = "Falha ao alterar!";
                //header ('Location: ../produto');
            endif;
        endif;
    }

    public function add($data)
    {
        session_start();
        $url = URL_BASE;
        $produtos = new Produto();
        // Select
        if(isset($data['btn-editar'])):
            $produtos->DESCRICAO = $data['descricao'];
            $produtos->save();
            if (!$produtos->fail()):
                $_SESSION['mensagem'] = "Gravado com sucesso!";
                //header ('Location: ../produto');
            else:
                $_SESSION['mensagem'] = "Falha ao gravar!";
                //header ('Location: ../produto');
            endif;
        endif;

    }
    
    public function delete($data)
    {
        // var_dump($data);
        session_start();
        $url = URL_BASE;
        $produtos = new Produto();
        // Select
        if(isset($data['id'])):
	        $selectproduto = $produtos->findById($data['id']);
        endif;

        $selectproduto->destroy();
        
        if (!$selectproduto->fail()):
            $_SESSION['mensagem'] = "Dado deletado com sucesso!";
            //header ('Location: ../produto');
        else:
            $_SESSION['mensagem'] = "Falha ao deletar!";
            //header ('Location: ../produto');
        endif;
        
    }

    public function error($data)
    {
        echo "<h1>Erro {$data["errcode"]}</h1>";
        var_dump($data);
    }
    
}
