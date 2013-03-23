<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller
{

    public function __construct(){
        parent::__construct();

    }
    public function index()
    {
        //$this->simplelogin->create('shadow2burn@gmail.com','123456',true);
        if (!$this->session->userdata('logged_in')) {
            redirect('users/login');
        }
    }

    public function login()
    {
        if ($this->input->post()) {
            if ($this->simplelogin->login($this->input->post('email'), $this->input->post('password'))) {
                $this->session->set_flashdata('msg', 'Logged in successfully');
                redirect('project');
            } else {
                $this->session->set_flashdata('msg', 'Please enter a valid email/password');
                redirect('users/login');
            }
        }
        $this->data['content'] = 'login';
        $this->load->view('_template', $this->data);
    }

    public function logout()
    {
        $this->simplelogin->logout();
        redirect('users/login');
    }

}