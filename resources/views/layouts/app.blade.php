<!DOCTYPE html>
<html lang="en">

<x-head />

<body class="g-sidenav-show  bg-gray-100">
    <x-sidenav />
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        <x-nav />
        @yield('content')
       
           
            <!-- <x-footer /> -->
        </div>
    </main>
    <fiexed_plugin />
    <js-files />

</body>

</html>