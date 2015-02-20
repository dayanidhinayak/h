<html>
<head>
   <link rel="stylesheet" href="assets/css/styles.css" />
	  <script src="assets/js/jquery-1.7.1.min.js"></script>
		<script src="assets/js/script.js"></script>
</head>
<body>
	<div id="formContainer">
			<form name="login" id="login" action="loginaction.php"  method="post" >
			<table>
			<tr>
			<td>
				<a href="#" id="flipToRecover" class="flipLink">Forgot?</a>
			</td>
			</tr>
			<tr>
			<td>	
				<input type="text" name="user" id="loginEmail" placeholder="Username"/>
			</td>
			</tr>
			<tr>
			<td>	
				<input type="password" name="pass" id="loginPass" placeholder="Password"/>
			</td>
			</tr>
			<tr>
			<td>	
				<input type="submit" name="sub" value="submit" />
			</td>
			</tr>
			</table>	
			</form>
			<form id="recover"  action="" method="post">
			<table>
			<tr>
			<td>
				<a href="#" id="flipToLogin" class="flipLink">Forgot?</a>
			</td>
			</tr>
			<tr>
			<td>	
				<input type="text" name="recoverEmail" id="recoverEmail" value="Email" />
				<input type="submit" name="submit" value="Recover" />
			</td>
			</tr>
			</table>	
			</form>
	</div>
		
</body>
</html> 