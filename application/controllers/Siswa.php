<?php

class Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model');
        $this->load->model('Auth_model');
        $this->Auth_model->cek_login();

        if ($this->session->userdata('is_admin')) {
            show_404();
        }
    }

    public function index()
    {
        $data['title'] = 'siswa';
        $data['siswa'] = $this->Siswa_model->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('siswa/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'tambah';
        $data['kelas'] = $this->Siswa_model->getAllKelas();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('siswa/create', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $this->form_validation->set_rules(array(
            array(
                'field' => 'nama_siswa',
                'label' => 'nama_siswa',
                'rules' => 'required'
            ),
            array(
                'field' => 'tgl_lahir_siswa',
                'label' => 'tgl_lahir_siswa',
                'rules' => 'required'
            ),
            array(
                'field' => 'alamat_siswa',
                'label' => 'alamat_siswa',
                'rules' => 'required'
            )
        ));

        if ($this->form_validation->run()) {
            $data = array(
                'nama_siswa' => $this->input->post('nama_siswa'),
                'tgl_lahir_siswa' => Date($this->input->post('tgl_lahir_siswa')),
                'alamat_siswa' => $this->input->post('alamat_siswa')
            );

            $result = $this->Siswa_model->store($data);
            $this->session->set_flashdata('success', 'Data siswa berhasil ditambahkan!');
            return redirect(base_url('siswa'));
        }

        $data['title'] = 'tambah';
        $data['kelas'] = $this->Siswa_model->getAllKelas();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('siswa/create', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        if ($id == null) {
            $this->session->set_flashdata('error', 'Data tidak ada!');
            return redirect(base_url('siswa'));
        }

        $data['title'] = 'edit';
        $data['siswa'] = $this->Siswa_model->getById($id);
        $data['kelas'] = $this->Siswa_model->getAllKelas();

        if ($data['siswa'] == null) {
            $this->session->set_flashdata('error', 'Data tidak ada!');
            return redirect(base_url('siswa'));
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('siswa/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $id = $this->uri->segment(3);
        if ($id == null) {
            $this->session->set_flashdata('error', 'Data tidak ada!');
            return redirect(base_url('siswa'));
        }

        $this->form_validation->set_rules(array(
            array(
                'field' => 'nama_siswa',
                'label' => 'nama_siswa',
                'rules' => 'required'
            ),
            array(
                'field' => 'alamat_siswa',
                'label' => 'alamat_siswa',
                'rules' => 'required'
            )
        ));

        if ($this->form_validation->run()) {
            $old_data = $this->Siswa_model->getById($id);
            if ($old_data == null) {
                $this->session->set_flashdata('error', 'Data gagal diupdate!');
                return redirect(base_url('siswa'));
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
                'alamat_siswa' => $this->input->post('alamat_siswa')
            );

            $this->Siswa_model->update($id, $new_data);

            $this->session->set_flashdata('update', 'Data berhasil diupdate!');
            return redirect(base_url('siswa'));
        }

        $data['title'] = 'edit';
        $data['siswa'] = $this->Siswa_model->getById($id);
        $data['kelas'] = $this->Siswa_model->getAllKelas();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('siswa/edit', $data);
        $this->load->view('templates/footer');
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        $this->Siswa_model->delete($id);
        echo json_encode(array(
            'status' => 200,
            'message' => 'Data berhasil dihapus!'
        ));
    }

    public function download()
    {
        $pdf = new TCPDF();
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->setAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('');
        $pdf->Write(0, 'Data siswa', '', 0, 'L', true, 0, false, false, 0);
        $pdf->setFont('');

        $data['siswa'] = $this->Siswa_model->getAll()->result();
        $table = <<<EOD
                    <table border="1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas Siswa</th>
                            <th>Wali kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                    EOD;
        $no = 0;
        foreach ($data['siswa'] as $row) {
            $no += 1;
            $table .= <<<EOD
            <tr>
                <td>$no</td>
                <td>$row->nama_siswa</td>
                <td>$row->nama_kelas</td>
                <td>$row->nama_guru</td>
            </tr>
        EOD;
        }
        $table .= <<<EOD
        </table>
        EOD;

        $pdf->writeHTML($table);
        $pdf->Output('Data siswa.pdf', 'D');
    }
}
