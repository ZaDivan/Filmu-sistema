<?php
session_start();
if(empty($_SESSION['role'])){
    header('location:index.php');
}elseif($_SESSION['role'] == 1) {
    header('location:admin_page.php');}
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

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Filmu sistēma</title>

     

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">

    <!-- Favicons -->

<meta name="theme-color" content="#7952b3">


  </head>
  <body>
    
<div style="display: none;">
<svg id="Info_system" height="40" width="32" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 512 512" xml:space="preserve" 
<g>
	<g>
		<g>
			<path d="M472.178,80.972H39.822C17.864,80.972,0,98.836,0,120.794v270.412c0,21.958,17.864,39.822,39.822,39.822h432.356
				c21.958,0,39.822-17.864,39.822-39.822V120.794C512,98.837,494.136,80.972,472.178,80.972z M98.751,396.895H39.822
				c-3.137,0-5.689-2.552-5.689-5.689v-43.44h64.618V396.895z M98.751,313.632H34.133v-40.565h64.618V313.632z M98.751,238.934
				H34.133v-40.565h64.618V238.934z M98.751,164.234H34.133v-43.44c0-3.136,2.552-5.689,5.689-5.689h58.929V164.234z
				 M379.114,396.895h-246.23v-281.79h246.23V396.895z M477.867,391.206c0,3.137-2.552,5.689-5.689,5.689h-58.93v-49.129h64.619
				V391.206z M477.867,313.632h-64.619v-40.565h64.619V313.632z M477.867,238.934h-64.619v-40.565h64.619V238.934z M477.867,164.234
				h-64.619v-49.129h58.93c3.137,0,5.689,2.553,5.689,5.689V164.234z"/>
			<path d="M212.076,327.145l109.804-55.938c12.407-6.32,12.404-24.095,0-30.414l-109.804-55.938
				c-11.332-5.774-24.814,2.471-24.814,15.208v111.874C187.262,324.763,200.827,332.873,212.076,327.145z M221.396,227.911
				l55.139,28.089l-55.139,28.089V227.911z"/>
		</g>
	</g>
</g>
</svg>
</div>

<main>

  <header class="p-3 mb-3 border-bottom">
    <div class="container">
			<div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
				<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
					<svg class="bi me-2" width="40" height="32"><use xlink:href="#Info_system"></use></svg>
					<span class="fs-4">Info system</span>
				</a>

				<div class="d-flex align-items-center">
					<form method="post" class="w-100 me-3">
						<input type="search" name="search" class="form-control" placeholder="Meklēt..." aria-label="Meklēt">
					</form>
					
					<div class="col-md-4 text-end">
						<a id="admin_bar" href="admin.php" ><button type="button" class="btn btn-outline-primary me-2">AdminPanels</button></a>
						<a href = "admin_page.php"><button type="button" class="btn btn-outline-primary me-2">Māja</button></a>
						<a href = "logout.php"><button type="button" class="btn btn-primary">Iziet</button></a>
				</div>
					
				</div>
			</div>
    </div>
  </header>

	<div class="container d-grid gap-2">
		<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
				<div class="container-fluid">
					<a class="navbar-brand" href="#">Žanri</a>
					<div class="collapse navbar-collapse">
								<?php foreach($genres as $item):?>
										<a href="?genre=<?php echo $item['id']; ?>" class="btn btn-outline-primary btn-sm mx-1" role="button" aria-disabled="true" style="width: 100px;"><?php echo $item["name"];?></a>
								<?php endforeach; ?>
					</div>
				</div>
		</nav>
	
		<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
				<div class="container-fluid">
					<a class="navbar-brand" href="#">Gadi</a>
					<div class="collapse navbar-collapse" >
							<?php foreach($years as $item):?>
									<a href="?year=<?php echo $item['id']; ?>" class="btn btn-outline-info btn-sm mx-1" role="button" aria-disabled="true" style="width: 100px;"><?php echo $item["name"];?></a>
							<?php endforeach; ?>
					</div>
				</div>
		</nav>
	</div>
</main>

		<div class="container d-grid pt-3 pb-5">
			<p class="h4">Labdien <?php echo $_SESSION['user_name'] ?></p>
            <p class="h4">Jūsu rekomendācijas</p>
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 ">
				<?php foreach($items as $item):?>
					<div class="col">
          <div class="card shadow-sm align-items-center">
						<img class="pt-2" style="width: 10rem;" src="<?php echo $item['photo']?>" alt="photo" >
            <div class="card-body">
               <div class="card-title "><?php echo $item['name']; ?></div>
              <div class="card-text text-center">
                  <a href = "single.php?id=<?php echo $item['id'];?>"><button type="button" class="btn btn-sm btn-outline-secondary">More</button></a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach;?>
			</div>
		</div>
  </body>
</html>
