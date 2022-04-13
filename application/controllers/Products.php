<?php

class Products extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn');

        $this->load->model('modelUser');
    }


    public function add_product()
    {

        if (!$this->isUserLoggedIn) {
            return show_404();
        }
        if ($this->input->post()) {
            // init user data.
            $userData = $_POST;
            // Create User entity.
            $this->modelUser->crate_user($userData);

        }

        $render_template = array(
            'header' => 'template/header.php',
            'body' => 'products/add_product.php',
            'footer' => 'template/footer.php'
        );

        $this->template($render_template);
    }

    public function product_list()
    {
        if (!$this->isUserLoggedIn) {
            return show_404();
        }

        $this->userData = $_POST;
        if (!empty($this->userData['edit'])) {
            $this->id = $this->userData['edit'];
            redirect('products/edit_product/' . $this->id);
        }

        if (!empty($this->userData['confirmButton'])) {
            $this->id = $this->userData['confirmButton'];
            redirect('products/delete_product/' . $this->id);
        }

        $render_template = array(
            'header' => 'template/header.php',
            'body' => 'products/product_list.php',
            'footer' => 'template/footer.php'
        );

        $params = array(
            'data' => $this->modelUser->get_all_users(),
        );

        $this->template($render_template, $params);
    }

    public function edit_product($id)
    {
        if (!$this->isUserLoggedIn) {
            return show_404();
        }

        $user = $this->modelUser->get_user_by_id($id);

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
        $render_template = array(
            'header' => 'template/header.php',
            'body' => 'products/edit_product.php',
            'footer' => 'template/footer.php'
        );

        $this->template($render_template, $user);
    }

    public function delete_product($id)
    {
        if (!$this->isUserLoggedIn) {
            return show_404();
        }

        $this->modelUser->delete_user($id);
        redirect('products/product_list');

        return true;
    }

    public function template($templates, $params = null)
    {
        $header = $this->load->view((isset($templates['header']) ? $templates['header'] : ''), $params, TRUE);
        $body = $this->load->view((isset($templates['body']) ? $templates['body'] : ''), $params, TRUE);
        $footer = $this->load->view((isset($templates['footer']) ? $templates['footer'] : ''), $params, TRUE);

        $page_data = array(
            'header' => $header,
            'body' => $body,
            'footer' => $footer
        );

        $this->load->view('pages/main/template.php', $page_data);
    }


}