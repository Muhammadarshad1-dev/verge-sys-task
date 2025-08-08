<?php
session_start();
class EmployeAdminController
{
    private $servername = 'localhost';
    private $username = 'root';
    private $pasword = '';
    private $dbname = 'portfolio';
    private $conn;
    private $logFile;

    function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->pasword, $this->dbname);
        $this->logFile = __DIR__ . "/../logs/employees.log"; // Log file path
    }

    private function writeLog($message)
    {
        $date = date('Y-m-d H:i:s');
        file_put_contents($this->logFile, "[$date] $message" . PHP_EOL, FILE_APPEND);
    }

    public function AddAdmin($post)
    {
        require_once __DIR__ . '/DropboxService.php'; // Corrected path to DropboxService

        $name = trim($_POST['employe_name']);
        $email = trim($_POST['employe_email']);
        $department = trim($_POST['department']);

        // Basic validation
        if (empty($name) || empty($email) || empty($department)) {
            echo '<div class="alert alert-danger">All fields are required.</div>';
            return;
        }

        // Check if file was uploaded
        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            echo '<div class="alert alert-danger">File upload failed or no file selected.</div>';
            return;
        }

        // Check Dropbox authentication
        if (!isset($_SESSION['dropbox_access_token'])) {
            $dropbox = new DropboxService();
            $authUrl = $dropbox->getAuthUrl();
            echo '<div class="alert alert-warning">Please connect Dropbox: <a href="' . $authUrl . '" target="_blank">Connect Now</a></div>';
            return;
        }

        // File path for Dropbox
        $filePath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];

        // Upload to Dropbox
        try {
            $dropbox = new DropboxService();
            $dropboxLink = $dropbox->uploadFile($filePath, $fileName);
            if (!$dropboxLink) {
                throw new Exception("Dropbox upload returned empty link.");
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">Dropbox upload failed: ' . $e->getMessage() . '</div>';
            $this->writeLog("Dropbox upload failed for {$name} ({$email}): " . $e->getMessage());
            return;
        }

        date_default_timezone_set('Asia/Karachi');
        $date = date('m/d/Y h:i:s a', time());

        // Insert into MySQL using direct query
        $insertAdmin = "INSERT INTO `employes` (`employe_name`, `employe_email`, `employe_dept`, `employe_file`, `date`, `status`) 
                    VALUES ('{$this->conn->real_escape_string($name)}', 
                            '{$this->conn->real_escape_string($email)}', 
                            '{$this->conn->real_escape_string($department)}', 
                            '{$this->conn->real_escape_string($dropboxLink)}', 
                            '{$date}', 
                            '1')";

        $result = $this->conn->query($insertAdmin);

        if ($result) {
            echo '<div class="alert alert-success">Employee Successfully Added</div>';
            $this->writeLog("Added employee: {$name} ({$email}) - File uploaded to Dropbox");
        } else {
            echo '<div class="alert alert-danger">Error!! Could not insert record: ' . $this->conn->error . '</div>';
            $this->writeLog("MySQL error for {$name}: " . $this->conn->error);
        }
    }



    public function DisplayAllEmploye()
    {
        $select = "SELECT * FROM `employes`";
        $result = $this->conn->query($select);
        $array = [];
        foreach ($result as $value) {
            $array[] = $value;
        }
        return $array;
    }

    public function EditEmployeRecord($post)
    {
        $Eaid = $_POST['Eaid'];
        $select = "SELECT * FROM `employes` WHERE `id`='{$Eaid}'";
        $result = $this->conn->query($select);
        $array = [];
        foreach ($result as $value) {
            $array[] = $value;
        }
        return $array;
    }

    public function UpdateEmployeRecord($post)
    {
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

    public function EmployeDelete($post)
    {
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
    public function UpdateEmployeStatus($post)
    {
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