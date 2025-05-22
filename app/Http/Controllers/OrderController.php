<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search  = $request->get('query');
        $perPage = (int) $request->get('size', 10);

        $orders = Order::with('product', 'customer')
            ->when($search, function ($query, $search) {
                $query->where('no_faktur', 'like', "%{$search}%")
                    ->orWhere('total_harga', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            })
            ->get()
            ->groupBy('no_faktur')
            ->map(function ($data) {
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
                    'id'             => $data->first()->id,
                    'no_faktur'      => $data->first()->no_faktur,
                    'nama_pelanggan' => $data->first()->customer->nama,
                    'nomor_telepon' => $data->first()->customer->no_telp,
                    'product'        => $products,
                    'jumlah_dibeli'  => $data->sum('jumlah_dibeli'),
                    'total_harga'    => $data->sum('total_harga'),
                    'status'         => $data->first()->status,
                    'created_at'     => $data->first()->created_at,
                    'tanggal'        => $data->first()->created_at->format('d-m-Y'),
                ];
            })
            ->sortByDesc(fn($item) => $item['created_at']->timestamp)
            ->values();

        // Paginate secara manual
        $page = $request->get('page', 1);
        $paginatedOrders = new \Illuminate\Pagination\LengthAwarePaginator(
            $orders->forPage($page, $perPage),
            $orders->count(),
            $perPage,
            $page,
            ['path' => url()->current(), 'query' => $request->query()]
        );

        $customers = Customer::all();
        $products = Product::all();

        return view('pages.order', compact('paginatedOrders', 'search', 'perPage', 'customers', 'products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $hex = strtoupper(bin2hex(random_bytes(10)));
        $noFaktur = "FK-$hex";

        $customerId = $request->input('customer_id');
        $productIds = $request->input('product_id');
        $jumlahList = $request->input('jumlah_dibeli');

        $customer       = Customer::findOrFail($customerId);

        DB::beginTransaction();

        try {
            foreach ($productIds as $i => $productId) {
                $product = Product::findOrFail($productId);
                $jumlah  = $jumlahList[$i];
                $total   = $product->harga * $jumlah;

                Order::create([
                    'no_faktur'   => $noFaktur,
                    'customer_id' => $customerId,
                    'product_id'  => $productId,
                    'jumlah_dibeli'      => $jumlah,
                    'total_harga' => $total,
                    'status'      => "Belum Lunas",
                ]);
            }

            DB::commit();

            return redirect()->route('orders.index')->with('success', 'Pesanan dari pelanggan ' . $customer->nama . ' berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan pesanan' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Order $order)
    {
        $no_faktur = $order->no_faktur;

        $orders = Order::where('no_faktur', $no_faktur)->update(['status' => 'Lunas']);
        return redirect()->route('orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if ($order->status === 'Lunas') {
            return redirect()->back()->with('error', "Pesanan dengan No Faktur {$order->no_faktur} tidak dapat dihapus karena sudah Lunas.");
        }

        Order::where('no_faktur', $order->no_faktur)->delete();
        return redirect()->back()->with('success', "Semua pesanan dengan No Faktur {$order->no_faktur} berhasil dihapus.");
    }
}
