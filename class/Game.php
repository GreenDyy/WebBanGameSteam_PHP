<?php
class Game
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;

    
    public static function getAll($pdo) {
        $sql = "SELECT * FROM game";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetchAll();
        }
    }
    public static function getPage($pdo, $limit, $offset) {
        $sql = "SELECT * FROM game ORDER BY id LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetchALL();
        }
    }
    public static function timGameTheoTheLoai($pdo, $limit, $offset, $genreid)
    {
        $sql = "SELECT game.*, genre.name as Genre FROM game 
        LEFT JOIN game_genre 
        ON game_genre.gameid = game.id
        LEFT JOIN genre
        ON game_genre.genreid = genre.id where genre.id = :genreid ORDER BY id LIMIT :limit OFFSET :offset";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':genreid', $genreid, PDO::PARAM_INT);

        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetchALL();
        }
    } 

    public static function getTheLoaiGame($pdo, $id)
    {
        $sql = "SELECT  genre.name as Genre, genre.id as GenreId FROM game
        LEFT JOIN game_genre 
        ON game_genre.gameid = game.id
        LEFT JOIN genre
        ON game_genre.genreid = genre.id where game.id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'game');
            return $stmt->fetchAll();
        }
    }
    //lay ten cua the loai game
    public static function getTenTheLoai($pdo, $genreid)
    {
        $sql = "SELECT name from genre WHERE id = :genreid";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':genreid', $genreid, PDO::PARAM_INT);

        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetch();
        }
    }

    public static function getOneByID($pdo, $id) {
        $sql = "SELECT * FROM game WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetch();
        }
    }

    public function createGame($pdo) {
        $sql = "INSERT INTO game(name, description, price, image) 
                VALUES (:name, :desc, :price, :image)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':desc', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_INT);
        $stmt->bindValue(':image', $this->image, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
    }

    public function createGameGenre($pdo, $gameid, $genreid) 
    {
        $sql = "INSERT INTO game_genre (gameid, genreid) VALUES ($gameid, $genreid)";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
    }
    
    public function updateGame($pdo, $id)
    {
        $sql = "UPDATE `game` SET `name`= :name,`description`= :desc,`price`= :price, `image`= :image WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':desc', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_INT);
        $stmt->bindValue(':image', $this->image, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
    }
    public function deleteGame($pdo, $id) 
    {
        $sql = "DELETE FROM `game` WHERE id = $id";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
    }
    public static function getAllGenreName($pdo)
    {
        $sql = "SELECT id, name from genre";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetchAll();
        }
    }
    // tim game
    public static function searchGame($pdo, $keyword, $limit, $offset) {
        $sql = "SELECT * FROM game WHERE name LIKE '%".$keyword."%' ORDER BY id LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        if ($stmt->execute()) {     
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetchAll();
        }
    }

    //sap xep tang dan theo gia
    public static function sapXepTheoGiaTang($pdo, $limit, $offset) {
        $sql = "SELECT * FROM game ORDER BY price ASC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetchALL();
        }
    }
    //sap xep giam dan theo gia
    public static function sapXepTheoGiaGiam($pdo, $limit, $offset) {
        $sql = "SELECT * FROM game ORDER BY price DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetchALL();
        }
    }     
    //sap xep ten A-Z
    public static function sapXepTheoTenAtoiZ($pdo, $limit, $offset) {
        $sql = "SELECT * FROM game ORDER BY name ASC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetchALL();
        }
    }     
    //sap xep ten A-Z
    public static function sapXepTheoTenZtoiA($pdo, $limit, $offset) {
        $sql = "SELECT * FROM game ORDER BY name DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        
        if($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetchALL();
        }
    }  
    //dem so ban ghi dùng trog index.php, index2 và sortgame.php
    public static function demSoBanGhi($pdo) {
        $sql = "SELECT COUNT(*) AS sobanghi FROM game";
        $stmt = $pdo->prepare($sql);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetch();
        }
    }
    //dem so ban ghi dùng trog gametheotheloai.php
    public static function demSoBanGhiTheoTheLoai($pdo, $genreid) {
        $sql = "SELECT COUNT(*) AS sobanghi FROM game LEFT JOIN game_genre 
        ON game_genre.gameid = game.id
        LEFT JOIN genre
        ON game_genre.genreid = genre.id where genre.id = :genreid";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':genreid', $genreid, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetch();
        }
    }
    //dem so ban ghi dùng trog searchgame.php
    public static function demSoBanGhiSearchGame($pdo, $keyword) {
        $sql = "SELECT COUNT(*) AS sobanghi FROM game WHERE name LIKE '%".$keyword."%'";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Game');
            return $stmt->fetch();
        }
    }
    //xoá genre ra khỏi game (dùng trog edit-game.php)
    
    public function deleteGenreFromGame($pdo, $id, $genreid) 
    {
        $sql = "DELETE FROM `game_genre` WHERE gameid = $id and genreid = $genreid";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        }
    }
}