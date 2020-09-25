<?php  

require_once './DBStaticFactory.php';
require_once './TodoModel.php';

class ToDoService {

    private $connection;

    public function __construct()
    {
        $this->connection = DBStaticFactory::con();
    }

    public function getWhereUserId($userId): array {
        $todos = [];
        $query = $this->connection->query("Select id,name,user,done,created from items WHERE user = {$userId}");
        return array_map(function($item){
            return new TodoModel($item['id'], $item['name'], $item['user'], $item['done'], $item['created']);
        }, $query->fetch_all(MYSQLI_ASSOC));
    }

}