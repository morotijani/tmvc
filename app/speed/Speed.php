<?php

namespace Speed;

defined('CPATH') OR exit('Access Denied!'); // Commadline path or current path

/**
 * Speed class
 */
class Speed {
    private $version = '1.0.0';

    public function db($argv) {
        $mode = $argv[1] ?? null;
        $param1 = $argv[2] ?? null;
        
        

        switch ($mode) {
            // create a table
            case 'db:create':

                // check if param1 is empty
                if (empty($param1)) 
                    die("\n\r Please provide a database name. \n\r");

                $db = new Database;
                $query = "CREATE DATABASE IF NOT EXISTS " . $param1;
                $db->query($query);
                die("\n\r Database created successfully. \n\r");
                break;

            // find whats inside the table
            case 'db:table':
                 // check if param1 is empty
                if (empty($param1)) 
                    die("\n\r Please provide a table name. \n\r");

                $db = new Database;
                $query = "DESCRIBE " . $param1;
                $response = $db->query($query);
                if ($response) {
                    // code...
                    print_r($response);
                } else {
                    echo "\n\r Could not find data for table:  $param1 \n\r";
                }
                break;

            // delete a table
            case 'db:drop':
                 // check if param1 is empty
                if (empty($param1)) 
                    die("\n\r Please provide a database name. \n\r");

                $db = new Database;
                $query = "DROP DATABASE " . $param1;
                $db->query($query);
                die("\n\r Database deleted successfully. \n\r");
                break;

            case 'db:seed':
                // code...
                break;
            
            default:
                // code...
                die("\n\r Unknown commad $argv[1] \n\r");
                break;
        }
    }

    public function make($argv) {
        $mode = $argv[1] ?? null;
        $classname = $argv[2] ?? null;
        
        // check if classname is empty
        if (empty($classname)) {
            // code...
            die("\n\r Please provide a class name. \n\r");
        }

        // clean class name
        $classname = preg_replace("/[^a-zA-Z0-9_]+/", "", $classname);

        // cheack if class name starts with a number
        if (preg_match("/^[^a-zA-Z_]+/", $classname)) 
            die("\n\r Class name cannot start with a number. \n\r");
        

        switch ($mode) {
            // create a controller
            case 'make:controller':
                $filename = "app" . DS . "controllers" . DS . ucfirst($classname) . ".php";
                if (file_exists($filename)) 
                    die("\n\r That controller already exists. \n\r");

                $sample_file =  file_get_contents("app" . DS . "speed" . DS . "samples" . DS . "controller.sample.php");
                $sample_file = preg_replace("/\{CLASSNAME\}/", ucfirst($classname), $sample_file);
                $sample_file = preg_replace("/\{classname\}/", strtolower($classname), $sample_file);

                if (file_put_contents($filename, $sample_file)) {
                    die("\n\r Controller created successfully. \n\r");
                } else {
                    die("\n\r Failed to create controller due to an error. \n\r");
                }
                break;

            // create a model
            case 'make:model':
                $filename = "app" . DS . "models" . DS . ucfirst($classname) . ".php";
                if (file_exists($filename)) 
                    die("\n\r That model already exists. \n\r");

                $sample_file =  file_get_contents("app" . DS . "speed" . DS . "samples" . DS . "model.sample.php");
                $sample_file = preg_replace("/\{CLASSNAME\}/", ucfirst($classname), $sample_file);
                // add an s to the end of the table name if it does not exist
                if (!preg_match("/s$/", $classname)) 
                    $sample_file = preg_replace("/\{table\}/", strtolower($classname) . 's', $sample_file);
                else 
                    $sample_file = preg_replace("/\{table\}/", strtolower($classname), $sample_file);


                if (file_put_contents($filename, $sample_file)) {
                    die("\n\r Model created successfully. \n\r");
                } else {
                    die("\n\r Failed to create model due to an error. \n\r");
                }
                break;

            case 'make:drop':
                // code...
                break;

            case 'make:seed':
                // code...
                break;
            
            default:
                // code...
                die("\n\r Unknown commad $argv[1] \n\r");
                break;
        }
    }

    public function migrate() {
        echo "\n\r This is the migrate function \n\r";
    }

    // echo out some help information
    public function help() {
        echo "
            Speed v$this->version Command Line Tool

            Database
                db:create                   Create a new database schema.
                db:seed                     Runs the specified seeder to populate known data into the database.
                db:table                    Retieves information on the selected table.
                db:drop                     Drop/Delete a database.
                migrate                     Locate and runs a migration from th specified plugin folder.
                migrate:refresh             Does a rollback followed by a latest to refresh the current state of the database.
                migrate.rollback            Runs the 'down' method for a migration in the specified plugin folder.

            Generators
                make:controller             Generates a new controller file.
                make:model                  Generates a new model file.
                make:migration              Generates a new migration file.
                make:seeder                 Generates new seeder file.
        ";
    }
}