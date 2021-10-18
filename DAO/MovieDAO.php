<?php

    namespace DAO;

    use Models\Movie as Movie;
    use Models\MovieGenre as MovieGenre;
    use DAO\MovieGenreDAO as MovieGenreDAO;

    class movieDAO 
    {
        private $movieList = array();

        public function getAll() 
        {
            //$this->retrieveData();
            $this->retrieveLimitedData();

            return $this->movieList;
        }

        public function getMovie($id) 
        {
            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/$id?api_key=" . API_KEY . "&language=es");
            
            $jsonToDecode = json_decode($jsonContent, true);

            $movie = null;

            if($id == $jsonToDecode["id"]) 
            {
                $movie = new Movie();

                $movie->setId($jsonToDecode["id"]);
                $movie->setPosterPath("http://image.tmdb.org/t/p/original" . $jsonToDecode["poster_path"]);
                $movie->setBackdropPath("http://image.tmdb.org/t/p/original" . $jsonToDecode["backdrop_path"]);
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
                $movie->setGenres($genres);
            }

            return $movie;
        }

        public function retrieveData() 
        {
            $this->movieList = array();

            set_time_limit(0);
            
            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . API_KEY . "&language=es-419");
            
            $arrayToDecode = json_decode($jsonContent, true);

            $pages = $arrayToDecode["total_pages"];


            for($i=1; $i<$pages; $i++) 
            {
                $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . API_KEY . "&language=es-419&page=" . $i);
            
                $arrayToDecode = json_decode($jsonContent, true);
                
                foreach($arrayToDecode["results"] as $valueArray) 
                {
                    $movie = new Movie();
                    $movie->setId($jsonToDecode["id"]);
                    $movie->setTitle($jsonToDecode["title"]);

                    array_push($this->movieList, $movie);
                }
            }
        }

        public function retrieveLimitedData() 
        {
            $this->movieList = array();

            set_time_limit(0);
            
            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/now_playing?api_key=" . API_KEY . "&language=es-419");
            
            $arrayToDecode = json_decode($jsonContent, true);
                
            foreach($arrayToDecode["results"] as $valueArray) 
            {
                $movie = new Movie();

                $movie->setId($valueArray["id"]);
                $movie->setTitle($valueArray["title"]);

                array_push($this->movieList, $movie);
            }
        }

        public function getTrailer($id) 
        {
            $jsonContent = file_get_contents("https://api.themoviedb.org/3/movie/$id/videos?api_key=" . API_KEY . "&language=es-ES");
            
            $jsonToDecode = json_decode($jsonContent, true);

            $trailer = null;

            if(isset($jsonToDecode["results"][0])) 
            {
                //$trailer = "https://www.youtube.com/watch?v=" . $result["key"];
                $trailer = '<iframe src="https://www.youtube.com/embed/' . $jsonToDecode["results"][0]["key"] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
            }

            return $trailer;
        }
    }
