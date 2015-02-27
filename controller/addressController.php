<?php

class addressController extends Controller
{
    use Request;

    /**
     * Read User Address
     * @param Model_Address $address
     * @return bool
     */
    protected function requestGET(Model_Address $address)
    {
        if(empty($this->_params['id'])) {
            $this->errorHandling(100); // missing fields
        }

        if ($address->find($this->_params['id'])) {
            $this->_response['street'] = $address->getStreet();
            $this->_response['phone'] = $address->getPhone();
            $this->_response['name'] = $address->getName();
            return true;
        } else {
            $this->errorHandling(101); // data not found
        }

        return false;
    }

    /**
     * Update User Address
     * @param Model_Address $address
     * @return bool
     */
    protected function requestPOST(Model_Address $address)
    {
        // check required params
        $required = ['id'];
        if($this->checkRequired($required)) {
            $this->errorHandling(100); // missing fields
            return false;
        }

        if($address->find($this->_params['id'])){
            $address->setOptions($this->_params);
            if($address->save()) {
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
     * @param Model_Address $address
     * @return bool
     */
    protected function requestPUT(Model_Address $address)
    {
        // check required params
        $required = array('street', 'phone', 'name');
        if($this->checkRequired($required)) {
            $this->errorHandling(100); // missing fields
            return false;
        }

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
     * @param Model_Address $address
     * @return bool
     */
    protected function requestDELETE(Model_Address $address)
    {
        if (empty($this->_params['id'])) {
            $this->errorHandling(100); // missing fields
        }else{
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