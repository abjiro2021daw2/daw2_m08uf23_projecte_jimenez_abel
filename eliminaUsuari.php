<?php
session_start();?>
<html>
<head>
<title>ELIMINANT DADES D'USUARIS DE LA BASE DE DADES LDAP</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>
<body>
<?php require 'navBar.php'; ?>
<div style="width:50%; margin: 25px auto">
<h1>ELIMINANT DADES D'USUARIS DE LA BASE DE DADES LDAP</h1>
<form action="http://zend-abjiro.fjeclot.net/zendldap/eliminaUsuari.php" method="GET">
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

    if ($_GET['usr'] && $_GET['ou']) {
        
        $uid = $_GET['usr'];
        $unorg = $_GET['ou'];
        $dn = 'uid=' . $uid . ',ou=' . $unorg . ',dc=fjeclot,dc=net';
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
        echo "<div style='width:60%; margin: 0 auto; border: 1px solid'>";
        echo "<div style='width:60%; margin: 0 auto'>";
        try {
            $ldap->delete($dn);
            echo "<b>Entrada esborrada</b><br>";
        } catch (Exception $e) {
            echo "<b>Aquesta entrada no existeix</b><br>";
        }
        echo "</div>";
        echo "</div>";
    }

?>



