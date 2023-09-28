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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <title>Video</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
<header>
<h1>Main page</h1>
<div class = "navbar">
    <ul>
        <li> <a href = "user_page.php">Home</a></li>
    </ul>
</div>
</header>
<br>
<main>
    <section class = "filters">
        <?php foreach($genres as $item):?>
            <a href="?genre=<?php echo $item['id']; ?>">
                <?php echo $item["name"];?>
            </a>
        <?php endforeach; ?>
    </section>

    <section class = "filters">
        <?php foreach($years as $item):?>
            <a href="?year=<?php echo $item['id']; ?>">
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
                <a class = "button" href = "single.php?id=<?php echo $item['id'];?>">More</a>
            </div>
        <?php endforeach;?>
    </section>
</main>
</body>
</html>