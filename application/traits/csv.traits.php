<?php
trait Csv
{
    protected $_fileObject;
    protected $_result;

    private function getIterator()
    {
        $iterator = new LimitIterator($this->_fileObject, 1);
        return $iterator;
    }

    protected function setFile($file)
    {
        $this->_fileObject = new SplFileObject($file);
        return $this;
    }

    protected function setFlags($flag)
    {
        $this->_fileObject->setFlags($flag);
        return $this;
    }

    protected function parseResult()
    {
        $result = [];
        $iterator = $this->getIterator();
        foreach ($iterator as $key => $row)
        {
            if(!empty($row[0]) && !empty($row[1])  && !empty($row[2]))
            {
                list($result[$key]['name'],$result[$key]['phone'],$result[$key]['street']) = $row;
            }
        }
        $this->_result = $result;
        return $this;
    }

    protected function getResult()
    {
        $this->parseResult();
        return $this->_result;
    }

    protected function lineExists($lineId)
    {
        if (array_key_exists($lineId, $this->_result)) {
            return $this->_result[$lineId];
        } else {
            return false;
        }
    }
}