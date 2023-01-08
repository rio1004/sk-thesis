<?php

namespace App\Http\Livewire\Pages;

use App\Models\Disbursement as ModelsDisbursement;
use App\Models\Official;
use App\Services\Constant;
use Livewire\Component;
use PhpOffice\PhpWord\TemplateProcessor;

class Disbursement extends Component
{
    public $disbursement;
    protected $listeners = ['delete'];


    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->disbursement->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id)
    {
        $disbursement = ModelsDisbursement::where('id', $id)->first();
        if($disbursement != null){
            $disbursement->delete();
            return redirect()->to('/dibursement');
        }
        return redirect()->to('/dibursement')->with('error', 'Something went wrong');
    }

    public function export()
    {
        $path = storage_path(Constant::TEMPLATE_PATH_SKCC);
        $templateProcessor = new TemplateProcessor($path);

        $this->disbursement->load(['disbursementItem', 'skcc', 'skcc.skccItem']);
        $officials = Official::get();
        // load barangay details
        $skTreasurer = $officials->where('position', 'Sk-Treasurer')->first();
        $skChairperson = $officials->where('position', 'Sk-Chairperson')->first();
        $skBmo = $officials->where('other_pos', 'BMO')->first();
        // load data
        $templateProcessor->setValue('sk-brgy', auth()->user()->brgy);
        $templateProcessor->setValue('sk-municipality', 'Sta. Magdalena');
        $templateProcessor->setValue('sk-province', 'Sorsogon');
        $templateProcessor->setValue('sk-payee', $this->disbursement->supplier->supplier_name);
        $templateProcessor->setValue('sk-address', $this->disbursement->supplier->address);
        $templateProcessor->setValue('sk-tin', $this->disbursement->supplier->tin);
        $templateProcessor->setValue('sk-dv', $this->disbursement->dv_no);
        $templateProcessor->setValue('sk-date', $this->disbursement->dv_date?->format('m/d/Y'));
        $templateProcessor->setValue('particular-text', $this->disbursement->particular_text);
        $templateProcessor->setValue('check_no', $this->disbursement->check_no);
        $templateProcessor->setValue('check_date', $this->disbursement->check_date?->format('m/d/Y'));
        $templateProcessor->setValue('bank_name', $this->disbursement->bank_name);
        $templateProcessor->setValue('bank_branch', $this->disbursement->bank_branch);
        $templateProcessor->setValue('or_no', $this->disbursement->or_no);
        $templateProcessor->setValue('or_date', $this->disbursement->or_date?->format('m/d/Y'));
        $templateProcessor->setValue('sk-bmo', $skBmo?->full_name);
        $templateProcessor->setValue('sk-treasurer', $skTreasurer?->full_name);
        $templateProcessor->setValue('sk-chairperson', $skChairperson?->full_name);

        $count = $this->disbursement->disbursementItem->count();
        if ($count > 0) {
            $templateProcessor->cloneBlock('block_name', $count, true, true);
            $templateProcessor->cloneBlock('particular_amount_block', $count, true, true);
        }

        foreach ($this->disbursement->disbursementItem as $key => $item) {
            $templateProcessor->setValue('particular_item#' . ($key + 1), $item->particular_item);
            $templateProcessor->setValue('particular_amount#' . ($key + 1), 'Php. ' . number_format($item->particular_amount, 2));
        }
        // skcc
        $templateProcessor->setValue('skcc', $this->disbursement?->skcc->skcc_no);
        $templateProcessor->setValue('skcc-date', $this->disbursement?->skcc->skcc_date?->format('m/d/Y'));
        $templateProcessor->setValue('to-name', $this->disbursement?->skcc->to_name);
        $templateProcessor->setValue('to-company', $this->disbursement?->skcc->to_company);
        $templateProcessor->setValue('to-address', $this->disbursement?->skcc->to_address);

        $acctCount = $this->disbursement->skcc->skccItem->count();
        if ($acctCount > 0) {
            $templateProcessor->cloneRow('acctItemNo', $acctCount);
        }

        foreach ($this->disbursement->skcc->skccItem as $key => $item) {
            if ($item->status == 1) {
                $templateProcessor->setValue('acctItemNo#' . ($key + 1), $item->account_no);
                $templateProcessor->setValue('acctCheckNo#' . ($key + 1), $item->check_no);
                $templateProcessor->setValue('acctDate#' . ($key + 1), "----");
                $templateProcessor->setValue('acctPayee#' . ($key + 1), $item->payee_name);
                $templateProcessor->setValue('acctAmount#' . ($key + 1), "----");
                $templateProcessor->setValue('acctPurpose#' . ($key + 1), "----");
            }
            $templateProcessor->setValue('acctItemNo#' . ($key + 1), $item->account_no);
            $templateProcessor->setValue('acctCheckNo#' . ($key + 1), $item->check_no);
            $templateProcessor->setValue('acctDate#' . ($key + 1), $item->date?->format('m/d/Y'));
            $templateProcessor->setValue('acctPayee#' . ($key + 1), $item->payee_name);
            $templateProcessor->setValue('acctAmount#' . ($key + 1), $item->amount);
            $templateProcessor->setValue('acctPurpose#' . ($key + 1), $item->purpose);
        }

        $filename = 'disbursement_voucher-' . date('Y-m-d-h-i-s-a');
        $tempPath = 'reports/' . $filename . '.docx';

        $templateProcessor->saveAs($tempPath);
        return response()->download(public_path($tempPath));
    }
    public function render()
    {
        return view('livewire.pages.disbursement');
    }
}
