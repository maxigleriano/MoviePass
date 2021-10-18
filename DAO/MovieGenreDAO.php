<?php

    namespace DAO;

    use Models\MovieGenre as MovieGenre;

    class GenreRepository {
    
        private $genreList;
        private $fileName;

        public function __construct() {
            $this->fileName = dirname(__DIR__) . "/Data/Genres.json";
        }

        public function getGenre($id)
        {
            $this->retrieveData();

            $i = 0;
            $genre = null;

            while($i < count($this->genreList && !$genre) 
            {
                if($this->genreList[$i]->getId() == $id)
                {
                    $genre = $this->genreList[$i];
                }
                $i++;
            }

            return $genre;
        }   

        public function getAll() {
            $this->retrieveData();
            return $this->genreList;
        }

        private function retrieveData() {
            $this->genreList = array();

            if(file_exists($this->fileName)) {
                $jsonContent = file_get_contents($this->fileName);
                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valueArray) 
                {    
                    $genre = new MovieGenre();
                    $genre->setId($valueArray["genre_id"]):
                    $genre->setName($valueArray["genre_name"]):

                    array_push($this->genreList, $genre);
                }
            }
        }    
    }
