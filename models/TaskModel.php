<?php

require_once MODEL_PATH . "UserModel.php";

/**
 * Class TaskModel
 */
class TaskModel extends Model
{
    /**
     * @var int
     */
    public $userId;

    /**
     * @var string
     */
    public $task;

    /**
     * @var string
     */
    public $status;

    /**
     * TaskModel constructor.
     * @param array $fields
     */
    public function __construct($fields = [])
    {
        parent::__construct($fields);
        $this->fields['user'] = 'Пользователь';
        $this->fields['email'] = 'Почта';
        $this->fields['task'] = 'Задача';
        $this->fields['status'] = 'Статус';

    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $sql = "SELECT * FROM tasks";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * @param int $leftLimit
     * @param int $rightLimit
     * @return mixed
     */
    public function getLimitTasks($leftLimit, $rightLimit)
    {
        $sql = "SELECT * FROM tasks LIMIT {$leftLimit}, {$rightLimit}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $result = $this->getStatusText($result);
        return $this->addUserData($result);
    }

    /**
     * @param $data
     * @return mixed
     */
    private function addUserData($data)
    {
        $userModel = new UserModel();
        foreach ($data as $key => $item) {
            $user = $userModel->getById($item['user_id']);
            $item['email'] = $user->email;
            $item['username'] = $user->username;
            $data[$key] = $item;
        }

        return $data;
    }

    /**
     * @param array $data
     * @return mixed
     */
    private function getStatusText($data)
    {
        foreach ($data as $key => $item) {
            $item['status'] = TaskStatus::getStatusName($item['status']);
            $data[$key] = $item;
        }

        return $data;
    }

//    public function saveProductInfo($id, $name, $price) {
//        $sql = "UPDATE products
//                SET price = :price, name = :name
//                WHERE id = :id
//                ";
//        $stmt = $this->db->prepare($sql);
//        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
//        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
//        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
//        $stmt->execute();
//        return true;
//    }
//
//
//    public function addProduct($productName, $productPrice) {
//        $sql = "INSERT INTO products(name, price)
//                VALUES(:productName, :productPrice)
//                ";
//        $stmt = $this->db->prepare($sql);
//        $stmt->bindValue(":productName", $productName, PDO::PARAM_STR);
//        $stmt->bindValue(":productPrice", $productPrice, PDO::PARAM_INT);
//        $stmt->execute();
//        return true;
//    }
//
//    public function deleteProduct($id) {
//        $sql = "DELETE FROM products WHERE id = :id";
//        $stmt = $this->db->prepare($sql);
//        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
//        $stmt->execute();
//        $count = $stmt->rowCount();
//        if($count > 0) {
//            return true;
//        } else {
//            return false;
//        }
//    }

}
