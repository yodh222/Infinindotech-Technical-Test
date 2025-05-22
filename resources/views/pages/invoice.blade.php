<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #invoice, #invoice * {
                visibility: visible;
            }

            #invoice {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                padding: 20px;
            }

            /* Optional: Hilangkan tombol print, navigasi, dsb */
            .no-print {
                display: none !important;
            }
        }

    </style>
</head>
<body class="bg-white p-8 text-gray-800">
    <div class="max-w-4xl mx-auto border p-6 rounded shadow">
        <div id="invoice">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Infinindotech</h1>
                    <p>Jl. Cocak I no 17 RT. 01 RW 03<br>Kelurahan Mangkubumen, Kecamatan Banjarsari, Kota Surakarta 57139</p>
                </div>
                <div>
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Perusahaan" class="h-20">
                </div>
            </div>

            <div class="mb-4">
                <h2 class="text-xl font-semibold">INVOICE</h2>
                <p><strong>No Faktur:</strong> {{ $orders[0]->no_faktur }}</p>
                <p><strong>Tanggal:</strong> {{ $orders[0]->created_at }}</p>
            </div>

            <div class="mb-6">
                <h3 class="font-semibold">Untuk:</h3>
                <p>{{ $orders[0]->customer->nama }}</p>
                <p>{{ $orders[0]->customer->alamat }}</p>
            </div>

            <table class="w-full text-left border-collapse mb-6">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">Nama Produk</th>
                        <th class="p-2 border">Jumlah</th>
                        <th class="p-2 border">Harga Satuan</th>
                        <th class="p-2 border">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="p-2 border">1</td>
                            <td class="p-2 border">{{ $order['product']->nama }}</td>
                            <td class="p-2 border">{{ $order->jumlah_dibeli }}</td>
                            <td class="p-2 border">Rp. {{ number_format($order['product']->harga, 0, ',', '.') }}</td>
                            <td class="p-2 border">Rp. {{ number_format($order->jumlah_dibeli * $order['product']->harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right mb-6">
                <p><strong>Total:</strong> <span class="text-lg font-bold">Rp. {{ number_format($orders->sum(fn($order) => $order->product->harga * $order->jumlah_dibeli), 0, ',', '.') }}</p>
                <p><strong>Status Pembayaran:</strong> <span class="text-{{ $orders->first()->status === 'Belum Lunas' ? 'red' : 'green' }}-600 font-semibold">{{ $orders->first()->status }}</span></p>
            </div>

            <div class="text-center text-sm text-gray-500">
                <p>Terima kasih telah berbelanja bersama kami.</p>
            </div>
        </div>

        <div class="mt-6 text-center no-print">
            <button id="print-invoice" class="bg-primary-600 text-white px-4 py-2 rounded hover:bg-primary-700">Cetak Invoice</button>
        </div>
    </div>
    <script>
        $('#print-invoice').on('click', function () {
            window.print();
        });
    </script>
</body>
</html>
