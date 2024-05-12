<?php
session_start();
if(empty($_SESSION['role'])){
    header('location:index.php');
}
require("db.php");
$result = $db->query("SELECT * FROM users WHERE id=".$_SESSION['id']);
$users = $result->fetch();


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Video</title>

     
<script src="js/jquery-3.7.1.js" ></script>
<script src="js/bootstrap.js"></script>

    <!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet" crossorigin="anonymous">
<link href="css/bootstrap-icons.min.css" rel="stylesheet" >

    <!-- Favicons -->

<meta name="theme-color" content="#7952b3">

  </head>
	

	
	
	
  <body >
	
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
    <div class="container">
			<div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
				<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
					<svg class="bi me-2" width="40" height="32"><use xlink:href="#Info_system"></use></svg>
					<span class="fs-4">Info sistēma</span>
				</a>

				<div class="d-flex align-items-center">
					
					
					<div class="col-md-12 text-end">
						<a href = "user_page.php"><button type="button" class="btn btn-outline-primary me-2">Māja</button></a>
						<a href = "logout.php"><button type="button" class="btn btn-primary">Iziet</button></a>
					</div>
					
				</div>
			</div>
    </div>
  </header>  



		<div class="container mt-4 mb-4 p-3 d-flex justify-content-center"> 
			<div class="card p-4 col-md-6"> 
				<span class="name text-center"><b>Lietotāja iestatījumi</b></span> 

					<div class="form-group">
						<label >Vārds</label>
						<input type="email" class="form-control" value="<?php echo $users['name'];?>" disabled>
						<small class="form-text text-muted">Lietotāja vārds.</small>
					</div>
					
					<div class="form-group">
						<label >E-pasta adrese</label>
						<input type="email" class="form-control" value="<?php echo $users['email'];?>" disabled>
						<small class="form-text text-muted">Reģistrācijas laikā norādītais e-mails adress.</small>
					</div>
				
				<hr class="my-3">
				
					<div class="form-group">
						<label >Vecā portāla parole</label>
						<input type="password" id="passOld" class="form-control" value="" >
						<small class="form-text text-muted">Parole, ar kuru pieslēdzāties portālā..</small>
					</div>
					
					<div class="form-group">
						<label >Jauna parole</label>
						<input type="password" id="newPass" class="form-control" value="" >
					</div>
					<div class="form-group">
						<label >Atkārtoti ievadiet jauno paroli.</label>
						<input type="password" id="rePass" class="form-control" value="" >
						<small class="form-text text-muted">Parolē jābūt vismaz 5 simboliem.</small>
					</div>
					<button type="button" onclick="javascript:passSave('<?php echo $_SESSION['id'];?>');" class="btn btn-primary">Apstiprināt</button>
					<a class="text-center" href = "user_page.php">Atcelt</a>
			</div>
		</div>


		<div class="toast-container position-fixed top-0 end-0 p-3">
			<div class="toast align-items-center" id="like_comment" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="d-flex">
					<div class="toast-body" id="div_text">..................</div>
					<button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Закрыть"></button>
				</div>
			</div>
		</div>
		
						<script>
								function passSave(user) {
									const toast = new bootstrap.Toast(document.getElementById('like_comment'))
									var pass = document.getElementById('passOld').value;
									var element = document.getElementById("like_comment");
									$.ajax({
										type: 'POST',
										data: {	type:'verification', id:user, pass:pass},
										url: "ajax.php",
										cache: false,
										success: function(data){
											if (data['success'] == true) {
												if (document.getElementById('newPass').value.length < 5 ) { 
														document.getElementById("div_text").innerHTML = "Jauna parole īsāka par <b>5</b> simboliem.";
														element.classList.remove("text-bg-success");
														element.classList.add("text-bg-danger");
												} else {
													if ( document.getElementById('newPass').value == document.getElementById('rePass').value ) {
														$.ajax({
															type: 'POST',
															data: {	type:'passSave', id:user, pass:document.getElementById('newPass').value},
															url: "ajax.php",
															cache: false,
															success: function(data){
																if (data['success'] == true) {
																	element.classList.remove("text-bg-danger");
																	element.classList.add("text-bg-success");
																	document.getElementById("div_text").innerHTML = "Parole veiksmīgi mainīta";
																	setTimeout(function() {location.reload();}, 500);
																} else {
																	alert('ERROR!!!!!!!');
																}
															}
														});
													} else {
														document.getElementById("div_text").innerHTML = "Jaunās paroles nesakrīt!!!";
														element.classList.remove("text-bg-success");
														element.classList.add("text-bg-danger");
													}
												}
											} else {
												document.getElementById("div_text").innerHTML = "Vecā parole ir nepareiza";
												element.classList.remove("text-bg-success");
												element.classList.add("text-bg-danger");
											}
											toast.show()
										}
									});
								};
						</script>
		
		
		
  </body>
</html>
