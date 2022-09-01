<?php

class Kelas_model extends CI_Model
{
    public function getAll()
    {
        $this->db->select(array('kelas.*', 'jurusan.nama_jurusan', 'guru.nama_guru'));
        $this->db->from('kelas');
        $this->db->join('jurusan', 'jurusan.id = kelas.jurusan_id');
        $this->db->join('guru', 'guru.id = kelas.guru_id');
        $data = $this->db->get();
        return $data;
    }

    public function store($new_data)
    {
        $this->db->insert('kelas', $new_data);

        $this->db->where(array('id' => $new_data['guru_id']));
        $this->db->update('guru', array('status_wali_kelas' => 1));
    }

    public function getById($id)
    {
        $data = array(
            'id' => $id
        );
        return $this->db->get_where('kelas', $data)->row();
    }

    public function update($new_data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('kelas', $new_data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kelas');
    }

    public function getAllJurusan()
    {
        return $this->db->get('jurusan');
    }

    public function getAllGuru($id = null)
    {
        $this->db->select(array('guru.id', 'guru.nama_guru'))
            ->join('user', 'user.guru_id = guru.id')
            ->where('user.is_admin', '0');

        if ($id == null) {
            $this->db->where('status_wali_kelas', '0');
        }
        $data = $this->db->get('guru');
        return $data;
    }

    public function getByIdJurusan($id)
    {
        $this->db->select(array('kelas.nama_kelas', 'kelas.jurusan_id', 'jurusan.nama_jurusan'));
        $this->db->from('kelas');
        $this->db->join('jurusan', 'jurusan.id = kelas.jurusan_id');
        $this->db->where('kelas.jurusan_id', $id);
        return $this->db->get()->result();
    }
}
