<?php
   define('DB_SERVER', 'localhost');
   // The DB credentials should not be be stored in source control, but they are include here to provide a complete example.  
   define('DB_USERNAME', 'sec_user');
   define('DB_PASSWORD', '*D8D83CD772490A5A5E41D880C313D3AE8C95EB3E');
   define('DB_DATABASE', 'security_challenge');
   $db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   $db->set_charset("utf8");
?>
