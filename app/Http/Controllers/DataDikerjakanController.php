<?php

namespace App\Http\Controllers;

use App\Models\Dikerjakan;
use App\Models\selesai;
use Illuminate\Http\Request;
use App\Models\RequestUser;
use App\Models\User;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\History;
use Illuminate\Support\Facades\Response;



class DataDikerjakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = Dikerjakan::latest()->get();
        $technicians = User::all();
        return view('pages.dikerjakan', compact('requests', 'technicians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = Dikerjakan::findOrFail($id); // Misalnya, ambil data request berdasarkan ID
        return view('pages.pekerjaan_selesai', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function moveToSelesai($id)
    {
        // Mengambil data permintaan berdasarkan ID
        $request = Dikerjakan::find($id);
        
        if ($request) {
            // Membuat entri baru di tabel dikerjakan
            $selesai = new selesai();
            $selesai->nup = $request->nup;
            $selesai->nama = $request->nama;
            $selesai->divisi = $request->divisi;
            $selesai->no_hp = $request->no_hp;
            $selesai->kategori_req = $request->kategori_req;
            $selesai->deskripsi_req = $request->deskripsi_req;
            $selesai->alasan_req = $request->alasan_req;
            $selesai->upload_gambar = $request->upload_gambar;
            $selesai->upload_file = $request->upload_file;
            $selesai->teknisi = $request->teknisi;
            $selesai->save();

            // Menghapus data dari tabel permintaan
            $request->delete();

            return redirect()->back()->with('success', 'Data berhasil dipindahkan ke tabel Selesai.');
        }
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    public function printToPDF()
    {   
        Carbon::setLocale('id');
        $requests = Dikerjakan::latest()->get();

    $data = [
        'requests' => $requests
    ];

    $pdf = PDF::loadView('pdf.data_dikerjakan', $data);

    return $pdf->download('data_dikerjakan_Persero.pdf');
    }

    public function storeHistory(Request $request)
    {
        // Example of storing history entry
        $history = new History();
        $history->name = $request->name;
        $history->category = $request->category;
        $history->technician = $request->technician;
        // Set other attributes as needed
        $history->save();

        return redirect()->back()->with('success', 'History entry created successfully.');
    }

    public function exportToExcel()
    {
    // Fetch requests with technician information
    $requests = Dikerjakan::with('technician')->latest()->get();

    $filename = "dikerjakan_" . date('Ymd') . ".csv";

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
