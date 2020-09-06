<?php

use GuzzleHttp\Client;

class Mahasiswa_model extends CI_model
{
    private $_client;

    function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost/Rest-API/Rest-Server/api/'
        ]);
    }

    function getAllMahasiswa()
    {
        $response = $this->_client->request('GET', 'Mahasiswa', [
            'query' => [
                'apikey' => 'rahasia'
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }

    function getMahasiswaById($id)
    {
        $response = $this->_client->request('GET', 'Mahasiswa', [
            'query' => [
                'apikey' => 'rahasia',
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    function tambahDataMahasiswa()
    {
        $data = [
            'nama' => $this->input->post('nama', true),
            'nrp' => $this->input->post('nrp', true),
            'email' => $this->input->post('email', true),
            'jurusan' => $this->input->post('nrp', true),
            'apikey' => 'rahasia'
        ];

        $response = $this->_client->request('POST', 'Mahasiswa', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    function hapusDataMahasiswa($id)
    {
        $response = $this->_client->request('DELETE', 'Mahasiswa', [
            'form_params' => [
                'apikey' => 'rahasia',
                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id', true),
            "apikey" => 'rahasia'
        ];

        $response = $this->_client->request('PUT', 'Mahasiswa', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}
