<?php
require("db.php");
$categories = $db->query("SELECT * FROM categories")->fetchAll(2);
$items = $db->query("SELECT * FROM items")->fetchAll(2);
$cities = $db->query("SELECT * FROM cities")->fetchAll(2);

if(isset($_GET['category'])){
        $id = $_GET['category'];
        $items = $db->query("SELECT * FROM items WHERE category=$id")->fetchAll(2);
}
if(isset($_GET['city'])) {
    $id = $_GET['city'];
    $items = $db->query("SELECT * FROM items WHERE city=$id")->fetchAll(2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
<header>

<h1>Hotels</h1>
<div class = "navbar">
    <ul>
        <li> <a href = "login.php">Login</a></li>
        <li> <a href = "viesis.php">Home</a></li>

    </ul>
</div>

</header>
<br>
<main>
    <p>Kategorijas</p>
    <section class = "filters">
        <?php foreach($categories as $item):?>
            <a href="?category=<?php echo $item['id']; ?>">
                <?php echo $item["name"];?>
            </a>
        <?php endforeach; ?>

    </section>
    <p>Pilsetas</p>
    <section class = "filters">
        <?php foreach($cities as $item):?>
            <a href="?city=<?php echo $item['id']; ?>">
                <?php echo $item["name"];?>
            </a>
        <?php endforeach; ?>

    </section>

    <section class = "container">
        <h2>Popular hotels</h2>
        <?php foreach($items as $item): ?>

            <div class = "item">
                <img src = "<?php echo $item['photo']?>" alt = "photo" width = "100">
                <h3><?php echo $item['name']; ?></h3>
                <p>$<?php echo $item['price'];?></p>
                <a class = "button" href = "single.php?id=<?php echo $item['id'];?>">More</a>
            </div>
        <?php endforeach;?>
    </section>
</main>
</body>
</html>
