<?php
$dbh = new PDO( "mysql:host=localhost", "root", "" );
$dbs = $dbh->query( 'SHOW DATABASES' );
while( ( $db = $dbs->fetchColumn( 0 ) ) !== false )
{
	echo $db.'<br>';
}