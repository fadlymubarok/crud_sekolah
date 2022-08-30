<?php

class Jurusan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation', 'session');
        $this->load->helper('url', 'form');

        $this->load->model('jurusan_model');
        $this->load->model('Auth_model');
        $this->Auth_model->cek_login();
    }

    public function index()
    {
        $data['title'] = 'Jurusan';
        $data['jurusan'] = $this->jurusan_model->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('jurusan/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'tambah';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('jurusan/create');
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $data['title'] = 'tambah';
        $this->form_validation->set_rules(
            'nama_jurusan',
            'nama_jurusan',
            'required|is_unique[jurusan.nama_jurusan]'
        );

        if ($this->form_validation->run()) {
            $data = array(
                'nama_jurusan' => $this->input->post('nama_jurusan')
            );
            var_dump('masuk');
            $this->Jurusan_Model->store($data);
            $this->session->set_flashdata('success', 'Data berhasil ditambah!');
            return redirect(base_url('jurusan'));
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('jurusan/create');
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        if ($id == null || $id == 0) {
            return redirect(base_url('jurusan'));
        }

        $data['title'] = 'edit';
        $data['jurusan'] = $this->Jurusan_Model->getById($id);
        if ($data['jurusan'] == null) {
            return redirect(base_url('jurusan'));
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('jurusan/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id = $this->uri->segment(3);
        if ($id == null || $id == 0) {
            return redirect(base_url('jurusan'));
        }

        $this->form_validation->set_rules(
            'nama_jurusan',
            'nama_jurusan',
            'required'
        );

        $old_data['jurusan'] = $this->Jurusan_Model->getById($id);
        if ($old_data == null) {
            return redirect(base_url('jurusan'));
        }

        $new_data = array(
            'nama_jurusan' => $this->input->post('nama_jurusan')
        );


        if ($old_data['jurusan']->nama_jurusan != $new_data['nama_jurusan']) {
            $this->form_validation->set_rules(
                'nama_jurusan',
                'nama_jurusan',
                'required|is_unique[jurusan.nama_jurusan]'
            );
        }

        if ($this->form_validation->run()) {
            $this->Jurusan_Model->update($id, $new_data);
            $this->session->set_flashdata('update', 'Data berhasil diupdate!');
            return redirect(base_url('jurusan'));
        }

        $old_data['title'] = 'edit';
        $this->load->view('templates/header', $old_data);
        $this->load->view('templates/sidebar');
        $this->load->view('jurusan/edit', $old_data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        $this->Jurusan_Model->delete($id);
        echo json_encode(array(
            "statusCode" => 200,
            "message" => "Data berhasil dihapus!"
        ));
    }
}
