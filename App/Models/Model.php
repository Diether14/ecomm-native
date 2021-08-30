<?php
require '../../App/Config/Database.php';

class Model {
    protected $db;
    public $conn;
    protected $primaryKey = 'id';
    protected $hidden = [];
    private $publicColumns;
    private $query;
    private $params;

	public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->connection();
        $this->query = '';
        $this->setVisibleColumns();
	}

    public function find($id) {
        $this->query = "SELECT $this->publicColumns FROM $this->table WHERE $this->$primaryKey = :id";
        $stmt = $this->conn->prepare($this->query);
		$stmt->bindParam(':appointment_id', $appointment_id);
		$stmt->execute();
        return $result;
    }

    public function findAll(){
        $this->query = "SELECT $this->publicColumns FROM $this->table";
        $stmt = $this->conn->prepare($this->query);
		$stmt->bindParam(':table', $this->table);
		$stmt->execute();
        return $stmt;
    }

    public function create($request) {
        try{
			$this->query = "INSERT INTO $this->table (";
            $count = 0;
            $length = count($request) - 1;
            $fields = '';
            $values = '';
            foreach ($request as $index => $val) {
                if($count == $length) {
                    $fields .= "$index) VALUES (";
                    $values .= ":$index)";
                } else {
                    $fields .= "$index, ";
                    $values .= ":$index, ";
                }
                $count++;
            }

            $this->query .= $fields;
            $this->query .= $values;
            $stmt = $this->conn->prepare($this->query);
            foreach ($request as $index => $val) {
                $stmt->bindValue(":$index", $val);
            }
			$stmt->execute();

			return 200;
		}
		catch(PDOException $x){
            echo $x->getMessage();
			return $x;
		}
    }

    private function setVisibleColumns() {
        $q = "SELECT `COLUMN_NAME` FROM INFORMATION_SCHEMA.COLUMNS WHERE `TABLE_SCHEMA` = 'ecommerce' AND TABLE_NAME = :table";
        $stmt = $this->conn->prepare($q);
		$stmt->bindParam(':table', $this->table);
		$stmt->execute();
        $result =  $stmt->fetchAll(PDO::FETCH_COLUMN);
        $publicColumns = array_diff($result, $this->hidden);
        $this->publicColumns = "";
        foreach ($publicColumns as $index => $column) {
            if($index == 0) {
                $this->publicColumns .= $column;
            } else {
                $this->publicColumns .= ', '. $column;
            }
        }
    }

    public function getTableName() {
        return $this->table;
    }
}
