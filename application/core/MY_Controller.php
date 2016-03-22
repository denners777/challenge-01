<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * controller MY_Controller
 * @link        https://github.com/denners777/challenge-01
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */
class MY_Controller extends CI_Controller {

    /**
     * data
     * @var array 
     */
    public $data = [];

    /**
     *
     * @var type 
     */
    protected $POST = NULL;

    /**
     * construct
     */
    public function __construct() {
        parent::__construct();

        $this->POST = $this->input->post(NULL, TRUE);

        $this->data['ERROR'] = $this->session->flashdata('ERROR');
        $this->data['NOTICE'] = $this->session->flashdata('NOTICE');
        $this->data['SUCCESS'] = $this->session->flashdata('SUCCESS');
    }

    /**
     * function is_ajax
     * @return type
     */
    public function is_ajax() {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest');
    }

    /**
     * function MY_view
     * @param type $view
     * @param type $data
     */
    public function MY_view($view, $data) {

        $this->load->view('common/header', $data);
        $this->load->view('common/alerts', $data);
        $this->load->view($view, $data);
        $this->load->view('common/footer', $data);
    }

}
