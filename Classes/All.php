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
        public function StudentLogin($data,$exmid){
            $sid = $this->fm->validation($data['id']);
           
            $query = "SELECT * FROM student_table WHERE sid='$sid'";
            $value = $this->db->select($query);
            if($value){
                $result = $value->fetch_assoc();
                $studentid = $result['sid'];
                if($studentid == false){
                    $msg ="<span style='color:red;'>Incorrect Id Number</span>";
                    return $msg;
                } else{
                    $query = "SELECT * FROM publish_exam WHERE exam_id='$exmid'";
                    $result = $this->db->select($query)->fetch_assoc();
                    if($result){
                        
                        $exam_id = $result['exam_id'];
                      
                        Session::set("exmid",$exam_id);
                        Session::set("student_id",$studentid);
                        header("Location: start-exam.php?xmid=$exam_id");
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
            $navigation = $this->fm->validation($data['nav']);
            $negative_mark = $this->fm->validation($data['negative_mark']);
            $acces = $this->fm->validation($data['access']);
            $howtime = $this->fm->validation($data['time']);
            $totaltime = $this->fm->validation($data['minute']);
            $can_take_test = $this->fm->validation($data['can_take_test']);
            $take_time = $this->fm->validation($data['take_time']);
            if (isset($data['after_answer'])) { $after= $data['after_answer']; } else { $after = ''; }
		        if ($after) {
                $afters = "";
                foreach($after as $soft_type) {  
                    $afters .= $soft_type . ",";  
                }
            }
            if (isset($data['other'])) { $other= $data['other']; } else { $other = ''; }
		        if ($other) {
                $others = "";
                foreach($other as $value) {  
                    $others .= $value . ",";  
                }
            }
            
            
          
            $query = "INSERT INTO  publish_exam(exam_id,exam_name,link,intro,color,pagination,navigation,after_answer,other,negative_mark,access,howtime,totaltime,can_take_test,take_time,browser) VALUES('$exam_id','$exam_name','$link','$intro','$color','$pagination','$navigation','$afters','$others','$negative_mark','$acces','$howtime','$totaltime','$can_take_test','$take_time','') ";
            $result = $this->db->insert($query);
            if($result){
                header("Location:publish-exam.php");
            }
            else{
                echo "Something went wrong";
            }

        }

        public function EditSetting($data,$id){
            $exam_id = $this->fm->validation($data['exam_id']);
            $exam_name = $this->fm->validation($data['exam_name']);
            $link = $this->fm->validation($data['link']);
            $intro = $this->fm->validation($data['intro']);
            $color = $this->fm->validation($data['color']);
            $pagination = $this->fm->validation($data['pg']);
            $navigation = $this->fm->validation($data['nav']);
            $negative_mark = $this->fm->validation($data['negative_mark']);
            $acces = $this->fm->validation($data['access']);
            $howtime = $this->fm->validation($data['time']);
            $totaltime = $this->fm->validation($data['minute']);
            $can_take_test = $this->fm->validation($data['can_take_test']);
            $take_time = $this->fm->validation($data['take_time']);

            if (isset($data['after_answer'])) { $after= $data['after_answer']; } else { $after = ''; }
		        if ($after) {
                $afters = "";
                foreach($after as $soft_type) {  
                    $afters .= $soft_type . ",";  
                }
            }
            if (isset($data['other'])) { $other= $data['other']; } else { $other = ''; }
		        if ($other) {
                $others = "";
                foreach($other as $value) {  
                    $others .= $value . ",";  
                }
            }
           
            $query = "UPDATE publish_exam 
            set 
            exam_name = '$exam_name',
            intro= '$intro',
            color = '$color',
            pagination= '$pagination',
            navigation = '$navigation',
            after_answer = '$afters',
            other = '$others',
            negative_mark = '$negative_mark',
            negative_mark = '$negative_mark',
            access = '$acces',
            howtime = '$howtime',
            totaltime = '$totaltime',
            can_take_test = '$can_take_test',
            take_time = '$take_time', 
            browser = ''             
            ";
            $result = $this->db->update($query);
            if($result){
                header("Location:publish-exam.php");
            }
            else{
                echo "Something went wrong";
            }

        }
    }
?>