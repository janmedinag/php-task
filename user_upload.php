<?php
    $sho_opt  = "uph";
    $lon_opt = ["file:", "create_table", "dry_run:", "help"];

    $options = getopt($sho_opt, $lon_opt);

    $val = sizeof($options);

    if ($val == 0){
        echo "You didn't send any option";
    }else{

        switch ($options) {

            case isset($options["u"]):
                echo "MYSQL username: ";
                break;
            case isset($options["p"]):
                echo "MYSQL password: ";
                break;
            case isset($options["h"]):
                echo "MYSQL host: ";
                break;                
            case isset($options["file"]):
                break;
            case isset($options["create_table"]):
                break;
            case isset($options["dry_run"]):
                break;
            case isset($options["help"]):
                echo "
                            --file [csv file name] - this is the name of the CSV to be parsed
                            --create_table - this will cause the MySQL users table to be built (and no further  
                            action will be taken)
                            --dry_run - this will be used with the --file directive in case we want to run the script but not 
                            insert into the DB. All other functions will be executed, but the database won't be altered
                            -u - MySQL username
                            -p - MySQL password
                            -h - MySQL host
                            --help - which will output the above list of directives with details
                            ";
                break;                
        }
    }

?>