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
    }
?>