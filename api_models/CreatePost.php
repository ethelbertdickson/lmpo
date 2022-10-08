<?php

class CreatePost
{
    //db stuffs
    private $conn;
    private $table = 'users';

    //post properties remote
    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $state_id;
    public $support_group;
    public $lga_id;
    public $gender;
    public $pvc_status;
    public $pu_id;
    public $ward_id;
    public $religion_id;
    public $create_at;
    public $updated_at;

    //constructor with db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //create post
    public function create()
    {
        //create query;
        $query = 'INSERT INTO ' . $this->table . '
        SET 
        first_name = :first_name,
        last_name = :last_name,
        phone = :phone,
        email = :email;
        state_id = :state_id
        lga_id = :lga_id
        ward_id = :ward_id
        pu_id = :pu_id
        gender = :gender
        pvc_status = :pvc_status
        
        ';


        //prepare statement
        $stmt = $this->conn->prepare($query);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->state_id = htmlspecialchars(strip_tags($this->state_id));
        $this->lga_id = htmlspecialchars(strip_tags($this->lga_id));
        $this->ward_id = htmlspecialchars(strip_tags($this->ward_id));
        $this->pu_id = htmlspecialchars(strip_tags($this->pu_id));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->pvc_status = htmlspecialchars(strip_tags($this->pvc_status));
        // $this->create_at = htmlspecialchars(strip_tags($this->create_at));
        // $this->update_at = htmlspecialchars(strip_tags($this->update_at));

        //bind data
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':state_id', $this->state_id);
        $stmt->bindParam(':pu_id', $this->pu_id);
        $stmt->bindParam(':ward_id', $this->ward_id);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':pvc_status', $this->pvc_status);
        $stmt->bindParam(':lga_id', $this->lga_id);
        // $stmt->bindParam(':create_at', $this->create_at);
        // $stmt->bindParam(':update_at', $this->update_at);

        if ($stmt->execute()) {
            return true;
        } else {

            printf("Error: %s.\n", $stmt->error);
        }


        return false;
    }
}
