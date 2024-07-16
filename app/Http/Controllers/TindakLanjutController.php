<?php

namespace App\Http\Controllers;

use App\Models\TindakLanjut;
use Illuminate\Http\Request;
use Carbon\Carbon;  
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class TindakLanjutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tindaklanjut = TindakLanjut::all();
        return view('pages.tindaklanjut_perbaikan', compact('tindaklanjut'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.form-tindaklanjut');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'tanggal' => 'required',
           'pic' => 'required',
           'kode_asset' => 'required',
           'keterangan' => 'required',
           'status' => 'required',
            ]);

        TindakLanjut::create($request->all());
        return redirect()->route('Tindaklanjut.index')->with('success', 'Post created successfully.');
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
        $perbaikan = TindakLanjut::findOrFail($id);
        return view('pages.edit-data-tindaklanjut', compact('perbaikan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perbaikan = TindakLanjut::findOrFail($id);
        $perbaikan->update($request->all());
        return redirect()->route('Tindaklanjut.index')->with('success', 'Data Berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perbaikan = TindakLanjut::findOrFail($id);
        $perbaikan->delete();
        return back()->with('info', 'Data telah dihapus');
    }

    public function printToPDF()
    {   
        Carbon::setLocale('id');
        $requests = TindakLanjut::latest()->get();

    $data = [
        'requests' => $requests
    ];

    $pdf = PDF::loadView('pdf.tindaklanjut', $data);

    return $pdf->download('Data_Tindaklanjut_Persero.pdf');
    }

    public function exportToExcel()
    {
    // Fetch requests with technician information
    $requests = TindakLanjut::latest()->get();

    $filename = "Tindaklanjut_" . date('Ymd') . ".csv";

    $handle = fopen($filename, 'w+');
    fputcsv($handle, ['kode_asset', 'keterangan','status','pic','tanggal','Created At', 'Updated At']);

    foreach ($requests as $row) {
        fputcsv($handle, [
            $row->kode_asset,
            $row->keterangan,
            $row->status,
            $row->pic,
            $row->tanggal_,
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
