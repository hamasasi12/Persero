<?php

namespace App\Http\Controllers;

use App\Models\Perbaikan;
use Illuminate\Http\Request;
use Carbon\Carbon;  
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perbaikan = Perbaikan::all();
        return view('pages.permintaan_perbaikan', compact('perbaikan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.form-perbaikan');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'no_permintaan' => 'required',
        'pic_permintaan' => 'required',
        'departemen' => 'required',
        'tanggal_permintaan' => 'required',
        'deskripsi_permintaan' => 'required'
        ]);
        Perbaikan::create($request->all());
            return redirect()->route('Perbaikan.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        return view('pages.edit-data-perbaikan', compact('perbaikan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->update($request->all());
        return redirect()->route('Perbaikan.index')->with('success', 'Data Berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perbaikan = Perbaikan::findOrFail($id);
        $perbaikan->delete();
        return back()->with('info', 'Data telah dihapus');
    }

    public function printToPDF()
    {   
        Carbon::setLocale('id');
        $requests = Perbaikan::latest()->get();

    $data = [
        'requests' => $requests
    ];

    $pdf = PDF::loadView('pdf.perbaikan', $data);

    return $pdf->download('Data_Perbaikan_Persero.pdf');
    }

    public function exportToExcel()
    {
    // Fetch requests with technician information
    $requests = Perbaikan::latest()->get();

    $filename = "Perbaikan_" . date('Ymd') . ".csv";

    $handle = fopen($filename, 'w+');
    fputcsv($handle, ['no_permintaan', 'pic_permintaan','departemen','tanggal_permintaan','deskripsi_permintaan','Created At', 'Updated At']);

    foreach ($requests as $row) {
        fputcsv($handle, [
            $row->no_permintaan,
            $row->pic_permintaan,
            $row->departemen,
            $row->tanggal_permintaan,
            $row->deskripsi_permintaan,
            $row->created_at,
            $row->updated_at,
        ]);
    }

    fclose($handle);

    $headers = [
        'Content-Type' => 'text/csv',
    ];

    return Response::download($filename, $filename, $headers);
    }
}
