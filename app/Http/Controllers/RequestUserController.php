<?php

namespace App\Http\Controllers;

use App\Models\Dikerjakan;
use App\Models\RequestUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;  
use Illuminate\Support\Facades\Response;

class RequestUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = RequestUser::latest()->get();
        $technicians = User::all();
        // $users = User::all();
        return view('pages.permintaan-masuk', compact('requests', 'technicians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('pages.request-user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nup' => 'required',
            'nama' => 'required',
            'divisi' => 'required',
            'no_hp' => 'required',
            'kategori_req' => 'required',
            'deskripsi_req' => 'required',
            'alasan_req' => 'required',
            'upload_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'upload_file' => 'nullable|mimes:pdf|max:10000',
            'teknisi' => 'nullable'
        ]);

        $input = $request->all();

        if ($image = $request->file('upload_gambar')) {
            $destinationPath = 'uploads/images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['upload_gambar'] = "$destinationPath$profileImage";
        }

        if ($file = $request->file('upload_file')) {
            $destinationPath = 'uploads/files/';
            $profileFile = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $profileFile);
            $input['upload_file'] = "$destinationPath$profileFile";
        }

        RequestUser::create($input);

        return redirect()->route('welcome')
            ->with('success', 'Request user baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request = RequestUser::findOrFail($id); // Misalnya, ambil data request berdasarkan ID
        return view('pages.dikerjakan', compact('request'));
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

    public function req()
    {
        return view('pages.request-user');
    }

    public function assignTechnician(Request $request, $id)
    {
        $validatedData = $request->validate([
            'teknisi' => 'required|exists:users,id',
        ]);

        // Cari permintaan berdasarkan ID
        $item = RequestUser::findOrFail($id);
        $item->teknisi = $request->teknisi;
        $item->save();

        return redirect()->back()->with('success', 'Teknisi Berhasil Ditambahkan');
    }

    public function moveToDikerjakan($id)
    {
        // Mengambil data permintaan berdasarkan ID
        $request = RequestUser::find($id);
        
        if ($request) {
            // Membuat entri baru di tabel dikerjakan
            $dikerjakan = new Dikerjakan();
            $dikerjakan->nup = $request->nup;
            $dikerjakan->nama = $request->nama;
            $dikerjakan->divisi = $request->divisi;
            $dikerjakan->no_hp = $request->no_hp;
            $dikerjakan->kategori_req = $request->kategori_req;
            $dikerjakan->deskripsi_req = $request->deskripsi_req;
            $dikerjakan->alasan_req = $request->alasan_req;
            $dikerjakan->upload_gambar = $request->upload_gambar;
            $dikerjakan->upload_file = $request->upload_file;
            $dikerjakan->teknisi = $request->teknisi;
            $dikerjakan->save();

            // Menghapus data dari tabel permintaan
            $request->delete();

            return redirect()->back()->with('success', 'Data berhasil dipindahkan ke tabel dikerjakan.');
        }
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    public function printToPDF()
    {   
        Carbon::setLocale('id');
        $requests = RequestUser::latest()->get();

    $data = [
        'requests' => $requests
    ];

    $pdf = PDF::loadView('pdf.all_requests', $data);

    return $pdf->download('Data_Request_Users_Persero.pdf');
    }

    public function exportToExcel()
    {
    // Fetch requests with technician information
    $requests = RequestUser::with('technician')->latest()->get();

    $filename = "requests_" . date('Ymd') . ".csv";

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

