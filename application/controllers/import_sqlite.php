<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/26/15
 * Time: 9:55 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/sqlite.php';
class Import_Sqlite extends CI_Controller{
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
            CREATE TABLE IF NOT EXISTS story
            (id INTEGER PRIMARY KEY NOT NULL,
              title           TEXT    NOT NULL,
              short_description INT   NOT NULL,
              img        INTEGER,
              stoty_slug         TEXT,
              category_slug TEXT,
              category_name TEXT,
              time INTEGER,
              update_time TEXT);
EOF;
        if(!$db->exec($story_table)){
            exit($db->lastErrorMsg());
        }
        $chapter_table = <<<EOF
            CREATE TABLE IF NOT EXISTS chapter
            (id INTEGER PRIMARY KEY AUTOINCREMENT,
              story_name TEXT,
              story_id INTEGER,
              chapter_name TEXT,
              chapter TEXT,
              chapter_number INTEGER,
              img        INTEGER,
              content         TEXT,
              update_time TEXT);
EOF;
        if(!$db->exec($chapter_table)){
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
        $data = $this->story_model->get_one(
            'story',
            array(
                'id'=>5101
            )
        );

        $insert = "INSERT INTO story(id,title,short_description) values(:id,:title,:short_description)";
        $smtp = $db->prepare($insert);

        $smtp->bindParam(':id',$data->id,SQLITE3_INTEGER);
        $smtp->bindParam(':title',$data->title,SQLITE3_TEXT);
        $smtp->bindParam(':short_description',$data->id,SQLITE3_TEXT);
        $smtp->execute();
        //lay toan bo chuong
        $chapter_table = strtoupper(substr(trim($data->story_slug),0,1)).'_story';
        echo '<pre>';
        print_r($chapter_table);
        echo '</pre>';
        $chapter = $this->story_model->get(
            $chapter_table,
            array(
                'story_id'=>$data->id
            )
        );
        $insert = "INSERT INTO chapter(story_name,story_id,chapter_name,chapter,
        chapter_number,img,content,update_time) values(:story_name,:story_id,:chapter_name,:chapter,
        :chapter_number,:img,:content,:update_time)";
        foreach($chapter as $row){
            $smtp = $db->prepare($insert);
            $smtp->bindParam(':story_name',$data->title,SQLITE3_TEXT);
            $smtp->bindParam(':story_id',$data->id,SQLITE3_INTEGER);
            $smtp->bindParam(':chapter_name',$row['chapter_name'],SQLITE3_TEXT);
            $smtp->bindParam(':chapter',$row['chapter'],SQLITE3_TEXT);
            $smtp->bindParam(':chapter_number',$row['chapter_number'],SQLITE3_INTEGER);
            $smtp->bindParam(':img',$data->img,SQLITE3_INTEGER);
            $smtp->bindParam(':content',$row['content'],SQLITE3_TEXT);
            $smtp->bindParam(':update_time',$row['update_time'],SQLITE3_TEXT);
            $smtp->execute();
        }

        echo 'het nhe';
    }
}