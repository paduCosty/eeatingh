<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public $id = '';
    public $userData;

    public function index()
    {
        $this->load->view('template/navbar');
        $this->userData = isset($_POST) ? $_POST : '';
        $this->load->model('modelUser');

        $data = array(
            'users' => $this->modelUser->get_all_users(),
            'id' => $this->id,
        );
        $this->load->model('modelUser');

        if (!empty($this->userData['name'])) {
            $this->add_user($this->userData);
        }

        if (!empty($this->userData['confirmButton'])) {
            $this->id = $this->userData['confirmButton'];
            redirect('user/delete_user/' . $this->id);
        }

        if (!empty($this->userData['edit'])) {
            $this->id = $this->userData['edit'];
            redirect('user/edit_user/' . $this->id);
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
        $this->load->view('template/navbar');
        $this->load->model('modelUser');
        $user = $this->modelUser->get_user_by_id($id);
        $this->load->view('edit_user', $user);
        $this->userData = isset($_POST) ? $_POST : '';
        if (!empty($this->userData['confirmEdit'])) {
            $row = array(
                'id' => $this->userData['confirmEdit'],
                'name' => $this->userData['name'],
                'text' => $this->userData['text']
            );
            $this->modelUser->update_user($row);

            if (!empty($this->userData['name'])) {
                redirect('user/');
            }

            return true;
        }
        if (!empty($this->userData['cancelEdit'])) {
            redirect('user');
        }
    }

}
