<?php

namespace App\Http\Livewire\Abc;

use App\Models\Abc as ModelsAbc;
use App\Services\Constant;
use Livewire\Component;
use PhpOffice\PhpWord\TemplateProcessor;

class Abc extends Component
{
    public $abc;
    protected $listeners = ['delete'];

    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->abc->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id){
        $abc = ModelsAbc::where('id', $id)->first();
        if($abc != null) {
            $abc->delete();
            return redirect()->to('/abc');
        }
        return redirect()->to('/abc')->with('error', 'ABC not found');
    }
    public function export(){
        $path = storage_path(Constant::TEMPLATE_PATH_ABC);
        $templateProcessor = new TemplateProcessor($path);

        // load brgy details
        // load data
        $templateProcessor->setValue('brgy', strtoupper(auth()->user()->brgy));
        $templateProcessor->setValue('municipality', 'Sta. Magdalena');
        $templateProcessor->setValue('province', 'Sorsogon');

        $this->abc->load('abc_items', 'approvedBy', 'recommendedBy','submittedBy');
        $templateProcessor->setValue('abc_number', $this->abc->abc_number);

        $templateProcessor->setValue('procurement_title', strtoupper($this->abc->procurement_title));

        $abc_items = $this->abc->abc_items->count();
        if($abc_items > 0){
            $templateProcessor->cloneRow('item', $abc_items);
        }

        foreach ($this->abc->abc_items as $key => $abc)
        {
            $templateProcessor->setValue('item#' . ($key + 1), $abc->item_no);
            $templateProcessor->setValue('description#' . ($key + 1), $abc->item);
            $templateProcessor->setValue('qty#' . ($key + 1), $abc->qty);
            $templateProcessor->setValue('unit#' . ($key + 1), $abc->unit);
            $templateProcessor->setValue('cmp#' . ($key + 1), number_format($abc->market_price, 2));
            $templateProcessor->setValue('vat#' . ($key + 1), number_format($abc->tax,2));
            $templateProcessor->setValue('freight#' . ($key + 1), number_format($abc->insurance,2));
            $templateProcessor->setValue('other_ic#' . ($key + 1), number_format($abc->indirect_cost,2));
            $templateProcessor->setValue('other_cost#' . ($key + 1), number_format($abc->valuation_adjustment,2));
            $templateProcessor->setValue('total_cost#' . ($key + 1), number_format($abc->total_cost,2));
            $templateProcessor->setValue('unit_cost#' . ($key + 1), number_format($abc->unit_cost,2));
        }

        $cost_total = $this->abc->abc_items->where('total_cost', '>', 0)->sum('total_cost');

        $templateProcessor->setValue('total_amount', number_format($cost_total,2));
        $templateProcessor->setValue('bidder', $this->abc->bidder);

        $templateProcessor->setValue('prepared_official', $this->abc->submittedBy->full_name);
        $templateProcessor->setValue('prepared_position', $this->abc->submittedBy->position);
        $templateProcessor->setValue('recommending_official', $this->abc->recommendedBy->full_name);
        $templateProcessor->setValue('recommending_position', $this->abc->recommendedBy->position);
        $templateProcessor->setValue('approved_official', $this->abc->approvedBy->full_name);
        $templateProcessor->setValue('approved_position', $this->abc->approvedBy->position);


        $filename = 'abc-' . date('Y-m-d-h-i-s-a');
        $tempPath = 'reports/' . $filename . '.docx';

        $templateProcessor->saveAs($tempPath);
        return response()->download(public_path($tempPath));
    }
    public function render()
    {
        return view('livewire.abc.abc');
    }
}
