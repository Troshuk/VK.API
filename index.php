<?php
require_once("config.php");
?>
<!DOCTYPE HTML>
  <html ng-app="project">
    <head>         
      <script src='//vk.com/js/api/openapi.js'></script>
      <script src='http://code.angularjs.org/angular-1.0.1.js'></script>
       <script type='text/javascript' src='jquery.js'></script> 
		<link rel='stylesheet' href='style.css'>
    </head>
    <body style='background: #FF8585'>
<?php 
if(empty($_SESSION['token'])){

	$ht = "https://oauth.vk.com/authorize?client_id=".$appid."&display=page&redirect_uri=https://oauth.vk.com/blank.html&scope=".$scope."&response_type=token";
	?> 
	<form id="data" action="login1.php" method="GET">
	<p align="center">Вставте сюди скопіювану з стрічки браузера СИЛКУ, для надання повного доступу керування вашим аккаунтом, ключ доступу діє лише 24 години!</p>
		<center><input form="data" type="text" name="http" placeholder="Вставте силку" id="http"></center>
		<input type="submit" id="click" value="Далі" align="center" style="margin-left: 40%; font-size: 40px">
	</form>
	<script type='text/javascript'>
		alert("!УВАГА, зверху браузера, надайте дозвіл вспливаючим вікнам, дякую! Ви будете переадресовані на іншу сторінку, СКОПІЮЙТЕ АДРЕСУ, закрийте ту вкладку, та слідуйте вказівкам, дякую!) Це потрібно для надання Повних прав користувачу, в іншому випадку можете відкрити сторінку з мінімальним надаванням прав доступу.");

		window.onload=function(e){
		  window.open('<?php echo $ht; ?>');
		}
	</script>
	<?php
} else {
	?>
	<script type="text/javascript">
	</script>
<div ng-controller="FirstCtrl">
	<center align="right"><button style="font-size: 20px" ng-click="logout()">Вийти</button></center>		   		
</div>
	<?php
	$token = $_SESSION['token'];
	$user_id = $_SESSION['user_id'];

	$query = file_get_contents("https://api.vk.com/method/users.get?&fields=photo_200&access_token=".$token);
	$result = json_decode($query, true);
	echo "<br><center><img src='".$result['response'][0]['photo_200']."'><br>";
	echo $result['response'][0]['first_name']." ".$result['response'][0]['last_name'];
	echo "
	<br>
	id : ".$user_id."<br>
	Email : ".$_SESSION['email']."</center><br>
	";
	$s = '';
	if(empty($_SESSION['token'])){ $s = 'style="display: none;"';}
	echo "<form action='do.php' method='GET' ".$s.">";
?>
   <p type="hidden"><b>Можливості</b></p>
   <p><input type="radio" name="option" value="0" checked>Усі мої друзі<Br>
   <input type="radio" name="option" value="1">Друзі ОНЛАЙН<Br>
   <input type="radio" name="option" value="2">Followers<Br> 
   <input type="radio" name="option" value="3">Нещодавно додані друзі<Br> 
   <input type="radio" name="option" value="4">Пошук моїх друзів<Br>
   <input type="radio" name="option" value="5">Загальний пошук людей<Br>
   <input type="radio" name="option" value="6">Видалення з друзів<Br>
   <input type="radio" name="option" value="7">Керування списками друзів
	<select name="lists">
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
   </p>
   <input type="submit" value="Показати">
</form>
<script>

	var projectModule = angular.module('project',[]);  
  projectModule.factory('user', function() {      
   var vk = {
     data: {}, 
     appID: '$appid',
     
     init: function(){      
       VK.init({apiId: vk.appID});                      
     },

     login:function(callback){                    
        function authInfo(response){  
           vk.data.user = response.session.user;
           callback(vk.data.user); 
        }                       
        VK.Auth.login(authInfo, vk.appPermissions);
     },

     access:function(callback){
       VK.Auth.getLoginStatus(function(response) { 
         if(response.session){
           callback(vk.data.user);
         }else {
           vk.login(callback);         
         }                    
       })     
     },

     logout:function(){
       VK.Auth.logout();
       this.data.user={};
       document.location.href = "logout.php";
       alert('Вихід здійснено!');
     }
   
  }
  
   vk.init();       
   return vk;     
    
  });
  
      
  function FirstCtrl($scope, user) {	    
    $scope.logout=function(){
       user.logout();
    }

    user.access(function(usr){
       // alert('Этот код исполнится только для авторизованных');
       console.log(usr);      
    });
    
  } 
</script>
<?php
}
?>
</body>
</html>