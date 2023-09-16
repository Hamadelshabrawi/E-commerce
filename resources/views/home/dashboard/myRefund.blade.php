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
      <th class="px-4 py-3">#</th>
      <th class="px-4 py-3">order id</th>
      <th class="px-4 py-3">Reason</th>
      <th class="px-4 py-3">Type of Refund</th>
      <th class="px-4 py-3">Admin Status</th>
      <th class="px-4 py-3">Admin Name</th>
      <th class="px-4 py-3">At</th>


    </tr>
  </thead>
  <tbody
    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
  >
  @php $num = 1; @endphp
  @foreach ( $datarefund as $datarefund )
      
    <tr class="text-gray-700 dark:text-gray-400">

      <td class="px-4 py-3">
      {{ $num++ }}
      </td>


      <td class="px-4 py-3 text-sm">
        {{ $datarefund->order_id }}
      </td>
      <td class="px-4 py-3 text-xs">
        {{-- <span
          class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
        >
          Approved
        </span> --}}
        {{ $datarefund->reason }}

      </td>
      <td class="px-4 py-3 text-sm">

        {{ $datarefund->replaceOrrefund }}

      </td>
      <td class="px-4 py-3 text-sm">
        
        {{ $datarefund->admin_approved }}


      </td>

        
        @if (!empty($adminName[$num-2]))
        <td class="px-4 py-3 text-sm">{{ $adminName[$num-2] }} </td>
        @else
        <td class="px-4 py-3 text-sm"> </td>
        @endif

      
      <td class="px-4 py-3 text-sm">
          <a class="badge badge-danger" href ="{{ url('show_my_invoice',$datarefund->order_id) }}" >Select</a>

      </td>
      
    </tr>


    @endforeach


  </tbody>
</table>

  </body>
</html>
