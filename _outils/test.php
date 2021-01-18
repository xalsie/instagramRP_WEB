<?php

echo date(DATE_RFC2822);

exit;

$dclist = gethostbynamel('prolival.fr');
// print_r($dclist);

foreach ($dclist as $k => $dc) if (serviceping($dc) == true) break; else $dc = 0;

echo $dc;

function serviceping($host, $port=389, $timeout=1)
{
        $op = fsockopen($host, $port, $errno, $errstr, $timeout);
        if (!$op) return 0; //DC is N/A
    else {
    fclose($opanak); //explicitly close open socket connection
    return 1; //DC is up & running, we can safely connect with ldap_connect
    }
}

?>