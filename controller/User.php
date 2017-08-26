<?php
class User
{
    private $id;
    private $name;
    private $surname;
    private $telephone;
    private $email;
    private $password;
    private $role;
    public $db;

    public function __construct($id)
    {
        if (isset($id) && is_numeric($id))
        {
            $this->db = DataBase::getDB();

            $zap = $this->db->prepare("SELECT * FROM user WHERE id = :id");
            $zap->bindValue(":id", $id, PDO::PARAM_INT);
            $zap->execute();
            $tab = $zap->fetch(PDO::FETCH_ASSOC);
            $zap->closeCursor();

            $this->id = $tab['id'];
            $this->name = $tab['name'];
            $this->surname = $tab['surname'];
            $this->telephone = $tab['telephone'];
            $this->email = $tab['email'];
            $this->password = $tab['password'];
            $this->role = $tab['role'];
        }
        else
        {
            $this->role = 0;
        }
    }
    public function __destruct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }


    public function getRole()
    {
        return $this->role;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($var)
    {
        $this->email = $var;
        $zap = $this->db->prepare("UPDATE user SET email = :var WHERE id = :id");
        $zap->bindValue(":id", $this->id, PDO::PARAM_INT);
        $zap->bindValue(":var", $var, PDO::PARAM_STR);
        $zap->execute();
        $zap->closeCursor();
    }
    public function setPassword($var)
    {
        $zap = $this->db->prepare("UPDATE user SET password = :var WHERE id = :id");
        $zap->bindValue(":id", $this->id, PDO::PARAM_INT);
        $zap->bindValue(":var", sha1($var), PDO::PARAM_STR);
        $zap->execute();
        $zap->closeCursor();
    }
    public function setRole($var)
    {
        $this->role = $var;
        $zap = $this->db->prepare("UPDATE user SET role = :var WHERE id = ".$this->getId());
        $zap->bindValue(":var", $var, PDO::PARAM_INT);
        $zap->execute();
        $zap->closeCursor();
    }
    public function getCinemaOwner() {
        $zap = $this->db->prepare("SELECT id from cinema WHERE manager = :id");
        $zap->bindValue(":id", $this->id, PDO::PARAM_INT);
        $zap->execute();
        $baza = $zap->fetchAll(PDO::FETCH_COLUMN, 0);
        if(count($baza) == 1) {
            return $baza[0];
        }
        return false;
    }

}