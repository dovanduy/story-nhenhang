<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/26/15
 * Time: 9:55 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/sqlite.php';
class Afamily extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('story_model');
    }
    public function story($type=''){
        $path = './public/story';
        $db = new Sqlite($path);
        if(file_exists($path)){
            exec('rm -rf '.$path);
        }
        if(!$db){
            die($db->lastErrorMsg());
        }
        $db = new Sqlite('./public/story');
        if(!$db){
            die($db->lastErrorMsg());
        }
        $story_table = <<<EOF
            CREATE TABLE IF NOT EXISTS category
            (id INTEGER PRIMARY KEY NOT NULL,
              name           TEXT    NOT NULL,
              parent_id INTEGER);
EOF;
        if(!$db->exec($story_table)){
            exit($db->lastErrorMsg());
        }

        $chapter_table = <<<EOF
            CREATE TABLE IF NOT EXISTS detail
            (id INTEGER PRIMARY KEY AUTOINCREMENT,
              category_name TEXT,
              category_id INTEGER,
              title TEXT,
              brief TEXT,
              description TEXT,
              is_like        INTEGER DEFAULT 0,
              update_time TEXT,
		status INTEGER DEFAULT 0);
EOF;
        if(!$db->exec($chapter_table)){
            exit($db->lastErrorMsg());
        }
	$indexes = <<<EOF
	CREATE INDEX categoryIdx ON detail(category_id);
	CREATE INDEX statusIdx ON detail(status);
	CREATE INDEX isLikeIdx ON detail(is_like);
	CREATE INDEX parentIdx ON category(parent_id);
	CREATE INDEX titleIdx ON detail(title);
EOF;
	if(!$db->exec($indexes)){
            exit($db->lastErrorMsg());
        }
        echo 'done';
        $db->close();
        $this->import_data($type);

    }

    public function import_data($type){
        $path = './public/story';
        if(empty($type)){
            $categoryTable = 'category';
            $detailTable = 'detail';
        }else{
            $categoryTable = 'category_monngon';
            $detailTable = 'detail_monngon';
        }
        $db = new Sqlite($path);
        if(!$db){
            die($db->lastErrorMsg());
        }

        $this->load->model('story_model');
        //doc du lieu tu mysql
        $data = $this->story_model->get(
            $categoryTable
        );

        $insert = "INSERT INTO category(id,name,parent_id) values(:id,:name,:parent_id)";
        foreach($data as $item){
            $smtp = $db->prepare($insert);

            $smtp->bindParam(':id',$item['id'],SQLITE3_INTEGER);
            $smtp->bindParam(':name',$item['name'],SQLITE3_TEXT);
            $smtp->bindParam(':parent_id',$item['parent_id'],SQLITE3_INTEGER);
            $smtp->execute();
        }
        $chapter = $this->story_model->get(
            $detailTable
        );
        $insert = "INSERT INTO detail(category_name,category_id,title,brief,
        description,update_time) values(:category_name,:category_id,:title,:brief,
        :description,:update_time)";
        foreach($chapter as $row){
            $smtp = $db->prepare($insert);
            $smtp->bindParam(':category_name',$row['category_name'],SQLITE3_TEXT);
            $smtp->bindParam(':category_id',$row['category_id'],SQLITE3_INTEGER);
            $smtp->bindParam(':title',$row['title'],SQLITE3_TEXT);
            $smtp->bindParam(':brief',$row['brief'],SQLITE3_TEXT);
            $smtp->bindParam(':description',$row['description'],SQLITE3_TEXT);
            $smtp->bindParam(':update_time',$row['update_time'],SQLITE3_TEXT);
            $smtp->execute();
        }

        echo 'het nhe';
    }
}
