<?php

class exampleController extends Controller
{
    
	public function index()
	{
		$addresses = array();
		$file = new SplFileObject(__SITE_PATH . "/example.csv");
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
		$this->registry->template->show('example');
	}
}