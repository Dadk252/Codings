
<?php

// Parent Class
class Person {
    private $name;

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}

// Child Class
class Student extends Person {
    private $studentID;

    public function setStudentID($studentID) {
        $this->studentID = $studentID;
    }

    public function getStudentID() {
        return $this->studentID;
    }
}

// Reservation Class
class Reservation {
    private $student;
    private $seat;

    public function __construct($student, $seat) {
        $this->student = $student;
        $this->seat = $seat;
    }

    public function getStudent() {
        return $this->student;
    }

    public function getSeat() {
        return $this->seat;
    }

    public function setSeat($seat) {
        $this->seat = $seat;
    }

    public function toArray() {
        return [
            "name" => $this->student->getName(),
            "studentID" => $this->student->getStudentID(),
            "seat" => $this->seat
        ];
    }
}

?>
