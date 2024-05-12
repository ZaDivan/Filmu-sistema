<?php
session_start();
error_reporting(0);
    require("db.php");
    date_default_timezone_set('Europe/Riga');
    $id = $_GET["id"];
	$ses_id = (!isset($_SESSION['id']) ? '0' : $_SESSION['id']);
    $comments = $db->query("SELECT * FROM comments WHERE film_id=$id ORDER BY `id` DESC")->fetchAll(2);
    $rating_num = $db->query("SELECT * FROM items_rating WHERE items_id=$id")->rowCount();
    $item = $db->query("SELECT * FROM items WHERE id=$id")->fetchAll(2);
    $items = $db->query("SELECT * FROM items")->fetchAll(2);
    if(count($item)>0){
        $item = $item[0];
    }


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
		 $results = $db->query(" SELECT * FROM items_rating WHERE items_id = '".$id."' AND user_id = ".$ses_id);
		if ($results->rowCount() > 0){
				$rating = '<div class="col"><a onclick="javascript:delrating(\''.$id.'\',\''.$ses_id.'\');" class="link-dark" href="javascript:"><i class="bi bi-star'.$star1.'"></i></a></div>';
				$rating .= '<div class="col"><a onclick="javascript:delrating(\''.$id.'\',\''.$ses_id.'\');" class="link-dark" href="javascript:"><i class="bi bi-star'.$star2.'"></i></a></div>';
				$rating .= '<div class="col"><a onclick="javascript:delrating(\''.$id.'\',\''.$ses_id.'\');" class="link-dark" href="javascript:"><i class="bi bi-star'.$star3.'"></i></a></div>';
				$rating .= '<div class="col"><a onclick="javascript:delrating(\''.$id.'\',\''.$ses_id.'\');" class="link-dark" href="javascript:"><i class="bi bi-star'.$star4.'"></i></a></div>';
				$rating .= '<div class="col"><a onclick="javascript:delrating(\''.$id.'\',\''.$ses_id.'\');" class="link-dark" href="javascript:"><i class="bi bi-star'.$star5.'"></i></a></div>';
		} else {
				$rating  = '<div class="col"><a onclick="javascript:rating(1,\''.$id.'\',\''.$ses_id.'\');" class="link-dark" href="javascript:"><i class="bi bi-star'.$star1.'"></i></a></div>';
				$rating .= '<div class="col"><a onclick="javascript:rating(2,\''.$id.'\',\''.$ses_id.'\');" class="link-dark" href="javascript:"><i class="bi bi-star'.$star2.'"></i></a></div>';
				$rating .= '<div class="col"><a onclick="javascript:rating(3,\''.$id.'\',\''.$ses_id.'\');" class="link-dark" href="javascript:"><i class="bi bi-star'.$star3.'"></i></a></div>';
				$rating .= '<div class="col"><a onclick="javascript:rating(4,\''.$id.'\',\''.$ses_id.'\');" class="link-dark" href="javascript:"><i class="bi bi-star'.$star4.'"></i></a></div>';
				$rating .= '<div class="col"><a onclick="javascript:rating(5,\''.$id.'\',\''.$ses_id.'\');" class="link-dark" href="javascript:"><i class="bi bi-star'.$star5.'"></i></a></div>';
		}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Filmu sistēma</title>

     
<script src="js/bootstrap.js"></script>
<script src="js/jquery-3.7.1.js" ></script>



		
<link href="css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
<link href="css/bootstrap-icons.min.css" rel="stylesheet" >



    <!-- Favicons -->


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
						<a href = "user_page.php"><button type="button" class="btn btn-outline-primary me-2">Māja</button></a>
						<?php if ( $ses_id !=0) { ?>
							<a href = "user_settings.php"><button type="button" class="btn btn-outline-primary me-2">Iestatījumi</button></a>
							<a href = "logout.php"><button type="button" class="btn btn-primary">Iziet</button></a>
						<?php } ?>
				</div>
					
				</div>
			</div>
    </div>
  </header>
	
	

	<div class="container d-grid pt-3">
		<div class="col-md-12">
				<div class="row g-0 border rounded flex-md-row mb-4 shadow-sm position-relative">
					<div class="col-auto d-none d-lg-block">
						<img src="<?php echo $item['photo']?>" alt = "item" width = "400">
						
						<div class="container">
							<div class="row text-center">
								<div class="col p-3">
								 <div class="row col">
									<?php echo $rating; ?>
									</div>
								</div>
							</div>
							<div class="row text-center " style="font-size: 13px; margin-top: -15px;">
								<em>Rating: <?php echo $item['rating'];?></em>
							</div>
						</div>
						
						
					</div>
					<div class="col p-4 d-flex flex-column position-static">
						<h3 class="mb-0"><?php echo $item['name']?></h3>
						<hr class="my-4">
						<p class="card-text mb-auto"><?php echo $item['description']?></p>
						<div class="d-grid gap-2">
							<a class="btn btn-outline-info text-start flex-grow-1" href="<?php echo $item['source_1']?>" target="_blank">Avots 1</a>
							<a class="btn btn-outline-info text-start flex-grow-1" href="<?php echo $item['source_2']?>" target="_blank">Avots 2</a>
						</div>
					</div>
				</div>
					<div class="card p-3 m-1">
							<div class="row">
								<div class="col-sm-10">
										<textarea class='form-control' name='message' id='message' placeholder='Ievadiet komentaru'></textarea><br>
								</div>
								<div class="col-sm text-center">
									<button type='submit' class='my-3 btn btn-outline-primary' onclick="javascript:addCom('<?php echo $ses_id; ?>','<?php echo $id; ?>' );" name = 'commentSubmit' >Komentet</button>
								</div>
							</div>
					</div>

					<div class="col-md-12">
						<?php foreach($comments as $com):
							$result = $db->query("SELECT * FROM users WHERE id=".$com['user_id']);
							$user_id = $result->fetch();
							
							   $results = $db->query(" SELECT * FROM comments_user WHERE comments_id = '".$com['id']."' AND user_id = ".$ses_id);
								 $user_com = $results->fetch();
								 
								if ($results->rowCount() > 0 OR $ses_id == $user_com['id'] OR $ses_id == $com['user_id'] ){
									$style_like = '<i class="link-primary bi bi-hand-thumbs-up" ></i>';
								} else {
									$style_like = '<a onclick="javascript:likeCom(\''.$ses_id.'\',\''.$com['id'].'\');" class="link-dark" href="javascript:"><i class="bi bi-hand-thumbs-up" ></i></a>';
								}
								
								$trash= $ses_id ==2 ? '<a onclick="javascript:delCom(\''.$com['id'].'\',\''.$ses_id.'\');" class="link-dark" href="javascript:"><i class="bi bi-trash3-fill"></i></a>':'';
							
						?>
							<div class="card p-3 m-1">
								<div class="d-flex justify-content-between align-items-center">
									<div class="user d-flex flex-row align-items-center">
										<span><small class="font-weight-bold text-primary"><?php echo $user_id['name'];?></small> </span>
									</div>
									<small><?php echo date("h:i d.m.Y", strtotime($com['date'])); echo $trash; ?></small>
								</div>
								<div class="action d-flex justify-content-between mt-2 align-items-center">
										<div class="reply px-4"><i class="bi bi-chat-left"></i><small class="m-2 font-weight-bold"><?php echo $com['message']; ?></small></div>
										<div class="icons align-items-center">
												<?php echo $style_like;?>
												<i class="fa"><?php echo $com['liked'];?></i>
										</div>
								</div>
							</div>
						<?php endforeach;?>
					</div>


		<div class="toast-container position-fixed top-0 end-0 p-3">
			<div class="text-bg-success toast align-items-center" id="like_comment" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="d-flex">
					<div class="toast-body" id="div_text">..................</div>
					<button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Закрыть"></button>
				</div>
			</div>
		</div>


		<!-- Modal HTML -->
		<div id="ratingModal" class="modal fade" tabindex="-1">
				<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
										<h5 class="modal-title" id="modal-title">...............</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
										<p id="text-body">.....</p>
										<p class="text-secondary" id="text-secondary"><small>....</small></p>
								</div>
								<div class="modal-footer">
										<input type='hidden' id='col_stars' value="">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Atcelt</button>
										<button type="button" id="model-button" class="btn btn-primary">....</button>
								</div>
						</div>
				</div>
		</div>

						<script>
								function delrating(id,user) {
									document.getElementById("model-button").innerHTML = "Dzēst";
									document.getElementById("modal-title").innerHTML = "Vērtējuma samazināšana";
									document.getElementById("text-body").innerHTML = 'Jus patiešām gribat dzēst filmas vērtējumu?';
									document.getElementById("text-secondary").innerHTML = "Filmas vērtējums tiks pārrēķināts no jauna.";
									document.getElementById("model-button").setAttribute('onclick','ratingDelSave(\''+id+'\',\''+user+'\')'); 
									$("#ratingModal").modal("show");
								};
								function rating(stars,id,user) {
									if (user != 0 ){
										document.getElementById("model-button").innerHTML = "Balsot";
										document.getElementById("modal-title").innerHTML = "Filmas vērtējums";
										document.getElementById("text-body").innerHTML = 'Jūs vēlaties piešķirt šai filmai <b id="col_star">'+stars+'</b><i class="bi bi-star-fill"></i> vērtējumu?';
										document.getElementById("text-secondary").innerHTML = "Filmas reitings tiek aprēķināts, summējot visu lietotāju balsis..";
										document.getElementById("col_stars").value = stars;
										document.getElementById("model-button").setAttribute('onclick','ratingSave(\''+id+'\',\''+user+'\')'); 
										$("#ratingModal").modal("show");
																		} else{
										  window.location.href = '/login.php';
									}
								};
								
								function delCom(user, comm) {
									document.getElementById("model-button").innerHTML = "Dzēšana";
									document.getElementById("modal-title").innerHTML = "Komentāru dzēšana";
									document.getElementById("text-body").innerHTML = 'Vai esat pārliecināts, ka vēlaties dzēst lietotāja komentāru?';
									document.getElementById("text-secondary").innerHTML = "Lietotāja komentāra dzēšana.";
									document.getElementById("model-button").setAttribute('onclick','delSave(\''+comm+'\',\''+user+'\')'); 
									$("#ratingModal").modal("show");
								};
								
								function addCom(user,id) {
									if (user != 0 ){
										var message = document.getElementById("message").value;
										var element = document.getElementById("like_comment");
										const toast = new bootstrap.Toast(document.getElementById('like_comment'))
										if (message) {
											$.ajax({
												type: 'POST',
												data: {	type:'addCom', id:id, user:user, message:message},
												url: "ajax.php",
												cache: false,
												success: function(data){
													if (data['success'] == true) {
														document.getElementById("div_text").innerHTML = "Komentārs pievienots.";
														element.classList.remove("text-bg-danger");
														element.classList.add("text-bg-success");
														toast.show()
														setTimeout(function() {location.reload();}, 500);
													} else {
														alert('ERROR!!!!!!!');
													}
												}
											});
										} else {
											document.getElementById("div_text").innerHTML = "Komentārs nevar būt tukšs.";
											element.classList.remove("text-bg-success");
											element.classList.add("text-bg-danger");
											toast.show()
										}
									} else{
										  window.location.href = '/login.php';
									}
								};
								
								function ratingDelSave(id,user) {
									const toast = new bootstrap.Toast(document.getElementById('like_comment'))
									$.ajax({
										type: 'POST',
										data: {	type:'deleRating', id:id, user:user},
										url: "ajax.php",
										cache: false,
										success: function(data){
											if (data['success'] == true) {
												document.getElementById("div_text").innerHTML = "Komentārs izdzēsts.";
												toast.show()
												setTimeout(function() {location.reload();}, 500);
											} else {
												alert('ERROR!!!!!!!');
											}
										}
									});
								};
								function delSave(user, id) {
									const toast = new bootstrap.Toast(document.getElementById('like_comment'))
									$.ajax({
										type: 'POST',
										data: {	type:'deleComm', id:id, user:user},
										url: "ajax.php",
										cache: false,
										success: function(data){
											if (data['success'] == true) {
												document.getElementById("div_text").innerHTML = "Komentārs izdzēsts.";
												toast.show()
												setTimeout(function() {location.reload();}, 500);
											} else {
												alert('ERROR!!!!!!!');
											}
										}
									});
								};
								
								function ratingSave(id,user) {
									var stars = document.getElementById('col_stars').value;
									const toast = new bootstrap.Toast(document.getElementById('like_comment'))
									$.ajax({
										type: 'POST',
										data: {	type:'ratingSave', id:id, user:user, stars:stars},
										url: "ajax.php",
										cache: false,
										success: function(data){
											if (data['success'] == true) {
												document.getElementById("div_text").innerHTML = "Paldies par filmas vērtējumu";
												toast.show()
												setTimeout(function() {location.reload();}, 500);
											} else {
												alert('ERROR!!!!!!!');
											}
										}
									});
								};
								
								function likeCom(user, like_id) {
									if (user != 0 ){
										const toast = new bootstrap.Toast(document.getElementById('like_comment'))
										$.ajax({
											type: 'POST',
											data: {	type:'like_comm', user:user, like_id:like_id},
											url: "ajax.php",
											cache: false,
											success: function(data){
												if (data['success'] == true) {
													document.getElementById("div_text").innerHTML = "Paldies par atsauksmēm";
													toast.show()
													setTimeout(function() {location.reload();}, 500);
												} else {
													alert('ERROR!!!!!!!');
												}
											}
										});
									} else{
										  window.location.href = '/login.php';
									}
								};
											
						</script>


	</body>
</html>