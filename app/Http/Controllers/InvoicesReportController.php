<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicesReportController extends Controller
{
    public function index()
    {
        return view('reports.invoices_report');
    }

    public function searchInvoices(Request $request)
    {

        $rdio = $request->rdio;

        if ($rdio == 1) {
            // Search by invoice type
            $type = $request->type;
            $startAt = $request->start_at;
            $endAt = $request->end_at;

            $invoices = Invoice::query()
                ->where('Status', $type);

            if ($startAt && $endAt) {
                $invoices->whereBetween('invoice_Date', [$startAt, $endAt]);
            }

            $invoices = $invoices->get();

            return view('reports.invoices_report', compact('type', 'startAt', 'endAt', 'invoices'));
        } else {
            // Search by invoice number
            $invoiceNumber = $request->invoice_number;
            $invoices = Invoice::select('*')->where('invoice_number', $invoiceNumber)->get();

            return view('reports.invoices_report', compact('invoices'));
        }
    }
}
