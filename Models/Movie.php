<?php

    namespace Models;

    class Movie {
        private $poster_path;
        private $backdrop_path;
        private $id;
        private $adult;
        private $genre_ids;
        private $title;
        private $vote_average;
        private $overview;
        private $release_date;
        private $runtime;

        public function __construct() {
            $params = func_get_args();
            $num_params = func_num_args();
            $funcion_constructor ='__construct'.$num_params;
            
            if (method_exists($this,$funcion_constructor)) {
                call_user_func_array(array($this,$funcion_constructor),$params);
            }
	    }

        public function __construct0() {
            $this->poster_path = "";
            $this->backdrop_path = "";
            $this->id = "";
            $this->adult = "";
            $this->genre_ids = "";
            $this->title = "";
            $this->vote_average = "";
            $this->overview = "";
            $this->release_date = "";
            $this->runtime = "";
        }

        public function __construct9($poster_path,$backdrop_path, $id, $adult, $genre_ids, $title, $vote_average, $overview, $release_date) {
            $this->poster_path = $poster_path;
            $this->backdrop_path = $backdrop_path;
            $this->id = $id;
            $this->adult = $adult;
            $this->genre_ids = $genre_ids;
            $this->title = $title;
            $this->vote_average = $vote_average;
            $this->overview = $overview;
            $this->release_date = $release_date;
            $this->runtime = "";
        }


        public function __construct10($poster_path,$backdrop_path, $id, $adult, $genre_ids, $title, $vote_average, $overview, $release_date, $runtime) {
            $this->poster_path = $poster_path;
            $this->id = $id;
            $this->adult = $adult;
            $this->genre_ids = $genre_ids;
            $this->title = $title;
            $this->vote_average = $vote_average;
            $this->overview = $overview;
            $this->release_date = $release_date;
            $this->release_date = $runtime;
        }

        public function setPosterPath($value) {
            $this->poster_path = $value;
        }

        public function getPosterPath() {
            return $this->poster_path;
        }

        public function setBackdropPath($value) {
            $this->backdrop_path = $value;
        }

        public function getBackdropPath() {
            return $this->backdrop_path;
        }

        public function setId($value) {
            $this->id = $value;
        }

        public function getId() {
            return $this->id;
        }

        public function setAdult($value) {
            $this->adult = $value;
        }

        public function getAdult() {
            return $this->adult;
        }

        public function setGenreIds($value) {
            $this->genre_ids = $value;
        }

        public function getGenreIds() {
            return $this->genre_ids;
        }

        public function setTitle($value) {
            $this->title = $value;
        }

        public function getTitle() {
            return $this->title;
        }

        public function setVoteAverage($value) {
            $this->vote_average = $value;
        }

        public function getVoteAverage() {
            return $this->vote_average;
        }

        public function setOverview($value) {
            $this->overview = $value;
        }

        public function getOverview() {
            return $this->overview;
        }

        public function setReleaseDate($value) {
            $this->release_date = $value;
        }

        public function getReleaseDate() {
            return $this->release_date;
        }

        public function setRuntime($value) {
            $this->runtime = $value;
        }

        public function getRuntime() {
            return $this->runtime;
        }



        public function hasGenre($value) {
            $i = false;
            foreach($this->genre_ids as $id) {
                if($value == $id) {
                    $i = true;
                }
            }
            return $i;
        }
    }
?>