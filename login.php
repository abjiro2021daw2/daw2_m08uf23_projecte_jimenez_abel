<html>
	<head>
		<title>
			AUTENTICANT AMB LDAP DE L'USUARI admin
		</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		
	</head>
	<body>
	<div style="width:50%; margin:50px auto;">
		<form action="http://zend-abjiro.fjeclot.net/zendldap/auth.php" method="POST">
			<div class="form-group" >
			Usuari amb permisos d'administració LDAP: <input class="form-control" type="text" name="adm"><br>
			</div>
			<div class="form-group">
			Contrasenya de l'usuari: <input class="form-control" type="password" name="cts"><br>
			</div>
			<input type="submit" class="btn btn-primary" value="Envia" />
			<input type="reset" class="btn btn-secondary" value="Neteja" />
		</form>
		</div>
	</body>
</html>