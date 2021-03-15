<?php
session_start();?>

<html>
<head>
<title>AFEGINT DADES D'USUARIS DE LA BASE DE DADES LDAP</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

</head>
<body>
<?php require 'navBar.php'; ?>
<div style="margin:25px auto; width:50%">
<h1>AFEGINT DADES D'USUARIS DE LA BASE DE DADES LDAP</h1>
	<form action="http://zend-abjiro.fjeclot.net/zendldap/afegirUsuari.php"
		method="POST">
		<div class="form-row row">
    		<div class="col">
        		Usuari: <input type="text" name="uid" class="form-control" required><br> 
        		Unitat organitzativa: <input type="text" name="unorg" class="form-control" required><br> 
        		Número usuari:<input type="text" name="num_id" class="form-control" required><br> 
        		Número grup:<input type="text" name="grup" class="form-control" required><br>
        		Directori personal:<input type="text" name="dir_pers" class="form-control" required><br> 
        		Shell:<input type="text" name="sh" class="form-control" required><br> 
        		cn:<input type="text" name="cn" class="form-control" required><br>
    		</div>
    		<div class="col">
        		sn:<input type="text" name="sn" class="form-control" required><br> 
        		Nom:<input type="text" name="nom" class="form-control" required><br>
        		Adreça:<input type="text" name="adressa" class="form-control" required><br> 
        		Mòbil:<input type="text" name="mobil" class="form-control" required><br> 
        		Telèfon:<input type="text" name="telefon" class="form-control" required><br>
        		Títol:<input type="text" name="titol" class="form-control" required><br> 
        		Descripció:<input type="text" name="descripcio" class="form-control" required><br>
    		</div>
		</div>
		<input type="submit" name="submit" class="btn btn-primary"/>
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
// Dades de la nova entrada
//

if (isset($_POST['submit'])) {
    
    $uid = $_POST['uid'];
    $unorg = $_POST['unorg'];
    $num_id = $_POST['num_id'];
    $grup = $_POST['grup'];
    $dir_pers = $_POST['dir_pers'];
    $sh = $_POST['sh'];
    $cn = $_POST['cn'];
    $sn = $_POST['sn'];
    $nom = $_POST['nom'];
    $mobil = $_POST['mobil'];
    $adressa = $_POST['adressa'];
    $telefon = $_POST['telefon'];
    $titol = $_POST['titol'];
    $descripcio = $_POST['descripcio'];
    $objcl = array(
        'inetOrgPerson',
        'organizationalPerson',
        'person',
        'posixAccount',
        'shadowAccount',
        'top'
    );
    
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-abjiro.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net'
    ];
    
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $nova_entrada = [];
    Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
    Attribute::setAttribute($nova_entrada, 'uid', $uid);
    Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
    Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
    Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
    Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
    Attribute::setAttribute($nova_entrada, 'cn', $cn);
    Attribute::setAttribute($nova_entrada, 'sn', $sn);
    Attribute::setAttribute($nova_entrada, 'givenName', $nom);
    Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
    Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
    Attribute::setAttribute($nova_entrada, 'title', $titol);
    Attribute::setAttribute($nova_entrada, 'description', $descripcio);
    $dn = 'uid=' . $uid . ',ou=' . $unorg . ',dc=fjeclot,dc=net';
    
    echo "<div style='width:60%; margin: 0 auto; border: 1px solid'>";
    echo "<div style='width:60%; margin: 0 auto'>";
    try {
        $ldap->add($dn, $nova_entrada);
        
        echo "Usuari creat";
    } catch (Exception $e) {
        echo "Alguna cosa ha fallat";
    }
    echo "</div>";
    echo "</div>";
}
?>


