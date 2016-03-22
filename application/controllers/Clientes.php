<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * controller Clientes
 * @link        https://github.com/denners777/challenge-01
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */
class Clientes extends MY_Controller {

    /**
     * construct
     */
    public function __construct() {
        parent::__construct();
        $this->load->Model('Clientes_Model', 'mClientes');
    }

    /**
     * action index
     */
    public function index() {

        $this->data['clientes'] = $this->mClientes->getAll();

        $this->MY_view('clientes/index', $this->data);
    }

    /**
     * action view
     * @return boolean
     * @throws Exception
     */
    public function view() {

        try {
            if ($this->POST) {

                $id = $this->POST['id'];

                $this->data['clientes'] = $this->mClientes->get($id);

                if ($this->is_ajax()) {
                    echo $this->load->view('clientes/view', $this->data, true);
                    return true;
                } else {
                    $this->MY_view('clientes/view', $this->data);
                }
            } else {
                throw new Exception('Acesso inválido');
            }
        } catch (Exception $exc) {
            $this->session->set_flashdata('ERROR', $exc->getMessage());
        }
        redirect('clientes');
    }

    /**
     * action save
     * @throws Exception
     */
    public function save() {
        try {
            if ($this->POST) {
                $return = $this->mClientes->save($this->POST);

                if (!$return) {
                    throw new Exception('Não foi possível gravar estes dados. Tente novamente!!!');
                } else {
                    $this->session->set_flashdata('SUCCESS', 'Dados gravados com sucesso.');
                }
            } else {
                throw new Exception('Acesso inválido');
            }
        } catch (Exception $exc) {
            $this->session->set_flashdata('ERROR', $exc->getMessage());
        }
        redirect('clientes');
    }

    /**
     * action edit
     * @throws Exception
     */
    public function edit() {
        try {
            if ($this->POST) {
                $id = $this->POST['id'];
                echo json_encode($this->mClientes->get($id));
            } else {
                throw new Exception('Acesso inválido');
            }
        } catch (Exception $exc) {
            $this->session->set_flashdata('ERROR', $exc->getMessage());
        }
    }

    /**
     * action delete
     * @throws Exception
     */
    public function delete() {
        try {
            if ($this->POST) {

                $return = $this->mClientes->delete($this->POST);

                if (!$return) {
                    throw new Exception('Não foi possível deletar este registro. Tente novamente!!!');
                } else {
                    $this->session->set_flashdata('SUCCESS', 'Registro deletado com sucesso.');
                    echo 'ok';
                }
            } else {
                throw new Exception('Acesso inválido');
            }
        } catch (Exception $exc) {
            $this->session->set_flashdata('ERROR', $exc->getMessage());
        }
    }

}
