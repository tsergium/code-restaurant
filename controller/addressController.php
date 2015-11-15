<?php

Class addressController Extends baseController
{
	protected function getParams()
	{
		$params = array();
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method == "PUT" || $method == "DELETE")
		{
			parse_str(file_get_contents('php://input'), $params);
			$GLOBALS["_{$method}"] = $params;
			$_REQUEST = $params + $_REQUEST;
		}
		else if($method == "GET")
		{
			$params = $_GET;
		}
		else if ($method == "POST")
		{
			$params = $_POST;
		}

		return $params;
	}

	public function index()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$params = $this->getParams();
		$response = array();

		switch ($method) {
			case 'PUT':
				// Create
				if(empty($params['street']) || empty($params['phone']) || empty($params['name']))
				{
					header('HTTP/1.1 400 Bad request');
					$response['response'] = 'Error: required field(s) missing.';
				}
				else
				{
					$address = new address();
					$address->setOptions($params);
					if($address->save())
					{
						header('HTTP/1.1 201 Created');
						$response['response'] = 'Success: save was successful.';
					}
				}

				break;
			case 'POST':
				// Update
				if(empty($params['id']))
				{
					header('HTTP/1.1 400 Bad request');
					$response['response'] = 'Error: required field(s) missing.';
				}
				else
				{
					$address = new address();
					$address->find($params['id']);
					$address->setOptions($params);
					if($address->save())
					{
						header('HTTP/1.1 201 Created');
						$response['response'] = 'Success: update was successful.';
					}
				}

				break;
			case 'GET':
				// Read
				if(empty($params['id']))
				{
					header('HTTP/1.1 400 Bad request');
					$response['response'] = 'Error: required field(s) missing.';
				}
				else
				{
					$address = new address();
					if ($address->find($params['id'])) {
						$response['street'] = $address->getStreet();
						$response['phone'] = $address->getPhone();
						$response['name'] = $address->getName();
					}
					else
					{
						$response['response'] = 'Error: unable to find address.';
					}
				}

				break;
			case 'DELETE':
				// Delete
				if(empty($params['id']))
				{
					header('HTTP/1.1 400 Bad request');
					$response['response'] = 'Error: required field(s) missing.';
				}
				else
				{
					$address = new address();
					if ($address->delete($params['id'])) {
						$response['response'] = 'Success: delete was successful.';
					} else {
						$response['response'] = 'Error: unable to delete.';
					}
				}

				break;
			default:
				header('HTTP/1.1 405 Method not allowed');
				header('Allow: PUT, POST, GET, DELETE');

				break;
		}
		echo json_encode($response);
	}

	public function example()
	{
		$addresses = array();
		$path = __SITE_PATH . "/example.csv";

		$file = new SplFileObject($path);
		$file->setFlags(SplFileObject::READ_CSV);
		$iterator = new LimitIterator($file, 1);

		foreach ($iterator as $key => $row)
		{
			if(!empty($row[0]) && !empty($row[1])  && !empty($row[2]))
			{
				list($addresses[$key]['name'],$addresses[$key]['phone'],$addresses[$key]['street']) = $row;
			}
		}

		if($_GET['id'] && array_key_exists($_GET['id'], $addresses))
		{
			$addresses = $addresses[$_GET['id']];
		}

		$this->registry->template->addresses = $addresses;
		$this->registry->template->show('address');
	}
}