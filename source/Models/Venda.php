<?PHP 

namespace source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Venda extends DataLayer
{
    public function __construct()
    {
        parent::__construct("venda", [], "ID_VEND", true);
    }
}
