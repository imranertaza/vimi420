@php
$business_id = request()->session()->get('user.business_id');
$subscription = Modules\Superadmin\Entities\Subscription::active_subscription($business_id);
$job_sheets_permission = null;
$add_job_sheet_permission = null;
$list_invoice_permission = null;
$add_invoice_permission = null;
$brands_permission = null;
$repair_settings_permission = null;

if(!empty($subscription)){
    $pacakge_details = $subscription->package_details;
    if(array_key_exists('job_sheets', $pacakge_details)){
        $job_sheets_permission = $pacakge_details['job_sheets'];
    }
    if(array_key_exists('add_job_sheet', $pacakge_details)){
        $add_job_sheet_permission = $pacakge_details['add_job_sheet'];
    }
    if(array_key_exists('list_invoice', $pacakge_details)){
        $list_invoice_permission = $pacakge_details['list_invoice'];
    }

    if(array_key_exists('add_invoice', $pacakge_details)){
        $add_invoice_permission = $pacakge_details['add_invoice'];
    }
    if(array_key_exists('brands', $pacakge_details)){
        $brands_permission = $pacakge_details['brands'];
    }
    if(array_key_exists('repair_settings', $pacakge_details)){
        $repair_settings_permission = $pacakge_details['repair_settings'];
    }
}

if (auth()->user()->can('superadmin')) {
    $job_sheets_permission = 1;
    $add_job_sheet_permission = 1;
    $list_invoice_permission = 1;
    $add_invoice_permission = 1;
    $brands_permission = 1;
    $repair_settings_permission = 1;
}
@endphp
<section class="no-print">
    <nav class="navbar navbar-default bg-white m-4">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"
                    href="{{action('\Modules\Repair\Http\Controllers\DashboardController@index')}}"><i
                        class="fa fa-wrench"></i> {{__('repair::lang.repair')}}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    @if($job_sheets_permission)
                    @if(auth()->user()->can('job_sheet.create') || auth()->user()->can('job_sheet.view_assigned') ||
                    auth()->user()->can('job_sheet.view_all'))
                    <li @if(request()->segment(2) == 'job-sheet' && empty(request()->segment(3))) class="active" @endif>
                        <a href="{{action('\Modules\Repair\Http\Controllers\JobSheetController@index')}}">
                            @lang('repair::lang.job_sheets')
                        </a>
                    </li>
                    @endif
                    @endif
                    @if($add_job_sheet_permission)
                    @can('job_sheet.create')
                    <li @if(request()->segment(2) == 'job-sheet' && request()->segment(3) == 'create') class="active"
                        @endif>
                        <a href="{{action('\Modules\Repair\Http\Controllers\JobSheetController@create')}}">
                            @lang('repair::lang.add_job_sheet')
                        </a>
                    </li>
                    @endcan
                    @endif

                    @if($list_invoice_permission)
                    @can('repair.view')
                    <li @if(request()->segment(2) == 'repair' && empty(request()->segment(3))) class="active" @endif><a
                            href="{{action('\Modules\Repair\Http\Controllers\RepairController@index')}}">@lang('repair::lang.list_invoices')</a>
                    </li>
                    @endcan
                    @endif

                    @if($add_invoice_permission)
                    @can('repair.create')
                    <li @if(request()->segment(2) == 'repair' && request()->segment(3) == 'create') class="active"
                        @endif><a
                            href="{{ action('SellPosController@create'). '?sub_type=repair'}}">@lang('repair::lang.add_invoice')</a>
                    </li>
                    @endcan
                    @endif

                    @if($brands_permission)
                    @if(auth()->user()->can('brand.view') || auth()->user()->can('brand.create'))
                    <li @if(request()->segment(1) == 'brands') class="active" @endif><a
                            href="{{action('BrandController@index')}}">@lang('brand.brands')</a></li>
                    @endif
                    @endif

                    @if($repair_settings_permission)
                    <li @if(request()->segment(1) == 'repair' && request()->segment(2) == 'repair-settings')
                        class="active" @endif><a
                            href="{{action('\Modules\Repair\Http\Controllers\RepairSettingsController@index')}}">@lang('messages.settings')</a>
                    </li>
                    @endif
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</section>