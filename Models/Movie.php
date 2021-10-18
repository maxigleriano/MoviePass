<?php

    namespace Models;

    class Movie 
    {
        private $posterPath;
        private $backdropPath;
        private $id;
        private $adult;
        private $genres;
        private $title;
        private $voteAverage;
        private $overview;
        private $releaseDate;
        private $runtime;

        /**
         * Get the value of posterPath
         */ 
        public function getPosterPath()
        {
                return $this->posterPath;
        }

        /**
         * Set the value of posterPath
         *
         * @return  self
         */ 
        public function setPosterPath($posterPath)
        {
                $this->posterPath = $posterPath;

                return $this;
        }

        /**
         * Get the value of backdropPath
         */ 
        public function getBackdropPath()
        {
                return $this->backdropPath;
        }

        /**
         * Set the value of backdropPath
         *
         * @return  self
         */ 
        public function setBackdropPath($backdropPath)
        {
                $this->backdropPath = $backdropPath;

                return $this;
        }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of adult
         */ 
        public function getAdult()
        {
                return $this->adult;
        }

        /**
         * Set the value of adult
         *
         * @return  self
         */ 
        public function setAdult($adult)
        {
                $this->adult = $adult;

                return $this;
        }

        /**
         * Get the value of genres
         */ 
        public function getGenres()
        {
                return $this->genres;
        }

        /**
         * Set the value of genres
         *
         * @return  self
         */ 
        public function setGenres($genres)
        {
                $this->genres = $genres;

                return $this;
        }

        /**
         * Get the value of title
         */ 
        public function getTitle()
        {
                return $this->title;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        /**
         * Get the value of voteAverage
         */ 
        public function getVoteAverage()
        {
                return $this->voteAverage;
        }

        /**
         * Set the value of voteAverage
         *
         * @return  self
         */ 
        public function setVoteAverage($voteAverage)
        {
                $this->voteAverage = $voteAverage;

                return $this;
        }

        /**
         * Get the value of overview
         */ 
        public function getOverview()
        {
                return $this->overview;
        }

        /**
         * Set the value of overview
         *
         * @return  self
         */ 
        public function setOverview($overview)
        {
                $this->overview = $overview;

                return $this;
        }

        /**
         * Get the value of releaseDate
         */ 
        public function getReleaseDate()
        {
                return $this->releaseDate;
        }

        /**
         * Set the value of releaseDate
         *
         * @return  self
         */ 
        public function setReleaseDate($releaseDate)
        {
                $this->releaseDate = $releaseDate;

                return $this;
        }

        /**
         * Get the value of runtime
         */ 
        public function getRuntime()
        {
                return $this->runtime;
        }

        /**
         * Set the value of runtime
         *
         * @return  self
         */ 
        public function setRuntime($runtime)
        {
                $this->runtime = $runtime;

                return $this;
        }
    }
