<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tables | TailAdmin - Tailwind CSS Admin Dashboard Template</title>

  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>

<body
  x-data="{ page: 'tables', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
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
              Tables
            </h2>

            <nav>
              <ol class="flex items-center gap-2">
                <li>
                  <a class="font-medium" href="index.html">Dashboard /</a>
                </li>
                <li class="font-medium text-primary">Tables</li>
              </ol>
            </nav>
          </div>

          <div class="flex flex-col gap-10">
            @include('partials.table-01')
            @include('partials.table-01')
            @include('partials.table-03')
          </div>
        </div>
      </main>
    </div>
  </div>
  @vite('resources/js/app.js')

</body>

</html>