<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/13/15
 * Time: 11:12 AM
 */
class Home extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('mysql_model');
    }
    public function index(){
        echo base_url();
    }
}