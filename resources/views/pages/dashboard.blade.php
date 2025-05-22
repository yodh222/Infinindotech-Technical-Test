@extends('main.template')

@section('title', 'Page | Dashboard')

@section('content')
<div class="mb-4 col-span-full xl:mb-2">
    <nav class="flex mb-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                    <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Dashboard</span>
                </div>
            </li>
        </ol>
    </nav>
    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Dashboard</h1>
</div>
<div class="grid grid-cols-4 gap-3">
    <x-card
        stat="{{ $customers->count() }}"
        unit="Orang">
            <x-slot:icon>
                <div class="p-3 rounded-lg bg-indigo-100 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.05 7.5h13.9a1.125 1.125 0 011.12 1.243zm-2.723 6.864a.375.375 0 11-.531-.531L12 12.75l-1.406-1.406a.375.375 0 01.531-.531L12 11.25l1.406 1.406a.375.375 0 01-.53 0z" />
                    </svg>
                </div>
            </x-slot>
            Jumlah Pelanggan
    </x-card>
    <x-card
        title=""
        stat="{{ $orders->count() }}"
        unit="Pesanan">
            <x-slot:icon>
                <div class="p-3 rounded-lg bg-cyan-100 dark:bg-cyan-900/20 text-cyan-600 dark:text-cyan-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.05 7.5h13.9a1.125 1.125 0 011.12 1.243zm-2.723 6.864a.375.375 0 11-.531-.531L12 12.75l-1.406-1.406a.375.375 0 01.531-.531L12 11.25l1.406 1.406a.375.375 0 01-.53 0z" />
                    </svg>
                </div>
            </x-slot>
            Total Pesanan
        </x-card>
    <x-card
        stat="Rp. {{ number_format($orders->sum('total_harga'), 0, ',', '.') }}">
            <x-slot:icon>
                <div class="p-3 rounded-lg bg-sky-100 dark:bg-sky-900/20 text-sky-600 dark:text-sky-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.05 7.5h13.9a1.125 1.125 0 011.12 1.243zm-2.723 6.864a.375.375 0 11-.531-.531L12 12.75l-1.406-1.406a.375.375 0 01.531-.531L12 11.25l1.406 1.406a.375.375 0 01-.53 0z" />
                    </svg>
                </div>
            </x-slot>
            Total Pendapatan
        </x-card>
    <x-card
        stat="{{ $products->where('stok', '<', 10)->count() }}"
        unit="Produk">
            <x-slot:icon>
                <div class="p-3 rounded-lg bg-purple-100 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.05 7.5h13.9a1.125 1.125 0 011.12 1.243zm-2.723 6.864a.375.375 0 11-.531-.531L12 12.75l-1.406-1.406a.375.375 0 01.531-.531L12 11.25l1.406 1.406a.375.375 0 01-.53 0z" />
                    </svg>
                </div>
            </x-slot>
            Produk Stok Terendah
    </x-card>
    <div class="col-span-4 block p-6 bg-white border border-gray-200 rounded-lg shadow-sm  dark:bg-gray-800 dark:border-gray-700">
        <h5 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Order Terakhir</h5>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Tabel berisi 10 transaksi terakhir.</p>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nomor
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nomor Faktur
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Pelanggan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Produk
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga Total
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($orders as $order)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">
                                {{ $i++ }}
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $order["no_faktur"] }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $order["nama_pelanggan"] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order["product"] }}
                            </td>
                            <td class="px-6 py-4">
                                Rp. {{ number_format($order["total_harga"], 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($order['status'] == "Belum Lunas")

                                <button type="button" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">{{ $order['status'] }}</button>
                                @else
                                <button type="button" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">{{ $order['status'] }}</button>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $order["tanggal"] }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('invoice', $order['no_faktur']) }}" target="_blank" class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
