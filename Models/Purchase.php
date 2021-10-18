<?php

    namespace Models;

    class Purchase 
    {
         private $id;
         private $ticketAmount;
         private $total;
         private $date;
         private $userId;
         private $projectionId;

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
          * Get the value of ticketAmount
          */ 
         public function getTicketAmount()
         {
                  return $this->ticketAmount;
         }

         /**
          * Set the value of ticketAmount
          *
          * @return  self
          */ 
         public function setTicketAmount($ticketAmount)
         {
                  $this->ticketAmount = $ticketAmount;

                  return $this;
         }

         /**
          * Get the value of total
          */ 
         public function getTotal()
         {
                  return $this->total;
         }

         /**
          * Set the value of total
          *
          * @return  self
          */ 
         public function setTotal($total)
         {
                  $this->total = $total;

                  return $this;
         }

         /**
          * Get the value of date
          */ 
         public function getDate()
         {
                  return $this->date;
         }

         /**
          * Set the value of date
          *
          * @return  self
          */ 
         public function setDate($date)
         {
                  $this->date = $date;

                  return $this;
         }

         /**
          * Get the value of user
          */ 
         public function getUserId()
         {
                  return $this->userId;
         }

         /**
          * Set the value of user
          *
          * @return  self
          */ 
         public function setUserId($userId)
         {
                  $this->userId = $userId;

                  return $this;
         }

         /**
          * Get the value of projectionId
          */ 
         public function getProjectionId()
         {
                  return $this->projectionId;
         }

         /**
          * Set the value of projectionId
          *
          * @return  self
          */ 
         public function setProjectionId($projectionId)
         {
                  $this->projectionId = $projectionId;

                  return $this;
         }
    }
