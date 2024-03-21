<?php

require("db.php");

if(isset($_GET["Add"])){
    $start = $_GET["start"];
    $end = $_GET['end'];
    $human_count = $_GET['human_count'];
    $room_nr = $_GET['room_nr'];
    $user = $_GET['user'];
    $hotel = $_GET['hotel'];
    if($db->query("INSERT INTO rezervers (start, end, human_count, room_nr, user, hotel) VALUES ('$start', '$end', '$human_count', $room_nr, '$user', '$hotel') ")){
        echo "<script>
                alert('Veiksmigi pievienots')
                location.href = 'reservation.php.php';
            </script>";
    }
}

$items = $db->query("SELECT * FROM items")->fetchAll(2);
$users = $db->query("SELECT * FROM users")->fetchAll(2);
$rezervers = $db->query("SELECT * FROM rezervers")->fetchAll(2);
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
<header>
<h1>Rezervation</h1>
</header>
<main>
    <h2>Maka a reservation</h2>
    <div class = "form-container">
        <form action="#" class="reservation">
            <label>
                Start
                <input type="date" required name="start"></label>
            <label>
                End
                <input type="date" required name="end" ></label>
            <label>
                Human count
                <input type="number" required min="0" name="human_count" ></label>
            <label>
                Room Number
                <input type="number" required min="0" name="room_nr" ></label>

            <label>
                User
                <select name="user" id="">
                    <?php foreach($users as $user): ?>
                        <option value="<?php echo $user['id'];?>">
                            <?php echo $user['name'] ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </label>
            <label>
                Hotel
                <select name="hotel" id="">
                    <?php foreach($items as $hotel): ?>
                        <option value="<?php echo $hotel['id'];?>">
                            <?php echo $hotel['name'] ?>
                        </option>
                    <?php endforeach;?>
                </select>
            </label>

            <input type="submit" name="Add" value="Add" class="form-btn">
        </form>
    </div>
    <section class = "container">
        <h2>Your reservations</h2>
        <?php foreach($rezervers as $reserv): ?>

            <div class = "item">

                <h3>Room_nr: <?php echo $reserv['room_nr']; ?></h3>
                <h4>Hotel: <?php echo $reserv['hotel']; ?></h4>
                <p>Start:<?php echo $reserv['start']; ?></p>
                <p>End:<?php echo $reserv['end'];?></p>
                <p>Human count: <?php echo $reserv['human_count'];?></p>
                <p></p>
            </div>
        <?php endforeach;?>
    </section>
</main>
</body>
</html>
