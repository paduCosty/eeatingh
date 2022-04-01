<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function index()
	{

		$userData = isset($_POST) ? $_POST : '';
		$this->load->model('modelUser');


		if (!empty($userData['name'])) {
			redirect('user/add_user/');
		}

		$id = '';
		if (!empty($userData['confirmButton'])) {
			$id = $userData['confirmButton'];
			redirect('user/delete_user/' . $id);
		}

		if (!empty($userData['edit'])) {
			$id = $userData['edit'];
		}

		$data = array(
			'users' => $this->modelUser->get_all_users(),
			'id' => $id,
		);

		$this->load->view('users_view', $data);
	}

	public function add_user()
	{
		print_r($_POST);
		$this->load->model('modelUser');
//		$this->modelUser->crate_user($userData);
//		redirect('user/');
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
