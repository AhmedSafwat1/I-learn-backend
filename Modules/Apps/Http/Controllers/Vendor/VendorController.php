<?php

namespace Modules\Apps\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Order\Repositories\Vendor\OrderRepository;
use Modules\Vendor\Repositories\Vendor\OfferRepository;
use Modules\Vendor\Repositories\Vendor\VendorRepository;
use Modules\Vendor\Repositories\Dashboard\VendorRepository as Vendor;
use Modules\Vendor\Repositories\Dashboard\VendorStatusRepository as VendorStatus;

class VendorController extends Controller
{
    protected $vendorStatuses;
    protected $vendor;

    function __construct(Vendor $vendor, VendorStatus $vendorStatuses)
    {
        $this->vendorStatuses = $vendorStatuses;
        $this->vendor = $vendor;
    }

    public function index()
    {
        $orderRepo  = app()->make(OrderRepository::class);
        $offerRepo  = app()->make(OfferRepository::class);
        $orderCount = $orderRepo->getAllCount();
        $offerCount = $offerRepo->getCount(); 
        return view('apps::vendor.index', compact("orderCount", 'offerCount'));
    }

    public function editVendorInfo(Request $request)
    {
        $vendor = $this->vendor->findById($request->id);
        if (!$vendor)
            abort(404);
        return view('apps::vendor.edit', compact('vendor'));
    }

    public function updateVendorInfo(Request $request, $id)
    {
        try {
            $update = $this->vendor->updateInfo($request, $id);

            if ($update) {
                return Response()->json([true,  __('apps::dashboard.messages.updated')]);
            }

            return Response()->json([false,__('apps::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

}
