<?php
class ADD_BLOG
{
    public $PDO = null;
    public function __construct($PDO)
    {
        $this->PDO = $PDO;
    }

    // assign a tokan for perticular page
    public function get_tokan_id()
    {
        $query = "SELECT id FROM main_blog ORDER BY id DESC LIMIT 1;";
        $stmt = $this->PDO->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    // check if slug available 
    public function check_slug_availability($slug, $token)
    {
        // $query = "SELECT COUNT(*) FROM main_blog WHERE slug=:slug AND token=:token;";
        $query = "SELECT COUNT(*) FROM main_blog WHERE slug=:slug;";
        $stmt = $this->PDO->prepare($query);
        $stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
        // $stmt->bindValue(":token", $token, PDO::PARAM_STR);
        try {
            $stmt->execute();
            $data = $stmt->fetchColumn();
            return $data;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }


    public function create_new_blog_element($token, $slug, $title, $sr_no, $element_name, $element_id, $value, $h, $color, $tag, $text_alignment)
    {
        $query = "INSERT INTO main_blog (token, slug, title, sr_no, element_name, element_id, value, h, color, tag, text_alignment) VALUE(:token, :slug, :title, :sr_no, :element_name, :element_id, :value, :h, :color, :tag, :text_alignment);";
        // $query = "SELECT * FROM user WHERE email=:email;";
        $stmt = $this->PDO->prepare($query);
        $stmt->bindValue(":token", $token, PDO::PARAM_STR);
        $stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":sr_no", $sr_no, PDO::PARAM_STR);
        $stmt->bindValue(":element_name", $element_name, PDO::PARAM_STR);
        $stmt->bindValue(":element_id", $element_id, PDO::PARAM_STR);
        $stmt->bindValue(":value", $value, PDO::PARAM_STR);
        $stmt->bindValue(":h", $h, PDO::PARAM_STR);
        $stmt->bindValue(":color", $color, PDO::PARAM_STR);
        $stmt->bindValue(":tag", $tag, PDO::PARAM_STR);
        $stmt->bindValue(":text_alignment", $text_alignment, PDO::PARAM_STR);
        try {
            if ($stmt->execute()) {
                echo json_encode(["message" => "Data inserted successfully", "status" => true]);
                // $query = "DELETE * FROM main_blog WHERE token=:token AND slug=:slug;";
                // $stmt->bindValue(":token", $token, PDO::PARAM_STR);
                // $stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
            } else {
                echo json_encode(["message" => "Data insertation failed", "status" => false]);
            }
            // $data = $stmt->fetch(PDO::FETCH_ASSOC);
            // return $data;
        } catch (PDOException $e) {
            echo "error:" . $e->getMessage();
        }
    }

    public function update_new_blog_element($token, $slug, $title, $sr_no, $element_name, $element_id, $value, $h, $color, $tag, $text_alignment)
    {
        // $query = "INSERT INTO main_blog (token, slug, title, sr_no, element_name, element_id, value, h, color, tag, text_alignment) VALUE(:token, :slug, :title, :sr_no, :element_name, :element_id, :value, :h, :color, :tag, :text_alignment);";
        $query = "UPDATE main_blog SET token = :token, slug = :slug, title = :title, sr_no = :sr_no, element_name = :element_name, element_id = :element_id, value = :value, h = :h, color = :color, tag = :tag, text_alignment = :text_alignment WHERE token = :token AND sr_no = :sr_no;";
        // $query = "SELECT * FROM user WHERE email=:email;";
        $stmt = $this->PDO->prepare($query);
        $stmt->bindValue(":token", $token, PDO::PARAM_STR);
        $stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":sr_no", $sr_no, PDO::PARAM_STR);
        $stmt->bindValue(":element_name", $element_name, PDO::PARAM_STR);
        $stmt->bindValue(":element_id", $element_id, PDO::PARAM_STR);
        $stmt->bindValue(":value", $value, PDO::PARAM_STR);
        $stmt->bindValue(":h", $h, PDO::PARAM_STR);
        $stmt->bindValue(":color", $color, PDO::PARAM_STR);
        $stmt->bindValue(":tag", $tag, PDO::PARAM_STR);
        $stmt->bindValue(":text_alignment", $text_alignment, PDO::PARAM_STR);
        try {
            if ($stmt->execute()) {
                echo json_encode(["message" => "Data updated successfully", "status" => true]);
                // $query = "DELETE * FROM main_blog WHERE token=:token AND slug=:slug;";
                // $stmt->bindValue(":token", $token, PDO::PARAM_STR);
                // $stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
            } else {
                echo json_encode(["message" => "Data insertation failed", "status" => false]);
            }
            // $data = $stmt->fetch(PDO::FETCH_ASSOC);
            // return $data;
        } catch (PDOException $e) {
            echo "error:" . $e->getMessage();
        }
    }

    public function check_if_token_and_sr_no($sr_no, $token)
    {
        $query = "SELECT COUNT(*) FROM main_blog WHERE sr_no=:sr_no AND token=:token;";
        $stmt = $this->PDO->prepare($query);
        $stmt->bindValue(":sr_no", $sr_no, PDO::PARAM_STR);
        $stmt->bindValue(":token", $token, PDO::PARAM_STR);
        try {
            $stmt->execute();
            $data = $stmt->fetchColumn();
            return $data;
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    // public function check_if_the_title_exist($sr_no, $value)
    // {
    //     $query = "SELECT COUNT(*) FROM main_blog WHERE sr_no=:sr_no AND value=:value;";
    //     $stmt = $this->PDO->prepare($query);
    //     $stmt->bindValue(":sr_no", $sr_no, PDO::PARAM_STR);
    //     $stmt->bindValue(":value", $value, PDO::PARAM_STR);
    //     try {
    //         $stmt->execute();
    //         $data = $stmt->fetchColumn();
    //         return $data;
    //     } catch (PDOException $e) {
    //         $e->getMessage();
    //     }
    // }
}
