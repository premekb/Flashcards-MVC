<?
/**
 * This class connects to the database using PDO.
 */
class Db {
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "flashcards";

    /**
     * Returns a connection to the DB.
     * 
     * @return resource
     */
    protected function connect() {
        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
            $pdo = new PDO($dsn, $this->user, $this->pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection to the DB failed: " . $e->getMessage();
        }
    }
}