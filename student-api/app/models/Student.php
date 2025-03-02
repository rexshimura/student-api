<?php
class Student {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllStudents() {
        $sql = "SELECT id, name, midterm_score, final_score, final_grade, status FROM students";
        $result = $this->conn->query($sql);

        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        return $students;
    }

    public function getStudentById($id) {
        $stmt = $this->conn->prepare("SELECT id, name, midterm_score, final_score, final_grade, status FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function addStudent($name, $midterm_score, $final_score) {
        $stmt = $this->conn->prepare("INSERT INTO students (name, midterm_score, final_score) VALUES (?, ?, ?)");
        $stmt->bind_param("sdd", $name, $midterm_score, $final_score);
        return $stmt->execute();
    }

    public function updateStudent($id, $midterm_score, $final_score) {
        $stmt = $this->conn->prepare("UPDATE students SET midterm_score = ?, final_score = ? WHERE id = ?");
        $stmt->bind_param("ddi", $midterm_score, $final_score, $id);
        return $stmt->execute();
    }

    public function deleteStudent($id) {
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
