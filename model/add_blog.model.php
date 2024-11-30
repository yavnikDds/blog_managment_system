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


    public function create_new_blog_element($token, $slug, $page_elements)
    {
        $page_elements = json_encode($page_elements);
        $query = "INSERT INTO main_blog (token, slug, page_elements) VALUE(:token, :slug, :page_elements);";
        // $query = "SELECT * FROM user WHERE email=:email;";
        $stmt = $this->PDO->prepare($query);
        $stmt->bindValue(":token", $token, PDO::PARAM_STR);
        $stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindValue(":page_elements", $page_elements, PDO::PARAM_STR);
        // $stmt->bindParam(":page_elements", $page_elements);
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

    public function update_new_blog_element($token, $slug, $page_elements)
    {
        // $query = "INSERT INTO main_blog (token, slug, title, sr_no, element_name, element_id, value, h, color, tag, text_alignment) VALUE(:token, :slug, :title, :sr_no, :element_name, :element_id, :value, :h, :color, :tag, :text_alignment);";
        $query = "UPDATE main_blog SET token = :token, slug = :slug, page_elements = :page_elements WHERE token = :token;";
        // $query = "SELECT * FROM user WHERE email=:email;";
        $stmt = $this->PDO->prepare($query);
        $stmt->bindValue(":token", $token, PDO::PARAM_STR);
        $stmt->bindValue(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindParam(":page_elements", $page_elements);
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

    public function do_page_needs_to_be_updated($token)
    {
        $query = "SELECT COUNT(*) FROM main_blog WHERE token=:token;";
        $stmt = $this->PDO->prepare($query);
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
