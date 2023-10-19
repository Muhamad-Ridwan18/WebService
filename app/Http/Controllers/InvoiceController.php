<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return Invoice::all();
    }

    public function show($id)
    {
        return Invoice::find($id);
    }

    public function store(Request $request)
    {
        return Invoice::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->update($request->all());
        return $invoice;
    }

    public function destroy($id)
    {
        Invoice::find($id)->delete();
        return ['message' => 'Invoice deleted'];
    }
}
