<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 12/17/14
 * Time: 11:40 PM
 */
class Api extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('mysql_model');
    }
    public function index(){
        $url = $this->input->post('url');
        $data = $this->mysql_model->get_limit(
            'get',
            'sites',
            array(
                'site_link'=>$url
            ),
            30,
            0,
            '',
            'time'
        );
        $this->send(json_encode(array('data'=>$data)));
        //check xem thoi diem lay lan cuoi cung cach day lau chua de goi api update
        if(count($data)==0||(time()-$data[0]['time']>3600)){
            $data = array(
                'link'=>$url
            );
            $ch = curl_init(base_url('tools/clone_data'));
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($data));
            curl_exec($ch);
            curl_close($ch);
            /*$data = $this->mysql_model->get_limit(
                'get',
                'sites',
                array(
                    'site_link'=>$url
                ),
                30,
                0,
                '',
                'time'
            );*/
        }
        //exit(json_encode(array('data'=>$data)));
    }
    function send($response){
        ob_end_clean();
        ignore_user_abort(true);//avoid apache to kill the php running
        ob_start();//start buffer output
        echo $response;
        header("Content-Encoding: none");//send header to avoid the browser side to take content as gzip format
        header("Content-Length: ".ob_get_length());//send length header
        header("Connection: close");//or redirect to some url: header('Location: http://www.google.com');
        ob_end_flush();flush();//really send content, can't change the order:1.ob buffer to normal buffer, 2.normal buffer to output
        session_write_close();//close session file on server side to avoid blocking other requests
    }
}