<?php

require_once MODEL_PATH . "UserModel.php";

/**
 * Class TaskModel
 */
class TaskModel extends Model
{

    /**
     * TaskModel constructor.
     */
    public function __construct()
    {
        parent::__construct();
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
     * @return mixed
     */
    public function countAll()
    {
        $sql = "SELECT COUNT(*) FROM tasks";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->get_result()->fetch_row()[0];
    }

    /**
     * @param int $leftLimit
     * @param int $rightLimit
     * @return mixed
     */
    public function getLimitTasks($leftLimit, $rightLimit, $orderBy = 'id ASC')
    {
        $sql = "SELECT * FROM tasks ORDER BY {$orderBy} LIMIT {$leftLimit}, {$rightLimit}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $this->getStatusText($result);
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

    /**
     * @param string $username
     * @param string $email
     * @param string $task
     * @return bool
     */
    public function createTask($username, $email, $task)
    {
        $sql = "INSERT INTO tasks(username, email, task, status)
                VALUES('{$username}', '{$email}', '{$task}', 1)
                ";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute();
    }

    /**
     * @param int $id
     * @param string $task
     * @param int $status
     * @param bool $statusOnly
     * @return bool
     */
    public function updateTask($id, $task, $status, $statusOnly = FALSE)
    {
        if ($statusOnly) {
            $sql = "UPDATE tasks
                SET status = {$status}
                WHERE id = {$id}
                ";
        } else {
            $sql = "UPDATE tasks
                SET task = '{$task}', was_edited = 1
                WHERE id = {$id}
                ";
        }
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteTask($id)
    {
        $sql = "DELETE FROM tasks WHERE id = {$id}";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }

}
