<?PHP

namespace Source\App;

use Source\Models\Venda;
use Source\Models\Cliente;
use Source\Models\Produto;

class Venda_c
{
    protected $templates;
    protected $produtos;
    protected $clientes;
    protected $vendas;
    

    public function __construct(){
        $this->clientes = new Cliente();
        $this->produtos = new Produto();
        $this->vendas = new Venda();

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
            'listavendas'   => $listavendas
        ]);
    }

   
    public function contact2($data)
    {
        echo "<h1>Contato2</h1>";
        var_dump($data);

        $url = URL_BASE;
        if (!$data){
            $data['first_name'] = " ";
            $data['last_name'] = " ";
            $data['email'] = " ";
        }
        // var_dump($data);
        require __DIR__ . "/../../views/contact.php";

    }

    public function error($data)
    {
        echo "<h1>Erro {$data["errcode"]}</h1>";
        var_dump($data);
    }
    
}
