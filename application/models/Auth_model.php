<?php

class Auth_model extends CI_Model
{
    public function user_login($input)
    {
        $this->db->select(array('user.username', 'user.password', 'user.guru_id', 'user.is_admin', 'guru.nama_guru', 'guru.status_wali_kelas'));
        $this->db->from('user');
        $this->db->join('guru', 'guru.id = user.guru_id');
        $this->db->where('user.username', $input['username']);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->row();
            if (password_verify($input['password'], $data->password)) {
                $this->session->set_userdata(array('id' => $data->guru_id));
                $this->session->set_userdata(array('username' => $input['username']));
                $this->session->set_userdata(array('name' => $data->nama_guru));
                $this->session->set_userdata(array('is_admin' => $data->is_admin));
                $this->session->set_userdata(array('status_wali_kelas' => $data->status_wali_kelas));
                $this->session->set_userdata(array('is_login' => true));

                return $this->session->userdata('is_login');
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function cek_login()
    {
        if (empty($this->session->userdata('is_login'))) {
            $this->session->set_flashdata('error', 'Anda Harus login!');
            return redirect(base_url('login'));
        }
    }
}
