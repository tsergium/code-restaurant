<?php

class addressController extends Controller
{
    use Request;
    
    /**
     * Read User Address
     * @return boolean
     */
    protected function requestGET()
    {
        if(empty($this->_params['id']))
        {
            $this->errorHandling(100); // missing fields
        }
        else
        {
            $address = new Model_Address();
            if ($address->find($this->_params['id'])) {
                $this->_response['street'] = $address->getStreet();
                $this->_response['phone'] = $address->getPhone();
                $this->_response['name'] = $address->getName();
                return true;
            }
            else
            {
                $this->errorHandling(101); // data not found
            }
        }
        return false;
    }
    
    /**
     * Update User Address
     */
    protected function requestPOST()
    {
        // check required params
        if(empty($this->_params['id']))
        {
            $this->errorHandling(100); // missing fields
            return false;
        }

        $address = new Model_Address();
        if($address->find($this->_params['id'])){
            $address->setOptions($this->_params);
            if($address->save())
            {
                $this->errorHandling(201); // success update
                return true;
            }
        }else{
            $this->errorHandling(101); // data not found
            return false;
        }
    }
    
    /**
     * Create User Address
     * @return boolean
     */
    protected function requestPUT()
    {
        // check required params
        if(empty($this->_params['street']) || empty($this->_params['phone']) || empty($this->_params['name']))
        {
            $this->errorHandling(100); // missing fields
            return false;
        }

        $address = new Model_Address();
        $address->setOptions($this->_params);
        if($address->save())
        {
            $this->errorHandling(200); // success create
            return true;
        } else {
            $this->errorHandling(102); // operation could not be completed
            return false;
        }
    }
    /**
     * Delete User Address
     * @return boolean
     */
    protected function requestDELETE()
    {
        if (empty($this->_params['id'])) {
            $this->errorHandling(100); // missing fields
        }else{
            $address = new Model_Address();
            if ($address->delete($this->_params['id'])) {
                $this->errorHandling(202); // success delete
                return true;
            } else {
                $this->errorHandling(101); // data not found
            }
        }
        return false;
    }
    
	public function index()
	{		
		$this->getRequestMethod();
		echo $this;
	}
}