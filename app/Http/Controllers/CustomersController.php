<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Sections;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        $sections = Sections::all();
        return view('reports.customers_report', compact('sections'));
    }

    public function Search_customers(Request $request)
    {

        $sectionId = $request->section;
        $product = $request->product;
        $startAt = $request->start_at;
        $endAt = $request->end_at;

        $invoices = Invoice::query()
            ->where('section_id', $sectionId)
            ->where('product', $product);

        if ($startAt && $endAt) {
            $invoices->whereBetween('invoice_date', [$startAt, $endAt]);
        }

        $invoices = $invoices->get();
        $sections = Sections::all();

        return view('reports.customers_report', compact('sections', 'invoices'));
    }
}
