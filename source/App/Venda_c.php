<?PHP

namespace Source\App;

use Source\Models\Venda;
use Source\Models\Cliente;
use Source\Models\Produto;
use Source\Models\Itens;

class Venda_c
{
    protected $templates;
    protected $produtos;
    protected $clientes;
    protected $vendas;
    Protected $itens;
    

    public function __construct(){
        $this->clientes = new Cliente();
        $this->produtos = new Produto();
        $this->vendas = new Venda();
        $this->itens = new Itens();

        // Create new Plates instance
        $this->templates = new \League\Plates\Engine('templates');
        // Preassign data to the layout
        $this->templates->addData([
            'company'       => 'Aula do Prof. Jaime',
            'activevenda'   => ' active',
            'acticliente'   => '',
            'actiproduto'   => '',
            'url'           => URL_BASE,
            'title'         => 'Carrinho'], 'layout');
    }

    public function venda($data)
    {
        foreach ($this->vendas->find()->fetch(true) as $venda){
            $nomecliente = $this->clientes->find("ID_CLI = :ID", "ID=$venda->FK_CLIENTE_ID_CLI")->fetch();
            $listavendas[] =[
                'ID_VEND'               =>  $venda->ID_VEND,
                'FK_CLIENTE_ID_CLI'     =>  $venda->FK_CLIENTE_ID_CLI,
                'NOME'                  =>  $nomecliente->NOME,
                'DATA'                  =>  date("d-m-Y",strtotime($venda->created_at))
            ];
        }
        
        // Render a template
        echo $this->templates->render('venda', [
            'url'           => URL_BASE,
            'listavendas'   => $listavendas
        ]);
    }

   
    public function formulario($data)
    {
        // var_dump($data);
        $ID_VEND = $data["id"];
        $FK_CLIENTE_ID_CLI = $data["FK_CLIENTE_ID_CLI"];
        $itensdavenda = $this->itens->find("FK_VENDA_ID_VEND = :ID_VEND", "ID_VEND=$ID_VEND")->fetch(true);
        // $listaitens[]  = "" ;
        if ($itensdavenda) {
            foreach ($itensdavenda as $lista){
            $descricao = $this->produtos->find("ID_PROD = :ID", "ID=$lista->FK_PRODUTO_ID_PROD")->fetch();
            $listaitens[] = [
                'ID'                    => $lista->ID,
                'ID_VEND'               => $ID_VEND,
                'FK_PRODUTO_ID_PROD'    => $lista->FK_PRODUTO_ID_PROD,
                'descricao' => $descricao->DESCRICAO,
                'quantidade' => $lista->quantidade
            ];
             
            }
        echo $this->templates->render('/form_venda', [
            'ID_VEND'       => $ID_VEND,
            'nome'          => $data["nome"],
            'FK_CLIENTE_ID_CLI' => $FK_CLIENTE_ID_CLI,
            'clientes'      => $this->clientes->find()->fetch(true),
            'produtos'      => $this->produtos->find()->fetch(true),
            'itens'         => $listaitens
        ]);    
            
        } else { 
            echo $this->templates->render('/form_venda', [
                'ID_VEND'       => $ID_VEND,
                'nome'          => $data["nome"],
                'FK_CLIENTE_ID_CLI' => $FK_CLIENTE_ID_CLI,
                'clientes'      => $this->clientes->find()->fetch(true),
                'produtos'      => $this->produtos->find()->fetch(true)
            ]);
        }  
        //  var_dump ($listaitens);
        // echo $this->templates->render('/form_venda', [
        //     'ID_VEND'       => $ID_VEND,
        //     'nome'          => $data["nome"],
        //     'FK_CLIENTE_ID_CLI' => $FK_CLIENTE_ID_CLI,
        //     'clientes'      => $this->clientes->find()->fetch(true),
        //     'produtos'      => $this->produtos->find()->fetch(true),
        //     'itens'         => $listaitens
        // ]);
    }

    public function error($data)
    {
        echo "<h1>Erro {$data["errcode"]}</h1>";
        var_dump($data);
    }
    
}
