<?php
	$b = stristr($_GET['http'], '#', true);
	$a = 'https://oauth.vk.com/blank.html';
	if (empty($_GET['http']) && !strnatcasecmp($b, $a)) header('location: /');
?>
<!DOCTYPE HTML>
  <html>
    <head>
      <script src='//vk.com/js/api/openapi.js'></script>
      <script src='http://code.angularjs.org/angular-1.0.1.js'></script>
       <script type='text/javascript' src='jquery.js'></script>            
    </head>
    <body style='background: #FF8585'>
		<form id="data2" action="login.php" method="GET">
				<input form="data2" type="hidden" name="token" id="token">
				<input form="data2" type="hidden" name="user_id" id="user_id">
				<input form="data2" type="hidden" name="email" id="email">
				<input type="submit" id="click" value="Моя Сторінка" align="center" style="margin-left: 40%; font-size: 40px">
		</form>
		<script type='text/javascript'>
			var loc = "<?php echo $_GET['http'];?>";
			var tok = loc;
			var us = loc;
			var mai = loc;

			var tok1 = tok.split('&')[0];
			var tok2 = tok1.split('=')[1];
			document.getElementById("token").value = tok2;
			if (tok2.toString() == "undefined") {
				document.getElementById("token").value = "";
			}

			var us1 = us.split('id=')[1];
			var us2 = us1.split('&')[0];
			document.getElementById("user_id").value = us2;
			if (us2.toString() == "undefined") {
				document.getElementById("user_id").value = "";
			} 

			var mai1 = mai.split('email=')[1];
			document.getElementById("email").value = mai1;
			if (mai1.toString() == "undefined") {
				document.getElementById("email").value = "";
			}
		</script>
	</body>
</html>