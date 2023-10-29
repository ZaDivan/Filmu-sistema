<?php

require("db.php");


if(isset($_GET["Delete"])){
    $id = $_GET['id'];
    if($db->query("DELETE FROM items WHERE id=$id")) {
        echo "<script>
                alert('Veiksmigi izrakstits')
                location.href = 'admin.php';
            </script>";
    }
}

if(isset($_GET["Add"])){
    $name = $_GET["new_item_name"];
    $photo = $_GET['photo'];
    $description = $_GET['description'];
    $price = $_GET['price'];
    $category = $_GET['category'];
    $city = $_GET['city'];
    if($db->query("INSERT INTO items (name, photo, description, price, category, city) 
VALUES ('$name', '$photo', '$description', $price, '$category', '$city') ")){
        echo "<script>
                alert('Veiksmigi pievienots')
                location.href = 'admin.php';
            </script>";
    }
}


if(isset($_GET["Update"])){
    $name = $_GET["item_name"];
    $photo = $_GET['photo'];
    $description = $_GET['description'];
    $price = $_GET['price'];
    $category = $_GET['category'];
    $city = $_GET['city'];
    $id = $_GET['id'];
    if($db->query("UPDATE items SET name='$name', photo='$photo',
        description='$description', price='$price', category='$category', city='$city' WHERE id=$id")){
        echo "<script>
                alert('Veiksmigi izmainits')
                location.href = 'admin.php';
            </script>";
    }
}

$categories = $db->query("SELECT * FROM categories")->fetchAll(2);
$items = $db->query("SELECT * FROM items")->fetchAll(2);
$cities = $db->query("SELECT * FROM cities")->fetchAll(2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel = "stylesheet" href = "style.css">
</head>
<body>
<h1>Admin panel</h1>
<header>
    <a href = "admin_page.php">Back</a>
</header>

<main>
    <h2>Products</h2>
    <div class = "container">
        <form action="#" class="item">
                <label>
                    Nosaukums
                    <input type="text" required name="new_item_name"></label>
                <label>
                    Foto
                    <input type="text" required name="photo" ></label>
                <label>
                    Apraksts
                    <textarea required name="description"></textarea></label>
                <label>
                    Cena
                    <input type="number" required min="0" name="price" ></label>

                <label>
                    Kategorija
                    <select name="category" id="">
                        <?php foreach($categories as $cat): ?>
                            <option value="<?php echo $cat['id'];?>">
                                <?php echo $cat['name'] ?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </label>

                <label>
                    City
                    <select name="city" id="">
                        <?php foreach($cities as $pilseta): ?>
                            <option value="<?php echo $pilseta['id'];?>">
                                <?php echo $pilseta['name'] ?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </label>

                <input type="submit" name="Add" value="Add" class="form-btn">
        </form>


            <?php foreach ($items as $item):?>
                <form action="#" class="item">
                    <img src="<?php echo $item['photo'];?>" alt="photo" width="100" height="100">
                    <label>
                        Nosaukums
                        <input type="text" name="item_name" value="<?php echo $item['name']?>"></label>
                    <label>
                        Foto
                        <input type="text" name="photo" value="<?php echo $item['photo']?>"></label>
                    <label>
                        Apraksts
                        <textarea name="description"><?php echo $item['description']?></textarea></label>
                    <label>
                        Cena
                        <input type="number" min="0" name="price" value="<?php echo $item['price']?>"></label>

                    <label>
                        Kategorija
                        <select name="category" id="">
                            <?php foreach($categories as $cat): ?>
                                <option <?php if($item['category'] == $cat['id']) echo 'selected';  ?> value="<?php echo $cat['id'];?>">
                                    <?php echo $cat['name'] ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </label>

                    <label>
                        City
                        <select name="city" id="">
                            <?php foreach($cities as $pilseta): ?>
                                <option <?php if($item['city'] == $pilseta['id']) echo 'selected';  ?> value="<?php echo $pilseta['id'];?>">
                                    <?php echo $pilseta['name'] ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </label>

                    <input type = "hidden" name="id" value="<?php echo $item['id']; ?>">

                    <input type="submit" name="Update" value="Update" class="form-btn">
                    <input type="submit" name="Delete" value="Delete" class="form-btn">
                </form>
            <?php endforeach;?>
        </div>
</main>
</body>
</html>