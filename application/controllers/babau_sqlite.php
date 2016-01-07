<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/26/15
 * Time: 9:55 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/sqlite.php';
class Babau_Sqlite extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('story_model');
    }
    public function index(){
        ############ TEST DB #########
        $db= new Sqlite('./public/story');
        if(!$db){
            exit('Error: '.$db->lastErrorMsg());
        }
        $create_table_string = <<<EOF
            CREATE TABLE IF NOT EXISTS COMPANY
              (ID INTEGER PRIMARY KEY NOT NULL,
              NAME           TEXT    NOT NULL,
              AGE            INT     NOT NULL,
              ADDRESS        CHAR(50),
              SALARY         REAL);
EOF;
        if(!$db->exec($create_table_string)){
            exit('Create table error: '.$db->lastErrorMsg());
        }
        //insert data
        $insert_data_string = <<<EOF
            INSERT INTO COMPANY (NAME,AGE,ADDRESS,SALARY)
              VALUES ('Paul', 32, 'California', 20000.00 );

              INSERT INTO COMPANY (NAME,AGE,ADDRESS,SALARY)
              VALUES ('Allen', 25, 'Texas', 15000.00 );

              INSERT INTO COMPANY (NAME,AGE,ADDRESS,SALARY)
              VALUES ('Teddy', 23, 'Norway', 20000.00 );

              INSERT INTO COMPANY (NAME,AGE,ADDRESS,SALARY)
              VALUES ('Mark', 25, 'Rich-Mond ', 65000.00 );
EOF;
        if(!$db->exec($insert_data_string)){
            exit('Insert data error: '.$db->lastErrorMsg());
        }

        echo 'Successful';
        $db->close();
    }
    public function story(){
        $db = new Sqlite('./public/story');
        if(!$db){
            die($db->lastErrorMsg());
        }
        $story_table = <<<EOF
            CREATE TABLE IF NOT EXISTS baubau_category
            (id INTEGER PRIMARY KEY NOT NULL,
              name TEXT);
EOF;
        if(!$db->exec($story_table)){
            exit($db->lastErrorMsg());
        }
        $chapter_table = <<<EOF
            CREATE TABLE IF NOT EXISTS babau
            (id INTEGER PRIMARY KEY AUTOINCREMENT,
              cate_name TEXT,
              cate_id INTEGER,
              title TEXT,
              short_description TEXT,
              content TEXT,
              status INTEGER DEFAULT 0,
              read_time DATE);
EOF;
        if(!$db->exec($chapter_table)){
            exit($db->lastErrorMsg());
        }
	$indexes = <<<EOF
	CREATE INDEX cate_idx ON babau(cate_id);
EOF;
	if(!$db->exec($indexes)){
            exit($db->lastErrorMsg());
        }
        echo 'done';
        $db->close();
        $this->import_data();

    }

    public function import_data(){
        $db = new Sqlite('./public/story');
        if(!$db){
            die($db->lastErrorMsg());
        }

        $this->load->model('story_model');
        //doc du lieu tu mysql
        $data = $this->story_model->get(
            'babau_category'
        );

        $insert = "INSERT INTO baubau_category(id,name) values(:id,:name)";
        foreach($data as $row){
            $smtp = $db->prepare($insert);

            $smtp->bindParam(':id',$row['id'],SQLITE3_INTEGER);
            $smtp->bindParam(':name',$row['name'],SQLITE3_TEXT);
            $smtp->execute();
        }

        //lay toan bo chuong
        $chapter = $this->story_model->get(
            'babau'
        );
        $insert = "INSERT INTO babau(cate_name,cate_id,title,short_description,
        content) values(:cate_name,:cate_id,:title,:short_description,
        :content)";
        foreach($chapter as $row){
            $ct=$row['content']."<div>Theo:<b> Eva.vn, Khampha.vn</b></div>";
            $smtp = $db->prepare($insert);
            $smtp->bindParam(':cate_name',$row['cate_name'],SQLITE3_TEXT);
            $smtp->bindParam(':cate_id',$row['cate_id'],SQLITE3_INTEGER);
            $smtp->bindParam(':title',$row['title'],SQLITE3_TEXT);
            $smtp->bindParam(':short_description',$row['short'],SQLITE3_TEXT);
            $smtp->bindParam(':content',$ct,SQLITE3_TEXT);
            $smtp->execute();
        }

        echo 'het nhe';
    }

    public function test(){
        $this->load->model('story_model');
        $data = $this->story_model->get_one('santruyen_story',array('chapter_number'=>6));
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}
