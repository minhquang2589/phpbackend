<?php
class classController extends Controller
{
    private $classModel;

    public function __construct()
    {
        parent::__construct();
        if (!Session::get('user')) {
            redirect('login');
        }

        $this->classModel = $this->loadModel('class');
    }


    public function index()
    {
        $lstClass = $this->classModel->all();
        $data = [
            'lstClass' => $lstClass
        ];
        $this->view('class/index', $data);
    }

    // load view addnew

    public function addnew()
    {
        
        $this->view('class/addnew');
    }

    // save data to database

    public function save(){
        if($this->isPost()){
            $name = $this->input()['post']['name'];
            $data = [
                'name' => $name
            ];
            $this->classModel->create($data);
            redirect(site_url("class"));
        }else{
            echo 'Method not allowed';
        }
    }

    public function edit($params){
        $id = isset($params['id']) ? $params['id'] : null;
        if(!$id){
            redirect(site_url("class"));
        }

        $class = $this->classModel->find($id);

        if(!$class){
            redirect(site_url("class"));
        }

        $data = [
            'class' => $class
        ];

        $this->view('class/edit', $data);
    }

    public function update(){
        
        if($this->isPost()){
            $id = $this->input()['post']['id'];
            $name = $this->input()['post']['name'];
            $data = [
                'name' => $name
            ];
            $this->classModel->update($id, $data);
            redirect(site_url("class"));
        }else{
            echo 'Method not allowed';
        }
    }

    public function delete(){
        if($this->isPost()){
            try{
                $id = $this->input()['post']['id'];
                $res = $this->classModel->delete($id);
                if($res){
                    echo json_encode(['status' => 1]);
                }else{
                    echo json_encode(['status' => 0]);
                }
            }catch(Exception $e){
                $message = 'Error occurred';
                switch($e->getCode()){
                    case 1451:
                    default:
                        $message = 'Không thể xóa lớp này vì có sinh viên trong lớp';
                    break;
                }
                echo json_encode(['status' => 0, 'message' => $message]);
            }
           
        }else{
            echo 'Method not allowed';
        }
    }

}
