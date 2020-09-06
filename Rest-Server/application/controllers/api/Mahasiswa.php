<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends CI_Controller
{

    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct()
    {
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('Mahasiswa_model', 'Mahasiswa');

        $this->methods['index_get']['limit'] = 1000;
    }

    function index_get()
    {
        $id = $this->get('id');

        if ($id == null) {
            $mahasiswa = $this->Mahasiswa->getMahasiswa();
        } else {
            $mahasiswa = $this->Mahasiswa->getMahasiswa($id);
        }

        if ($mahasiswa) {
            $this->set_response([
                'status' => true,
                'data' => $mahasiswa
            ], 200);
        } else {
            $this->set_response([
                'status' => false,
                'message' => 'id not found!'
            ], 404);
        }
    }

    function index_delete()
    {
        $id = $this->delete('id');

        if ($id == null) {
            $this->set_response([
                'status' => false,
                'message' => 'id not found!'
            ], 404);
        } else {
            if ($this->Mahasiswa->deleteMahasiswa($id) > 0) {
                $this->set_response([
                    'status' => true,
                    'id' => $id,
                    'message' => 'your id has been deleted!'
                ], 200);
            } else {
                $this->set_response([
                    'status' => false,
                    'message' => 'id not found!'
                ], 404);
            }
        }
    }

    function index_post()
    {
        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')
        ];

        if ($this->Mahasiswa->createMahasiswa($data) > 0) {
            $this->set_response([
                'status' => true,
                'data' => $data,
                'message' => 'your id has been created!'
            ], 201);
        } else {
            $this->set_response([
                'status' => false,
                'message' => 'failed to create students id!'
            ], 400);
        }
    }

    function index_put()
    {
        $id = $this->put('id');

        $data = [
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan')
        ];

        if ($this->Mahasiswa->updateMahasiswa($data, $id) > 0) {
            $this->set_response([
                'status' => true,
                'id' => $id,
                'data' => $data,
                'message' => 'your id has been updated!'
            ], 201);
        } else {
            $this->set_response([
                'status' => false,
                'message' => 'failed to update students id!'
            ], 400);
        }
    }
}
