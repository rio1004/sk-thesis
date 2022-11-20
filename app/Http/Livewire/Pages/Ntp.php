<?php

namespace App\Http\Livewire\Pages;

use App\Models\Ntp as ModelsNtp;
use App\Models\Official;
use App\Services\Constant;
use Livewire\Component;
use PhpOffice\PhpWord\TemplateProcessor;

class Ntp extends Component
{
    protected $listeners = ['delete'];

    public $ntp;
    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->ntp->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id)
    {

        $ntp = ModelsNtp::findOrFail($id);
        if($ntp != null){
            $ntp->delete();
            $this->ntp = ModelsNtp::make();
        }

        return redirect()->to('/notice-to-proceed')->with('error', 'Something went wrong');
    }

    public function export()
    {
        $path = storage_path(Constant::TEMPLATE_PATH_NTP);
        $templateProcessor = new TemplateProcessor($path);

        $this->ntp->load(['canvass']);

        $officials = Official::get();
        $skTreasurer = $officials->where('position', 'Sk-Treasurer')->first();
        $skChairperson = $officials->where('position', 'Sk-Chairperson')->first();
        $supplier = $this->ntp->canvass->canvass_suppliers->where('status',1)->first();

        $templateProcessor->setValue('project_name', strtoupper($this->ntp->canvass->project_name));
        $templateProcessor->setValue('approved_supplier',$supplier->supplier->supplier_name );
        $templateProcessor->setValue('address',$supplier->supplier->address );

        // load brgy details
        // load data
        $templateProcessor->setValue('brgy', auth()->user()->brgy);
        $templateProcessor->setValue('municipality', 'Sta. Magdalena');
        $templateProcessor->setValue('province', 'Sorsogon');

        $templateProcessor->setValue('ntp_date', $this->ntp->ntp_date->format('M. d, Y'));
        $templateProcessor->setValue('ntp_effectivity_date', $this->ntp->ntp_effectivity_date->format('M. d, Y'));
        $templateProcessor->setValue('project_location', $this->ntp->project_location);
        $templateProcessor->setValue('sk_treasurer', $skTreasurer != null ? $skTreasurer->full_name : '');
        $templateProcessor->setValue('sk_chairman', $skChairperson !=null ? $skChairperson->full_name : '');


        $filename = 'ntp-' . date('Y-m-d-h-i-s-a');
        $tempPath = 'reports/' . $filename . '.docx';

        $templateProcessor->saveAs($tempPath);
        return response()->download(public_path($tempPath));
    }
    public function render()
    {
        return view('livewire.pages.ntp');
    }
}
