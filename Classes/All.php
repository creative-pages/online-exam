<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath . '/../init.php');

    class All
    {
        private $db;
	    private $fm;
        public function __construct()
        {
            $this->db= new Database;
            $this->fm= new Format;
        }
        public function AddClass($data){
            $topic = $this->fm->validation($data['topic']);
            $batch = $this->fm->validation($data['batch']);
            $subject = $this->fm->validation($data['subject']);
            $chapter = $this->fm->validation($data['chapter']);
            $c_link = $this->fm->validation($data['c_link']);
            $exm_link = $this->fm->validation($data['exm_link']);
            $note_link = $this->fm->validation($data['note_link']);

            $query = "INSERT INTO class_add(topic,batch_id,subject_id,chapter,c_link,exm_link,note_link) VALUES('$topic','$batch','$subject','$chapter','$c_link','$exm_link','$note_link')";
            $result = $this->db->insert($query);
            if($result){
                header("Location:add-class.php");
            }
        }

        public function AllClass(){
            $query = "SELECT * FROM class_add ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function Dltsub($id){
            $query = "DELETE FROM subject_add WHERE id = $id";
            $result = $this->db->delete($query);
            if($result){
                $msg = "<span style='color:red;'>Subject Delete Successfully</span>";
                return $msg;
            }
           
        }
        public function StudentLogin($data){
            $sid = $this->fm->validation($data['id']);
           
            $query = "SELECT * FROM student_table WHERE sid='$sid'";
            $result = $this->db->select($query);
            if($result){
                while($value = $result->fetch_assoc()){
                    $studentid = $value['sid'];
                    if($studentid==false){
                        $msg ="<span style='color:red;'>Incorrect Id Number</span>";
                        return $msg;
                    }
                    
                    else{
                        header("Location:start-exam.php");
                    }
                       
                }
                
            }
        }

        public function PublishExam($data){
            $exam_id = $this->fm->validation($data['exam_id']);
            $exam_name = $this->fm->validation($data['exam_name']);
            $link = $this->fm->validation($data['link']);
            $intro = $this->fm->validation($data['intro']);
            $color = $this->fm->validation($data['color']);
            $pagination = $this->fm->validation($data['pg']);
            $howtime = $this->fm->validation($data['time']);
            $totaltime = $this->fm->validation($data['minute']);

            $query = "INSERT INTO  publish_exam(exam_id,exam_name,link,intro,color,pagination,howtime,totaltime) VALUES('$exam_id','$exam_name','$link','$intro','$color','$pagination','$howtime','$totaltime') ";
            $result = $this->db->insert($query);
            if($result){
                header("Location:publish-exam.php");
            }

        }
    }
?>