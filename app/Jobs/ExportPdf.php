<?php

namespace App\Jobs;

use App\Events\KirimNotif;
use App\Models\Notifikasi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ExportPdf implements ShouldQueue
{
    use Queueable;
    public $notifikasiId;

    /**
     * Create a new job instance.
     */
    public function __construct($notifikasiId)
    {
        $this->notifikasiId = $notifikasiId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fileName = rand(1000, 9999).'_export.pdf';

        $pdf = Pdf::loadView('export_template_pdf');
        $pdf->save(storage_path('app/public/'.$fileName));

        $id = $this->notifikasiId;
        Notifikasi::where('id', $id)
            ->update([
                'status' => 'completed',
                'file_path' => $fileName,
            ]);

        $notifikasi = Notifikasi::find($id);

        Log::info('Notifikasi'.json_encode($notifikasi));

        // Ketika proses hanlde selesai
        // Lakukan broadcast ke client
        KirimNotif::dispatch($notifikasi);
    }
}
