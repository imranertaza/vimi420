<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountTransaction;
use App\ContactLedger;
use App\Transaction;
use App\TransactionPayment;
use App\Utils\ModuleUtil;
use App\Utils\TransactionUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerPaymentBulkController extends Controller
{
    protected $transactionUtil;
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param TransactionUtil $transactionUtil
     * @return void
     */
    public function __construct(TransactionUtil $transactionUtil, ModuleUtil $moduleUtil)
    {
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;

        try {
            $business_id = request()->session()->get('business.id');

            $input['payment_ref_no'] = 'CPB-' . $request->customer_payment_bulk_payment_ref_no;
            $input['payment_for'] = $request->customer_payment_bulk_customer_id;
            $input['method'] = $request->customer_payment_bulk_payment_method;
            $input['card_number'] = $request->customer_payment_bulk_card_number;
            $input['card_type'] = $request->customer_payment_bulk_card_name;
            $input['bank_name'] = $request->customer_payment_bulk_bank_name;
            $input['cheque_date'] = !empty($request->customer_payment_bulk_cheque_date) ? $this->transactionUtil->uf_date($request->customer_payment_bulk_cheque_date) : null;
            $input['cheque_number'] = $request->customer_payment_bulk_cheque_number;
            $input['paid_on'] = !empty($request->transaction_date) ? Carbon::parse($request->transaction_date)->format('Y-m-d') : date('Y-m-d');
            $input['business_id'] = $business_id;
            $input['created_by'] = Auth::user()->id;

            $total_interest = 0;

            foreach ($request->paying as $key => $interest) {
                if ($interest != null){
                    $total_interest += $request->interest[$key];
                }
            }

            // return $total_interest;
            DB::beginTransaction();
            $total_amount = 0;
            foreach ($request->paying as $key => $paying) {

                $input['transaction_id'] = $key;
                $input['amount'] = $request->amount[$key];
                $total_amount += $input['amount'];

                $tp = TransactionPayment::create($input);

                $transaction = Transaction::find($key);
                $this->transactionUtil->updatePaymentStatus($transaction->id, $transaction->final_total);
            }


            //return $transaction;

            $account_id = $this->transactionUtil->getDefaultAccountId($input['method'], $transaction->location_id);
            $account_receivable_id = $this->transactionUtil->account_exist_return_id('Accounts Receivable');
            //create account transactions
            if ($transaction->type == 'sell') {
                $account_transaction_data = [
                    'amount' => $total_amount,
                    'interest' => $total_interest,
                    'account_id' => $account_id,
                    'type' => 'debit',
                    'operation_date' => date('Y-m-d H:i:s'),
                    'created_by' => Auth::user()->id,
                    'transaction_id' => !empty($transaction) ? $transaction->id : null,
                    'transaction_payment_id' => $tp->id
                ];

                //return $account_transaction_data;
                AccountTransaction::createAccountTransaction($account_transaction_data);
                $account_transaction_data['account_id'] = $account_receivable_id;
                $account_transaction_data['type'] = 'credit';

                AccountTransaction::createAccountTransaction($account_transaction_data);
                $account_transaction_data['contact_id'] = $transaction->contact_id;
                $account_transaction_data['sub_type'] = 'payment';

                ContactLedger::createContactLedger($account_transaction_data);
            }

            DB::commit();

            $output = [
                'success' => true,
                'tab' => 'bulk',
                'msg' => __('lang_v1.payment_added_success')
            ];
        } catch (\Exception $e) {
//            return $e->getMessage();
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => false,
                'tab' => 'bulk',
                'msg' => __('messages.something_went_wrong')
            ];
        }

        return redirect()->back()->with('status', $output);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function bulkPaymentTable(Request $request)
    {
        $customer_id = $request->customer_id;

        $sells = Transaction::leftjoin('transaction_payments', 'transactions.id', 'transaction_payments.transaction_id')
            ->whereIn('transactions.payment_status', ['due', 'partial'])
            ->where('transactions.type', 'sell')
            ->where('transactions.contact_id', $customer_id)
            ->select(
                'transactions.id as transaction_id',
                'transactions.transaction_date',
                'transactions.invoice_no',
                'transactions.ref_no',
                'transactions.final_total',
                DB::raw('SUM(transaction_payments.amount) as total_paid')
            )->groupBy('transactions.id')->get();

        return view('customer_payments.partials.bulk_payment_table')->with(compact(
            'sells'
        ));
    }
}
