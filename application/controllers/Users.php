<?php defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        // Load form validation ibrary & user model
        $this->load->library('form_validation');
        $this->load->model('user');

        // User login status
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');
    }

    public function index()
    {
        if ($this->isUserLoggedIn) {
            redirect('users/account');
        } else {
            redirect('users/login');
        }
    }

    public function account()
    {
        $data = array();


        if ($this->isUserLoggedIn) {
            $con = array(
                'id' => $this->session->userdata('userId')
            );
            $data['user'] = $this->user->getRows($con);

            $render_template = array(
                array(
                    'label' => 'account.php',
                    'param' => $data
                )
            );
            $this->template($render_template);

        } else {
            redirect('users/login');
        }

    }

    public function login()
    {
        $data = array();


        // Get messages from the session
        if ($this->session->userdata('success_msg')) {
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if ($this->session->userdata('error_msg')) {
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        // If login request submitted
        if ($this->input->post('loginSubmit')) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'password', 'required');

            if ($this->form_validation->run() == true) {
                $con = array(
                    'returnType' => 'single',
                    'conditions' => array(
                        'email' => $this->input->post('email'),
                        'password' => md5($this->input->post('password')),
                        'status' => 1
                    )
                );
                $checkLogin = $this->user->getRows($con);
                if ($checkLogin) {
                    $this->session->set_userdata('isUserLoggedIn', TRUE);
                    $this->session->set_userdata('userId', $checkLogin['id']);
                    redirect('users/account/');

                } else {
                    $data['error_msg'] = 'Wrong email or password, please try again.';
                }
            } else {
                $data['error_msg'] = 'Please fill all the mandatory fields.';
            }
        }

        $render_template = array(
            array(
                'label' => 'login.php',
                'param' => $data
            )
        );
        $this->template($render_template);

    }

    public function registration()
    {
        $data = $userData = array();

        // If registration request is submitted
        if ($this->input->post('signupSubmit')) {
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('password', 'password', 'required');
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');

            $userData = array(
                'first_name' => strip_tags($this->input->post('first_name')),
                'last_name' => strip_tags($this->input->post('last_name')),
                'email' => strip_tags($this->input->post('email')),
                'password' => md5($this->input->post('password')),
            );

            if ($this->form_validation->run() == true) {
                $insert = $this->user->insert($userData);
                if ($insert) {
                    $this->session->set_userdata('success_msg', 'Your account registration has been successful. Please login to your account.');
                    redirect('users/login');
                } else {
                    $data['error_msg'] = 'Some problems occured, please try again.';
                }
            } else {
                $data['error_msg'] = 'Please fill all the mandatory fields.';
            }
        }

        // Posted data
        $data['user'] = $userData;

        $render_template = array(
            array(
                'label' => 'registration.php',
                'param' => $data
            )
        );
        $this->template($render_template);
    }

    public function logout()
    {
        $this->session->unset_userdata('isUserLoggedIn');
        $this->session->unset_userdata('userId');
        $this->session->sess_destroy();
        redirect('users/login/');
    }


    // Existing email check during validation
    public function email_check($str)
    {
        $con = array(
            'returnType' => 'count',
            'conditions' => array(
                'email' => $str
            )
        );
        $checkEmail = $this->user->getRows($con);
        if ($checkEmail > 0) {
            $this->form_validation->set_message('email_check', 'The given email already exists.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function template($page)
    {
        if ($this->isUserLoggedIn && ($page[0]['label'] == 'registration.php' || $page[0]['label'] == 'login.php')) {
            $page = show_404();
        }
        $data['users'] = $page[0]['param'];
        $this->load->view('template/header');
        $this->load->view('users/' . $page[0]['label'], $data['users']);
        $this->load->view('template/footer');

        return $page;
    }

}