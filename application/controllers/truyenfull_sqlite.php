<?php
/**
 * Created by PhpStorm.
 * User: tienn2t
 * Date: 2/26/15
 * Time: 9:55 AM
 */
require_once $_SERVER['DOCUMENT_ROOT'].'/sqlite.php';
class Truyenfull_Sqlite extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('story_model');
    }
    public function story(){
        $db = new Sqlite('./public/story');
        if(!$db){
            die($db->lastErrorMsg());
        }

        $chapter_table = <<<EOF
            CREATE TABLE IF NOT EXISTS chapter
            (id INTEGER PRIMARY KEY AUTOINCREMENT,
              chapter_name TEXT,
              content         TEXT,
		chapter TEXT,
              status INTEGER DEFAULT 0);
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

        //lay toan bo chuong
        $chapter_table = 'chapter';
        echo '<pre>';
        print_r($chapter_table);
        echo '</pre>';
        $chapter = $this->story_model->get(
            $chapter_table
        );
        $insert = "INSERT INTO chapter(chapter_name,chapter,content) values(:chapter_name,:chapter,:content)";
        foreach($chapter as $row){
            $smtp = $db->prepare($insert);
            $smtp->bindParam(':chapter_name',$row['chapter_name'],SQLITE3_TEXT);
            $smtp->bindParam(':content',$row['content'],SQLITE3_TEXT);
            $smtp->bindParam(':chapter',$row['chapter'],SQLITE3_TEXT);
            $smtp->execute();
        }

        echo 'het nhe';
    }
}
