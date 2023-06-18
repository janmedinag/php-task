<?php
    
    $hostname = "";
    $username = "";
    $password = "";
    $dbname = "";
    
    date_default_timezone_set('Australia/Brisbane');

    $sho_opt  = "uph";
    $lon_opt = ["file:", "create_table", "dry_run:", "help"];

    $options = getopt($sho_opt, $lon_opt);

    $val = sizeof($options);

    if ($val == 0){
        echo "You didn't send any option";
    }else{

        switch ($options) {

            case isset($options["u"]):
                echo "MYSQL username: ".$username;
                break;
            case isset($options["p"]):
                echo "MYSQL password: ".$password;
                break;
            case isset($options["h"]):
                echo "MYSQL host: ".$hostname;
                break;                
            case isset($options["file"]):
                break;
            case isset($options["create_table"]):
                $stdouts = fopen('stdout.log', 'r');
                $line = '';
                while (!feof($stdouts)) {
                    $line = $line.fgets($stdouts);
                }
                fclose($stdouts);

                $stdout = fopen('stdout.log', 'w');

                $conn = new mysqli($hostname, $username, $password, $dbname);
                if ($conn->connect_error) {
                    fwrite($stdout, $line.date("d/m/Y H:i:s")." Database Connection failed: ". $conn->connect_error."\n");
                    die("Database Connection failed: " . $conn->connect_error);
                } 
                $sql = "DROP TABLE IF EXISTS users";
                
                if ($conn->query($sql) === FALSE) {
                    fwrite($stdout, $line.date("d/m/Y H:i:s")." Error droping table: " . $conn->error."\n");
                }
                
                $sql = "CREATE TABLE users (
                    id int AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(50) NOT NULL,
                    surname VARCHAR(50) NOT NULL,
                    email VARCHAR(50) NOT NULL,
                    UNIQUE KEY unique_email (email)  
                    )";
            
                if ($conn->query($sql) === TRUE) {
                    fwrite($stdout, $line.date("d/m/Y H:i:s")." Table users created successfully\n");
                } else {
                    fwrite($stdout, $line.date("d/m/Y H:i:s")." Error creating table: " . $conn->error."\n");
                }

                fclose($stdout);
                $conn->close();
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