<?PHP 

namespace source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Itens extends DataLayer
{
    public function __construct()
    {
        parent::__construct("itens", [], "ID", false);
    }
}
