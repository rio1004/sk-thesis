<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Official;
use app\Models\RequestQoutation as RequestQout;
use App\Services\Constant;
use PhpOffice\PhpSpreadsheet\TemplateProcessor;
use PhpOffice\PhpSpreadsheet\IOFactory;

use Arr;
use Auth;
class RequestQoutation extends Component
{

    public $qoutation;
    protected $listeners = ['delete'];

    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->qoutation->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id){
        $qoutation = RequestQout::where('id', $id)->first();
        if($qoutation != null) {
            $qoutation->delete();
            return redirect()->to('/qoutation');
        }
        return redirect()->to('/qoutation')->with('error', 'Qoutation not found');
    }

    public function export(){
        $path = storage_path(Constant::TEMPLATE_PATH_RFQ);
        $spreadsheet = IOFactory::load($path);
        $spreadsheet->setActiveSheetIndex(0);
        $brgy = auth()->user()->brgy;

        if ($this->qoutation) {
            $this->qoutation->load('request_items', 'supplier', 'procurement_officer');

            $count = $this->qoutation->request_items->count();

            // if ($count > 0) {
            //     $spreadsheet->getActiveSheet()->insertNewRowBefore(12, $count);
            // }
            $format = new \NumberFormatter('en_US', \NumberFormatter::SPELLOUT);
            // $amountInWords = $format->format($this->qoutation->request_items->total);
            // dd($amountInWords);

            $spreadsheet->getActiveSheet()
                ->setCellValue('B2', 'Barangay' . auth()->user()->brgy)
                ->setCellValue('B5', 'TEL NO.' . $this->qoutation->supplier->supplier_name)
                ->setCellValue('G5', $this->qoutation->date)
                ->setCellValue('B6', $brgy.','.'Sorsogon')
                ->setCellValue('G6', $this->qoutation->qoutation_no)
                ->setCellValue('F11', $this->qoutation->procurement_officer->full_name);

            foreach ($this->qoutation->request_items as $key => $request_items) {
                // $date = Carbon::parse($request_items->per_of_implementation->format('F j Y'));
                $spreadsheet->getActiveSheet()
                    ->setCellValue('B' . ($key + 14), $key + 1)
                    ->setCellValue('C' . ($key + 14), $request_items->unit)
                    ->setCellValue('D' . ($key + 14), $request_items->item)
                    ->setCellValue('E' . ($key + 14), $request_items->qty)
                ;
            }

        }

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $filename = 'requisition_qoutation' . date('Y-m-d-h-i-s-a');
        $tempPath = 'reports/' . $filename . '.xlsx';

        $writer->save($tempPath);
        return response()->download(public_path($tempPath));
    }
    public function render()
    {
        return view('livewire.pages.request-qoutation');
    }
}
