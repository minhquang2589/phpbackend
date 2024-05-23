<?php
class dashboardController extends Controller
{

    private $studentModel = null;

    public function __construct()
    {
        parent::__construct();
        if(!Session::get('user')){
            redirect('login');
        }

        $this->studentModel = $this->loadModel('student');
    }

    public function index()
    {
        $students = $this->studentModel->all();
        $current_user  = Session::get('user');
        $data = [];
        $data['students'] = $students;
        $data['current_user'] = $current_user;
        $this->view('dashboard/index', $data);
    }
}