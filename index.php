<?PHP
require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

/*
 * Controllers
 */
$router->namespace("Source\App");

/*
 * WEB
 * home
 */
$router->group(null);
$router->get("/", "Web_c:home");
// $router->get("/contato/{id_cont}", "Web:contact");

/*
 * cliente
 */
$router->group("cliente");
$router->get("/", "Cliente_c:cliente");
// $router->get("/delete", "Cliente_c:delete");
$router->get("/form", "Cliente_c:form");
$router->post("/form", "Cliente_c:form");
$router->post("/add", "Cliente_c:add");
$router->post("/edt", "Cliente_c:edt");
$router->post("/delete", "Cliente_c:delete");

/*
 * produto
 */
$router->group("produto");
$router->get("/", "Produto_c:produto");

$router->get("/form", "Produto_c:form");
$router->post("/form", "Produto_c:form");
$router->post("/add", "Produto_c:add");
$router->post("/edt", "Produto_c:edt");
$router->post("/delete", "Produto_c:delete");

/*
 * venda
 */
$router->group("venda");
$router->get("/", "Venda_c:venda");

$router->get("/form", "Venda_c:form");
$router->post("/form", "Venda_c:form");
$router->post("/add", "Venda_c:add");
$router->post("/edt", "Venda_c:edt");
$router->post("/delete", "Venda_c:delete");


/*
 * ERRORS
 */
$router->group("ooops");
$router->get("/{errcode}", "Web_c:error");

$router->dispatch();

if($router->error()) {
    // var_dump($router);
    $router->redirect("/ooops/{$router->error()}");
}

?>