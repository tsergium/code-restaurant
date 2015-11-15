<?php

class exampleController extends Controller
{
	use Csv;

	public function index()
	{
		$this->setFile(__SITE_PATH . DIRECTORY_SEPARATOR . 'example.csv');
		$this->setFlags(SplFileObject::READ_CSV);
		$result = $this->getResult();

		$lineId = isset($_GET['id']) ? $_GET['id'] : 0;
		$addresses = !empty($lineId) ? $this->lineExists($lineId) : $result;

		$this->registry->template->addresses = $addresses;
		$this->registry->template->show('example');
	}
}