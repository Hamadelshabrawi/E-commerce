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


@include('home.dashboard.main')

      </div>
    </div>
  </body>
</html>
