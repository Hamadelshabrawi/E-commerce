<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    @include('home.dashboard.head')
    @include('sweetalert::alert')

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
      <th class="px-4 py-3">product Name</th>
      <th class="px-4 py-3">comment</th>
      <th class="px-4 py-3">Remove</th>
      <th class="px-4 py-3">At</th>
    </tr>
  </thead>
  <tbody
    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
  >
  @php $num = 1; @endphp
  @foreach ( $dataComment as $dataComment )
      
    <tr class="text-gray-700 dark:text-gray-400">

      <td class="px-4 py-3">
      {{ $num++ }}
      </td>


      <td class="px-4 py-3 text-sm">
        
        <a href="{{ url('/more_details',$dataComment->product_id) }}">{{ $dataComment->product_title }}</a>
      </td>
      <td class="px-4 py-3 text-xs">
        {{ $dataComment->comment }}

      </td>
      <td class="">
        <form action="{{ url('remove_mycomment',$dataComment->id) }}" method="post">
          @csrf
          <button class="btn btn-primary" >Remove<button>
            
        </form>

      </td>
      <td class="px-4 py-3 text-sm">
        {{ $dataComment->created_at }}

      </td>

      <td class="px-4 py-3 text-sm">

      </td>
      
    </tr>


    @endforeach


  </tbody>
</table>

  </body>
</html>
