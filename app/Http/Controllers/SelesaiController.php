<?php

namespace App\Http\Controllers;

use App\Models\selesai;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class SelesaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = selesai::latest()->get();
        $technicians = User::all();
        return view('pages.pekerjaan_selesai', compact('requests', 'technicians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Code to store data in the selesai table
        // ...

        // Also store the data in the history table
        History::create([
            'name' => $request->name,
            'category' => $request->category,
            'technician' => $request->technician,
            'progress_at' => $request->progress_at,
            'finished_at' => $request->finished_at,
            'duration' => $request->duration,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(selesai $selesai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(selesai $selesai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, selesai $selesai)
    {
        // Code to update data in the selesai table
        // ...

        // Also update the data in the history table
        $history = History::find($selesai->id);
        $history->update([
            'name' => $request->name,
            'category' => $request->category,
            'technician' => $request->technician,
            'progress_at' => $request->progress_at,
            'finished_at' => $request->finished_at,
            'duration' => $request->duration,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(selesai $selesai)
    {
        // Code to delete data from the selesai table
        // ...

        // Also delete the data from the history table
        History::destroy($selesai->id);
    }

    public function printToPDF()
    {
        Carbon::setLocale('id');
        $requests = selesai::latest()->get();

        $data = [
            'requests' => $requests
        ];

        $pdf = PDF::loadView('pdf.data_selesai', $data);

        return $pdf->download('Data_Selesai_Persero.pdf');
    }
    
    public function exportToExcel()
    {
    // Fetch requests with technician information
    $requests = selesai::with('technician')->latest()->get();

    $filename = "selesai_" . date('Ymd') . ".csv";
    
    $handle = fopen($filename, 'w+');
    fputcsv($handle, ['NUP', 'Nama', 'Divisi', 'No HP', 'Kategori Request', 'Deskripsi Request', 'Alasan Request', 'Teknisi', 'Created At', 'Updated At']);

    foreach ($requests as $row) {
        fputcsv($handle, [
            $row->nup,
            $row->nama,
            $row->divisi,
            $row->no_hp,
            $row->kategori_req,
            $row->deskripsi_req,
            $row->alasan_req,
            $row->technician ? $row->technician->name : 'N/A', // Fetch technician name
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
