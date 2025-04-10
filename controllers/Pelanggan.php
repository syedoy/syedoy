<?php

defined('BASEPATH') or exit('no direct script access allowed');

class Pelanggan extends CI_Controller
{

    public function index()
    {

        $pelanggan = $this->db->get('pelanggan')->result();
        $data = [
            'pelanggan' => $pelanggan,

        ];

        $this->load->view('template/header');
        $this->load->view('pelanggan/pelanggan', $data);
        $this->load->view('template/footer');
    }

    public function prosescreate()
    {
        $this->form_validation->set_rules('NamaPelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('Alamat', 'Alamat', 'Required');
        $this->form_validation->set_rules('NomorTelpon', 'Nomor Telpon', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'NamaPelanggan' => $this->input->post('NamaPelanggan'),
                'Alamat' => $this->input->post('Alamat'),
                'NomorTelpon' => $this->input->post('NomorTelpon'),
            ];

            if ($this->db->insert('Pelanggan', $data)) {
                $this->session->set_flashdata('success', 'berhasil menambahkan data pelanggan');
                redirect('Pelanggan');
            } else {
                $this->session->set_flashdata('error', 'gagal menambahakan data pelangan');
                redirect('pelanggan/create');
            }
        }
    }

    public function prosesedit($id)
    {
        $this->form_validation->set_rules('NamaPelanggan', 'Nama Pelanggan', 'required');
        $this->form_validation->set_rules('Alamat', 'Alamat', 'Required');
        $this->form_validation->set_rules('NomorTelpon', 'Nomor Telpon', 'required|numeric');
        $id = $this->input->post('id');

        if ($this->form_validation->run() == FALSE) {
            $this->edit();
        } else {
            $data = [
                'NamaPelanggan' => $this->input->post('NamaPelanggan'),
                'Alamat' => $this->input->post('Alamat'),
                'NomorTelpon' => $this->input->post('NomorTelpon'),

            ];
            $this->db->where('pelangganID', $id);
            $update = $this->db->update('pelanggan', $data);
            if ($update) {
                $this->session->set_flashdata('success', 'berhasil mengubah data pelanggan');
                redirect('pelanggan');
            } else {
                $this->session->set_flashdata('error', 'gagal mengubah data pelanggan');
                redirect('pelanggan/edit/' . $id);
            }
        }
    }

    public function Hapus($id)
    {
        $this->db->where('pelangganID', $id);
        $delete = $this->db->delete('pelanggan');

        if ($delete) {
            $this->session->set_flashdata('success', 'berhasil menghapus data pelanggan');
            redirect('pelanggan');
        } else {
            $this->session->set_flashdata('error', 'gagal menghapus data pelanggan');
            redirect('pelanggan');
        }
    }
}
