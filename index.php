<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
if($_SESSION['role']==1){
    header('location:user_page.php');
}elseif($_SESSION['role']==2){
    header('location:admin_page.php');
}
require("db.php");

$genres = $db->query("SELECT * FROM genres ORDER BY `name` DESC")->fetchAll(2);
$years = $db->query("SELECT * FROM years ORDER BY `name` ASC")->fetchAll(2);

$where = "";
$genresql = "";


if(isset($_GET['genre'])){
		$where = "WHERE ";
		$genresql = "genre_id=".$_GET['genre'];
}
if(isset($_GET['year'])) {
		$where = "WHERE ";
		$andsql = $_GET['genre'] ? " AND " : "";
		$yearsql  = $andsql."year_id=".$_GET['year'];
}

if (isset($_POST["search"])){
		$genresql = "";
		$yearsql  = "";
		$where = "WHERE ";
		$searcsql = "name LIKE '%".$_POST["search"]."%'";
}


$items = $db->query("SELECT * FROM items ".$where.$genresql.$yearsql.$searcsql." ORDER BY `rating` DESC")->fetchAll(2);


$genre = (!isset($_REQUEST['genre']) ? '' : $_REQUEST['genre']);
$year = (!isset($_REQUEST['year']) ? '' : $_REQUEST['year']);


$genreurl = $genre ? '?genre='.$genre.'&' : '?';
$yearurl = $year ? '?year='.$year.'&' : '?'; 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Viesis</title>

     

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
<link href="css/bootstrap-icons.min.css" rel="stylesheet" >

    <!-- Favicons -->

<meta name="theme-color" content="#7952b3">

  </head>
  <body>

<main>
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
  <header class="p-3 mb-3 border-bottom">
    <div class="container-fluid">
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
						<a href = "login.php"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
						<a href = "index.php"><button type="button" class="btn btn-primary">Home</button></a>
				</div>
					
				</div>
			</div>
    </div>
  </header>

	<div class="container-fluid d-grid gap-2">
		<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
				<div class="container-fluid">
					<a class="navbar-brand" href="#">Žanri</a>
					<div class="collapse navbar-collapse">
								<?php foreach($genres as $item):
										$sel_genre =	$genre != $item['id'] ? '-outline' : '';
								?>
										<a href="<?php echo $yearurl; ?>genre=<?php echo $item['id']; ?>" class="btn btn<?php echo $sel_genre;?>-primary btn-sm mx-1" role="button" aria-disabled="true" style="width: 100px;"><?php echo $item["name"];?></a>
								<?php endforeach; ?>
					</div>
					<div class="collapse navbar-collapse justify-content-end">		
								<a href="<?php echo $yearurl; ?>" class="btn btn-outline-secondary btn-sm mx-1" role="button" aria-disabled="true" style="width: 100px;">Filtra tīrīšana</a>
					</div>
				</div>
		</nav>
	
		<nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
				<div class="container-fluid">
					<a class="navbar-brand" href="#">Gadi</a>
					<div class="collapse navbar-collapse" >
							<?php foreach($years as $item):
											$sel_genre =	$year != $item['id'] ? '-outline' : '';
							?>
									<a href="<?php echo $genreurl; ?>year=<?php echo $item['id']; ?>" class="btn btn<?php echo $sel_genre;?>-info btn-sm mx-1" role="button" aria-disabled="true" style="width: 100px;"><?php echo $item["name"];?></a>
							<?php endforeach; ?>
					</div>
					<div class="collapse navbar-collapse justify-content-end">		
								<a href="<?php echo $genreurl; ?>" class="btn btn-outline-secondary btn-sm mx-1" role="button" aria-disabled="true" style="width: 100px;">Filtra tīrīšana</a>
					</div>
				</div>
		</nav>
	</div>
</main>


		<div class="container-fluid d-grid pt-3 pb-5">
            <p class="h4">Labdien <?php echo $_SESSION['user_name'] ?></p>
            <p class="h4">Jūsu rekomendācijas</p>
			<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 ">
				<?php foreach($items as $item):
								if ($item['rating'] == 0) {
										$star1 = '';
										$star2 = '';
										$star3 = '';
										$star4 = '';
										$star5 = '';
								} else if ($item['rating'] > 0 && $item['rating'] <= 1 ) {
										$star1 = '-fill';
										$star2 = '';
										$star3 = '';
										$star4 = '';
										$star5 = '';
								} else if ($item['rating'] > 1 && $item['rating'] <= 2 ) {
										$star1 = '-fill';
										$star2 = '-fill';
										$star3 = '';
										$star4 = '';
										$star5 = '';		
								} else if ($item['rating'] > 2 && $item['rating'] <= 3 ) {
										$star1 = '-fill';
										$star2 = '-fill';
										$star3 = '-fill';
										$star4 = '';
										$star5 = '';
								} else if ($item['rating'] > 3 && $item['rating'] <= 4 ) {
										$star1 = '-fill';
										$star2 = '-fill';
										$star3 = '-fill';
										$star4 = '-fill';
										$star5 = '';		
								} else if ($item['rating'] > 4 && $item['rating'] <= 5 ) {
										$star1 = '-fill';
										$star2 = '-fill';
										$star3 = '-fill';
										$star4 = '-fill';
										$star5 = '-fill';		
								}
				?>
				<div class="col">
					<div class="card shadow-sm align-items-center" style="height:24rem;">
						<div class="h-75">
							<img class="pt-2 " style="width: 10rem;" src="<?php echo $item['photo']?>" alt="photo" >
						</div>
						<div class="row text-center ">
							<div class="col p-1">
							 <div class="row col">
									<div class="col"><i class="bi bi-star<?php echo $star1;?>"></i></div>
									<div class="col"><i class="bi bi-star<?php echo $star2;?>"></i></div>
									<div class="col"><i class="bi bi-star<?php echo $star3;?>"></i></div>
									<div class="col"><i class="bi bi-star<?php echo $star4;?>"></i></div>
									<div class="col"><i class="bi bi-star<?php echo $star5;?>"></i></div>
								</div>
							</div>
						</div>
						<div class="row text-center " style="font-size: 12px; margin-top: -10px;">
							<em>Rating: <?php echo $item['rating'];?></em>
						</div>
						<div class="card-body text-center">
							<div class="card-title"><?php echo $item['name']; ?></div>
							<div class="card-text">
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
