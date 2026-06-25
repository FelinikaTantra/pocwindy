<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class CatalogPdfController extends Controller
{
    public function download()
    {
        // Get all active products with categories and images
        $products = Product::with(['category', 'images'])->where('is_active', true)->get();
        
        $pdf = Pdf::loadView('pdf.catalog', compact('products'));
        
        // Set paper format
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('e-catalog-' . date('Y-m-d') . '.pdf');
    }
}
