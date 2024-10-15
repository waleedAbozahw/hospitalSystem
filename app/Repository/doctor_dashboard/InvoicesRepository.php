<?php

namespace App\Repository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Models\invoice;
use App\Models\Laporatory;
use App\Models\Ray;
use Illuminate\Support\Facades\Auth;

class InvoicesRepository implements InvoicesRepositoryInterface
{
    public function index()
    {
        $invoices = invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 1)->get();
        return view('dashboard.doctor.invoices.index', compact('invoices'));
    }
    public function reviewInvoices()
    {
        $invoices = invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 2)->get();
        return view('dashboard.doctor.invoices.review_invoices', compact('invoices'));
    }
    public function completeInvoices()
    {
        $invoices = invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 3)->get();
        return view('dashboard.doctor.invoices.completed_invoices', compact('invoices'));
    }

    public function show($id)
    {
        $rays = Ray::where('doctor_id',auth()->user()->id)->findOrFail($id);
        return view('dashboard.doctor.invoices.view_rays', compact('rays'));
    }
    public function showLaporatory($id){
        $laboratory = Laporatory::where('doctor_id',auth()->user()->id)->findOrFail($id);
        return view('dashboard.doctor.invoices.view_laboratories', compact('laboratory'));
    }
}
