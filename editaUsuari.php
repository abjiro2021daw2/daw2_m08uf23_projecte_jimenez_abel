<?php
session_start();?>
<html>
<head>
<title>EDITANT DADES D'USUARIS DE LA BASE DE DADES LDAP</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>
<body>
<?php require 'navBar.php'; ?>
<div style="width:50%; margin: 25px auto">
<h1>EDITANT DADES D'USUARIS DE LA BASE DE DADES LDAP</h1>
<form action="http://zend-abjiro.fjeclot.net/zendldap/editaUsuari.php" method="GET">
Unitat organitzativa: <input type="text" name="ou" class="form-control"><br>
Usuari: <input type="text" name="usr" class="form-control"><br>
<input type="submit" class="btn btn-primary"/>
<input type="reset" class="btn btn-secondary"/>
</form>
</div>
</body>
</html>

<?php 
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);


if ($_GET['usr'] && $_GET['ou']){
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-abjiro.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada='uid='.$_GET['usr'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
    if($usuari){?>
    
<div style="width:50%;margin:0 auto; border:1px solid">
<div style="width:50%;margin:0 auto; ">
	<label>Unitat Organitzativa: <strong><?php echo $_GET['ou']?></strong></label>
	<label>Usuari: <strong><?php echo $_GET['usr'] ?></strong></label>
	<form action="http://zend-abjiro.fjeclot.net/zendldap/editar.php" method="POST">
  		<p>Quin camp vols modificar?</p>
  		<div class="form-row row">
  			<input type="text" name="uid" value="<?php echo $_GET['usr']?>" hidden="true" ><br> 
          	<input type="text" name="unorg" value="<?php echo $_GET['ou']?>" hidden="true"><br>
    		<div class="col form-check">
                Número usuari:<input class="form-check-input" type="radio" name="atribut" value="uidNumber"><br> 
                Número grup:<input class="form-check-input" type="radio" name="atribut" value="gidNumber"><br>
                Directori personal:<input class="form-check-input" name="atribut" type="radio" value="homeDirectory"><br> 
                Shell:<input class="form-check-input" type="radio" name="atribut" value="loginShell"><br> 
                cn:<input class="form-check-input" type="radio" name="atribut" value="cn"><br> 
                sn:<input class="form-check-input" type="radio" name="atribut" value="sn"><br> 
        	</div>
            <div class="col form-check">
                Nom:<input class="form-check-input" type="radio" name="atribut" value="givenName"><br>
                Adreça:<input class="form-check-input" type="radio" name="atribut" value="postalAddress"><br> 
                Mòbil:<input class="form-check-input" type="radio" name="atribut" value="mobile"><br> 
                Telèfon:<input class="form-check-input" type="radio" name="atribut" value="telephoneNumber"><br>
                Títol:<input class="form-check-input" type="radio" name="atribut" value="title"><br> 
                Descripció:<input class="form-check-input" type="radio" name="atribut" value="description"><br> 
            </div>
        </div>
        Valor del camp a modificar: <input name="valor" type="text" required><br>
  		<input type="submit" name="submit" class="btn btn-primary"/>
  		
	</form>
	</div>
</div>

<?php 
    }else{
        echo "<div style='width:60%; margin: 0 auto; border: 1px solid'>";
        echo "<div style='width:60%; margin: 0 auto'>";
        echo "No s'ha trobat aquest usuari";
        echo "</div>";
        echo "</div>";
    }
}


?>

