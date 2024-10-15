<?php
namespace App\Repository\finance;

use App\Interfaces\finance\RecieptRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use Illuminate\Support\Facades\DB;

class RecieptRepository implements RecieptRepositoryInterface{

    public function index(){
       $receipts = ReceiptAccount::all();
       return view('dashboard.Receipt.index',compact('receipts'));
    }

    public function create(){
         $Patients = Patient::all();
         return view('dashboard.Receipt.add',compact('Patients'));
    }
    public function store($request){
        DB::beginTransaction();

        try{
            // store receipt_accounts
            $receipt_accounts = new ReceiptAccount();
            $receipt_accounts->date =date('y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->debit = $request->Debit;
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();
            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->receipt_id = $receipt_accounts->id;
            $fund_accounts->debit = $request->Debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receipt_id = $receipt_accounts->id;
            $patient_accounts->debit = 0.00;
            $patient_accounts->credit =$request->Debit;
            $patient_accounts->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('reciept.index');
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request){
        DB::beginTransaction();

        try{
            // store receipt_accounts
            $receipt_accounts = ReceiptAccount::findOrFail($request->id);
            $receipt_accounts->date =date('y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->debit = $request->Debit;
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();
            // store fund_accounts
            $fund_accounts = FundAccount::where('receipt_id',$request->id)->first();
            $fund_accounts->date =date('y-m-d');
            $fund_accounts->receipt_id = $receipt_accounts->id;
            $fund_accounts->debit = $request->Debit;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
            // store patient_accounts
            $patient_accounts = PatientAccount::where('receipt_id',$request->id)->first();
            $patient_accounts->date =date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receipt_id = $receipt_accounts->id;
            $patient_accounts->debit = 0.00;
            $patient_accounts->credit =$request->Debit;
            $patient_accounts->save();

            DB::commit();
            session()->flash('edit');
            return redirect()->route('reciept.index');
        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id){
        $receipt = ReceiptAccount::findOrFail($id);
        return view('dashboard.Receipt.print',compact('receipt'));
    }

    public function edit($id){
        $receipt_accounts = ReceiptAccount::findOrFail($id);
        $Patients = Patient::all();
        return view('Dashboard.Receipt.edit',compact('receipt_accounts','Patients'));

    }

    public function destroy($request){

        ReceiptAccount::destroy($request->id);
        session()->flash('delete');
        return redirect()->route('reciept.index');
    }

}
