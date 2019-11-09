<?PHP

namespace Source\App;

use Source\Models\Cliente;

class Cliente_c
{
    protected $templates;
    protected $clientes;

    public function __construct(){
        session_start();
        $this->clientes = new Cliente();
        // Create new Plates instance
        $this->templates = new \League\Plates\Engine('templates');
        // Preassign data to the layout
        $this->templates->addData([
            'company'       => 'Aula do Prof. Jaime',
            'activevenda'   => '',
            'acticliente'   => ' active',
            'actiproduto'   => '',
            'url'           => URL_BASE,
            'title'         => 'Carrinho'], 'layout');
    }

    public function cliente($data)
    {
        // var_dump($this->clientes->find()->fetch(true));
        // Render a template
        echo $this->templates->render('cliente', [
            'listaclientes' => $this->clientes->find()->fetch(true)
        ]);
    }

    
    public function edt($data)
    {
        session_start();
        $url = URL_BASE;
        $clientes = new Cliente();
        // Select
        if(isset($data['btn-editar'])):
            $selectcliente = $clientes->findById($data['id']);
            $selectcliente->NOME = $data['nome'];
            $selectcliente->save();
            if (!$selectcliente->fail()):
                $_SESSION['mensagem'] = "Alterado com sucesso!";
                //header ('Location: ../cliente');
                //echo json_encode($_SESSION);
            else:
                $_SESSION['mensagem'] = "Falha ao alterar!";
                //header ('Location: ../cliente');
                //echo json_encode($_SESSION);
            endif;
        endif;
    }

    public function add($data)
    {
        session_start();
        $url = URL_BASE;
        $clientes = new Cliente();
        // Select
        if(isset($data['btn-editar'])):
            $clientes->NOME = $data['nome'];
            $clientes->save();
            if (!$clientes->fail()):
                $_SESSION['mensagem'] = "Gravado com sucesso!";
                // header ('Location: ../cliente');
            else:
                $_SESSION['mensagem'] = "Falha ao gravar!";
                // header ('Location: ../cliente');
            endif;
        endif;

    }
    
    public function delete($data)
    {
        // var_dump($data);
        session_start();
        $url = URL_BASE;
        $clientes = new Cliente();
        // Select
        if(isset($data['id'])):
	        $selectcliente = $clientes->findById($data['id']);
        endif;

        $selectcliente->destroy();
        
        if (!$selectcliente->fail()):
            $_SESSION['mensagem'] = "Dado deletado com sucesso!";
            // header ('Location: ../cliente');            
        else:
            $_SESSION['mensagem'] = "Falha ao deletar!";
            // header ('Location: ../cliente');// Render a template
            
        endif;
        
    }

    public function error($data)
    {
        echo "<h1>Erro {$data["errcode"]}</h1>";
        var_dump($data);
    }
    
}
