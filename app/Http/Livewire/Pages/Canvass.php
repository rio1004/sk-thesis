<?php

namespace App\Http\Livewire\Pages;

use App\Models\Canvass as ModelsCanvass;
use App\Models\Official;
use App\Services\Constant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Canvass extends Component
{
    protected $listeners = ['delete'];

    public $canvass;

    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->canvass->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id)
    {
        $canvass = ModelsCanvass::where('id', $id)->first();
        if($canvass != null){
            $canvass->delete();
            return redirect()->to('/abstract-canvass');
        }
        return redirect()->to('/abstract-canvass')->with('error', 'Something went wrong');
    }

    public function export(){
        $officials = Official::get();
        $skTreasurer = $officials->where('position', 'Sk-Treasurer')->first();
        $skChairperson = $officials->where('position', 'Sk-Chairperson')->first();
        $brgy = auth()->user()->brgy;

        $path = storage_path(Constant::TEMPLATE_PATH_CANVASS);
        $spreadsheet = IOFactory::load($path);
        $spreadsheet->setActiveSheetIndex(0);

        $colArr = ['D', 'E','F'];
        if ($this->canvass) {
            $count = $this->canvass->canvass_items->count();
            $i = 0;
            $j = 1;
            $approved = $this->canvass->canvass_suppliers->where('status',1)->first();
            // $treasurer =
            foreach($this->canvass->canvass_items as $key => $qoutation){
                $spreadsheet->getActiveSheet()->setCellValue($colArr[$i].'10','Qoutation '.$j.' '.$qoutation->qoutation_name);
                $spreadsheet->getActiveSheet()->setCellValue($colArr[$i].'11', number_format( $qoutation->qoutation_price, 2));
                $i = $i+1;
                $j++;
            }
            $spreadsheet->getActiveSheet()->setCellValue('E6', $this->canvass->project_name);
            $spreadsheet->getActiveSheet()->setCellValue('A11', $this->canvass->qty);
            $spreadsheet->getActiveSheet()->setCellValue('B11', $this->canvass->unit);
            $spreadsheet->getActiveSheet()->setCellValue('C11', $this->canvass->description);
            $spreadsheet->getActiveSheet()->setCellValue('A21', 'By the open and careful examined validation and of all the eligibility,technical, and financial requirements submitted to declare '.strtoupper($approved->qoutation_name).'.as the Bidder with the lowest calculated and responsive Bid and to recommend forthe award and approval of the foregoing things.');
            $spreadsheet->getActiveSheet()->setCellValue('D30', $skTreasurer?->full_name);
            $spreadsheet->getActiveSheet()->setCellValue('D33', $skChairperson?->full_name);



        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $filename = 'canvass-' . date('Y-m-d-h-i-s-a');
        $tempPath = 'reports/' . $filename . '.xlsx';

        $writer->save($tempPath);
        return response()->download(public_path($tempPath));
        }
    }
    public function render()
    {
        return view('livewire.pages.canvass');
    }
}
