<?php

namespace App\Http\Controllers;

use App\Helpers\DeleteRow;
use App\Http\Requests\PaymentGatewayRequest;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        $results = PaymentGateway::filter()->paginate();
        return view('payment-gateways.index', compact('results'));
    }

    public function create()
    {
        return view('payment-gateways.create');
    }

    public function store(PaymentGatewayRequest $request)
    {
        $data = $request->validated();

        PaymentGateway::create($data);

        return redirect()->route('payment-gateways.index')->with('success', 'Payment Gateway created successfully.');
    }

    public function show(PaymentGateway $paymentGateway)
    {
        return view('payment-gateways.show', compact('paymentGateway'));
    }

    public function edit(PaymentGateway $paymentGateway)
    {
        return view('payment-gateways.edit', compact('paymentGateway'));
    }

    public function update(PaymentGatewayRequest $request, PaymentGateway $paymentGateway)
    {
        $data = $request->validated();

        $paymentGateway->update($data);

        return redirect()->route('payment-gateways.index')->with('success', 'Payment Gateway updated successfully.');
    }

    public function destroy(PaymentGateway $paymentGateway)
    {
        $paymentGateway->delete();

        return redirect()->route('payment-gateways.index')->with('success', 'Payment Gateway deleted successfully.');
    }

    public function deleteSelectRow(Request $request)
    {
        $selectedRows=$request->input('selectedRows');
        if ($selectedRows==null)
        {
            return back()->withErrors([__('please select row')]);
        }
        DeleteRow::helperDeleteSelectedRows(PaymentGateway::class, $selectedRows);
        return back()->with('success', __('Payment Gateway deleted successfully.'));

    }

}
