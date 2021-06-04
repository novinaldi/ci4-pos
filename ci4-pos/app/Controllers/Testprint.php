<?php

namespace App\Controllers;

use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class Testprint extends BaseController
{
    public function index()
    {
        $connector = new FilePrintConnector("php://stdout");
        $printer = new Printer($connector);
        $printer->text("Hello World!\n");
        $printer->cut();
        $printer->close();
    }
}