<?php

namespace App\Http\Livewire\Pages;

use App\Models\Official;
use App\Models\PurchaseRequest as ModelsPurchaseRequest;
use App\Services\Constant;
use PhpOffice\PhpWord\TemplateProcessor;
use Livewire\Component;

class PurchaseRequest extends Component
{

    public $purchaseRequest;
    protected $listeners = ['delete'];

    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->purchaseRequest->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id){
        $purchaseRequest = ModelsPurchaseRequest::where('id', $id)->first();
        if($purchaseRequest != null) {
            $purchaseRequest->delete();
            return redirect()->to('/purchase-request');
        }
        return redirect()->to('/purchase-request')->with('error', 'Official not found');
    }


    public function export()
    {
        $path = storage_path(Constant::TEMPLATE_PATH_PR);
        $templateProcessor = new TemplateProcessor($path);

        // $spreadsheet = IOFactory::load($path);
        // $spreadsheet->setActiveSheetIndex(0);

        $officials = Official::get();
        $skChairperson = $officials->where('position', 'Sk-Chairperson')->first();
        if ($this->purchaseRequest) {
            $this->purchaseRequest->load('purchaseRequestItem', 'requestedBy');

            $count = $this->purchaseRequest->purchaseRequestItem->count();
            if ($count > 0) {
                $templateProcessor->cloneRow('item', $count);
                $total = $this->purchaseRequest->purchaseRequestItem->sum('estimated_amount');
            }

            $format = new \NumberFormatter('en_US', \NumberFormatter::SPELLOUT);
            $amountInWords = $format->format($total);

            $templateProcessor->setValue('brgy', strtoupper(auth()->user()->brgy));
            $templateProcessor->setValue('municipality', strtoupper('Sta. Magdalena'));
            $templateProcessor->setValue('province', strtoupper('Sorsogon'));
            $templateProcessor->setValue('pr_no', $this->purchaseRequest->pr_no);
            $templateProcessor->setValue('date', $this->purchaseRequest->pr_date);
            $templateProcessor->setValue('requesting_official', $this->purchaseRequest->requestedBy->full_name);
            $templateProcessor->setValue('sk_chairperson', $skChairperson->full_name);
            $templateProcessor->setValue('total_words', strtoupper($amountInWords));
            $templateProcessor->setValue('total_amount', 'Php ' . number_format($total));
            $templateProcessor->setValue('purpose', $this->purchaseRequest->purpose);


            foreach($this->purchaseRequest->purchaseRequestItem as $key => $item) {
                $templateProcessor->setValue('item#' . ($key + 1), $count > 0 ? $key + 1 : $key + 2);
                $templateProcessor->setValue('qty#' . ($key + 1), $item->qty);
                $templateProcessor->setValue('unit#' . ($key + 1), $item->unit);
                $templateProcessor->setValue('item_desc#' . ($key + 1), $item->item);
                $templateProcessor->setValue('est_cost#' . ($key + 1), $item->estimated_unit_cost);
                $templateProcessor->setValue('est_amount#' . ($key + 1), $item->estimated_amount);
            }
        }

        $filename = 'PurchaseRequest' . date('Y-m-d-h-i-s-a');
        $tempPath = 'reports/' . $filename . '.docx';

        $templateProcessor->saveAs($tempPath);
        return response()->download(public_path($tempPath));
    }
    public function render()
    {
        return view('livewire.pages.purchase-request');
    }
}
