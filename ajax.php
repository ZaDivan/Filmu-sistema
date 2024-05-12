<?php
require_once("db.php");;

header("Content-Type: application/json; charset=UTF-8");
$return = Array();
$apiCommand = (!isset($_REQUEST['type']) ? '' : $_REQUEST['type']);
$id = (!isset($_REQUEST['id']) ? '' : $_REQUEST['id']);


	if($apiCommand == 'like_comm') {
		$insert = "INSERT INTO comments_user(comments_id,	user_id) VALUES('".$_REQUEST['like_id']."','".$_REQUEST['user']."')";
		$db->query($insert);
		$update = "UPDATE `comments` SET `liked`=`liked`+1 WHERE id = '".$_REQUEST['like_id']."'";
		$db->query($update);
	
		$return['success'] = true;

	} else if ($apiCommand=='ratingSave') {
		
		$rating_col = $db->query("SELECT * FROM items_rating WHERE items_id=$id")->rowCount();
		$reit = $db->query("SELECT * FROM items WHERE id=".$id)->fetch();
		$new_rating = ($reit['rating'] + $_REQUEST['stars']) / ($rating_col+1);
		
		$update = "UPDATE `items` SET `rating`='".$new_rating."' WHERE id = '".$id."'";
		$db->query($update);
		
		$insert = "INSERT INTO items_rating(user_id, items_id,stars) VALUES('".$_REQUEST['user']."','".$id."','".$_REQUEST['stars']."')";
		$db->query($insert);
		
		$return['success'] = true;
	} else if ($apiCommand =='verification') {
		$row = $db->query("SELECT * FROM users WHERE id=".$id." AND password = '".$_REQUEST['pass']."' ")->rowCount();
			if ($row > 0){
				$return['success'] = true;
			} else {
				$return['success'] = false;
			}
	} else if ($apiCommand=='passSave') {
			$update = "UPDATE `users` SET `password`= '".$_REQUEST['pass']."'  WHERE id = '".$id."'";
			$db->query($update);
	
		$return['success'] = true;
		
	} else if ($apiCommand=='deleComm') {
			$delete = "DELETE FROM `comments`  WHERE id = '".$id."'";
			$db->query($delete);
			$del = "DELETE FROM `comments_user`  WHERE comments_id = '".$id."'";
			$db->query($del);
		$return['success'] = true;
		
	} else if ($apiCommand=='deleRating') {
			$del = "DELETE FROM `items_rating`  WHERE user_id = '".$_REQUEST['user']."' AND  items_id = '".$id."' ";
			$db->query($del);
			
			$rating_col = $db->query("SELECT * FROM items_rating WHERE items_id=$id")->fetchAll(2);
			$allStar =0;
			$row=0;
			foreach($rating_col as $item):
				$allStar  = $allStar + $item['stars'];
				$row++;
			endforeach;

			$new_rating = $allStar / $row;
			$update = "UPDATE `items` SET `rating`='".$new_rating."' WHERE id = '".$id."'";
			$db->query($update);

		$return['success'] = true;
		
	} else if ($apiCommand=='addCom') {
		
		$date = date('Y-m-d H:i:s');
		$insert = $db->query("INSERT INTO comments (user_id, film_id, date, message) VALUES ('".$_REQUEST['user']."','".$id."','".$date."','".$_REQUEST['message']."') ");
		$return['success'] = true;
	} else {
		$return['success'] = false;
		$return['text'] = "error command";
	}

echo json_encode($return);
