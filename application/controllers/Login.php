<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        return $this->load->model('auth_model');
    }

    public function index()
    {
        if ($this->session->userdata('name') != null || $this->session->userdata('name') == true) {
            return redirect(base_url());
        }

        $this->load->view('login/login');
    }

    public function proses()
    {
        $this->form_validation->set_rules(array(
            array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required'
            )
        ));
        if ($this->form_validation->run()) {
            $input = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );

            $result = $this->Auth_model->user_login($input);
            if ($result == false) {
                $this->session->set_flashdata('error', 'username/password salah!');
                return redirect(base_url('login'));
            }
            $this->session->set_flashdata('success', 'Login berhasil!');
            return redirect(base_url());
        }

        $this->load->view('login/login');
    }

    public function logout()
    {
        $this->session->unset_userdata(array('username', 'name', 'is_login'));
        $this->session->set_flashdata('success', 'Anda berhasil logout');
        return redirect(base_url('login'));
    }
}
