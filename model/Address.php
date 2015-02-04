<?php
class Model_Address
{
    protected $_id;
    protected $_street;
    protected $_phone;
    protected $_name;

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if(in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setStreet($street)
    {
        $this->_street = (string) $street;
        return $this;
    }

    public function getStreet()
    {
        return $this->_street;
    }

    public function setPhone($phone)
    {
        $this->_phone = (string) $phone;
        return $this;
    }

    public function getPhone()
    {
        return $this->_phone;
    }

    public function setName($name)
    {
        $this->_name = (string) $name;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function find($id)
    {
        $db = db::getInstance();

        $statement = $db->query("SELECT `id`, `street`, `phone`, `name` FROM `address` WHERE `id` = '{$id}' LIMIT 1 ");
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $row = $statement->fetch();

        if(!$row){
            return false;
        }

        $this->setOptions($row);

        return $this;
    }

    public function save()
    {
        if($this->_id) {
            $result = $this->update();
        } else {
            $result = $this->insert();
        }

        return $result;
    }

    private function update()
    {
        $db = db::getInstance();
        $options = array(
            'id'        => $this->_id,
            ':street'   => $this->_street,
            ':phone'    => $this->_phone,
            ':name'     => $this->_name
        );
        $sql = "UPDATE `address` SET `street` = :street, `phone` = :phone, `name` = :name WHERE `id` = :id";
        $statement = $db->prepare($sql);
        return $statement->execute($options);
    }

    private function insert()
    {
        $db = db::getInstance();
        $options = array(
            ':street'   => $this->_street,
            ':phone'    => $this->_phone,
            ':name'     => $this->_name
        );
        $options[':id'] = $this->_id;
        $sql = "INSERT INTO `address` ( `street`, `phone`, `name` ) VALUES ( :street, :phone, :name )";
        $statement = $db->prepare($sql);
        return $statement->execute($options);
    }

    public function delete($id)
    {
        $db = db::getInstance();

        $statement = $db->prepare("DELETE FROM `address` WHERE `id` = :id");
        $result = $statement->execute(array(':id' => $id));

        return $result;
    }
}