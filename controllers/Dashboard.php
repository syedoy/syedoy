<?php

defined('BASEPATH') or exit('no direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $penjualan = $this->db->count_all('penjualan');
        $pelanggan = $this->db->count_all('pelanggan');
        $produk = $this->db->count_all('produk');

        $this->db->select_sum('Totalharga');
        $this->db->from('penjualan');
        $pendapatan = $this->db->get()->row();
        $data = [
            'penjualan' => $penjualan,
            'pendapatan' => $pendapatan,
            'pelanggan' => $pelanggan,
            'produk' => $produk,
        ];
        $this->load->view('template/header');
        $this->load->view('Dashboard', $data);
        $this->load->view('template/footer');
    }
}
