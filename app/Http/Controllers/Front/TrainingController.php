<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Diklat;
use App\Models\DiklatSubOne;
use App\Models\Employee;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TrainingController extends Controller
{
    public function index(Request $request)
    {
        $employee = Employee::orderBy('created_at', 'asc')->get();

        $diklat = Diklat::orderBy('created_at', 'asc')->get();

        $diklatSubOne = DiklatSubOne::orderBy('created_at', 'asc')->get();


        return view('frontend.training', compact(
            'employee',
            'diklat',
            'diklatSubOne',
        ));
    }

    public function getSubDiklats($diklat_id)
    {
        // Ganti 'DiklatSubOne' dengan nama model sub diklat Anda yang sebenarnya
        $subDiklats = DiklatSubOne::where('diklat_id', $diklat_id)->pluck('name', 'id');
        return response()->json($subDiklats);
    }

    public function store(Request $request)
    {

//         echo "<pre>";
//         print_r($request->all());
//         exit();

        // 1. Validasi Input
        $validator = Validator::make($request->all(), [
            'employee_id'       => 'required|exists:employees,uuid',
            'diklat_id'         => 'required|exists:diklats,id',
            'diklat_sub_id'     => 'required|exists:diklat_sub_ones,id',
            'training_name'     => 'required|string|max:255',
            'organizer'         => 'required|string|max:255',
            'certificate_number'=> 'nullable|string|max:100',
            'start_date'        => 'required|date',
            'end_date'          => 'required|date|after_or_equal:start_date',
            'year'              => 'required|digits:4',
            'duration_hours'    => 'required|integer|min:1',
            'certificate_file'  => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048', // max 2MB
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 2. Memulai Database Transaction
        // Ini memastikan semua proses (simpan data & upload file) berhasil,
        // atau semua akan dibatalkan jika salah satu gagal.
        DB::beginTransaction();

        try {
            // 3. Membuat instance & mengisi data model
            $training = new Training();

            // Mengisi data dari request ke model, kecuali file
            $training->fill($request->except('certificate_file'));
            $training->status = 'pending';
            // 4. Menangani Upload File
            if ($request->hasFile('certificate_file')) {
                // Simpan file ke storage/app/public/certificates
                // dan dapatkan path-nya untuk disimpan di database.
                $path = $request->file('certificate_file')->store('certificates', 'public');

                // Simpan path ke kolom di database (misal: 'certificate_file')
                $training->certificate_file = $path;
            }

            // 5. Menyimpan data ke database
            $training->save();

            // 6. Jika semua berhasil, commit transaction
            DB::commit();

            // 7. Mengembalikan response sukses
            return response()->json([
                'message' => 'Data pelatihan berhasil disimpan!'
            ]);

        } catch (\Exception $e) {
            // 8. Jika terjadi error, batalkan semua perubahan (rollback)
            DB::rollBack();

            // Catat error ke log untuk debugging
            Log::error('Gagal menyimpan data pelatihan: ' . $e->getMessage());

            // Mengembalikan response error
            return response()->json([
                'message' => 'Terjadi kesalahan pada server. Gagal menyimpan data.'
            ], 500);
        }
    }

}

