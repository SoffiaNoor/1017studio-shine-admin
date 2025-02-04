<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Charts | TailAdmin - Tailwind CSS Admin Dashboard Template</title>

  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>

<body
  x-data="{ page: 'Chart', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
  x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
  :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
  @include('partials.preloader')


  <div class="flex h-screen overflow-hidden">
    @include('partials.sidebar')

    <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
      @include('partials.header')

      <main>
        <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
          <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="text-title-md2 font-bold text-black dark:text-white">
              Chart
            </h2>

            <nav>
              <ol class="flex items-center gap-2">
                <li>
                  <a class="font-medium" href="index.html">Dashboard /</a>
                </li>
                <li class="font-medium text-primary">Chart</li>
              </ol>
            </nav>
          </div>

          <div class="grid grid-cols-12 gap-4 md:gap-6 2xl:gap-7.5">
            <div class="col-span-12">
              @include('partials.chart-04')
            </div>

            @include('partials.chart-01')
            @include('partials.chart-02')
            @include('partials.chart-03')

          </div>
        </div>
      </main>
    </div>
  </div>
  @vite('resources/js/app.js')

</body>

</html>