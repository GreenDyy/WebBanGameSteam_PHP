<?php
class Cart
{
    public $id_cart;
    public $id_user;
    public $code_cart;
    public $cart_status;
    public $id_game;
    public $quantity;
    public $price;
    public $address;
    public $total_price;

    
    public static function getAllCart($pdo) {
        $sql = "SELECT cart.*, fullname, sdt  from cart, users where id_user = users.id";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
            return $stmt->fetchAll();
        }
    }

    public static function getDetailCart($pdo, $code_cart) {
        $sql = "SELECT DISTINCT cart_detail.code_cart, name, fullname, sdt, quantity, price, total_price 
        FROM cart_detail, cart, users, game 
        WHERE cart_detail.code_cart = cart.code_cart AND cart.id_user = users.id and game.id = cart_detail.id_game 
        and cart_detail.code_cart = :code_cart";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':code_cart', $code_cart, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
            return $stmt->fetchAll();
        }
    }
    //lấy thông tin khách từ cartdetail
    
    public static function getThongTinKhach($pdo, $code_cart) {
        $sql ="SELECT DISTINCT fullname, sdt, address
        FROM cart_detail, cart, users
        WHERE cart_detail.code_cart = cart.code_cart AND cart.id_user = users.id
        and cart_detail.code_cart = :code_cart";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':code_cart', $code_cart, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cart');
            return $stmt->fetch();
        }
    }
    //tạo cart
    public function createCart($pdo) {
        $sql = "INSERT INTO cart(id_user, code_cart, cart_status) VALUES (:id_user, :code_cart, :cart_status)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $stmt->bindValue(':code_cart', $this->code_cart, PDO::PARAM_INT);
        $stmt->bindValue(':cart_status', $this->cart_status, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $this->id_cart = $pdo->lastInsertId();
            return true;
        }
    }
    //tạo detailcart
    public function createDetailCart($pdo) {
        $sql = "INSERT INTO cart_detail(code_cart, id_game, quantity, total_price, address) 
        VALUES (:code_cart, :id_game, :quantity, :total_price, :address)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':code_cart', $this->code_cart, PDO::PARAM_INT);
        $stmt->bindValue(':id_game', $this->id_game, PDO::PARAM_INT);
        $stmt->bindValue(':quantity', $this->quantity, PDO::PARAM_INT);
        $stmt->bindValue(':total_price', $this->total_price, PDO::PARAM_INT);
        $stmt->bindValue(':address', $this->address, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
    }
    //cập nhật trạng thái đơn hàng
    public function updateStatusCart($pdo, $id_cart)
    {
        $sql = "UPDATE cart SET cart_status = 1 WHERE id_cart = $id_cart";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $this->id_cart = $pdo->lastInsertId();
            return true;
        }
    }
    //delete đơn hàng
    public function deleteCart($pdo, $id_cart) 
    {
        $sql = "DELETE FROM cart WHERE id_cart = $id_cart";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $this->id_cart = $pdo->lastInsertId();
            return true;
        }
    }
}