<?php

namespace App\Http\Livewire\Pages;

use App\Models\Noa as ModelsNoa;
use App\Models\Official;
use App\Services\Constant;
use Livewire\Component;
use PhpOffice\PhpWord\TemplateProcessor;

class Noa extends Component
{
    protected $listeners = ['delete'];

    public $noa;
    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->noa->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id)
    {

        $noa = ModelsNoa::findOrFail($id);
        if($noa != null){
            $noa->delete();
            $this->noa = ModelsNoa::make();
        }

        return redirect()->to('/notice-of-award')->with('error', 'Something went wrong');
    }

    public function export()
    {
        $path = storage_path(Constant::TEMPLATE_PATH_NOA);
        $templateProcessor = new TemplateProcessor($path);

        $this->noa->load(['canvass']);

        $officials = Official::get();
        $skTreasurer = $officials->where('position', 'Sk-Treasurer')->first();
        $skChairperson = $officials->where('position', 'Sk-Chairperson')->first();
        $supplier = $this->noa->canvass->canvass_suppliers->where('status', 1)->first();
        // dd($supplier);
        $templateProcessor->setValue('project_name', strtoupper($this->noa->canvass->project_name));
        $templateProcessor->setValue('approved_supplier', $supplier->supplier->supplier_name);
        $templateProcessor->setValue('address', $supplier->supplier->address);

        // load brgy details
        // load data
        $templateProcessor->setValue('brgy', auth()->user()->brgy);
        $templateProcessor->setValue('municipality', 'Sta. Magdalena');
        $templateProcessor->setValue('province', 'Sorsogon');

        $format = new \NumberFormatter('en_US', \NumberFormatter::SPELLOUT);
        $amountInWords = $format->format($this->noa->noa_approved_price);

        $templateProcessor->setValue('noa_approved_price', strtoupper($amountInWords));
        $templateProcessor->setValue('noa_date', $this->noa->noa_date->format('m/d/Y'));
        $templateProcessor->setValue('bid_date', $this->noa->bid_date->format('m/d/Y'));
        $templateProcessor->setValue('sk_treasurer', $skTreasurer?->full_name);
        $templateProcessor->setValue('sk_chairman', $skChairperson?->full_name);


        $filename = 'noa-' . date('Y-m-d-h-i-s-a');
        $tempPath = 'reports/' . $filename . '.docx';

        $templateProcessor->saveAs($tempPath);
        return response()->download(public_path($tempPath));
    }

    public function render()
    {
        return view('livewire.pages.noa');
    }
}
