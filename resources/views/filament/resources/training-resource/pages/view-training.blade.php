<x-filament::page>
    <div class="space-y-6">
        <x-filament::section>
            <x-slot name="title">Pendaftaran Detail</x-slot>
            <x-slot name="description">Informasi lengkap mengenai pendaftaran</x-slot>

            <table
                class="w-full text-sm text-left text-gray-700 dark:text-white border border-gray-200 dark:border-gray-700">
                <tbody>
                    <tr>
                        <th class="p-2 font-medium w-1/3">Pegawai</th>
                        <td class="p-2">{{ $record->employee->name }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 font-medium">Pelatihan Name</th>
                        <td class="p-2">{{ $record->training_name }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 font-medium">Penyelenggara</th>
                        <td class="p-2">{{ $record->organizer }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 font-medium">No. Sertifikat</th>
                        <td class="p-2">{{ $record->certificate_number }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 font-medium">Mulai</th>
                        <td class="p-2">{{ \Carbon\Carbon::parse($record->start_date)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 font-medium">Selesai</th>
                        <td class="p-2">{{ \Carbon\Carbon::parse($record->end_date)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 font-medium">Tahun</th>
                        <td class="p-2">{{ $record->year }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 font-medium">Durasi (jam)</th>
                        <td class="p-2">{{ $record->duration_hours }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 font-medium">Diklat</th>
                        <td class="p-2">{{ $record->diklat->name }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 font-medium">Sub Diklat</th>
                        <td class="p-2">{{ $record->diklatSub?->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="p-2 font-medium">Status</th>
                        <td class="p-2">{{ ucfirst($record->status) }}</td>
                    </tr>
                    @if ($record->status === 'rejected')
                        <tr>
                            <th class="p-2 font-medium text-red-600">Rejection Reason</th>
                            <td class="p-2 text-red-600">{{ $record->rejection_reason }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </x-filament::section>

        @if ($record->certificate_file)
            <x-filament::section>
                <x-slot name="title">Certificate File</x-slot>

                <a href="{{ \Storage::url($record->certificate_file) }}" target="_blank"
                    class="text-blue-500 underline">
                    View Certificate
                </a>
            </x-filament::section>
        @endif
    </div>
</x-filament::page>
