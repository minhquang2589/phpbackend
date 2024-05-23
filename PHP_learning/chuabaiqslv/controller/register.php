<?php
class registerController extends Controller
{
    public function index()
    {
        if ($this->isPost()) {
            // $username = $_POST['username'];
            // $password = $_POST['password'];
            $username = $this->input()['post']['username'];
            $password = $this->input()['post']['password'];
            $email = $this->input()['post']['email'];
            $confirm_password = $this->input()['post']['confirm_password'];
            $fulname = $this->input()['post']['fullname'];

            if ($password != $confirm_password) {
                echo "Password and confirm password not match";
                return;
            }

            $password = sha1($password);

            $conn = $this->getConn();
            $sql = "INSERT INTO users (username, password, email, fullname) VALUES ('$username', '$password', '$email', '$fulname')";

            if ($conn->query($sql) === TRUE) {
                echo 'here';
                redirect("login");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            return;
        }
        
        
        $this->view("register/index");
    
      
    }


}
