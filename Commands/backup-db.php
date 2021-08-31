<?php

$filename='database_backup_'.date('G_a_m_d_y').'.sql';

$return_var = NULL;
$output = NULL;
$command = "/usr/bin/mysqldump -u root -h localhost -p ecommerce > ../DB/backups/$filename";
exec($command, $output, $return_var);

if($return_var) {
    var_dump($output);
} else {
    echo "backup successful: $filename";
}