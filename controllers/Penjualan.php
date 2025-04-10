<?php

defined('BASEPATH') or exit('no direct script access allowed');

class Penjualan extends CI_Controller
{

    public function index()
    {

        $this->db->select('penjualan.*, pelanggan.*');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'pelanggan.PelangganID = penjualan.PelangganID', 'left');
        $penjualan = $this->db->get()->result();
        $pelanggan = $this->db->get('pelanggan')->result();
        $data = [
            'penjualan' => $penjualan,
            'pelanggan' => $pelanggan

        ];

        $this->load->view('template/header');
        $this->load->view('penjualan/penjualan', $data);
        $this->load->view('template/footer');
    }

    public function prosespenjualan($id)
    {
        $this->db->where('pelangganID', $id);
        $pelanggan = $this->db->get('pelanggan')->row();

        $tanggal = date('y-m-d');
        if ($pelanggan) {
            $data = [
                'TanggalPenjualan' => $tanggal,
                'PelangganID' => $pelanggan->pelangganID,
                'TotalHarga' => 0
            ];

            $this->db->insert('penjualan', $data);
            $penjualanID = $this->db->insert_id();
            if ($penjualanID) {
                redirect('penjualan/detail/' . $penjualanID);
            } else {
                redirect('penjualan');
            }
        } else {

            $this->session->set_flashdata('error', 'gagal memasukkan penjualan');
            redirect('penjualan');
        }
    }

    public function Hapuspenjualan($id)
    {
        $this->db->where('penjualanID', $id);
        $delete = $this->db->delete('penjualan');
        if ($delete) {
            $this->session->set_flashdata('success', 'data penjualan dihapus');
            redirect('penjualan');
        } else {
            $this->session->set_flashdata('error', 'data penjualan tidak dapat dihapus');
            redirect('penjualan');
        }
    }

    public function Detail($id)
    {
        $this->db->select('penjualan.*, pelanggan.*');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'pelanggan.PelangganID = penjualan.PelangganID', 'left');
        $this->db->where('PenjualanID', $id);
        $penjualan = $this->db->get()->row();


        $this->db->select('detailpenjualan.*, produk.*');
        $this->db->from('detailpenjualan');
        $this->db->join('produk', 'produk.ProdukID = detailpenjualan.ProdukID', 'left');
        $this->db->where('PenjualanID', $id);
        $detail = $this->db->get()->result();

        $this->db->select_sum("Subtotal");
        $this->db->where('PenjualanID', $id);
        $TotalHarga = $this->db->get('detailpenjualan')->row();


        $produk = $this->db->get('produk')->result();
        $data = [
            'produk' => $produk,
            'penjualan' => $penjualan,
            'detail' => $detail,
            'TotalHarga' => $TotalHarga,
        ];
        $this->load->view('Template/Header');
        $this->load->view('Penjualan/Detail', $data);
        $this->load->view('Template/Footer');
    }

    public function AddDetail()
    {
        $ProdukID = $this->input->post('ProdukID');
        $JumlahProduk = $this->input->post('JumlahProduct');
        $PenjualanID = $this->input->post('PenjualanID'); // Perbaikan di sini
        $this->form_validation->set_rules('ProdukID', 'Produk ID', 'required');
        $this->form_validation->set_rules('JumlahProduct', 'Jumlah Produk', 'required');
        $this->form_validation->set_rules('PenjualanID', 'Penjualan ID', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->Detail($PenjualanID);
        } else {

            $this->db->where('PenjualanID', $PenjualanID);
            $this->db->where('ProdukID', $ProdukID);
            $ProdukSudahAda = $this->db->get('detailpenjualan')->row();

            if ($ProdukSudahAda) {
                $this->session->set_flashdata('error', 'Produk sudah ada di detail penjualan.');
                redirect('Penjualan/Detail/' . $PenjualanID);
            }

            $Produk = $this->db->where('ProdukID', $ProdukID)->get('produk')->row();
            if ($Produk->Stok < $JumlahProduk) {
                $this->session->set_flashdata('error', 'Stok Tidak Mencukupi');
                redirect('Penjualan/Detail/' . $PenjualanID);
            }
            $SubTotal = $JumlahProduk * (int) $Produk->Harga;
            $data = [
                'PenjualanID' => $PenjualanID,
                'ProdukID' => $ProdukID,
                'JumlahProduk' => $JumlahProduk,
                'Subtotal' => $SubTotal,
            ];

            if ($this->db->insert('detailpenjualan', $data)) {
                // Proses Mengurangi Stok 
                $this->db->where('ProdukID', $ProdukID);
                $this->db->set('Stok', 'Stok - ' . (int)$JumlahProduk, false); // Perbaikan di sini
                $this->db->update('produk');

                $this->session->set_flashdata('success', 'Detail Ditambahkan');
                redirect('Penjualan/Detail/' . $PenjualanID);
            } else {
                $this->session->set_flashdata('error', 'Detail Gagal Ditambahkan');
                redirect('Penjualan/Detail/' . $PenjualanID);
            }
        }
    }


    public function HapusDetail($id)
    {
        $this->db->where('Detail', $id);
        $detail = #this->db->get('detailpenjualan')->row();

            $jumlahdikembalikan = $detail->JumlahProduk;

        $this->db->set('stok', 'stok +' . $jumlahdikembalikan, FALSE);
        $kembaliStok = $this->db->update('produk');

        if (kembaliStok) {

           $delete = // hapus

            $this->db->where('DetailID', $id);
            $this->db->delete('detailpenjualan');

            // hapus

            $this->session->set_flashdata('success', 'detail produk dihapus');
            redirect('Penjualan/detail/' . $detail->PenjualanID);
        } else {
            $this->session->set_flashdata('error', 'gagal menghapus detail');
        }
    }

    public function Bayar($id)
    {
        $TotalHarga = $this->input->post('TotalHarga');
        $Pembayaran = $this->input->post('Pembayaran');

        if ($Pembayaran < $TotalHarga) {
            $this->session->set_flashdata('error', 'Pembayaran kurang');
            return;
        }

        $data = [
            'TotalHarga' => $TotalHarga,
            'TotalPembayaran' => $Pembayaran,
        ];
        $this->db->where('PenjualanID', $id);

        $bayar = $this->db->update('Penjualan', $data);

        if ($bayar) {
            redirect('Penjualan/struk/' . $id);
        } else {
            redirect('Penjualan/detail/' . $id);
        }
    }

    public function Struk($id)
    {


        $this->db->select('penjualan.*, pelanggan.*');
        $this->db->from('penjualan');
        $this->db->join('pelanggan', 'pelanggan.PelangganID = penjualan.PelangganID', 'left'); // Perbaikan di sini        $this->db->where('PenjualanID', $id);
        $penjualan = $this->db->get()->row();


        $this->db->select('detailpenjualan.*, produk.*');
        $this->db->from('detailpenjualan');
        $this->db->join('produk', 'produk.ProdukID = detailpenjualan.ProdukID', 'left');
        $this->db->where('PenjualanID', $id);
        $detail = $this->db->get()->result();


        $produk = $this->db->get('produk')->result();

        $data = [
            'produk' => $produk,
            'penjualan' => $penjualan,
            'detail' => $detail,
            'penjualan' => $penjualan,

        ];

        // $this->load->view('Template/Header'); 
        $this->load->view('Penjualan/struk', $data);
        // $this->load->view('Template/Footer'); 
    }
    /* End of file Penjualan.php */
}
