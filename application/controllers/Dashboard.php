<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Auth_model', 'Siswa_model', 'Kelas_model', 'Guru_model', 'Jurusan_model'));
        $this->Auth_model->cek_login();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['siswa'] = count($this->Siswa_model->getAll()->result());
        $data['kelas'] = count($this->Kelas_model->getAll()->result());
        $data['guru'] = count($this->Guru_model->getAll()->result());
        $data['jurusan'] = count($this->Jurusan_model->getAll()->result());
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard');
        $this->load->view('templates/footer');
    }
}
