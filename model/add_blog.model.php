<?php
class ADD_BLOG
{
    public $PDO = null;
    public function __construct($PDO)
    {
        $this->PDO = $PDO;
    }
    public function create_new_blog_element($element_name, $sr_no, $element_id, $value, $tag, $h, $color, $text_alignment)
    {
        $query = "INSERT INTO main_blog (element_name, element_id, h, color, sr_no, tag, text_alignment, value) VALUE(:element_name, :element_id, :h, :color, :sr_no, :tag, :text_alignment, :value);";
        // $query = "SELECT * FROM user WHERE email=:email;";
        $stmt = $this->PDO->prepare($query);
        $stmt->bindValue(":element_name", $element_name, PDO::PARAM_STR);
        $stmt->bindValue(":element_id", $element_id, PDO::PARAM_STR);
        $stmt->bindValue(":h", $h, PDO::PARAM_STR);
        $stmt->bindValue(":color", $color, PDO::PARAM_STR);
        $stmt->bindValue(":sr_no", $sr_no, PDO::PARAM_STR);
        $stmt->bindValue(":tag", $tag, PDO::PARAM_STR);
        $stmt->bindValue(":text_alignment", $text_alignment, PDO::PARAM_STR);
        $stmt->bindValue(":value", $value, PDO::PARAM_STR);
        try {
            if ($stmt->execute()) {
                echo "data inserted";
            } else {
                echo "somthing went wrong";
            }
            // $data = $stmt->fetch(PDO::FETCH_ASSOC);
            // return $data;
        } catch (PDOException $e) {
            echo "error:" . $e->getMessage();
        }
    }
    // assign a tokan for perticular page
    public function get_tokan_id(){
        $query = "SELECT id FROM main_blog ORDER BY id DESC LIMIT 1;";
        $stmt =$this->PDO->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function check_if_the_title_exist($sr_no, $value){
        $query = "SELECT COUNT(*) FROM main_blog WHERE sr_no=:sr_no AND value=:value;";
        $stmt =$this->PDO->prepare($query);
        $stmt->bindValue(":sr_no",$sr_no,PDO::PARAM_STR);
        $stmt->bindValue(":value",$value,PDO::PARAM_STR);
        try{
            $stmt->execute();
            $data = $stmt->fetchColumn();
            return $data;
    return $data;
        }catch(PDOException $e){
            $e->getMessage();
        }

        

    }
}
