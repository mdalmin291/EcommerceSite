<?php

namespace App\Http\Livewire\Backend\Report;


use App\Models\Backend\Inventory\StockAdjustment;
use Carbon\Carbon;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Setting\Branch;
use App\Models\Backend\Setting\Warehouse;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StockAdjustmentReport extends Component
{
    public $to_date = Null;
    public $from_date = Null;
    public $second=NULL;
    public $type;
    public $contact_id;
    public $branch_id;


    public function dateFilter($model){
        return $model->where('date', '>=', Carbon::parse($this->from_date)->format('Y-m-d'))->where('date', '<=', Carbon::parse($this->to_date)->format('Y-m-d'));
    }
    public function saveStockAdjustmentReport()
    {
        // dd('$true');

        $this->validate([

            'to_date' => 'required',
            'from_date' => 'required',
            'contact_id' => 'required',
            'branch_id' => 'required',

            // 'type' => 'required',
            // 'from_branch_id' => 'required',
            // 'to_branch_id' => 'required',
            // 'from_warehouse_id' => 'required',
            // 'to_warehouse_id' => 'required',
        ]);


            // Product
            if($this->StockAdjustmentReportId){
               $Query=StockAdjustment::find($this->StockAdjustmentReportId);
            }else{
               $Query=new StockAdjustment();
            }

            $Query->date=$this->date;
            $Query->date=$this->date1;
            $Query->contact_id= $this->contact_id;
            $Query->to_branch_id=$this->to_branch_id;

            // $Query->type=$this->type;
            // $Query->from_branch_id=$this->from_branch_id;
            // $Query->from_warehouse_id=$this->from_warehouse_id;
            // $Query->to_warehouse_id=$this->to_warehouse_id;
            // $Query->note=$this->note;
            $Query->save();
           //    Stock



        $this->reset();
        $this->emit('success', [
            'text' => 'Stock Adjustment C/U Successfully',
        ]);
    }

    public function render()
    {

        return view('livewire.backend.report.stock-adjustment-report',[
            'stocks' => StockAdjustment::get(),
            'contacts' => Contact::get(),
            'branches' => Branch::get(),

            // 'dates' => StockAdjustment::get(),
            // 'warehouses' => Warehouse::get(),
        ]);
    }
}
