<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath . '/../init.php');

    class Exam
    {
        private $db;
	    private $fm;
        public function __construct()
        {
            $this->db= new Database;
            $this->fm= new Format;
        }
        public function AddExam($data){
            $examname    = $this->fm->validation($data['examname']);
            $subjectname = $this->fm->validation($data['subjectname']);
            $duration    = $this->fm->validation($data['duration']);
            $exmdate     = $this->fm->validation($data['exmdate']);

            $query = "insert into add_exam(examname,subjectname,duration,exmdate ) values('$examname','$subjectname','$duration','$exmdate')";
            $insert_row = $this->db->insert($query);
            if($insert_row){
                echo "<script> window.location.assign('add-quetion.php'); </script>";
            }
           
        }

        public function AllExamList(){
            $query = "SELECT * FROM add_exam ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function ExamById($id){
            $query = "SELECT * FROM add_exam WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;

        }

        public function AllBranchList(){
            $query = "SELECT * FROM add_branch ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;  
        }

        public function AllQuestion($id){
            $query = "SELECT * FROM questions WHERE exam_id = '$id' ORDER BY `serial` ASC";
            $result = $this->db->select($query);
            return $result;

        }

        public function UpdateQuetion($data,$id){
                   $query = "SELECT * FROM questions WHERE exam_id = '$id'";
                   $result = $this->db->select($query);
                   if($result){
                       $i=0;
                       while($row= $result->fetch_assoc()){
                           $i++;
                     $exam_id      = $this->fm->validation($data['exam_id']);
                    $question        = $this->fm->validation($data['question'.$i]);
                    $option_one     = $this->fm->validation($data['option_one'.$i]);
                    $option_two     = $this->fm->validation($data['option_two'.$i]);
                    $option_three   = $this->fm->validation($data['option_three'.$i]);
                    $option_four    = $this->fm->validation($data['option_four'.$i]);
                    $answer         = $this->fm->validation($data['answer'.$i]);
                    $description    = $this->fm->validation($data['description'.$i]);

                
                    
                    $query = "UPDATE questions
                    SET
                    ex = '$exam_id',    
                    question = '$question',
                    option_one = '$option_one',
                    option_two = '$option_two',
                    option_three = '$option_three',
                    option_four = '$option_four',
                    answer = '$answer',
                    description  = '$description '
                
                    WHERE exam_id='$id'";
                    $update_quetion = $this->db->update($query);
                    if($update_quetion){
                    //  header("Location:add-exam.php");
                    }
                } 
                }    
            
        }

        public function DltXmQue($dltid){
            $query = "DELETE FROM add_exam WHERE id = '$dltid'";
            $dlt = $this->db->delete($query);
            if($dlt){
                $query = "DELETE FROM questions WHERE exam_id = '$dltid'";
                $dltq = $this->db->delete($query);
                if($dltq){
                    $msg = "<button type='button' class='btn btn-lg d-block w-100 btn-light-success text-success font-medium' id='ts-success'>Success</button>";
                    return $msg;
                }

            }
            

        }
        public function DeleteBranch($bid){
            $query = "DELETE FROM add_branch WHERE id = '$bid'";
            $dlt = $this->db->delete($query);
            if($dlt){
                header("Location:addbranch.php");
            }
        }

        public function ExamProcess($id,$data){
            $totalquetion = $this->fm->validation($data['totalquetion']);
            for($i=1;$i<=$totalquetion;$i++){
                $serial    = $this->fm->validation($data['serial']);
                $ans = $this->fm->validation($data['ans'.$i]);

                if(!isset($_SESSION['score'])){
                    $_SESSION['score'] = '0';	
                }
                $right = rightAns($serial,$id);
                if($right == $ans ){
                    $_SESSION['score']++;
                }
            }
            header("Location: final.php");

        }

        private function rightAns($serial,$id){
            $query = "SELECT * FROM quetion WHERE exam_id = '$id' AND serial = '$serial'";
            $result = $this->db->select($query);
            if($result){
                while($ans = $result->fetch_assoc() ){
                    $righta = $ans['answer'];
                    if($righta=="option_one"){
                        $rightans = $righta;
                    }
                    elseif($righta=="option_two"){
                        $rightans = $righta; 
                    }
                    elseif($righta=="option_three"){
                        $rightans = $righta; 
                    }
                    elseif($righta=="option_four"){
                        $rightans = $righta; 
                    }
                    return $rightans;

                }
            }
           
           
        }


    }
?>