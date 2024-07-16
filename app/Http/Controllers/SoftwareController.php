<?php

namespace App\Http\Controllers;

use App\Models\TambahDataSoftware;
use Illuminate\Http\Request;
use Carbon\Carbon;  
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $software = TambahDataSoftware::latest()->get();
        return view('pages.software', compact('software'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.form-data-software');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_aplikasi' =>'nullable',
            'tahun' => 'nullable',
            'no_inventaris' => 'nullable',
            'nama_aplikasi' => 'nullable',
            'pengguna' => 'nullable',
            'divisi' => 'nullable'
        ]);
            TambahDataSoftware::create($request->all());
            return redirect()->route('TambahDataSoftware.index')->with('message', 'Data Berhasil Ditambahkan');
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
        $software = TambahDataSoftware::findOrFail($id);
        return view('pages.edit-data-software', compact('software'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $software = TambahDataSoftware::findOrFail($id);
        $software->update($request->all());
        return redirect()->route('TambahDataSoftware.index')->with('message', 'Data Berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $software = TambahDataSoftware::findOrFail($id);
        $software->delete();
        return back()->with('info', 'Data telah dihapus');
    }

    public function printToPDF()
    {   
        Carbon::setLocale('id');
        $requests = TambahDataSoftware::latest()->get();

    $data = [
        'requests' => $requests
    ];

    $pdf = PDF::loadView('pdf.software', $data);

    return $pdf->download('Data_Software_Persero.pdf');
    }

    public function exportToExcel()
    {
    // Fetch requests with technician information
    $requests = TambahDataSoftware::latest()->get();

    $filename = "software_" . date('Ymd') . ".csv";

    $handle = fopen($filename, 'w+');
    fputcsv($handle, ['no_inventaris', 'tahun','jenis_aplikasi','nama_aplikasi','pengguna','divisi','Created At', 'Updated At']);

    foreach ($requests as $row) {
        fputcsv($handle, [
            $row->no_inventaris,
            $row->tahun,
            $row->jenis_aplikasi,
            $row->nama_aplikasi,
            $row->pengguna,
            $row->divisi,
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
