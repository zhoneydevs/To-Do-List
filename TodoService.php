<?php  

require_once './DBStaticFactory.php';
require_once './TodoModel.php';

class ToDoService {

    private $connection;

    public function __construct()
    {
        $this->connection = DBStaticFactory::con();
    }

    public function getWhereUserId($itemId): array {
      
        $query = $this->connection->query("Select id,name,user,done,created from items WHERE user = {$itemId}");
        return array_map(function($item){
            return new TodoModel($item['id'], $item['name'], $item['user'], $item['done'], $item['created']);
		}, $query->fetch_all(MYSQLI_ASSOC));

	}

	public function getMarkAsDoneToSql($itemId):string{
		$update= "UPDATE items SET done=1 WHERE id= {$itemId}";
		
	return $update;

	}
	
	public function exists(int $id): bool {
		return $this->getWhereUserId($id) !== null;
	}

	public function isNotDone(int $id): bool {
		return !$this->getWhereUserId($id);
	}

	public function existsAndIsNotDone(int $id): bool{
		return $this->exists($id) && $this->isNotDone($id)!==null;
	}

	public function markAsDone(int $id){
		$todo = $this->getWhereUserId($id);
		$getu= $this->getMarkAsDoneToSql($id);
		return $this->connection->query($getu);
	}
	
	

}

/*
class TodoService {

	private $connection;

	public function __construct(){
		$this->connection = DBStaticFactory::con();
	}

	public function getById($id) {

		// Query para obtener el ID 
        // SELECT * FROM items WHERE id = {$id} LIMIT 1
        $query=$this->connection->query("Select id,name,user,done,created from items WHERE user = {$id} LIMIT 1");

		$todo = new TodoModel($id,$name,$user,$done,$created);
		return $todo;
	}

	public function exists(int $id): bool {
		return $this->getById($id) !== null;
	}

	public function isNotDone(int $id) {
		return !$this->getById($id)->isDone();
	}

	public function existsAndIsNotDone(int $id){
		return $this->exists($id) && $this->isNotDone($id);
	}

	public function markAsDone(int $id){
		$todo = $this->getById($id);
		return $this->connection->query($todo->getMarkAsDoneToSql());
	}

}
*/


