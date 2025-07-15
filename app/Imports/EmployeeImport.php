<?php

namespace App\Imports;

use App\Models\Education;
use App\Models\Employee;
use App\Models\Institute;
use App\Models\Major;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Events\AfterImport;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Events\ImportFailed;

class EmployeeImport implements ToCollection, WithHeadingRow, WithBatchInserts,WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $row)
    {
        foreach ($row as $item) {
            $education = Education::where('education_id','=',$item['tingkat_pendidikan_id'])->first();
            $institute = Institute::where('institute_id','=',$item['instansi_id'])->first();
            $major = Major::where('major_id','=',$item['jurusan_id'])->first();

            Employee::updateOrInsert([
                'pns_id' => $item['pns_id']
            ],
            [
                'uuid' => (string) Str::uuid(),
                'pns_id' => $item['pns_id'],
                'old_nip' => null,
                'nip' => str_replace("'",'',$item['nip_baru']),
                'name' => $item['nama'],
                'degree_prefix' => $item['gelar_depan'],
                'degree_suffix' => $item['gelar_belakang'],
                'national_id' => str_replace("'",'',$item['nik']),
                'birth_place' => $item['tempat_lahir_nama'],
                'birth_date' => Carbon::parse($item['tanggal_lahir'])->format('Y-m-d'),
                'gender' => strtolower($item['jenis_kelamin']) == 'f' ? 'female' : 'male',
                'religion' => $item['agama_nama'],
                'phone' => str_replace("'",'',$item['nomor_hp']),
                'email' => $item['email'],
                'unit' => $item['unit'],
                'institute_id' => $institute ? $institute->id : null,
                'education_id' => $education ? $education->id : null,
                'major_id' => $major ? $major->id : null
            ]);
        };
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function(AfterImport $event) {
                $this->afterImport($event);
            },
            ImportFailed::class => function(ImportFailed $event) {
                $this->failedImport($event);
            },
        ];
    }

    public function afterImport(AfterImport $event)
    {
        $recipient = auth()->user();
        Notification::make()->title('Data imported')->body('Data Succesfuly import')->sendToDatabase($recipient);
    }

    public function failedImport(AfterImport $event)
    {
        $recipient = auth()->user();
        Notification::make()->title('Data import failed')->body('Data Failed import, please try again later')->sendToDatabase($recipient);
    }

}
