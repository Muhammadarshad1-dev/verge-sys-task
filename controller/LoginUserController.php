<?php 
    session_start();
  class LoginUserController{
      Private $servername ='localhost';
      Private $username='root';
      Private $pasword='';
      Private $dbname='portfolio';
      Private $conn;

      function __construct()
      {
        $this->conn = new mysqli($this->servername, $this->username, $this->pasword, $this->dbname);
        //  
      }// Constructor Close


      public function UserLogin($post)
    {
       $email=$_POST['email'];
       $password=$_POST['password'];
       $loginQuery="SELECT * FROM `users` 
       WHERE u_email='$email' AND u_password='$password'";
       $QueryResult=$this->conn->query($loginQuery);
        if ($QueryResult->num_rows ==1){
        while ($row=$QueryResult->fetch_assoc()) 
        { 
              echo 1;
              $uid=$row['u_id'];
              $username=$row['u_username'];

              $_SESSION['AdminLogin'] = true;
              $_SESSION['uid'] = $uid;
              $_SESSION['username'] = $username;
        }
        }
        else
        {
            echo 0;
        }

    }

  }
  ?>