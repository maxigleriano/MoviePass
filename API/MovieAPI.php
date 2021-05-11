<?php

    namespace API;

    use Models\Movie as Movie;
    use DAO\MovieGenreDAO as MovieGenreDAO;

    class movieAPI {
        private $movieList = array();

        public function getAll() {
            $this->retrieveLimitedData();

            return $this->movieList;
        }

        public function getByDate($date1, $date2) {   
            $this->retrieveData();
            $movies = array();

            foreach($this->movieList as $movie) {   
                if($movie->getReleaseDate() >= $date1 && $movie->getReleaseDate() <= $date2) {   
                    array_push($movies,$movie);
                }
            }
        
            return $movies;
        }

        public function getByGenre($genreValue) {
            $this->retrieveData();
            $movies = array();

            $movieGenreDAO = new MovieGenreDAO();

            $genre = $movieGenreDAO->getByName($genreValue);

            if($genre) 
            {
                foreach($this->movieList as $movie)
                {
                    if($movie->hasGenre($genre->getId()))
                    {
                        array_push($movies,$movie);
                    }
                }
            }
            
            return $movies;
        }

        public function retrieveData() {
            set_time_limit(0);
            
            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . API_KEY . "&language=es-419");
            
            $arrayToDecode = json_decode($jsonContent, true);

            $pages = $arrayToDecode["total_pages"];


            for($i=1; $i<$pages; $i++) {

                $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . API_KEY . "&language=es-419&page=" . $i);
            
                $arrayToDecode = json_decode($jsonContent, true);

                $APIArray = $arrayToDecode["results"];
                
                foreach($APIArray as $valueArray) {
                    
                    $movie = new Movie();
                
                    $movie->setPosterPath("http://image.tmdb.org/t/p/original" . $valueArray["poster_path"]);
                    $movie->setBackdropPath("http://image.tmdb.org/t/p/original" . $valueArray["backdrop_path"]);
                    $movie->setId($valueArray["id"]);
                    $movie->setAdult($valueArray["adult"]);
                    $movie->setGenreIds($valueArray["genre_ids"]);
                    $movie->setTitle($valueArray["title"]);
                    $movie->setVoteAverage($valueArray["vote_average"]);
                    $movie->setOverview($valueArray["overview"]);
                    $movie->setReleaseDate(date($valueArray["release_date"]));

                    array_push($this->movieList, $movie);
                }
            }
        }

        public function retrieveLimitedData() {
            set_time_limit(0);
            
            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . API_KEY . "&language=es-419");
            
            $arrayToDecode = json_decode($jsonContent, true);

            $APIArray = $arrayToDecode["results"];
                
            foreach($APIArray as $valueArray) {
                    
                $movie = new Movie();
                
                $movie->setPosterPath("http://image.tmdb.org/t/p/original" . $valueArray["poster_path"]);
                $movie->setBackdropPath("http://image.tmdb.org/t/p/original" . $valueArray["backdrop_path"]);
                $movie->setId($valueArray["id"]);
                $movie->setAdult($valueArray["adult"]);
                $movie->setGenreIds($valueArray["genre_ids"]);
                $movie->setTitle($valueArray["title"]);
                $movie->setVoteAverage($valueArray["vote_average"]);
                $movie->setOverview($valueArray["overview"]);
                $movie->setReleaseDate(date($valueArray["release_date"]));

                array_push($this->movieList, $movie);
            }
        }

        public function getAllTitles() {
            set_time_limit(0);
            
            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . API_KEY . "&language=es-419");
            
            $arrayToDecode = json_decode($jsonContent, true);

            $pages = $arrayToDecode["total_pages"];

            $titles = array();


            for($i=1; $i<$pages; $i++) {

                $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . API_KEY . "&language=es-419&page=" . $i);
            
                $arrayToDecode = json_decode($jsonContent, true);

                $APIArray = $arrayToDecode["results"];
                
                foreach($APIArray as $valueArray) {
                    
                    array_push($titles, $valueArray["title"]);
                }
            }

            return $titles;
        }

        public function getByName($name) {
            $newName = str_replace(" ", "%20", $name);

            $jsonContent = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=" . API_KEY . "&language=es&query=" . $newName . "&page=1");
            
            $arrayToDecode = json_decode($jsonContent, true);

            $APIArray = $arrayToDecode["results"];

            foreach($APIArray as $valueArray) {
                if($name == $valueArray["title"]) {
                    $movie = $this->getById($valueArray["id"]);

                    return $movie;
                }
            }

            return null;
    
        }

        public function getById($id) {

            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/$id?api_key=" . API_KEY . "&language=es");
            
            $jsonToDecode = json_decode($jsonContent, true);

                if($id == $jsonToDecode["id"]) {
                    $movie = new Movie();
                    
                    $movie->setPosterPath("http://image.tmdb.org/t/p/original" . $jsonToDecode["poster_path"]);
                    $movie->setBackdropPath("http://image.tmdb.org/t/p/original" . $jsonToDecode["backdrop_path"]);
                    $movie->setId($jsonToDecode["id"]);
                    $movie->setAdult($jsonToDecode["adult"]);
                    $movie->setTitle($jsonToDecode["title"]);
                    $movie->setVoteAverage($jsonToDecode["vote_average"]);
                    $movie->setOverview($jsonToDecode["overview"]);
                    $movie->setReleaseDate(date($jsonToDecode["release_date"]));
                    $movie->setRuntime($jsonToDecode["runtime"]);
                    
                    $genreArray = $jsonToDecode["genres"];
                    $genres = array();
                    foreach($genreArray as $genre) {
                        array_push($genres, $genre["id"]);
                    }
                    
                    $movie->setGenreIds($genres);

                    return $movie;
                }

                else {
                    return null;
                }
        }

        public function getMovies($movieIds) {
            $movies = array();
            
            foreach($movieIds as $id) {
                array_push($movies, $this->getById($id));
            }
            return $movies;
        }

        public function getTrailer($id) {
            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/$id/videos?api_key=" . API_KEY . "&language=es-ES");
            
            $jsonToDecode = json_decode($jsonContent, true);

                if($id == $jsonToDecode["id"]) 
                {
                    $results = $jsonToDecode["results"];

                    foreach($results as $result) 
                    {
                        //$trailer = "https://www.youtube.com/watch?v=" . $result["key"];
                        $trailer = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $result["key"] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        return $trailer;
                    }
                }

                else {
                    return null;
                }
        }
        

        /* public function retrieveData() {
            set_time_limit(0);

            for($i=1; $i<20; $i++) {

                $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . API_KEY . "&language=es-419&page=" . $i);
            
                $arrayToDecode = json_decode($jsonContent, true);

                $APIArray = $arrayToDecode["results"];
                
                foreach($APIArray as $valueArray) {
                    
                    $movie = new Movie();
                
                    $movie->setPosterPath("http://image.tmdb.org/t/p/original" . $valueArray["poster_path"]);
                    $movie->setId($valueArray["id"]);
                    $movie->setAdult($valueArray["adult"]);
                    $movie->setGenreIds($valueArray["genre_ids"]);
                    $movie->setTitle($valueArray["title"]);
                    $movie->setVoteAverage($valueArray["vote_average"]);
                    $movie->setOverview($valueArray["overview"]);
                    $movie->setReleaseDate(date($valueArray["release_date"]));

                    array_push($this->movieList, $movie);
                }
            }
        } */
    }

?>