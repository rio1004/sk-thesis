<?php

namespace App\Http\Livewire\Pages;

use App\Models\Official;
use App\Models\PurchaseOrder as ModelsPurchaseOrder;
use App\Services\Constant;
use Livewire\Component;
use PhpOffice\PhpWord\TemplateProcessor;

class PurchaseOrder extends Component
{

    public $purchaseOrder;

    protected $listeners = ['delete', 'approved', 'disapproved'];


    public function deleteConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->purchaseOrder->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id)
    {
        $purchaseOrder = ModelsPurchaseOrder::where('id', $id)->first();
        if($purchaseOrder != null) {
            $purchaseOrder->delete();
            return redirect()->to('/purchase-order')->with('success', 'Purchase Order has been deleted');
        }
        return redirect()->to('/purchase-order')->with('error', 'Purchase Order not found');

    }
    public function approvedConfirmation()
    {
        $this->dispatchBrowserEvent('swal:confirm-approved', [
            'id' => $this->purchaseOrder->id,
            'message' => 'Are you sure?',
            'text' => 'You are about to APPROVED this Purchase Order',
        ]);
    }

    public function approved($id)
    {
        $disbursement = ModelsPurchaseOrder::find($id);
        if ($disbursement) {
            $disbursement->update([
                'status' => 1
            ]);
        }
        return redirect()->to('purchase-order');
    }
    public function disapprovedConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm-disapproved', [
            'id' => $this->purchaseOrder->id,
            'message' => 'Are you sure?',
            'text' => 'You are about to DISAPPROVED this Purchase Order',
        ]);
    }

    public function disapproved($id)
    {
        $disbursement = ModelsPurchaseOrder::find($id);
        if ($disbursement) {
            $disbursement->update([
                'status' => 2
            ]);
        }
        return redirect()->to('purchase-order');
    }

    public function export()
    {
        $path = storage_path(Constant::TEMPLATE_PATH_PO);
        $templateProcessor = new TemplateProcessor($path);

        if ($this->purchaseOrder) {

            $count = $this->purchaseOrder->purchaseOrderItem->count();
            if ($count > 0) {
                $templateProcessor->cloneRow('count', $count);
            }

            $format = new \NumberFormatter('en_US', \NumberFormatter::SPELLOUT);
            $amountInWords = $format->format($this->purchaseOrder->total_amount);


            $templateProcessor->setValue('brgy', auth()->user()->brgy);
            $templateProcessor->setValue('municipality', 'Sta. Magdalena');
            $templateProcessor->setValue('province', 'Sorsogon');

            // get officials
            $officials = Official::get();
            $sk_chairperson = $officials->where('position', 'Sk-Chairperson')->first();
            $bmo = $officials->where('other_pos', 'BMO')->first();
            if ($sk_chairperson) {
                $templateProcessor->setValue('sk_chairperson', $sk_chairperson->full_name);
            }
            if ($bmo) {
                $templateProcessor->setValue('bmo', $bmo->full_name);
            }
            $templateProcessor->setValue('tel_no', $sk_chairperson?->contact_no);

            $templateProcessor->setValue('po_no', $this->purchaseOrder->po_no);
            $templateProcessor->setValue('po_date', $this->purchaseOrder->po_date?->format('F d, Y'));
            $templateProcessor->setValue('mode_procurement', $this->purchaseOrder->mode_of_procurement);

            $templateProcessor->setValue('supplier_name', $this->purchaseOrder->supplier?->supplier_name);
            $templateProcessor->setValue('sup_address', $this->purchaseOrder->supplier?->address);
            $templateProcessor->setValue('sup_tel_no', $this->purchaseOrder->supplier?->contact_no);
            $templateProcessor->setValue('sup_tin', $this->purchaseOrder->supplier?->tin);

            $templateProcessor->setValue('total_words', strtoupper($amountInWords));
            $templateProcessor->setValue('total', number_format($this->purchaseOrder->total_amount, 2));

            $templateProcessor->setValue('delivery_place', $this->purchaseOrder->place_of_delivery);
            $templateProcessor->setValue('delivery_date', $this->purchaseOrder->date_of_delivery?->format('F d, Y'));
            $templateProcessor->setValue('delivery_term', $this->purchaseOrder->delivery_term);
            $templateProcessor->setValue('payment_term', $this->purchaseOrder->payment_term);

            foreach ($this->purchaseOrder->purchaseOrderItem as $key => $item) {
                $templateProcessor->setValue('count#' . ($key + 1), $key + 1);
                $templateProcessor->setValue('unit#' . ($key + 1), $item->unit);
                $templateProcessor->setValue('item#' . ($key + 1), $item->item);
                $templateProcessor->setValue('qty#' . ($key + 1), $item->qty);
                $templateProcessor->setValue('price#' . ($key + 1), number_format($item->unit_price, 2));
                $templateProcessor->setValue('amount#' . ($key + 1), number_format($item->unit_price * $item->qty, 2));
            }

            $templateProcessor->setValue('date', now()->format('F d, Y'));
            $templateProcessor->setValue('fund', ' ');
            $templateProcessor->setValue('fund_source', ' ');

        }

        $filename = 'purchase-order-' . date('Y-m-d-h-i-s-a');
        $tempPath = 'reports/' . $filename . '.docx';

        $templateProcessor->saveAs($tempPath);
        return response()->download(public_path($tempPath));
    }

    public function render()
    {
        return view('livewire.pages.purchase-order');
    }
}
