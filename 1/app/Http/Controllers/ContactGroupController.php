<?php

namespace App\Http\Controllers;

use App\ContactGroup;
use App\Utils\BusinessUtil;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use App\Utils\Util;
use Illuminate\Http\Request;
use Modules\Superadmin\Entities\HelpExplanation;
use Yajra\DataTables\Facades\DataTables;

class ContactGroupController extends Controller
{
    protected $moduleUtil;

    /**
     * Constructor
     *
     * @param Util $commonUtil
     * @return void
     */
    public function __construct(Util $commonUtil, ModuleUtil $moduleUtil)
    {
        $this->commonUtil = $commonUtil;
        $this->moduleUtil = $moduleUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('customer.view')) {
            abort(403, 'Unauthorized action.');
        }
        $business_id = request()->session()->get('user.business_id');
        if (request()->ajax()) {
            $type = request()->type;

            $groups = ContactGroup::where('business_id', $business_id)->where('type', $type)
                ->select(['name', 'amount', 'id']);

            return Datatables::of($groups)
                ->addColumn(
                    'action',
                    '
                        @can("customer.update")
                        <button data-href="{{action(\'ContactGroupController@edit\', [$id])}}" class="btn btn-xs btn-primary edit_contact_group_button"><i class="glyphicon glyphicon-edit"></i> @lang("messages.edit")</button>
                        &nbsp;
                        @endcan
                        
                        @if($name != "Own Company")
                        @can("customer.delete")
                            <button data-href="{{action(\'ContactGroupController@destroy\', [$id])}}" class="btn btn-xs btn-danger delete_contact_group_button"><i class="glyphicon glyphicon-trash"></i> @lang("messages.delete")</button>
                        @endcan
                        @endif
                        '
                )
                ->removeColumn('id')
                ->rawColumns([2])
                ->make(false);
        }

        $contact_customer = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'contact_customer');
        $contact_supplier = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'contact_supplier');

        return view('contact_group.index')->with(compact(
            'contact_customer',
            'contact_supplier'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('customer.create')) {
            abort(403, 'Unauthorized action.');
        }
        $help_explanations = HelpExplanation::pluck('value', 'help_key');
        $type = request()->type;

        return view('contact_group.create')->with(compact('help_explanations', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('customer.create')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $input = $request->only(['name', 'amount']);
            $input['business_id'] = $request->session()->get('user.business_id');
            $input['type'] = $request->type;
            $input['created_by'] = $request->session()->get('user.id');
            $input['amount'] = !empty($input['amount']) ? $this->commonUtil->num_uf($input['amount']) : 0;

            $contact_group = ContactGroup::create($input);
            $output = [
                'success' => true,
                'data' => $contact_group,
                'msg' => __("lang_v1.success")
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __("messages.something_went_wrong")
            ];
        }

        return $output;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactGroup  $ContactGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('customer.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $contact_group = ContactGroup::where('business_id', $business_id)->find($id);
            $type = $contact_group->type;

            return view('contact_group.edit')
                ->with(compact('contact_group', 'type'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('customer.update')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $input = $request->only(['name', 'amount']);
                $business_id = $request->session()->get('user.business_id');
                $input['type'] = $request->type;
                $input['amount'] = !empty($input['amount']) ? $this->commonUtil->num_uf($input['amount']) : 0;

                $contact_group = ContactGroup::where('business_id', $business_id)->findOrFail($id);
                $contact_group->name = $input['name'];
                $contact_group->amount = $input['amount'];
                $contact_group->save();

                $output = [
                    'success' => true,
                    'msg' => __("lang_v1.success")
                ];
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __("messages.something_went_wrong")
                ];
            }

            return $output;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('customer.delete')) {
            abort(403, 'Unauthorized action.');
        }

        if (request()->ajax()) {
            try {
                $business_id = request()->user()->business_id;

                $cg = ContactGroup::where('business_id', $business_id)->findOrFail($id);
                $cg->delete();

                $output = [
                    'success' => true,
                    'msg' => __("lang_v1.success")
                ];
            } catch (\Exception $e) {
                \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

                $output = [
                    'success' => false,
                    'msg' => __("messages.something_went_wrong")
                ];
            }

            return $output;
        }
    }
}
