<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Project extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }

        $this->load->model('project_model', 'project');
    }

    public function index($id = null)
    {
        if($id){
            $this->project->id = $id;
            $project = $this->project->find();
            $this->data['project'] = $project;
        }
        else
            $this->data['project'] = '';
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('msg', 'You are not authorize to access that location');
        }
        $this->data['project_list'] = $this->project->getList();
        $this->data['content'] = 'index';

        $this->load->view('_template', $this->data);

    }

    public function search()
    {

        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('msg', 'You are not authorize to access that location');
        }
        $this->data['projects'] = $this->project->findAll();
        $this->data['content'] = 'search';
        $this->load->view('_template', $this->data);

    }

    public function save_project($id = null)
    {

        if ($this->input->post()) {
            if ($id)
                $this->project->id = $id;
            if ($this->project->save($this->input->post())) {
                if ($id)
                    print json_encode($id);
                else
                    print $this->project->lastInsertId();
            }
            else
                print json_encode(false);
        }else
        print json_encode(false);
    }

    public function generateProjectList()
    {

        $this->data['project_list'] = $this->project->getList();
        $this->load->view('project/project_list', $this->data);

    }

    public function getProject($id = null)
    {

        if ($this->input->post('project_list'))
            $id = $this->input->post('project_list');

        if ($id) {
            $this->project->id = $id;
            $result = $this->project->find();
            print json_encode($result);
        } else
            print json_encode(false);
    }

    public function getProjectKeywords($id = null){
        $this->project->id = $id;
        $result = $this->project->getProjectKeywords();
        if($result)
            print json_encode($result);
        else
            print json_encode(false);

    }

    public function saveProjectKeywords($id = null){
        $this->project->id = $id;
        if($this->input->post()){
            $result = $this->project->saveKeyword($this->input->post());
            print $result;
        }
    }

    public function getProjectServices($id = null){
        $this->project->id = $id;
        $result = $this->project->getProjectServices();
        if($result)
            print json_encode($result);
        else
            print json_encode(false);

    }
    public function saveProjectService($id = null){
        $this->project->id = $id;
        if($this->input->post()){
            $result = $this->project->saveService($this->input->post());
            print $result;
        }
    }

    public function deleteProject($id)
    {
        if ($this->project->deleteProject($id))
            print json_encode($id);
        else
            print false;

    }

    public function terminateProject($id)
    {
        if ($this->project->terminateProject($id))
            print json_encode($id);
        else
            print false;

    }

    public function saveMeta($type,$project_id){
        $this->project->id = $project_id;
        if($this->input->post()){
            $data['key'] = $type;
            $data['value'] = serialize($this->input->post());
            print $this->project->saveMetaData($data);

        }
    }

    public function getAdditional($id){
        $this->project->id = $id;
        $result = $this->project->getAdditionalData();
        if($result){
            print json_encode($result);
        }
        else
            print json_encode(false);

    }

    public function saveAdditional($id){
        $this->project->id = $id;
        if($this->input->post()){
            $data = $this->input->post();
            if($this->project->checkExistingAdditional($data)){
                $key = $data['key'];
                $result = $this->project->updateAdditional($data,$key);
            }
            else
            {
                $result = $this->project->insertAdditional($data);
            }

            print $result;
        }
        else
            return false;
    }

    public function deleteAdditional($id){
        if ($this->project->deleteAdditional($id))
            print json_encode($id);
        else
            print false;
    }

    public function deleteService($id){
        if ($this->project->deleteService($id))
            print json_encode($id);
        else
            print false;
    }
    public function deleteKeyword($id){
        if ($this->project->deleteKeyword($id))
            print json_encode($id);
        else
            print false;
    }
    public function check_data(){

        // set the project id and get the value of for that project
        $this->project->id = 33;

        // facebook_url
	    // twitter_url
	    // google_plus_url
	    // linkedin_url
	    // yelp_url
	    // city_search_url

        $this->project->get('facebook_url');

    }


    public function check_meta_data(){

        //set project id
        $this->project->id = 30;
        // set key
        $key = "Name 3";

        $this->project->getMeta($key);

    }


}