<?php
    try{
        $host        = "host = silly.db.elephantsql.com;";
        $port        = "port = 5432;";
        $dbname      = "dbname = blaiyjfo;";
        $dbuser 	 = "blaiyjfo";
        $dbpassword	 = "ZgOq9WxpaZvURWA8BtY4XqE4jPUGN5tJ";
		
		ini_set("default_socket_timeout", 60);

        // para conectar ao mysql, substitua pgsql por mysql
        $db= new PDO('pgsql:' . $host . $port . $dbname, $dbuser, $dbpassword);

        //alguns atributos de performance.
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
		$db->setAttribute(PDO::ATTR_TIMEOUT,30);
        $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
        echo $e;
    }

?>