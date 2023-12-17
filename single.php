<?php
    require("db.php");
    if(!isset($_GET["id"])) {
        echo "<script>
            alert('not chosen item');
            location.href = 'user_page.php';
        </script>";
        exit();
    }
    $id = $_GET["id"];

    $item = $db->query("SELECT * FROM items WHERE id=$id")->fetchAll(2);
    $items = $db->query("SELECT * FROM items")->fetchAll(2);

    if(count($item)>0){
        $item = $item[0];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content="width= device-width, initial-scale=1.0">
    <title>Filmu sistēma</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
<header>
    <h1>Info system</h1>
    <form method="post">
        <input type="text" name="search" value="" placeholder="Search bar" >
    </form>
    <div class = "navbar">
        <ul>
            <li> <a href = "user_page.php">Māja</a></li>
            <li> <a href = "logout.php">Iziet</a></li>
        </ul>
    </div>
</header>
</body>
<body class = "single">
    <main>
        <section class = "info">
            <img src="<?php echo $item['photo']?>" alt = "item" width = "400">
            <h2><?php echo $item['name']?></h2>
            <p><?php echo $item['description']?></p>
            <td><a class="edit" href="<?php echo $item['source_1']?>" target="_blank">Avots 1</a></td>
            <td><a class="edit" href="<?php echo $item['source_2']?>" target="_blank">Avots 2</a></td>
        </section>
    </main>
</body>
</html>