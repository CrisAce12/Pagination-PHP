<?php

    require('DBConnection.php');

    class Pagination{

        public $resultsPerPage;

        public $numberOfPages;
        public $dividedResults;

        function Paginate($resultsPerPage){

            $this->$resultsPerPage = $resultsPerPage;

            $connector = new DBConnector();
            $connection = $connector->getConnection();

            $preparedStatement = $connection->prepare("SELECT COUNT(*) FROM usuario;");
            $preparedStatement->execute();

            $numberOfResults = $preparedStatement->fetchColumn();

            //Number of Pages

            $numberOfPages = ceil($numberOfResults / $resultsPerPage);

            $this->numberOfPages = $numberOfPages;

            /* 

                Sketch for Printing Pagination Buttons
            
                for($page=1;$page<=$numberOfPages;$page++){

                    echo "<a href='index.php?page=". $page ."'>". $page ."</a> ";

                }
            
            */

            //User Actual Page

            if(!isset($_GET['page'])){

                $page = 1;

            }
            else{

                $page = $_GET['page'];

            }

            //Divide the Results for Each Page

            $firstResult = ($page-1)*$resultsPerPage;

            $connector2 = new DBConnector();
            $connection2 = $connector2->getConnection();

            $preparedStatement2 = $connection2->prepare("SELECT * FROM usuario LIMIT ".$firstResult.",".$resultsPerPage);
            $preparedStatement2->execute();

            $dividedResults = $preparedStatement2->fetchAll(PDO::FETCH_OBJ);
            
            $this->dividedResults = $dividedResults;

            /*

                Sketch for Printing Pagination Buttons

                foreach($dividedResults as $dividedResults){

                    echo $dividedResults->idUsuario." ".$dividedResults->nombreUsuario."<br>";

                }

            */

        }

    }
    
?>