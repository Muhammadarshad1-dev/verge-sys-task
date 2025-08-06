<?php 
session_start();

class EmployeAdminController {
    private $servername = 'localhost';
    private $username = 'root';
    private $pasword = '';
    private $dbname = 'portfolio';
    private $conn;
    private $logFile;

    function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->pasword, $this->dbname);
        $this->logFile = __DIR__ . "/../logs/employees.log"; // Log file path
    }

    private function writeLog($message) {
        $date = date('Y-m-d H:i:s');
        file_put_contents($this->logFile, "[$date] $message" . PHP_EOL, FILE_APPEND);
    }

    public function AddAdmin($post) {
        $name = $_POST['employe_name'];
        $email = $_POST['employe_email'];
        $department = $_POST['department'];

        $target_dir = "../public/Profiles/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

        date_default_timezone_set('Asia/Karachi');
        $date = date('m/d/Y h:i:s a', time());

        $insertAdmin = "INSERT INTO `employes`(`employe_name`, `employe_email`, `employe_dept`,`employe_file`,`date`,`status`) 
                        VALUES ('{$name}','{$email}','{$department}','{$target_file}','{$date}','1')";
        $result = $this->conn->query($insertAdmin);

        if ($result) {
            echo '<div class="alert alert-success">Employes Successfully Added</div>';
            $this->writeLog("Added employee: {$name} ({$email})");
        } else {
            echo '<div class="alert alert-danger">Error!! Something is wrong try again</div>';
            $this->writeLog("Failed to add employee: {$name} ({$email}) - " . $this->conn->error);
        }
    }

    public function DisplayAllEmploye() {
        $select = "SELECT * FROM `employes`";
        $result = $this->conn->query($select);
        $array = [];
        foreach ($result as $value) {
            $array[] = $value;
        }
        return $array;
    }

    public function EditEmployeRecord($post) {
        $Eaid = $_POST['Eaid'];
        $select = "SELECT * FROM `employes` WHERE `id`='{$Eaid}'";
        $result = $this->conn->query($select);
        $array = [];
        foreach ($result as $value) {
            $array[] = $value;
        }
        return $array;
    }

    public function UpdateEmployeRecord($post) {
        $employe_id = $_POST['Eaid'];
        $name = $_POST['edit_name'];
        $email = $_POST['edit_email'];
        $department = $_POST['department'];

        $target_dir = "../public/Profiles/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $imageUploaded = move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

        if (!$imageUploaded) {
            $update = "UPDATE `employes` SET `employe_name`='{$name}',`employe_email`='{$email}',`employe_dept`='{$department}' WHERE `id`='{$employe_id}'";
        } else {
            $update = "UPDATE `employes` SET `employe_name`='{$name}',`employe_email`='{$email}',`employe_dept`='{$department}',`employe_file`='{$target_file}' WHERE `id`='{$employe_id}'";
        }

        $result = $this->conn->query($update);
        if ($result) {
            echo '<div class="alert alert-success">Successfully Updated</div>';
            $this->writeLog("Updated employee ID: {$employe_id}");
        } else {
            echo '<div class="alert alert-danger">Error!! Record could not be update</div>';
            $this->writeLog("Failed to update employee ID: {$employe_id} - " . $this->conn->error);
        }
    }

    public function EmployeDelete($post) {
        $Daid = $_POST['Daid'];
        $Delete = "DELETE FROM `employes` WHERE `id`='{$Daid}'";
        $result = $this->conn->query($Delete);

        if ($result) {
            echo '<div class="alert alert-success">Successfully Deleted</div>';
            $this->writeLog("Deleted employee ID: {$Daid}");
        } else {
            echo '<div class="alert alert-danger">Error!! Record could not be delete</div>';
            $this->writeLog("Failed to delete employee ID: {$Daid} - " . $this->conn->error);
        }
    }



    // update emoloye status controller code 
    public function UpdateEmployeStatus($post) {
        $employeId = $_POST['employeId'];
        $status = $_POST['status'];

        $updateStatus = "UPDATE `employes` SET `status`='{$status}' WHERE `id`='{$employeId}'";
        $result = $this->conn->query($updateStatus);

        if ($result) {
            echo '<div class="alert alert-success">Status Updated Successfully</div>';
            $this->writeLog("Updated status for employee ID: {$employeId} to {$status}");
        } else {
            echo '<div class="alert alert-danger">Error!! Status could not be updated</div>';
            $this->writeLog("Failed to update status for employee ID: {$employeId} - " . $this->conn->error);
        }
    }
}




?>
