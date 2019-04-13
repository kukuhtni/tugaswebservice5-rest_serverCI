<?php
 use Restserver\Libraries\REST_Controller;
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
 
class Barang extends REST_Controller {
 
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
 
    // show data barang
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $barang = $this->db->get('barang')->result();
        } else {
            $this->db->where('id', $id);
            $barang = $this->db->get('barang')->result();
        }
        $this->response($barang, 200);
    }
 
    // insert new data to barang
    function index_post() {
        $data = array(
            'id'=>$this->post('id'),
            'id_barang'=>$this->post('id_barang'),
            'nama'=>$this->post('nama'),
            'kategori'=>$this->post('kategori'),
            'stok'=>$this->post('stok'),
            'satuan'=>$this->post('satuan'),
            'isi'=>$this->post('isi'),
            'harga_beli'=>$this->post('harga_beli'),
            'harga_jual'=>$this->post('harga_jual'));
        $insert = $this->db->insert('barang', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // update data barang
    function index_put() {
        $id = $this->put('id');
        $data = array(
            'id'=>$this->put('id'),
            'id_barang'=>$this->put('id_barang'),
            'nama'=>$this->put('nama'),
            'kategori'=>$this->put('kategori'),
            'stok'=>$this->put('stok'),
            'satuan'=>$this->put('satuan'),
            'isi'=>$this->put('isi'),
            'harga_beli'=>$this->put('harga_beli'),
            'harga_jual'=>$this->put('harga_jual'));
        $this->db->where('id', $id);
        $update = $this->db->update('barang', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
    // delete barang
    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('barang');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
 
}