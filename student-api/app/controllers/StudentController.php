<?php
require_once '../app/models/Student.php';
require_once '../app/views/Response.php';

class StudentController {
    private $model;

    public function __construct($db) {
        $this->model = new Student($db);
    }

    public function getAllStudents() {
        $students = $this->model->getAllStudents();
        Response::json($students);
    }

    public function getStudentById($id) {
        $student = $this->model->getStudentById($id);
        if ($student) {
            Response::json($student);
        } else {
            Response::json(["message" => "Student not found."], 404);
        }
    }

    public function addStudent($data) {
        if (isset($data['name'], $data['midterm_score'], $data['final_score'])) {
            $this->model->addStudent($data['name'], $data['midterm_score'], $data['final_score']);
            Response::json(["message" => "Student added successfully."]);
        } else {
            Response::json(["message" => "Invalid input."], 400);
        }
    }

    public function updateStudent($data) {
        if (isset($data['id'], $data['midterm_score'], $data['final_score'])) {
            $this->model->updateStudent($data['id'], $data['midterm_score'], $data['final_score']);
            Response::json(["message" => "Student updated successfully."]);
        } else {
            Response::json(["message" => "Invalid input."], 400);
        }
    }

    public function deleteStudent($id) {
        $this->model->deleteStudent($id);
        Response::json(["message" => "Student deleted successfully."]);
    }
}
?>
