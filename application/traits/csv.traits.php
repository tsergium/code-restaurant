<?php
trait Csv
{
    protected $_fileObject;

    private function getIterator()
    {
        $iterator = new LimitIterator($this->_fileObject, 1);
        return $iterator;
    }

    protected function setFile()
    {
        /*
         * ToDo: dynamic file; weird error on SplFileObject
         */
        $this->_fileObject = new SplFileObject(__SITE_PATH . DIRECTORY_SEPARATOR . 'example.csv');
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
        return $result;
    }
}