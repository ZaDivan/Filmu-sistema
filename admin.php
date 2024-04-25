<?php
session_start();
if(empty($_SESSION['role'])){
    header('location:index.php');
}elseif($_SESSION['role'] == 1) {
    header('location:admin_page.php');}
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
	
    $name = $_GET["item_name"];
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
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Admin</title>
		
		
		 <script src="js/bootstrap.js"></script>
     

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
					<span class="fs-4">Admin panel</span>
				</a>
				<div class="col-md-12 text-end">
						<a href = "admin_page.php"><button type="button" class="btn btn-outline-primary me-2">Back</button></a>
				</div>
			</div>
    </div>
  </header>
	
	
		<div class="container">
        <div class="row">
					<div class="col-md-6">
							<div class="accordion">
								<div class="accordion-item">
									<h2 class="accordion-header" >
										<button class="accordion-button" type="button" data-bs-toggle="collapse"  aria-expanded="true"  disabled>
											Add new video
										</button>
									</h2>
									<div class="accordion-collapse collapse show">
										<div class="accordion-body">
											<form action="#">
												<div class="mb-1">
													<label for="name" class="form-label">Name</label>
													<input type="text" class="form-control" id="name"  name="new_item_name" >
												</div>
												<div class="mb-1">
													<label for="photo" class="form-label">Photo</label>
													<input type="text" class="form-control" id="photo"  name="photo" >
												</div>
												<div class="mb-1">
													<label for="description" class="form-label">Description</label>
													<textarea class="form-control" id="description" name="description" rows="3"></textarea>
												</div>
												<div class="mb-1">
													<label for="genre" class="form-label">Genre</label>
													<select class="form-select form-select mb-3" name="genre_id" id="" >
													 <?php foreach($genres as $gen): ?>
															<option value="<?php echo $gen['id'];?>">
																	<?php echo $gen['name'] ?>
															</option>
													<?php endforeach;?>
												</select>
												</div>
												<div class="mb-1">
													<label for="year" class="form-label">Year</label>
													<select class="form-select form-select mb-3" name="year_id" id="" >
													 <?php foreach($years as $year): ?>
															<option value="<?php echo $year['id'];?>">
																	<?php echo $year['name'] ?>
															</option>
													<?php endforeach;?>
													</select>
												</div>
												<div class="mb-1">
													<label for="source_1" class="form-label">Avots_1</label>
													<input type="text" class="form-control" id="source_1"  name="source_1" >
												</div>
												<div class="mb-1">
													<label for="source_2" class="form-label">Avots_2</label>
													<input type="text" class="form-control" id="source_2"  name="source_2" >
												</div>
												<div class="mb-1">
													<div class="d-grid gap-2 col-6 mx-auto">
														<input type="submit" name="Add" value="Add" class="btn btn-sm btn-primary">
													</div>
												</div>
											</div>
										</form>
									</div>
							</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="contaiten-fluid">
						
							
						<div class="accordion" id="accordionExample">
							<?php 
								$a =0;
								foreach ($items as $item):
								$atype = $a == 0 ? 'show' : '';
								$collapsed = $a == 0 ? '' : 'collapsed';
							?>
							<form action="#" class="item">
								<div class="accordion-item">
									<h2 class="accordion-header">
										<button class="accordion-button <?php echo $collapsed;?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $a;?>" aria-expanded="false" aria-controls="collapse<?php echo $a;?>">
										 <?php echo $item['name']?>
										</button>
									</h2>
									<div id="collapse<?php echo $a;?>" class="accordion-collapse collapse <?php echo $atype; ?>" data-bs-parent="#accordionExample" style="">
										<div class="accordion-body">
											<div class="row">
												<div class="col-auto d-none d-lg-block">
													<img src="<?php echo $item['photo']?>" alt = "item" width = "150">
												</div>
												<div class="col d-flex flex-column position-static">
													<div class="mb-0">
														<label for="item_name" class="form-label">Name</label>
														<input type="text" class="form-control" id="item_name"  name="item_name" value="<?php echo $item['name']?>" >
													</div>
													<div class="mb-0">
														<label for="descriptions" class="form-label">Apraksts</label>
														<textarea class="form-control" id="descriptions" name="description" rows="3"><?php echo $item['description']?></textarea>
													</div>

													<hr class="my-4">
												</div>
												<div class="d-grid gap-2">
													<div class="mb-0">
														<label for="photos" class="form-label">Foto</label>
														<input type="text" class="form-control" id="photos"  name="photo" value="<?php echo $item['photo']?>" >
													</div>
													<div class="mb-0">
														<label for="genre" class="form-label">Genre</label>
														<select class="form-select form-select mb-3" name="genre_id" id="">
																<?php foreach($genres as $gen): ?>
																		<option <?php if($item['genre_id'] == $gen['id']) echo 'selected="selected"';  ?> value="<?php echo $gen['id'];?>">
																				<?php echo $gen['name'] ?>
																		</option>
																<?php endforeach;?>
														</select>
													</div>
													<div class="mb-0">
														<label for="year" class="form-label">Year</label>
														<select class="form-select form-select mb-3" name="year_id" id="">
																<?php foreach($years as $year): ?>
																	<option <?php if($item['year_id'] == $year['id']) echo 'selected';  ?> value="<?php echo $year['id'];?>">
																			<?php echo $year['name'] ?>
																	</option>
																<?php endforeach;?>
														</select>
													</div>
													<div class="mb-1">
														<label for="source_1" class="form-label">Avots_1</label>
														<input type="text" class="form-control" id="source_1"  name="source_1" value="<?php echo $item['source_1']?>" >
													</div>
													<div class="mb-1">
														<label for="source_2" class="form-label">Avots_2</label>
														<input type="text" class="form-control" id="source_2"  name="source_2" value="<?php echo $item['source_2']?>">
													</div>
													<div class="mb-1">
														<div class="d-grid gap-2 col-6 mx-auto">
															<input type = "hidden" name="id" value="<?php echo $item['id']; ?>">
															<input type="submit" name="Update" value="Update" class="btn btn-sm btn-primary">
															<input type="submit" name="Delete" value="Delete" class="btn btn-sm btn-danger">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
            <?php 
							$a++;
							endforeach;
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		
  </body>
</html>
