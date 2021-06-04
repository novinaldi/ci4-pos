<?php

namespace App\Controllers;

use App\Models\Modelproduk;

class Produk extends BaseController
{
    public function __construct()
    {
        $this->produk = new Modelproduk();
        $this->db = db_connect();
    }
    public function index()
    {

        $data = [
            'dataproduk' => $this->produk->join('kategori', 'produk_katid=katid')
                ->join('satuan', 'produk_satid=satid')
                ->paginate(10, 'produk'),
            'pager' => $this->produk->pager,
            // 'nohalaman' => $noHalaman,
            // 'cari' => $cari
        ];
        return view('produk/data', $data);
    }

    public function add()
    {
        return view('produk/formtambah');
    }

    public function ambilDataKategori()
    {
        if ($this->request->isAJAX()) {
            $datakategori = $this->db->table('kategori')->get();

            $isidata = "<option value='' selected>-Pilih-</option>";

            foreach ($datakategori->getResultArray() as $row) :
                $isidata .= '<option value="' . $row['katid'] . '">' . $row['katnama'] . '</option>';
            endforeach;

            $msg = [
                'data' => $isidata
            ];
            echo json_encode($msg);
        }
    }

    public function ambilDataSatuan()
    {
        if ($this->request->isAJAX()) {
            $datasatuan = $this->db->table('satuan')->get();

            $isidata = "<option value='' selected>-Pilih-</option>";

            foreach ($datasatuan->getResultArray() as $row) :
                $isidata .= '<option value="' . $row['satid'] . '">' . $row['satnama'] . '</option>';
            endforeach;

            $msg = [
                'data' => $isidata
            ];
            echo json_encode($msg);
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            $kodebarcode = $this->request->getVar('kodebarcode');
            $namaproduk = $this->request->getVar('namaproduk');
            $stok = $this->request->getVar('stok');
            $kategori = $this->request->getVar('kategori');
            $satuan = $this->request->getVar('satuan');
            $hargabeli = str_replace(',', '', $this->request->getVar('hargabeli'));
            $hargajual = str_replace(',', '', $this->request->getVar('hargajual'));

            $validation =  \Config\Services::validation();

            $doValid = $this->validate([
                'kodebarcode' => [
                    'label' => 'Kode Barcode',
                    'rules' => 'is_unique[produk.kodebarcode]|required',
                    'errors' => [
                        'is_unique' => '{field} sudah ada, coba dengan kode yang lain',
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'namaproduk' => [
                    'label' => 'Nama Produk',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'stok' => [
                    'label' => 'Stok Tersedia',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'kategori' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'satuan' => [
                    'label' => 'Satuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib dipilih'
                    ]
                ],
                'hargabeli' => [
                    'label' => 'Harga Beli',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh Kosong',
                    ]
                ],
                'hargajual' => [
                    'label' => 'Harga Jual',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh Kosong'
                    ]
                ],
                'uploadgambar' => [
                    'label' => 'Upload Gambar',
                    'rules' => 'mime_in[uploadgambar,image/png,image/jpg,image/jpeg]|ext_in[uploadgambar,png,jpg,jpeg]|is_image[uploadgambar]',
                ]
            ]);

            if (!$doValid) {
                $msg = [
                    'error' => [
                        'errorKodeBarcode' => $validation->getError('kodebarcode'),
                        'errorNamaProduk' => $validation->getError('namaproduk'),
                        'errorStok' => $validation->getError('stok'),
                        'errorKategori' => $validation->getError('kategori'),
                        'errorSatuan' => $validation->getError('satuan'),
                        'errorHargaBeli' => $validation->getError('hargabeli'),
                        'errorHargaJual' => $validation->getError('hargajual'),
                        'errorUpload' => $validation->getError('uploadgambar')
                    ]
                ];
            } else {
                $uploadGambar = $_FILES['uploadgambar']['name'];

                if ($uploadGambar != NULL) {
                    $namaFileGambar = "$kodebarcode-$namaproduk";
                    $fileGambar = $this->request->getFile('uploadgambar');
                    $fileGambar->move('assets/upload', $namaFileGambar . '.' . $fileGambar->getExtension());

                    $pathGambar = '.assets/upload/' . $fileGambar->getName();
                } else {
                    $pathGambar = '';
                }

                $this->produk->insert([
                    'kodebarcode' => $kodebarcode,
                    'namaproduk' => $namaproduk,
                    'produk_satid' => $satuan,
                    'produk_katid' => $kategori,
                    'stok_tersedia' => $stok,
                    'hargabeli' => $hargabeli,
                    'hargajual' => $hargajual,
                    'gambar' => $pathGambar
                ]);

                $msg = [
                    'sukses' => 'Berhasil dieksekusi'
                ];
            }

            echo json_encode($msg);
        }
    }
}