<?php

$path = $_SERVER['PATH_INFO'];

if ($path == '/address')
{
  $controller = new \Controller();
  $return = $controller->ex();
  echo $return;
}

class Controller
{
  protected $addresses = array();

  public function ex()
  {
    $this->rcd();
    $id = $_GET['id'];
    $address = $this->addresses[$id];
    return json_encode($address);
  }

  private function rcd()
  {
    $file = fopen('example.csv', 'r');
    while (($line = fgetcsv($file)) !== FALSE) {
        $this->addresses[] = [
            'name' => $line[0],
            'phone' => $line[1],
            'street' => $line[2]
        ];
    }

    fclose($file);
  }
}

