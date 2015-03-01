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
        $this->load->model('story_model');
        $this->load->library('paginate');
    }
    public function index(){
        $data['view'] = 'home_view';
        $data['hot_stories'] = $this->story_model->get_pagination(
            'get',
            'story',
            array(
                'top_hot'=>1
            ),
            10,
            0,
            'id,title,img,update_unixtime,total_view,category_slug,category_name,story_slug',
            'update_unixtime'
        );
        $data['hot_view_stories'] = $this->story_model->get_pagination(
            'get',
            'story',
            array(
                'top_hot'=>0
            ),
            6,
            0,
            'id,title,img,update_unixtime,total_view,category_slug,category_name,story_slug',
            'update_unixtime'
        );
        $this->load->view('index_view.php',$data);
    }
    public function cate($slug){
        echo $slug;
        $slug = explode('_',$slug);
        $start = 0;
        if(count($slug)>1){
            $start = $slug[1];
        }
        $slug = $slug[0];
        $query = array(
            'category_slug'=>$slug
        );
        //lay thong tin app
        $total = $this->story_model->get_pagination(
            'total',
            'story',
            $query
        );
        $limit = 20;
        $link = base_url($slug);
        $data['page_nav'] = $this->paginate->paging($total,$limit,$start,$link,'.html');
        $data['view'] = 'category_view';
        $data['title'] = $slug.', nhenhang.com, truyện tình yêu, tâm sự, kiếm hiệp, kinh dị, tiên hiệp hay nhất, mới nhất hiện nay.';
        $data['list_apps'] = $this->story_model->get_pagination(
            'get',
            'story',
            $query,
            $limit,
            $start,
            '',
            'update_time'
        );
        $data['hot_view_stories'] = $this->story_model->get_pagination(
            'get',
            'story',
            array(
                'top_hot'=>1,
                'category_slug !='=>$slug
            ),
            10,
            0,
            'id,title,img,update_unixtime,total_view,category_slug,category_name,story_slug',
            'update_unixtime'
        );
        $this->load->view('index_view',$data);
    }


    public function change(){
        $db = $this->load->database('story',TRUE);
        $tables = $db->list_tables();
        foreach($tables as $table){
            if(preg_match('/[\w\d]_story/',$table)){
                $sql = 'ALTER TABLE '.$table.' ADD COLUMN (chapter_slug TEXT, story_slug TEXT)';
                $db->query($sql);
                echo $table.'<br>';
            }
        }

    }
}