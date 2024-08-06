<?php 
require_once __DIR__ . '/../../../config/database.php';

class DcodeDao {
    private $table = 'discount_codes';
    public $database;
    public $db;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
    }


    public function getDiscountByCode($code) {
        $sql = "SELECT * FROM discount_codes WHERE code = :code AND expiry_date > NOW()";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addDiscountCode($code, $amount, $expiryDate) {
        $stmt = $this->db->prepare("INSERT INTO discount_codes (code, amount, expiry_date) VALUES (?, ?, ?)");
        $stmt->execute([$code, $amount, $expiryDate]);
    }

    public function getAllDiscountCodes() {
        $stmt = $this->db->query("SELECT * FROM discount_codes WHERE expiry_date >= CURDATE()");
        return $stmt->fetchAll();
    }
    public function getDiscountAmountByCode($code) {
        $stmt = $this->db->prepare("SELECT amount FROM discount_codes WHERE code = :code");
        $stmt->bindParam(':code', $code, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['amount'] : 0;
    }
}
?>