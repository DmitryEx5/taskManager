<?php

/**
 * Class UserModel
 */
class UserModel extends Model
{

    /**
     * @param $id
     * @return object|stdClass
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM users WHERE id = {$id}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_object(UserModel::class);
    }

    /**
     * @param string $username
     * @param string $pwd
     * @return object|stdClass
     */
    public function getByParams($username, $pwd)
    {
        $sql = "SELECT * FROM users WHERE username='{$username}' AND password='{$pwd}'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_object(UserModel::class);
    }

}
