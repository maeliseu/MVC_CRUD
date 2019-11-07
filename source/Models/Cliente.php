<?PHP 

namespace source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Cliente extends DataLayer
{
    public function __construct()
    {
        parent::__construct("cliente", [], "ID_CLI", true);
    }
}
