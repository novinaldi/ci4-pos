<?php

namespace App\Controllers;

use App\Models\Modelsatuan;
use App\Models\Modeldatasatuan;
use Config\Services;

class Satuan extends BaseController
{
    public function __construct()
    {
        $this->satuan = new Modelsatuan();
    }
    public function index()
    {
        return view('satuan/data');
    }

    function ambilDataSatuan()
    {
        if ($this->request->isAJAX()) {
            $request = Services::request();
            $datasatuan = new Modeldatasatuan($request);
            if ($request->getMethod(true) == 'POST') {
                $lists = $datasatuan->get_datatables();
                $data = [];
                $no = $request->getPost("start");
                foreach ($lists as $list) {
                    $no++;

                    $tombolHapus = "<button type=\"button\" class=\"btn btn-sm btn-danger\" onclick=\"hapus('" . $list->satid . "','" . $list->satnama . "')\"><i class=\"fa fa-trash-alt\"></i></button>";
                    $tombolEdit = "<button type=\"button\" class=\"btn btn-sm btn-info\" onclick=\"edit('" . $list->satid . "')\"><i class=\"fa fa-pencil-alt\"></i></button>";

                    $row = [];
                    $row[] = $no;
                    $row[] = $list->satnama;
                    $row[] = $tombolHapus . ' ' . $tombolEdit;
                    $data[] = $row;
                }
                $output = [
                    "draw" => $request->getPost('draw'),
                    "recordsTotal" => $datasatuan->count_all(),
                    "recordsFiltered" => $datasatuan->count_filtered(),
                    "data" => $data
                ];
                echo json_encode($output);
            }
        }
    }

    function formTambah()
    {
        if ($this->request->isAJAX()) {
            $aksi = $this->request->getPost('aksi');
            $msg = [
                'data' => view('satuan/modalformtambah', ['aksi' => $aksi])
            ];
            echo json_encode($msg);
        }
    }

    function simpandata()
    {
        if ($this->request->isAJAX()) {
            $namasatuan = $this->request->getVar('namasatuan');

            $this->satuan->insert([
                'satnama' => $namasatuan
            ]);

            $msg = [
                'sukses' => 'Satuan berhasil ditambahkan'
            ];
            echo json_encode($msg);
        }
    }
    function hapus()
    {
        if ($this->request->isAJAX()) {
            $idSatuan = $this->request->getVar('idsatuan');

            $this->satuan->delete($idSatuan);

            $msg = [
                'sukses' => 'Satuan berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    function formEdit()
    {
        if ($this->request->isAJAX()) {
            $idsatuan =  $this->request->getVar('idsatuan');

            $ambildatasatuan = $this->satuan->find($idsatuan);
            $data = [
                'idsatuan' => $idsatuan,
                'namasatuan' => $ambildatasatuan['satnama']
            ];

            $msg = [
                'data' => view('satuan/modalformedit', $data)
            ];
            echo json_encode($msg);
        }
    }

    function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idsatuan = $this->request->getVar('idsatuan');
            $msg = [
                'sukses' =>  'Data satuan berhasil diupdate'
            ];
            echo json_encode($msg);
        }
    }
}