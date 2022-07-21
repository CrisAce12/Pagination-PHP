<?php 

    class DBConnector{

        public function getConnection(){

            $host = "localhost";
            $databaseName = "pruebas_cristian";
            $user = "root";
            $password = "";

            try{
    
                $connection = new PDO("mysql:host=$host;dbname=$databaseName",$user,$password);

                return $connection;
    
            }catch(Exception $e){
    
                echo $e->getMessage();
    
            }

        }

        public function closeConnection($connection){

            $connection = null;

        }

    }

?>