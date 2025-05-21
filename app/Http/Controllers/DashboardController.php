<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        $orders = Order::with('product', 'customer')->get()->groupBy('no_faktur')->map(function ($data) {
            $products = "";
            $productsCount = count($data);

            foreach ($data as $i => $value):
                if ($i == $productsCount - 1) {
                    $products .= $value->product->nama . " ($value->jumlah_dibeli Produk)";
                } else {
                    $products .= $value->product->nama . " ($value->jumlah_dibeli Produk) ; ";
                }
            endforeach;

            return [
                'no_faktur' => $data->first()->no_faktur,
                'nama_pelanggan' => $data->first()->customer->nama,
                'product' => $products,
                'jumlah_dibeli' => $data->sum('jumlah_dibeli'),
                'total_harga' => $data->sum('total_harga'),
                'status' => $data->first()->status,
                'created_at' => $data->first()->created_at,
                'tanggal' => $data->first()->created_at->format('d-m-Y'),
            ];
        })->sortByDesc(fn($item) => $item['created_at']->timestamp)->take(10);
        $products = Product::all();
        return view('pages.dashboard', ['customers' => $customers, 'orders' => $orders, 'products' => $products]);
    }
}
