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
    $genre_id = $_GET['genre_id'];
    $photo = $_GET['photo'];
    $description = $_GET['description'];
    $year_id = $_GET['year_id'];
    $source_1 = $_GET['source_1'];
    $source_2 = $_GET['source_2'];
    if($db->query("INSERT INTO items (name, genre_id, year_id, description, photo, source_1, source_2) 
VALUES ('$name','$genre_id','$year_id','$description','$photo' ,'$source_1','$source_2') ")){
        echo "<script>
                alert('Veiksmigi pievienots')
                location.href = 'admin.php';
            </script>";
    }
}


if(isset($_GET["Update"])){
    $name = $_GET["new_item_name"];
    $photo = $_GET['photo'];
    $description = $_GET['description'];
    $year_id = $_GET['year_id'];
    $genre_id = $_GET['genre_id'];
    $source_1 = $_GET['source_1'];
    $source_2 = $_GET['source_2'];
    $id = $_GET['id'];
    if($db->query("UPDATE items SET name='$name',genre_id='$genre_id',year_id='$year_id',description='$description', photo='$photo',source_1='$source_1',source_2='$source_2' WHERE id=$id")){
        echo "<script>
                alert('Veiksmigi izmainits')
                location.href = 'admin.php';
            </script>";
    }
}

$genres = $db->query("SELECT * FROM genres")->fetchAll(2);
$items = $db->query("SELECT * FROM items")->fetchAll(2);
$years = $db->query("SELECT * FROM years")->fetchAll(2);
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

    <div class = "container">
        <form action="#" class="item">
                <label>
                    Name
                    <input type="text" required name="new_item_name"></label>
                <label>
                    Photo
                    <input type="text" required name="photo" ></label>
                <label>
                    Description
                    <textarea required name="description"></textarea></label>
                <label>

                <label>
                    Genre
                    <select name="genre_id" id="">
                        <?php foreach($genres as $gen): ?>
                            <option value="<?php echo $gen['id'];?>">
                                <?php echo $gen['name'] ?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </label>

                <label>
                    Year
                    <select name="year_id" id="">
                        <?php foreach($years as $year): ?>
                            <option value="<?php echo $year['id'];?>">
                                <?php echo $year['name'] ?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </label>

                <label>
                    Avots_1
                    <input type="text" required name="source_1" ></label>
                </label>
                    Avots_2
                    <input type="text" required name="source_2" ></label>

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

                    <label>
                        Genre
                        <select name="genre_id" id="">
                            <?php foreach($genres as $gen): ?>
                                <option <?php if($item['genre_id'] == $gen['id']) echo 'selected';  ?> value="<?php echo $gen['id'];?>">
                                    <?php echo $gen['name'] ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </label>

                    <label>
                        Year
                        <select name="year_id" id="">
                            <?php foreach($years as $year): ?>
                                <option <?php if($item['year_id'] == $year['id']) echo 'selected';  ?> value="<?php echo $year['id'];?>">
                                    <?php echo $year['name'] ?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    </label>
                    <label>
                        Avots_1
                        <input type="text" required name="source_1" ></label>
                    <label>
                    Avots_2
                    <input type="text" required name="source_2" ></label>

                    <input type = "hidden" name="id" value="<?php echo $item['id']; ?>">

                    <input type="submit" name="Update" value="Update" class="form-btn">
                    <input type="submit" name="Delete" value="Delete" class="form-btn">
                </form>
            <?php endforeach;?>
        </div>
</main>
</body>
</html>