<?
// connexion
$dbConnect = pg_connect("host=db.int dbname=ourfeeling user=monitor password=monitor") or die('Erreur de connexion: ' .pg_last_error());;

// Requete sql 
$query = 'select count(*) from sf_guard_user';
$result = pg_query($dbConnect,$query) or die('Requete en erreur: ' .pg_last_error());
$ligne = pg_fetch_row($result);

// Traitement
$etat = $ligne[0] ;
if ( $etat > 0 )  
    $etat = 'OK';
else
    $etat = 'CRITICAL';

// Affichage
echo $etat . "\n";

// Liberation du / des resultat
pg_free_result($result);
// Fermeture de la connexion avec la base de donneee
pg_close($dbConnect);
?>
