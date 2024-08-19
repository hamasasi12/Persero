<?php

namespace App\Http\Controllers;

use App\Models\TambahDataHardware;
use Illuminate\Http\Request;
use Carbon\Carbon;  
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;


class HardwareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hardware = TambahDataHardware::latest()->get();
        return view('pages.hardware', compact('hardware'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.form-hardware');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_inventaris' =>'required',
            'tahun' =>'required',
            'jenis' =>'required',
            'merek' =>'required',
            'proc' =>'required',
            'ram' =>'required',
            'hdd' =>'required',
            'ip' =>'required',
            'user' =>'required',  
            'unit' =>'required',
            'lokasi' =>'required',
            'status' =>'required',
            'windows' =>'required',
            'office' =>'required',
            'garansi' =>'required',
        ]);
            TambahDataHardware::create($request->all());
            return redirect()->route('TambahDataHardware.index')->with('success', 'Data Berhasil Ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hardware = TambahDataHardware::findOrFail($id);
        return view('pages.edit-data-hardware', compact('hardware'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hardware = TambahDataHardware::findOrFail($id);
        $hardware->update($request->all());
        return redirect()->route('TambahDataHardware.index')->with('success', 'Data Berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hardware = TambahDataHardware::findOrFail($id);
        $hardware->delete();
        return back()->with('success', 'Data telah dihapus');
    }

    public function printToPDF()
    {
        Carbon::setLocale('id');
        $requests = TambahDataHardware::latest()->get();

        $data = [
            'requests' => $requests
        ];

        $pdf = PDF::loadView('pdf.hardware', $data)
                  ->setPaper('A4', 'landscape'); // Set landscape orientation for better table fit

        return $pdf->download('Data_Hardware_Persero.pdf');
    }

    public function exportToExcel()
    {
    // Fetch requests with technician information
    $requests = TambahDataHardware::latest()->get();

    $filename = "hardware_" . date('Ymd') . ".csv";

    $handle = fopen($filename, 'w+');
    fputcsv($handle, ['no_inventaris', 'tahun', 'jenis', 'merek', 'proc', 'ram', 'hdd', 'ip', 'user', 'unit', 'lokasi', 'status', 'windows','office','garansi','created_at','updated_at']);

    foreach ($requests as $row) {
        fputcsv($handle, [
            $row->no_inventaris,
            $row->tahun,
            $row->jenis,
            $row->merek,
            $row->proc,
            $row->ram,
            $row->hdd,
            $row->ip,
            $row->user,
            $row->unit,
            $row->lokasi,
            $row->status,
            $row->windows,
            $row->office,
            $row->garansi,
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
