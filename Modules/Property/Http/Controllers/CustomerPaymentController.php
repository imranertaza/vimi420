<?php

namespace Modules\Property\Http\Controllers;

use App\Contact;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use App\Utils\TransactionUtil;
use App\Utils\Util;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Property\Entities\Property;

class CustomerPaymentController extends Controller
{
    protected $moduleUtil;
    protected $commonUtil;
    protected $businessUtil;
    protected $transactionUtil;

    /**
     * Constructor
     *
     *
     * @return void
     */
    public function __construct(ModuleUtil $moduleUtil, Util $commonUtil, BusinessUtil $businessUtil, TransactionUtil $transactionUtil)
    {
        $this->moduleUtil = $moduleUtil;
        $this->commonUtil = $commonUtil;
        $this->businessUtil = $businessUtil;
        $this->transactionUtil = $transactionUtil;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('property::customer');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $business_id = request()->session()->get('user.business_id');

        $layout = 'property';
        $customers = Contact::propertyCustomerDropdown($business_id, false, true);
        $land_and_blocks = Property::getLandAndBlockDropdown($business_id, true, true);

        return view('property::customer_payment.create')->with(compact(
            'layout',
            'customers',
            'land_and_blocks',
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('property::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('property::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    /**
     * get property dropddown by customer id
     * @param int $customer_id
     * @return Renderable
     */
    public function getPropertyDropdownByCustomer($customer_id){
        $properties = Property::getLandAndBlockByCustomerDropdown($customer_id, true, true);

        return $this->transactionUtil->createDropdownHtml($properties, 'Please Select');
    }
    
}
