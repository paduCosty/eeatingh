<?php

class User extends CI_Controller
{
    public function template($page)
    {
        $data['users'] = $page[0]['param'];
        $this->load->view('template/header');
        $this->load->view('user/' . $page[0]['label'], $data['users']);
        $this->load->view('template/footer');

        return $page;
    }

    public function add_user()
    {
        $userData = isset($_POST) ? $_POST : '';
        $this->load->model('modelUser');
        $render_template = array(
            array(
                'label' => 'add_user.php',
                'param' => null
            )
        );
        $this->template($render_template);

        if (empty($userData['name'])) {
            return false;
        }
        $this->modelUser->crate_user($userData);

    }

    public function users_list()
    {
        $this->load->model('modelUser');
        $data = array(
            'users' => $this->modelUser->get_all_users(),
        );

        $render_template = array(
            array(
                'label' => 'users_list.php',
                'param' => $data
            )
        );


        $this->userData = $_POST;
        if (!empty($this->userData['edit'])) {
            $this->id = $this->userData['edit'];
            redirect('user/edit_user/' . $this->id);
        }

        if (!empty($this->userData['confirmButton'])) {
            $this->id = $this->userData['confirmButton'];
            redirect('user/delete_user/' . $this->id);
        }

        $this->template($render_template);
    }

    public function edit_user($id)
    {
        $this->load->model('modelUser');
        $user = $this->modelUser->get_user_by_id($id);
        $render_template = array(
            array(
                'label' => 'edit_user.php',
                'param' => $user
            )
        );

        $this->userData = isset($_POST) ? $_POST : '';
        if (!empty($this->userData['confirmEdit'])) {
            $row = array(
                'id' => $this->userData['confirmEdit'],
                'name' => $this->userData['name'],
                'text' => $this->userData['text']
            );
            if (!empty($this->userData['name'])) {
                $this->modelUser->update_user($row);
            }
            redirect('user/users_list');

            return true;
        }
        if (!empty($this->userData['cancelEdit'])) {
            redirect('user/users_list');
        }

        $this->template($render_template);
    }

    public function delete_user($id)
    {
        $this->load->model('modelUser');
        $this->modelUser->delete_user($id);
        redirect('user/users_list');

        return true;
    }

}