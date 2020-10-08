<?php
    session_start();
    
    require_once 'DBStaticFactory.php';

    require_once 'TodoService.php';
    require_once 'TodoModel.php';

    $user_id = $_SESSION['user_id']=1;
    
    $todo_service = new ToDoService();
    
    $todos = $todo_service->getWhereUserId($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">  
</head>
<body>

    <div class="list">
        <h1 class="header">To do List</h1>

        <?php if (!empty($todos)):?>
        <ul class="items">
            <?php foreach($todos as $todo):?>
            <li>
                <span class="item <?php echo $todo->getDone() ? 'done' : '' ?>"><?php echo $todo->getName()?></span>
                <?php if (!$todo->getDone()):?>
                    <a href="mark.php?as=done&item=<?php echo $todo->getId();?>" class="done-button">Mark as done</a>
                <?php endif; ?>
            </li>
            <?php endforeach;?>
        </ul>
        
            <?php else: ?>
            <p>Aun no has añadido ningun elemento</p>
            <?php endif;?>
        
        

        <form class="item-add" action="add.php" method="POST">
            <input type="text" name="name" placeholder="Escribe un item..." class="input" autocomplete="off" autocapitalize="on" required>
            <input type="submit" value="Add" class="submit">
        </form>

    </div>
    
</body>
</html>