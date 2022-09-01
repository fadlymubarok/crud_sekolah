<?php

class Siswa_model extends CI_Model
{
    public function getAll()
    {
        $this->db->select(array('siswa.id', 'siswa.nama_siswa', 'kelas.nama_kelas', 'jurusan.nama_jurusan', 'guru.nama_guru'));
        $this->db->join('kelas', 'siswa.kelas_id = kelas.id');
        $this->db->join('guru', 'kelas.guru_id = guru.id');
        $this->db->join('jurusan', 'kelas.jurusan_id = jurusan.id');
        $this->db->where('kelas.guru_id', $this->session->userdata('id'));
        $result = $this->db->get('siswa');
        return $result;
    }
    public function store($data)
    {
        $query = $this->db->query(
            'SELECT kelas.id
            FROM `guru` 
            INNER JOIN kelas on kelas.guru_id = guru.id
            where guru.id = ' . $this->session->userdata('id')
        );
        $query = $query->row();

        $data += array(
            'kelas_id' => $query->id
        );
        return $this->db->insert('siswa', $data);
    }

    public function getById($id)
    {
        $this->db->where(array('id' => $id));
        $data = $this->db->get('siswa')->row();

        if ($data == null) {
            return null;
        }

        return $data;
    }

    public function update($id, $new_data)
    {
        $this->db->where('id', $id);
        return $this->db->update('siswa', $new_data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('siswa');
    }

    public function getAllKelas()
    {
        return $this->db->get('kelas');
    }
}
