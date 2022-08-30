<?php

class Siswa_model extends CI_Model
{
    public function getAll()
    {
        $this->db->select(array('siswa.*', 'kelas.nama_kelas', 'guru.nama_guru'));
        $this->db->join('kelas', 'siswa.kelas_id = kelas.id');
        $this->db->join('guru', 'kelas.guru_id = guru.id');
        $result = $this->db->get('siswa');
        return $result;
    }
    public function store()
    {
        $data = array(
            'nama_siswa' => $this->input->post('nama_siswa'),
            'tgl_lahir_siswa' => Date($this->input->post('tgl_lahir_siswa')),
            'alamat_siswa' => $this->input->post('alamat_siswa'),
            'kelas_id' => $this->input->post('kelas_id')

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

    public function update($id)
    {
        $old_data = $this->getById($id);
        if ($old_data == null) {
            return null;
        }

        $tgl_lahir = '';
        if ($this->input->post('tgl_lahir_siswa') == '' || $this->input->post('tgl_lahir_siswa') == null) {
            $tgl_lahir = $old_data->tgl_lahir_siswa;
        } else {
            $tgl_lahir = Date($this->input->post('tgl_lahir_siswa'));
        }

        $new_data = array(
            'nama_siswa' => $this->input->post('nama_siswa'),
            'tgl_lahir_siswa' => $tgl_lahir,
            'alamat_siswa' => $this->input->post('alamat_siswa'),
            'kelas_id' => $this->input->post('kelas_id')
        );

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
