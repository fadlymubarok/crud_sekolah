<?php

class Jurusan_model extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('jurusan');
    }

    public function store($data)
    {
        return $this->db->insert('jurusan', $data);
    }

    public function getById($id)
    {
        $data = $this->db->get_where('jurusan', array('id' => $id))->row();
        if ($data == null) {
            return null;
        }
        return $data;
    }

    public function update($id, $new_data)
    {
        $this->db->where('id', $id);
        $this->db->update('jurusan', array('nama_jurusan' => $new_data['nama_jurusan']));
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('jurusan');
    }
}
