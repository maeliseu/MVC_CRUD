<?PHP

namespace Source\App;


// use Source\Models\Venda;
// use Source\Models\Cliente;

class Web_c
{
    public function home($data)
    {
        session_start();
        // Create new Plates instance
        $templates = new \League\Plates\Engine('templates');

        // Preassign data to the layout
        $templates->addData([
            'company'       => 'Aula do Prof. Jaime',
            'activevenda'   => '',
            'acticliente'   => '',
            'actiproduto'   => '',
            'url'           => URL_BASE,
            'title'         => 'Carrinho'], 'layout');

        // Render a template
        echo $templates->render('home', []);

    }
    
    public function error($data)
    {
        echo "<h1>Erro {$data["errcode"]}</h1>";
        var_dump($data);
    }
    
}
