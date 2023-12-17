<?php
require("db.php");
$genres = $db->query("SELECT * FROM genres")->fetchAll(2);
$years = $db->query("SELECT * FROM years")->fetchAll(2);
$items = $db->query("SELECT * FROM items")->fetchAll(2);

if(isset($_GET['genre'])){
    $id = $_GET['genre'];
    $items = $db->query("SELECT * FROM items WHERE genre_id=$id")->fetchAll(2);
}
if(isset($_GET['year'])) {
    $id = $_GET['year'];
    $items = $db->query("SELECT * FROM items WHERE year_id=$id")->fetchAll(2);
}

if (isset($_POST["search"])){
    $str = $_POST["search"];
    $items = $db->query("SELECT * FROM items WHERE name LIKE '%$str%'")->fetchAll(2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmu sistēma</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
<header>
    <h1>Info sistēma</h1>
    <form method="post">
        <input type="text" name="search" value="" placeholder="Meklēt" >
    </form>
    <div class = "navbar">
        <ul>
            <li> <a id="admin_bar" href="admin.php">AdminPanels</a></li>
            <li> <a href = "admin_page.php">Māja</a></li>
            <li> <a href = "logout.php">Iziet</a></li>

        </ul>
    </div>
</header>
    <br>
<main>
    <h2>Žanri</h2>
    <section class = "filters">
        <?php foreach($genres as $item):?>
            <a href="?genre=<?php echo $item['id']; ?>">
                <?php echo $item["name"];?>
            </a>
        <?php endforeach; ?>
    </section>

    <h2>Gadi</h2>
    <section class = "filters">
        <?php foreach($years as $item):?>
            <a href="?year=<?php echo $item['id']; ?>">
                <?php echo $item["name"];?>
            </a>
        <?php endforeach; ?>
    </section>

        <section class = "container">
            <h2>Populāras filmas and seriāli</h2>
            <?php foreach($items as $item): ?>

                <div class = "item">
                    <img src = "<?php echo $item['photo']?>" alt = "photo" width = "100">
                    <h3><?php echo $item['name']; ?></h3>
                    <a class = "button" href = "single.php?id=<?php echo $item['id'];?>">More</a>
                </div>
            <?php endforeach;?>
        </section>
    </main>
</body>
</html>