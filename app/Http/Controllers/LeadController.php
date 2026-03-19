<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Services\LeadAssignmentService;
use Smalot\PdfParser\Parser;

class LeadController extends Controller
{

    public function index()
    {
        $leads = Lead::latest()->paginate(10);
        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        return view('leads.create');
    }

    public function store(Request $request, LeadAssignmentService $service)
    {
        $vendedorId = $service->assignLead();

        Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
            'source' => $request->source,
            'probability' => $request->probability,
            'expected_revenue' => $request->expected_revenue,

            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'job_title' => $request->job_title,
            'notes' => $request->notes,

            'vendedor_id' => $vendedorId
        ]);

        return redirect()->route('leads.index');
    }

    public function import(Request $request, LeadAssignmentService $service)
    {
        $file = $request->file('file');

        if ($file->getClientOriginalExtension() === 'csv') {

            $rows = array_map('str_getcsv', file($file));

            foreach ($rows as $row) {

                $vendedorId = $service->assignLead();

                Lead::create([
                    'name' => $row[0] ?? 'Lead',
                    'email' => $row[1] ?? null,
                    'phone' => $row[2] ?? null,
                    'vendedor_id' => $vendedorId
                ]);
            }
        }

        if ($file->getClientOriginalExtension() === 'pdf') {

            $parser = new Parser();
            $pdf = $parser->parseFile($file);
            $text = $pdf->getText();

            $lines = explode("\n", $text);

            foreach ($lines as $line) {

                if (strlen(trim($line)) > 5) {

                    $vendedorId = $service->assignLead();

                    Lead::create([
                        'name' => $line,
                        'vendedor_id' => $vendedorId
                    ]);
                }
            }
        }

        return redirect()->route('leads.index');
    }
}