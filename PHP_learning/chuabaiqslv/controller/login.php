<?php
class loginController extends Controller
{
    private $userModel = null;
    public function __construct(){
        parent::__construct();
        $this->userModel = $this->loadModel('user');
    }

    public function index()
    {

        if($this->isPost()){
            $username = $this->input()['post']['username'];
            $password = $this->input()['post']['password'];
            $res = $this->userModel->auth($username, $password);
            if($res){
                // bo cot password trong banghi tra ve
                unset($res['password']);
                // luu thong tin nguoi dung vao session
                Session::set('user', $res);
                redirect('dashboard');
            }
        }

        $this->view('login/index');
    }


}
