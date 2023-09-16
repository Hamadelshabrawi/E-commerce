<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    @include('home.dashboard.head')
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->


@include('home.dashboard.sidebar')






<div class="flex flex-col flex-1 w-full">
@include('home.dashboard.header')


<table class="w-full whitespace-no-wrap">
  <thead>
    <tr
      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
    >
      <th class="px-4 py-3">Num</th>
      <th class="px-4 py-3">order_id</th>
      <th class="px-4 py-3">total</th>
      <th class="px-4 py-3">delivery</th>
      <th class="px-4 py-3">paid by</th>
      <th class="px-4 py-3">created at</th>
      <th class="px-4 py-3">Select</th>


    </tr>
  </thead>
  <tbody
    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
  >
  @php $num = 1; @endphp
  @foreach ( $my_order as $my_order )
      
    <tr class="text-gray-700 dark:text-gray-400">

      <td class="px-4 py-3">
      {{ $num++ }}
      </td>


      <td class="px-4 py-3 text-sm">
        {{ $my_order->order_id }}
      </td>
      <td class="px-4 py-3 text-xs">
        {{-- <span
          class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
        >
          Approved
        </span> --}}
        {{ $my_order->total }}

      </td>
      <td class="px-4 py-3 text-sm">

        {{ $my_order->delivery }}

      </td>
      <td class="px-4 py-3 text-sm">
        {{ $my_order->paid_by }}

      </td>
        <td class="px-4 py-3 text-sm">
        {{ $my_order->created_at }}

      </td>

      <td class="px-4 py-3 text-sm">
          <a class="badge badge-danger" href ="{{ url('show_my_invoice',$my_order->order_id) }}" >Select</a>

      </td>
      
    </tr>


    @endforeach


  </tbody>
</table>


  </body>
</html>
