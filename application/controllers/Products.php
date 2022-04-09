<?php

class Products extends CI_Controller
{
    public function template($page)
    {
        $data['users'] = $page[0]['param'];
        $this->load->view('template/header');
        $this->load->view('products/' . $page[0]['label'], $data['users']);
        $this->load->view('template/footer');

        return $page;
    }

    public function add_product()
    {
        $userData = isset($_POST) ? $_POST : '';
        $this->load->model('modelUser');
        $render_template = array(
            array(
                'label' => 'add_product.php',
                'param' => null
            )
        );
        $this->template($render_template);

        if (empty($userData['name'])) {
            return false;
        }
        $this->modelUser->crate_user($userData);

    }

    public function product_list()
    {
        $this->load->model('modelUser');
        $data = array(
            'users' => $this->modelUser->get_all_users(),
        );

        $render_template = array(
            array(
                'label' => 'product_list.php',
                'param' => $data
            )
        );


        $this->userData = $_POST;
        if (!empty($this->userData['edit'])) {
            $this->id = $this->userData['edit'];
            redirect('products/edit_product/' . $this->id);
        }

        if (!empty($this->userData['confirmButton'])) {
            $this->id = $this->userData['confirmButton'];
            redirect('products/delete_product/' . $this->id);
        }

        $this->template($render_template);
    }

    public function edit_product($id)
    {
        $this->load->model('modelUser');
        $user = $this->modelUser->get_user_by_id($id);
        $render_template = array(
            array(
                'label' => 'edit_product.php',
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
            redirect('products/product_list');

            return true;
        }
        if (!empty($this->userData['cancelEdit'])) {
            redirect('products/product_list');
        }

        $this->template($render_template);
    }

    public function delete_product($id)
    {
        $this->load->model('modelUser');
        $this->modelUser->delete_user($id);
        redirect('products/product_list');

        return true;
    }

}