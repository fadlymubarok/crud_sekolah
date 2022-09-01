<?php

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Guru_model');
        $this->load->model('Auth_model');
        $this->Auth_model->cek_login();

        if (!$this->session->userdata('is_admin')) {
            show_404();
        }
    }

    public function index()
    {
        $data['title'] = 'guru';
        $data['guru'] = $this->Guru_model->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('guru/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'tambah';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('guru/create');
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules(array(
            array(
                'field' => 'nama_depan',
                'label' => 'nama_depan',
                'rules' => 'required'
            ),
            array(
                'field' => 'nama_belakang',
                'label' => 'nama_belakang',
                'rules' => 'required'
            ),
            array(
                'field' => 'tanggal_lahir_guru',
                'label' => 'tanggal_lahir_guru',
                'rules' => 'required'
            ),
            array(
                'field' => 'alamat_guru',
                'label' => 'alamat_guru',
                'rules' => 'required'
            )
        ));

        if ($this->form_validation->run()) {
            $data = array(
                'nama_guru' => $this->input->post('nama_depan') . " " . $this->input->post('nama_belakang'),
                'tanggal_lahir_guru' => $this->input->post('tanggal_lahir_guru'),
                'alamat_guru' => $this->input->post('alamat_guru'),
                'status_aktif' => 1,
                'status_wali_kelas' => 0
            );

            $this->Guru_model->store($data);
            $this->session->set_flashdata('success', 'Data guru berhasil ditambah');
            return redirect(base_url('guru'));
        }

        $data['title'] = 'tambah';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('guru/create');
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        if ($id == null || $id <= 0) {
            return redirect(base_url('guru'));
        }

        $get_data['guru'] = $this->Guru_model->getById($id);

        if ($get_data == null || $get_data <= 0) {
            return redirect(base_url('guru'));
        }

        $get_data['title'] = 'edit';
        $this->load->view('templates/header', $get_data);
        $this->load->view('templates/sidebar');
        $this->load->view('guru/edit', $get_data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id = $this->uri->segment(3);
        if ($id == null || $id <= 0) {
            return redirect(base_url('guru'));
        }

        $this->form_validation->set_rules(array(
            array(
                'field' => 'nama_guru',
                'label' => 'nama_guru',
                'rules' => 'required',
            ),
            array(
                'field' => 'alamat_guru',
                'label' => 'alamat_guru',
                'rules' => 'required'
            )
        ));

        if ($this->form_validation->run()) {
            $new_data = array(
                'nama_guru' => $this->input->post('nama_guru'),
                'tanggal_lahir_guru' => $this->input->post('tanggal_lahir_guru'),
                'alamat_guru' => $this->input->post('alamat_guru')
            );

            $result = $this->Guru_model->update($id, $new_data);
            if ($result == null) {
                $this->session->set_flashdata('error', 'Data Gagal diupdate!');
                return redirect(base_url('guru'));
            }
            $this->session->set_flashdata('update', 'Data berhasil diupdate!');
            return redirect(base_url('guru'));
        }

        $get_data['title'] = 'edit';
        $get_data['guru'] = $this->Guru_model->getById($id);
        $this->load->view('templates/header', $get_data);
        $this->load->view('templates/sidebar');
        $this->load->view('guru/edit', $get_data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        if ($id == null) {
            $this->session->set_flashdata('error', 'Data tidak ada');
            echo json_encode(array(
                "status" => 404,
            ));
        }
        $result = $this->Guru_model->delete($id);
        echo json_encode(array(
            'status' => 200,
            'message' => 'Data berhasil dihapus!'
        ));
    }
}
