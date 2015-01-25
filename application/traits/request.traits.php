<?php
trait Request
{
    protected $_params;
    protected $_response;
    protected $_requestMethod;
    
    /**
     * Fetch Params
     * @return array
     */
	protected function getParams()
	{
		$params = array();
		$this->_requestMethod = $_SERVER['REQUEST_METHOD'];
		if ($this->_requestMethod == "PUT" || $this->_requestMethod == "DELETE")
		{
			parse_str(file_get_contents('php://input'), $this->_params);
			$GLOBALS["_{$method}"] = $this->_params;
			$_REQUEST = $this->_params + $_REQUEST;
		}
		else if($this->_requestMethod == "GET")
		{
			$this->_params = $_GET;
		}
		else if ($this->_requestMethod == "POST")
		{
			$this->_params = $_POST;
		}

		return $params;
	}
    
    /**
     * Read User Address
     * @return boolean
     */
    protected function requestGET()
    {
        if(empty($this->_params['id']))
        {
            header('HTTP/1.1 400 Bad request');
            $this->_response['response'] = 'Error: required field(s) missing.';
        }
        else
        {
            $address = new address();
            if ($address->find($this->_params['id'])) {
                $this->_response['street'] = $address->getStreet();
                $this->_response['phone'] = $address->getPhone();
                $this->_response['name'] = $address->getName();
                return true;
            }
            else
            {
                $this->_response['response'] = 'Error: unable to find address.';
            }
        }
        return false;
    }
    
    /**
     * Update User Address
     */
    protected function requestPOST()
    {
        if(empty($this->_params['id']))
        {
            header('HTTP/1.1 400 Bad request');
            $this->_response['response'] = 'Error: required field(s) missing.';
        }
        else
        {
            $address = new address();
            if($address->find($this->_params['id'])){
                $address->setOptions($this->_params);
                if($address->save())
                {
                    header('HTTP/1.1 201 Created');
                    $this->_response['response'] = 'Success: update was successful.';
                    return true;
                }   
            }else{
                header('HTTP/1.1 400 Bad request');
                $this->_response['response'] = 'Error: unable to update.';
            }
        }
        return false;
    }
    
    /**
     * Create User Address
     * @return boolean
     */
    protected function requestPUT()
    {
        if(empty($this->_params['street']) || empty($this->_params['phone']) || empty($this->_params['name']))
        {
            header('HTTP/1.1 400 Bad request');
            $this->_response['response'] = 'Error: required field(s) missing.';
        }
        else
        {
            $address = new address();
            $address->setOptions($this->_params);
            if($address->save())
            {
                header('HTTP/1.1 201 Created');
                $this->_response['response'] = 'Success: save was successful.';
                return true;
            }
        }
        return false;
    }
    /**
     * Delete User Address
     * @return boolean
     */
    protected function requestDELETE()
    {
        if (empty($this->_params['id'])) {
            header('HTTP/1.1 400 Bad request');
            $this->_response['response'] = 'Error: required field(s) missing.';
        }else{
            $address = new address();
            if ($address->delete($this->_params['id'])) {
                $this->_response['response'] = 'Success: delete was successful.';
                return true;
            } else {
                $this->_response['response'] = 'Error: unable to delete.';
            }
        }
        return false;
    }
    
    /**
     * Returns the response
     * @return json
     */
    public function __toString()
    {
        return json_encode($this->_response);
    }
}