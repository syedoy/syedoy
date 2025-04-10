<?php

defined('BASEPATH') or exit('no direct script access allowed');

class Produk extends CI_Controller
{

    public function index()
    {

        $produk = $this->db->get('produk')->result();
        $data = [
            'produk' => $produk,

        ];

        $this->load->view('template/header');
        $this->load->view('produk/produk', $data);
        $this->load->view('template/footer');
    }

    public function prosescreate()
    {
        $this->form_validation->set_rules('NamaProduk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('Harga', 'Harga Produk', 'Required');
        $this->form_validation->set_rules('Stok', 'Nama Produk', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $data = [
                'NamaProduk' => $this->input->post('NamaProduk'),
                'Harga' => $this->input->post('Harga'),
                'Stok' => $this->input->post('Stok'),
            ];

            if ($this->db->insert('Produk', $data)) {
                $this->session->set_flashdata('success', 'berhasil menambahkan data produk');
                redirect('Produk');
            } else {
                $this->session->set_flashdata('error', 'gagal menambahakan data produk');
                redirect('produk/create');
            }
        }
    }

    public function ProsesEdit($id)
    {
        $this->form_validation->set_rules('NamaProduk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('Harga', 'Harga', 'Required');
        $this->form_validation->set_rules('Stok', 'Stok', 'required|numeric');
        $id = $this->input->post('id');

        if ($this->form_validation->run() == FALSE) {
            $this->edit();
        } else {
            $data = [
                'NamaProduk' => $this->input->post('NamaProduk'),
                'Harga' => $this->input->post('Harga'),
                'Stok' => $this->input->post('Stok'),

            ];
            $this->db->where('produkID', $id);
            $update = $this->db->update('produk', $data);
            if ($update) {
                $this->session->set_flashdata('success', 'berhasil mengubah data produk');
                redirect('produk');
            } else {
                $this->session->set_flashdata('error', 'gagal mengubah data produk');
                redirect('produk/edit/' . $id);
            }
        }
    }

    public function Hapus($id)
    {
        $this->db->where('produkID', $id);
       $delete = $this->db->delete('produk');

        if ($delete) {
            $this->session->set_flashdata('success', 'berhasil menghapus data produk');
            redirect('produk');
        } else {
            $this->session->set_flashdata('error', 'gagal menghapus data produk');
            redirect('produk');
        }
    }
}
