<?php

class ModelUser extends CI_Model
{
    public $table = 'dbApp';

    public function crate_user($data)
    {
        if (isset($data['name'])) {

            $userData = array(
                'name' => isset($data['name']) ? $data['name'] : '',
                'text' => isset($data['text']) ? $data['text'] : ''
            );
            $this->db->insert($this->table, $userData);

            return true;
        }
        return false;
    }

    public function get_all_users()
    {
        $query = $this->db->get($this->table);
        return $query;
    }

    public function delete_user($userId)
    {
        $this->db->where('id', $userId);
        $q = $this->db->get($this->table);

        if (empty($q->result_array())) {
            return false;
        }
        $data = $q->result_array();
        $id = $data[0]['id'];

        if ($userId == $id) {
            $this->db->where("id", $id);
            $this->db->delete($this->table);
        }
        return true;
    }

    public function update_user($row)
    {
        $this->db->where('id', $row['id']);
        $this->db->update($this->table, $row);

        return true;
    }

    public function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        $user = $this->db->get($this->table);
        $userRow = null;
        foreach ($user->result() as $row) {
            $userRow = array(
                'id' => $row->id,
                'name' => $row->name,
                'text' => $row->text
            );
        }
        return $userRow;
    }

}
