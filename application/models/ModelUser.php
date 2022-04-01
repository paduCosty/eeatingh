<?php

class ModelUser extends CI_Model
{
	public function crate_user($data)
	{
		print_r($data);
		if (isset($data['name'])) {

			$userData = array(
				'name' => isset($data['name']) ? $data['name'] : '',
				'text' => isset($data['text']) ? $data['text'] : ''
			);
			$this->db->insert('user2', $userData);

			return true;
		}
		return false;
	}

	public function get_all_users()
	{
		$query = $this->db->get('user2');

		return $query;
	}

	public function delete_user($userId)
	{
		$this->db->where('id', $userId);
		$q = $this->db->get('user2');

		if (empty($q->result_array())) {
			return false;
		}
		$data = $q->result_array();
		$id = $data[0]['id'];

		if ($userId == $id) {
			$this->db->where("id", $id);
			$this->db->delete("user2");
		}
		return true;
	}

	public function update_user($userId)
	{
		$this->db->where('id', $userId['edit']);
		$q = $this->db->get('db_app');

		if (empty($q->result_array())) {
			return false;
		}
		$data = $q->result_array();
		$id = $data[0]['id'];

		if ($userId['edit'] == $id) {
			$this->db->where("id", $id);
		}
		return true;

	}
}
