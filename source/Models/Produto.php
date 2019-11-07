<?PHP 

namespace source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Produto extends DataLayer
{
    public function __construct()
    {
        parent::__construct("produto", [], "ID_PROD", true);
    }
}
