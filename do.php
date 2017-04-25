<?php require_once('index.php'); ?>
<html>
    <head>           
    </head>
    <body style='background: #FF8585'>
    	<div align="right"><a href="index.php">Очистити</a></div>
		<?php
		$action = $_GET['option'];
			echo "<div class='gallery'>";
			switch ($_GET['option']) {
			    case 0:
			        $query = file_get_contents("https://api.vk.com/method/friends.get?count=424&user_id=".$user_id."&access_token=".$token);
					$result = json_decode($query, true);
					$out = $result['response'];
					$out = implode(',', $out);
					$query = file_get_contents("https://api.vk.com/method/users.get?user_ids=".$out."&fields=photo_100&access_token=".$token);
					$users_get = json_decode($query, true);
					$i = 0;
					while($i < count($users_get['response'])) {
						echo "<div class='image_block'><img src='".$users_get['response'][$i]['photo_100']."'> ";
						echo $users_get['response'][$i]['first_name'].'<br>';
						echo $users_get['response'][$i]['last_name'].'<br>';
						echo "</div>";
						$i++;
					}
			        break;
			    case 1:
			        $query = file_get_contents("https://api.vk.com/method/friends.getOnline?count=424&user_id=".$user_id."&online_mobile=0&access_token=".$token);
					$result = json_decode($query, true);
					$out = $result['response'];
					$out = implode(',', $out);
					$query = file_get_contents("https://api.vk.com/method/users.get?user_ids=".$out."&fields=photo_100&access_token=".$token);
					$users_get = json_decode($query, true);
					$i = 0;
					while($i < count($users_get['response'])) {
						echo "<div class='image_block'><img src='".$users_get['response'][$i]['photo_100']."'><br>";
						echo $users_get['response'][$i]['first_name'].'<br>';
						echo $users_get['response'][$i]['last_name'].'<br>';
						echo "</div>";
						$i++;
					}
			        break;
			    case 2:
			        $query = file_get_contents("https://api.vk.com/method/users.getFollowers?user_id=".$user_id."&count=424&fields=photo_100,domain");
					$users = json_decode($query, true);	
					$i = 0;
					foreach($users['response']['items'] as $k=>$v) {
						echo "<div class='image_block'><img src='".$v['photo_100']."'>";
						echo $v['first_name'].'<br>';
						echo $v['last_name'].'<br>';
						echo "</div>";
						$i++;
					}
			        break;
			    case 3:
			    	$query = file_get_contents("https://api.vk.com/method/friends.getRecent?user_id=".$user_id."&access_token=".$token);
					$result = json_decode($query, true);
					$out = $result['response'];
					$out = implode(',', $out);
					$query = file_get_contents("https://api.vk.com/method/users.get?user_ids=".$out."&fields=photo_100&access_token=".$token);
					$users_get = json_decode($query, true);
					$i = 0;
					while($i < count($users_get['response'])) {
						echo "<div class='image_block'><img src='".$users_get['response'][$i]['photo_100']."'> ";
						echo $users_get['response'][$i]['first_name'].'<br>';
						echo $users_get['response'][$i]['last_name'].'<br>';
						echo "</div>";
						$i++;
					}
			        break;
		        case 4:
		        	?>
					<form method="POST">
					   <p><b>С какими операционными системами вы знакомы?</b></p>
					   <p><input type="text" name="search"><Br>
					   <p><input type="submit" value="Пошук"></p>
					</form>
		        	<?php
		        	$query = file_get_contents("https://api.vk.com/method/friends.search?sort=0&count=1000&fields=photo_100,screen_name&q=".$_POST['search']."&access_token=".$token);
					$users = json_decode($query, true);	
					$i = 0;
					while($i < count($users['response'])) {
						$i++;
						echo $users['response'][$i]['first_name'].'<br>';
						echo $users['response'][$i]['last_name'].'<br>';
						echo "<div class='image_block'><img src='".$users['response'][$i]['photo_100']."'>";
						echo "</div>";
						$i++;
					}
		        	break;
		        case 5:
		        	?>
					<form align="center" method="POST">
					   <p><b>С какими операционными системами вы знакомы?</b></p>
					   <p><input type="text" name="search"><Br>
					   <p><input type="submit" value="Пошук"></p>
					</form>
		        	<?php
					$query = file_get_contents("https://api.vk.com/method/users.search?sort=0&count=1000&fields=photo_100,screen_name&q=".$_POST['search']."&access_token=".$token);
					$users = json_decode($query, true);	
					$i = 0;
					while($i < count($users['response'])) {
						echo "<div class='image_block'><img src='".$users['response'][$i]['photo_100']."'>";
						echo $users['response'][$i]['first_name'].'<br>';
						echo $users['response'][$i]['last_name'].'<br>';
						echo "</div>";
						$i++;
					}
					break;
		        case 6:
						$query = file_get_contents("https://api.vk.com/method/friends.get?count=424&user_id=".$user_id."&access_token=".$token);
						$result = json_decode($query, true);
						$out = $result['response'];
						$out = implode(',', $out);
						$query = file_get_contents("https://api.vk.com/method/users.get?user_ids=".$out."&fields=photo_50&access_token=".$token);
						$users_get = json_decode($query, true);
					?>
					<form method="POST">
					   <p align="center"><b>Видалення користрувачів</b></p>
						<select align="center" name="delete" style="width: 500px;">
							<?php
								echo "<option selected disabled>Виберіть користувача, та натисніть видалити</option>";
								$i = 0;
								while($i < count($users_get['response'])) {
									echo "<option value=".$users_get['response'][$i]['uid'].">".$users_get['response'][$i]['first_name']." ";
									echo $users_get['response'][$i]['last_name']."</option>";
									$i++;
								}
							?>
						</select>
					   <p align="center"><input type="submit" value="Delete"></p>
					</form>
		        	<?php
		        	$del = $_POST['delete'];
		        	if(!empty($del)){
					$query = file_get_contents("https://api.vk.com/method/users.get?user_ids=".$del."&access_token=".$token);
					$users_get = json_decode($query, true);
		        	echo "Користувач ";
					echo $users_get['response'][0]['first_name']." ";
					echo $users_get['response'][0]['last_name'];
					echo ", був видалений з ваших друзів";
		        	$query = file_get_contents("https://api.vk.com/method/friends.delete?user_id=".$del."&access_token=".$token);
					}
					break;
		        case 7:
		        	$list = $_GET['lists'];
		        	if(!empty($list)){
						$query = file_get_contents("https://api.vk.com/method/friends.get?count=424&user_id=".$user_id."&access_token=".$token);
						$result = json_decode($query, true);
						$out = $result['response'];
						$out = implode(',', $out);
						$query = file_get_contents("https://api.vk.com/method/users.get?user_ids=".$out."&fields=photo_50&access_token=".$token);
						$users_get = json_decode($query, true);
						?>

						<form method="POST">
						   <p align="center"><b>Додавання у список друга</b></p>
						   <p align="center">
							<select name="list">
								<?php
									echo "<option selected disabled>Виберіть список</option>";
									$query = file_get_contents("https://api.vk.com/method/friends.getLists?&user_id=".$user_id."&access_token=".$token);
									$result = json_decode($query, true);
									$i = 0;
									while($i < count($result['response'])) {
										echo "<option value=".$result['response'][$i]['lid'].">";
										echo $result['response'][$i]['name']."</option>";
										$i++;
									}
								?>
							</select>
							<select name="friend" style="width: 500px;">
								<?php
									echo "<option selected disabled>Виберіть користувача, та натисніть Додати</option>";
									$i = 0;
									while($i < count($users_get['response'])) {
										echo "<option value=".$users_get['response'][$i]['uid'].">".$users_get['response'][$i]['first_name']." ";
										echo $users_get['response'][$i]['last_name']."</option>";
										$i++;
									}
								?>
							</select>
						   </p>
						   <p align="center"><input type="submit" value="Додати у список"></p>
						</form>

						<form method="POST">
						   <p align="center"><b>Видалення друга із списку</b></p>
						   <p align="center">
							<select name="list2">
								<?php
									echo "<option selected disabled>Виберіть список</option>";
									$query = file_get_contents("https://api.vk.com/method/friends.getLists?&user_id=".$user_id."&access_token=".$token);
									$result = json_decode($query, true);
									$i = 0;
									while($i < count($result['response'])) {
										echo "<option value=".$result['response'][$i]['lid'].">";
										echo $result['response'][$i]['name']."</option>";
										$i++;
									}
								?>
							</select>
							<select name="friend2" style="width: 500px;">
								<?php
									echo "<option selected disabled>Виберіть користувача, та натисніть Видалити</option>";
									$i = 0;
									while($i < count($users_get['response'])) {
										echo "<option value=".$users_get['response'][$i]['uid'].">".$users_get['response'][$i]['first_name']." ";
										echo $users_get['response'][$i]['last_name']."</option>";
										$i++;
									}
								?>
							</select>

						<form method="POST">
						   <p align="center"><b>Видалити список</b></p>
						   <p align="center">
							<select name="delete_list">
								<?php
									echo "<option selected disabled>Виберіть список</option>";
									$query = file_get_contents("https://api.vk.com/method/friends.getLists?&user_id=".$user_id."&access_token=".$token);
									$result = json_decode($query, true);
									$i = 0;
									while($i < count($result['response'])) {
										echo "<option value=".$result['response'][$i]['lid'].">";
										echo $result['response'][$i]['name']."</option>";
										$i++;
									}
								?>
							</select>
						   <input type="submit" value="Видалити список"></p>
						</form>

						<form method="POST">
						   <p align="center"><b>Створити список</b></p>
						   <p align="center">
						   <input type="text" name="create_list">
						   <input type="submit" value="Створити список"></p>
						</form>

						<?php

						$list_add = $_POST['list'];
						$friend_add = $_POST['friend'];
						if(!empty($list_add) && !empty($friend_add)){
			        		$query = file_get_contents("https://api.vk.com/method/friends.editList?list_id=".$list_add."&add_user_ids=".$friend_add."&access_token=".$token);
							$result = json_decode($query, true);
							echo "<br>Друг доданий у список!<br>";
						}

						$list_del = $_POST['list2'];
						$friend_del = $_POST['friend2'];
						if(!empty($list_del) && !empty($friend_del)){
			        		$query = file_get_contents("https://api.vk.com/method/friends.editList?list_id=".$list_del."&delete_user_ids=".$friend_del."&access_token=".$token);
							$result = json_decode($query, true);
							echo "<br>Друг видалений зі списоку!<br>";
						}

						$list_create = $_POST['create_list'];
						if(!empty($list_create)){
			        		$query = file_get_contents("https://api.vk.com/method/friends.addList?name=".$list_create."&access_token=".$token);
							$result = json_decode($query, true);
							echo "<br>Список додано!<br>";
						}

						$list_delete = $_POST['delete_list'];
						if(!empty($list_delete)){
			        		$query = file_get_contents("https://api.vk.com/method/friends.deleteList?list_id=".$list_delete."&access_token=".$token);
							$result = json_decode($query, true);
							echo "<br>Список видалено!<br>";
						}

			        	$query = file_get_contents("https://api.vk.com/method/friends.get?count=424&list_id=".$list."&user_id=".$user_id."&access_token=".$token);
						$result = json_decode($query, true);
						$out = $result['response'];
						$out = implode(',', $out);
						$query = file_get_contents("https://api.vk.com/method/users.get?user_ids=".$out."&fields=photo_100&access_token=".$token);
						$users_get = json_decode($query, true);
						$i = 0;
						while($i < count($users_get['response'])) {
							echo "<div class='image_block'><img src='".$users_get['response'][$i]['photo_100']."'> ";
							echo $users_get['response'][$i]['first_name'].'<br>';
							echo $users_get['response'][$i]['last_name'].'<br>';
							echo "</div>";
							$i++;
						}
					}
					break;
			}
			echo "</div>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";

		?>
	</body>
</html>