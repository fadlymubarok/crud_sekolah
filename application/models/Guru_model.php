<?php

class Guru_model extends CI_Model
{
    public function getAll()
    {
        $this->db->select('*')
            ->join('user', 'user.guru_id = guru.id')
            ->where('user.is_admin', '0');
        $data = $this->db->get('guru');
        return $data;
    }

    public function store($data)
    {
        $this->db->insert('guru', $data);

        $result = $this->db->select('*')
            ->from('guru')
            ->order_by('id', 'desc')
            ->limit(1)
            ->get()
            ->result();


        $data_user = array(
            'username' => str_replace(" ", ".", strtolower($result[0]->nama_guru)),
            'password' => password_hash('12345678', PASSWORD_DEFAULT),
            'guru_id' => $result[0]->id,
            'is_admin' => 0
        );

        return $this->db->insert('user', $data_user);
    }

    public function getById($id = null)
    {
        $data = $this->db->get_where('guru', array('id' => $id))->row();

        if ($data == null) {
            return null;
        }
        return $data;
    }

    public function update($id, $new_data)
    {
        $old_data = $this->getById($id);

        if ($old_data == null) {
            return null;
        }

        $tgl_lahir = $new_data['tanggal_lahir_guru'];
        if ($tgl_lahir == null) {
            $tgl_lahir = $old_data->tanggal_lahir_guru;
        }

        $new_data['tanggal_lahir_guru'] = $tgl_lahir;

        $this->db->where('id', $id);
        return $this->db->update('guru', $new_data);
    }

    public function delete($id)
    {
        $result = $this->getById($id);
        $this->db->where('guru_id', $result->id);
        $this->db->delete('user');

        $this->db->where('id', $id);
        $this->db->delete('guru');

        return true;
    }
}
