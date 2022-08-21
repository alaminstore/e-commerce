<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class SalesSummeryReportController extends Controller
{
    public function __invoke(Request $request)
    {
        $dateRange = explode(',', $request->created_between); //in filter section, by default currentdate receive from front end(react js)
        $salesSummeryReport = DB::table('orders AS o')
            ->selectRaw('o.id AS id,
                o.order_code AS code,
                o.ordered_amount AS amount,
                o.total_price AS total_price,
                o.ordered_qty AS quantity,
                o.store_name AS store_name,
                o.brands AS brands,
                payment.payable AS payable,
                payment.due AS due,
                payment.total_paid AS total_paid,
                payment.paid_at AS paid_at,
                payment.status AS payment_status,
                product.id AS product_id,
                product.product_name AS product_name,
                product.sku AS sku,
                product.thumbnail AS thumbnail,
                product.mrp AS mrp')
            ->join('payment_infos AS payment', 'o.payment_info_id', '=', 'payment.id')
            ->join('product_id AS product', 'o.product_id', '=', 'product.id')
            ->where('i.latest_status', '=', request()->latest_status)
            ->whereDate('o.created_at', '>=', $dateRange[0])
            ->whereDate('o.created_at', '<=', $dateRange[1])
            ->when(request()->has('product_name'), function (Builder $builder) {
                $builder->where('product.product_name', 'like', request()->product_name . '%');
            })
            ->when(request()->has('store_name'), function (Builder $builder) {
                $builder->where('o.store_name', 'like', request()->store_name . '%');
            })
            ->when(request()->has('brands'), function (Builder $builder) {
                $builder->where('o.brands', 'like', request()->brands . '%');
            })
            // ->when(request()->has('created_between'), function (Builder $builder) {
            //     $dateRange = explode(',', request()->created_between);
            //     $builder->whereDate('o.created_at', '>=', $dateRange[0])
            //         ->whereDate('o.created_at', '<=', $dateRange[1]);
            // })              // if we want to use created date menually, not coming from front end by default
            ->orderBy('o.updated_at', 'desc')
            ->paginate();
        return response()->json('salesSummeryReport', $salesSummeryReport);
    }
}
