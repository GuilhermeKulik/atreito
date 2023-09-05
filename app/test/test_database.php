<?

require_once '/../config/Config.php';
require_once '/../config/DBConnection.php';
require_once '/../model/GenericModel.php';

$db = new DBConnection();  // Cria a conexão
$model = new GenericModel($db->getConnection());  // Inicializa o modelo genérico

// Exemplos de utilização:
$data = $model->fetchAll("user");
// ... [resto do código]