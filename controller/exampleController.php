<?php

class exampleController extends Controller
{
	use Csv;

	public function index()
	{
		$this->setFile();
		$this->setFile(SplFileObject::READ_CSV);
		$result = $this->parseResult();

		if (isset($_GET['id']) && array_key_exists($_GET['id'], $result)) {
			$addresses = $result[$_GET['id']];
		} else {
			$addresses = $result;
		}

		$this->registry->template->addresses = $addresses;
		$this->registry->template->show('example');
	}
}