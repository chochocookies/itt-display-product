<?php

namespace App\Http\Controllers;


use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class BarcodeController extends Controller
{
    public function generateBarcode($productCode)
    {
        $barcodeSvg = DNS1D::getBarcodeSVG($productCode, 'C128', 2, 50);
        return response($barcodeSvg, 200)->header('Content-Type', 'image/svg+xml');
    }
}
