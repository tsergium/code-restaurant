<?php
trait Request
{
    protected $_params;
    protected $_response;
    protected $_requestMethod;
    protected $_errorCodes = array(
        100 => array( // missing fields
            'header'    => 'HTTP/1.1 400 Bad request',
            'message'   => 'Error: required field(s) missing.'
        ),
        101 => array( // data not found
            'header'    => 'HTTP/1.1 400 Bad request',
            'message'   => 'Error: data not found.'
        ),
        102 => array( // operation could not be completed
            'header'    => 'HTTP/1.1 400 Bad request',
            'message'   => 'Error: data not found.'
        ),        
        200 => array( // success create
            'header'    => 'HTTP/1.1 201 Created',
            'message'   => 'Success: save was successful.'
        ),
        201 => array( // success update
            'header'    => 'HTTP/1.1 201 Created',
            'message'   => 'Success: update was successful.'
        ),
        202 => array( // success delete
            'header'    => 'HTTP/1.1 200 OK',
            'message'   => 'Success: delete was successful.'
        ),
        500 => array( // method not allowed
            'header'    => 'HTTP/1.1 405 Method not allowed',
            'message'   => 'Error: method not allowed.'
        )
    );
    
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
			$GLOBALS["_{$this->_requestMethod}"] = $this->_params;
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
     * Error handling based on error codes
     * @param int $code
     */
    protected function errorHandling($code)
    {
        header($this->_errorCodes[$code]['header']);
        $this->_response['response'] = $this->_errorCodes[$code]['message'];
    }
    
    /**
     * Returns the response
     * @return json
     */
    public function __toString()
    {
        return json_encode($this->_response);
    }
    
    public function getRequestMethod()
    {
        $params = $this->getParams();
        $method = 'request' . $this->_requestMethod;
        
        if(is_callable(array($this, $method))){
            call_user_func_array(array($this,$method), array($params));
        } else {
            $this->errorHandling(100); // method not allowed
        }
        return $method;
    }
}