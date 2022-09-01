<?php

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_admin')) {
            show_404();
        }
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'session'));

        $this->load->model('Kelas_model');
        $this->load->model('Auth_model');

        $this->Auth_model->cek_login();
    }

    public function index()
    {
        $data['title'] = 'kelas';
        $data['kelas'] = $this->Kelas_model->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kelas/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'tambah';
        $data['jurusan'] = $this->Kelas_model->getAllJurusan();
        $data['guru'] = $this->Kelas_model->getAllGuru();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kelas/create', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $data['title'] = 'tambah';
        $data['jurusan'] = $this->Kelas_model->getAllJurusan();
        $data['guru'] = $this->Kelas_model->getAllGuru();
        $data['kelas'] = $this->Kelas_model->getAll()->result_array();

        $this->form_validation->set_rules('jurusan_id', 'jurusan_id', 'required');
        $this->form_validation->set_rules('nama_kelas', 'nama_kelas', 'required');
        $this->form_validation->set_rules('guru_id', 'guru_id', 'required');

        $new_data = array(
            'nama_kelas' => strtoupper($this->input->post('nama_kelas')),
            'jurusan_id' => $this->input->post('jurusan_id'),
            'guru_id' => $this->input->post('guru_id'),
        );

        if (count($data['kelas']) > 0) {
            foreach ($data['kelas'] as $row) {
                if ($row['jurusan_id'] == $new_data['jurusan_id']) {
                    $hitung_kelas = count(array($row['nama_kelas'] == $new_data['nama_kelas']));
                    $hitung_kelas += $hitung_kelas;

                    if ($hitung_kelas > 0) {
                        $this->form_validation->set_rules('nama_kelas', 'nama_kelas', 'required|is_unique[kelas.nama_kelas]');
                    }
                }
            }
        }

        if ($this->form_validation->run()) {

            $this->Kelas_model->store($new_data);
            $this->session->set_flashdata('success', 'Data berhasil ditambah!');
            return redirect(base_url('kelas'));
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kelas/create', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        if ($id == 0 || $id == null) {
            return redirect(base_url('kelas'));
        }
        $data['title'] = 'edit';
        $data['kelas'] = $this->Kelas_model->getById($id);
        $data['jurusan'] = $this->Kelas_model->getAllJurusan();
        $data['guru'] = $this->Kelas_model->getAllGuru($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kelas/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id = $this->uri->segment(3);
        if ($id <= 0 || $id == null) {
            $this->session->set_flashdata('error', 'Data tidak ada!');
            return redirect(base_url('kelas'));
        }

        $this->form_validation->set_rules('nama_kelas', 'nama_kelas', 'required');
        $this->form_validation->set_rules('jurusan_id', 'jurusan_id', 'required');
        $this->form_validation->set_rules('guru_id', 'guru_id', 'required');

        $new_data = array(
            'nama_kelas' => $this->input->post('nama_kelas'),
            'jurusan_id' => $this->input->post('jurusan_id'),
            'guru_id' => $this->input->post('guru_id')
        );

        $old_data['title'] = 'edit';
        $old_data['jurusan'] = $this->Kelas_model->getAllJurusan();
        $old_data['guru'] = $this->Kelas_model->getAllGuru($id);
        $old_data['kelas'] = $this->Kelas_model->getById($id);
        $idJurusan = $this->Kelas_model->getByIdJurusan($new_data['jurusan_id']);

        if ($old_data['kelas'] == null || $idJurusan == null) {
            $this->session->set_flashdata('error', 'Jurusan tersebut belum memiliki kelas');
            return redirect(base_url('kelas'));
        }

        // lanjut update
        if ($new_data['nama_kelas'] != $old_data['kelas']->nama_kelas || $new_data['jurusan_id'] != $old_data['kelas']->jurusan_id) {
            foreach ($idJurusan as $row) {
                if (($row->nama_kelas == $new_data['nama_kelas'])) {
                    $hitung_kelas = count(array($row->nama_kelas == $new_data['nama_kelas']));
                    $hitung_kelas += $hitung_kelas;

                    if ($hitung_kelas > 0) {
                        $this->form_validation->set_rules('nama_kelas', 'nama_kelas', 'required|is_unique[kelas.nama_kelas]');
                    }
                }
            }
        }

        if ($this->form_validation->run()) {
            $result = $this->Kelas_model->update($new_data, $id);
            $this->session->set_flashdata('update', 'Data berhasil diupdate');
            return redirect(base_url('kelas'));
        }
        $this->load->view('templates/header', $old_data);
        $this->load->view('templates/sidebar');
        $this->load->view('kelas/edit', $old_data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        $this->Kelas_model->delete($id);
        echo json_encode(array(
            "status" => 200,
            "message" => "Data berhasil dihapus!"
        ));
    }
}
