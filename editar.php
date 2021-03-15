<html>
<head>
<title>DADES EDITADES</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>
<body>
</body>
</html>
<?php 
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;
require 'navBar.php';
$uid = $_POST['uid'];  
$unorg = $_POST['unorg'];
$valor= $_POST['valor'];
$atribut = $_POST['atribut'];
$dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';

#
#Opcions de la connexió al servidor i base de dades LDAP
$opcions = [
    'host' => 'zend-abjiro.fjeclot.net',
    'username' => 'cn=admin,dc=fjeclot,dc=net',
    'password' => 'fjeclot',
    'bindRequiresDn' => true,
    'accountDomainName' => 'fjeclot.net',
    'baseDn' => 'dc=fjeclot,dc=net',
];
#
# Modificant l'entrada
#
$ldap = new Ldap($opcions);
$ldap->bind();
$entrada = $ldap->getEntry($dn);
echo "<div style='width:60%; margin: 0 auto; border: 1px solid'>";
echo "<div style='width:60%; margin: 0 auto'>";
if ($entrada){
    Attribute::setAttribute($entrada,$atribut,$valor);
    $ldap->update($dn, $entrada);
    echo "Atribut modificat";
} else echo "<b>Aquesta entrada no existeix</b><br><br>";
echo "</div>";
echo "</div>";
?>
