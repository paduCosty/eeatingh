<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public $id = '';
    public $userData;
    public function index()
    {
        $this->userData = isset($_POST) ? $_POST : '';
        $this->load->model('modelUser');

        if (!empty($this->userData['confirmButton'])) {
            $this->id = $this->userData['confirmButton'];
            redirect('user/delete_user/' . $this->id);
        }

        if (!empty($this->userData['edit'])) {
            $this->id = $this->userData['edit'];
        }

        $data = array(
            'users' => $this->modelUser->get_all_users(),
            'id' => $this->id,
        );
        $this->load->model('modelUser');

        if (!empty($this->userData['name'])) {
            $this->add_user($this->userData);

        }
        $this->load->view('users_view', $data);

    }

    public function add_user($userData)
    {
        $this->load->model('modelUser');
        $this->modelUser->crate_user($userData);
        redirect('user');
    }

    public function delete_user($id)
    {
        $this->load->model('modelUser');
        $this->modelUser->delete_user($id);
        redirect('user/');

        return true;
    }

    public function edit_user($id)
    {
        $this->load->view('edit_user');

        $this->modelUser->update_user($id);
        echo 'cartof' . $id;
    }

}
