<?php
    class Person {
        private $first_name, $last_name, $grade;

        public function __construct($f_name, $l_name, $grade){
            $this->first_name = trim($f_name);
            $this->last_name = trim($l_name);
            $this->grade = $grade;
        }

        public function getFirstName(){
            return $this->first_name;
        }
        public function getLastName(){
            return $this->last_name;
        }
        public function getGrade(){
            return $this->grade;
        }
        public function setGrade($grade){
            $this->grade = $grade;
        }

    }
?>
