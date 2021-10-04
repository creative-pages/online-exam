<?php
	
class Product
{
	private $db;
	private $fm;
	public function __construct()
	{
	$this->db= new Database;
	$this->fm= new Format;
	}
    public function AddCatagory($data){
        $catname    = $this->fm->validation($data['catname']);
        $catname    = mysqli_real_escape_string($this->db->link,$catname);
        $query      = "INSERT INTO catagory_tbl(catname) VALUES('$catname')";
        $insert_row = $this->db->insert($query);
        if ($insert_row) {
          $msg="<div class='alert alert-success alert-dismissible fade show'>
            <strong>Success!</strong>Catagory Insert Succesfully
          <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
      return $msg;
        
        }
    }
    public function CatagoryList(){
        $query= "SELECT * FROM catagory_tbl";
          $result = $this->db->select($query);
          return $result;
      }
      public function AddPublication($data){
        $pname    = $this->fm->validation($data['catname']);
        $pname    = mysqli_real_escape_string($this->db->link,$pname);
        $query      = "INSERT INTO publication_tbl(pname) VALUES('$pname')";
        $insert_row = $this->db->insert($query);
        if ($insert_row) {
          $msg="<div class='alert alert-success alert-dismissible fade show'>
            <strong>Success!</strong>Publication Insert Succesfully
          <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
      return $msg;
        
        }
    }
    public function PublicList(){
        $query= "SELECT * FROM publication_tbl";
          $result = $this->db->select($query);
          return $result;
      }
      public function AddProduct($data,$file)
      {
        $name= $this->fm->validation($data['name']);
        $author= $this->fm->validation($data['author']);
        $description= $this->fm->validation($data['description']);
        $cat_id= $this->fm->validation($data['cat_id']);
        $pub_id= $this->fm->validation($data['pub_id']);
        $price= $this->fm->validation($data['price']);
        $title= $this->fm->validation($data['title']);
        $subtitle= $this->fm->validation($data['subtitle']);
        $keywords= $this->fm->validation($data['keywords']);

        $name= mysqli_real_escape_string($this->db->link,$name);
        $author= mysqli_real_escape_string($this->db->link,$author);
        $description= mysqli_real_escape_string($this->db->link,$description);
        $cat_id= mysqli_real_escape_string($this->db->link,$cat_id);
        $pub_id= mysqli_real_escape_string($this->db->link,$pub_id);
        $price= mysqli_real_escape_string($this->db->link,$price);
        $title= mysqli_real_escape_string($this->db->link,$title);
        $subtitle= mysqli_real_escape_string($this->db->link,$subtitle);
        $keywords= mysqli_real_escape_string($this->db->link,$keywords);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
         $file_name = $file['image']['name'];
         $file_size = $file['image']['size'];
         $file_temp = $file['image']['tmp_name'];
     
         $div = explode('.', $file_name);
         $file_ext = strtolower(end($div));
         $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
         $uploaded_image = "upload/".$unique_image;
       if ($name == ''|| $price=='') {
        $msg="<div class='alert alert-warning alert-dismissible fade show'>
        <strong>Success!</strong>Field Must Not be Emty...
      <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
             return $msg;
           }else{
              move_uploaded_file($file_temp, $uploaded_image);
              $query = "INSERT INTO product_tbl(name,author,description,cat_id,pub_id,price,image,title,subtitle,keyword ) VALUES('$name','$author','$description','$cat_id','$pub_id','$price','$uploaded_image','$title','$subtitle','$keywords')";
               $insert_product = $this->db->insert($query);
           if ($insert_product) {
            $msg="<div class='alert alert-success alert-dismissible fade show'>
            <strong>Success!</strong>Product Insert Succesfully
          <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
           return $msg;
           }else{
              $msg = "<span class='error'>Error!Not Added</span>!!";
             return $msg;
              }
           }
      }
      public function AllProList(){
        $query= "SELECT * FROM product_tbl ORDER BY 'id' DESC";
          $result = $this->db->select($query);
          return $result;
      }
      public function AllProListbyId($id){
        $query= "SELECT * FROM product_tbl WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
      }

      public function AddOrder($data,$user_id,$id){
         $quantity    = $this->fm->validation($data['quantity']);
        $quantity    = mysqli_real_escape_string($this->db->link,$quantity);
        $queryum     ="SELECT * FROM user_money WHERE user_id ='$user_id'";
        $resultu     =$this->db->select($queryum);
        $rquery      = "SELECT * FROM product_tbl WHERE id = '$id'";
        $resulp       = $this->db->select($rquery);
        $checkquery  = "SELECT * FROM odr_tbl WHERE user_id = '$user_id'";
        $resultodr   = $this->db->select($checkquery);
         if($resultu!=NULL && $resulp!==NULL && $resultodr!=NULL){
          $sum=0;
          $sumodt=0;
          while ($value = $resulp->fetch_assoc()) {
            $name    = $value['name'];
            $author  = $value['author'];
            $price   = $value['price']*$quantity ;
          }
            while ($value = $resultodr->fetch_assoc()) {
             $sumodt += $value['price'];
            }
             while($row=$resultu->fetch_assoc()){
              $sum += $row['amaunt'];
             }
              $aprice = $sum-$sumodt;
              $dprice= $aprice-50;
              if($price>$dprice){
                $msg="<div class='alert alert-warning alert-dismissible fade show'>
                <strong>Error!</strong>Insufisiant Balance.Please Deposite money to Your Account..
              <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
               return $msg;
              }
              else{
                $query = "INSERT INTO odr_tbl(user_id,p_id,pname,author,quantity,price) VALUES('$user_id','$id','$name','$author','$quantity','$price')";
                $insert_product = $this->db->insert($query);
                if ($insert_product){
                  $msg="<div class='alert alert-success alert-dismissible fade show'>
                    <strong>Success!</strong>You have successfully buy this prodoct.More details please goto your profile..
                  <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
                   return $msg;
               
          }
        }
         }else if($resultu!=NULL && $resulp!==NULL && $resultodr==NULL){
         $sum=0;
          while ($value = $resulp->fetch_assoc()) {
            $name    = $value['name'];
            $author  = $value['author'];
            $price   = $value['price']*$quantity ;
           
             while($row=$resultu->fetch_assoc()){
              $sum += $row['amaunt'];
              $aprice = $sum;
              $dprice= $aprice-50;
              if($price>$dprice){
                $msg="<div class='alert alert-warning alert-dismissible fade show'>
                <strong>Error!</strong>Insufisiant Balance.Please Deposite money to Your Account..
              <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
               return $msg;
              }
              else{
                $query = "INSERT INTO odr_tbl(user_id,p_id,pname,author,quantity,price) VALUES('$user_id','$id','$name','$author','$quantity','$price')";
                $insert_product = $this->db->insert($query);
                if ($insert_product){
                  $msg="<div class='alert alert-success alert-dismissible fade show'>
                    <strong>Success!</strong>You have successfully buy this prodoct.More details please goto your profile..
                  <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
                   return $msg;
                
             }
            }
            }
          }

         }else{
          $msg="<div class='alert alert-success alert-dismissible fade show'>
          <strong>Error!</strong>Something went wrong..Please check your acaunt balance.
        <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
         return $msg;
         }
     
            

      }
     
        public function OrderList($user_id){
          $query= "SELECT * FROM odr_tbl WHERE user_id='$user_id'";
          $result = $this->db->select($query);
          return $result;
        }
        public function ProById($id){
           $query= "SELECT * FROM product_tbl WHERE id='$id'";
          $result = $this->db->select($query);
          return $result;
        } 
          public function UpdateProduct($id,$data,$file)
        {
          $name= $this->fm->validation($data['name']);
          $author= $this->fm->validation($data['author']);
          $description= $this->fm->validation($data['description']);
          $cat_id= $this->fm->validation($data['cat_id']);
          $pub_id= $this->fm->validation($data['pub_id']);
          $price= $this->fm->validation($data['price']);
        
  
          $name= mysqli_real_escape_string($this->db->link,$name);
          $author= mysqli_real_escape_string($this->db->link,$author);
          $description= mysqli_real_escape_string($this->db->link,$description);
          $cat_id= mysqli_real_escape_string($this->db->link,$cat_id);
          $pub_id= mysqli_real_escape_string($this->db->link,$pub_id);
          $price= mysqli_real_escape_string($this->db->link,$price);
         
          $permited  = array('jpg', 'jpeg', 'png', 'gif');
           $file_name = $file['image']['name'];
           $file_size = $file['image']['size'];
           $file_temp = $file['image']['tmp_name'];
       
           $div = explode('.', $file_name);
           $file_ext = strtolower(end($div));
           $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
           $uploaded_image = "upload/".$unique_image;
         
            move_uploaded_file($file_temp, $uploaded_image);
                $query = "UPDATE product_tbl
                SET
                name          = '$name',
                author        = '$author',
                description   = '$description',
                cat_id        = '$cat_id',
                pub_id        = '$pub_id',
                price         = '$price',
                image         = '$uploaded_image'
                WHERE id       =  '$id'";
       
                 $update_product = $this->db->update($query);
             if ($update_product) {
              $msg="<div class='alert alert-success alert-dismissible fade show'>
              <strong>Success!</strong>Product Update Succesfully
            <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
             return $msg;
             }else{
                $msg = "<span class='error'>Error!Not Added</span>!!";
               return $msg;
                }
              }
         public function DeleteProduct($id){
           $query= "DELETE  FROM product_tbl WHERE id='$id'";
           $result=$this->db->update($query);
           if($result){
            $msg="<div class='alert alert-success alert-dismissible fade show'>
            <strong>Success!</strong>Product Delete Succesfully
          <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
           return $msg;
           }
         }
         
          public function PubById($id){
          $query= "SELECT * FROM publication_tbl WHERE id='$id'";
          $result=$this->db->select($query);
          return $result;
         }
         public function EditPublication($data,$id){
          $pname    = $this->fm->validation($data['pname']);
          $pname    = mysqli_real_escape_string($this->db->link,$pname);
          $query = "UPDATE publication_tbl
                SET
                pname          = '$pname'
               WHERE id       =  '$id'";
       
                 $update_product = $this->db->update($query);
             if ($update_product) {
              $msg="<div class='alert alert-success alert-dismissible fade show'>
              <strong>Success!</strong>Publication Update Succesfully
            <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
             return $msg;
             }else{
                $msg = "<span class='error'>Error!Not Added</span>!!";
               return $msg;
                }
         }
         public function DltPub($id){

          $query= "DELETE FROM publication_tbl WHERE id='$id'";
          $result = $this->db->delete($query);
          if ($result) {
            $msg="<div class='alert alert-success alert-dismissible fade show'>
            <strong>Success!</strong>Publication Delete Succesfully
          <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
           return $msg;
           }
         }
         public function CatById($id){
          $query= "SELECT * FROM catagory_tbl WHERE id='$id'";
          $result=$this->db->select($query);
          return $result;
         }

         public function EditCatagory($data,$id){
          $catname    = $this->fm->validation($data['catname']);
          $catname    = mysqli_real_escape_string($this->db->link,$catname);
          $query = "UPDATE catagory_tbl
                SET
                catname          = '$catname'
               WHERE id       =  '$id'";
       
                 $update_product = $this->db->update($query);
             if ($update_product) {
              $msg="<div class='alert alert-success alert-dismissible fade show'>
              <strong>Success!</strong>Catagory Update Succesfully
            <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
             return $msg;
             }else{
                $msg = "<span class='error'>Error!Not Added</span>!!";
               return $msg;
                }
         }
         public function DltCat($id){

          $query= "DELETE FROM catagory_tbl WHERE id='$id'";
          $result = $this->db->delete($query);
          if ($result) {
            $msg="<div class='alert alert-success alert-dismissible fade show'>
            <strong>Success!</strong>Catagory Delete Succesfully
          <button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
           return $msg;
           }
         }

       
      }
    

?>