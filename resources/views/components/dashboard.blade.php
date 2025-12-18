<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coinledger</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex justify-between relative bg-[#fdfdfd]">
    <nav class="w-[250px] h-screen p-3 fixed z-10 inset-0 bg-white shadow-[0_0_10px_rgba(0,0,0,0.1)] flex flex-col"
        id="sidebar">
        <div class="flex items-center justify-between mb-10">
            <h1 class="flex gap-2 items-center text-lg cursor-pointer" onclick="toggleSidebar()"><img
                    src="{{ asset('images/icons/logo.png') }}" alt="" class="w-12 relative bottom-0.5">CoinLedger</h1>
            <button onclick="toggleSidebar()" class="cursor-pointer p-2 rounded-full hover:bg-gray-200"><img
                    src="{{ asset('images/icons/sidebar-icon.png') }}" alt="" class="h-7 w-7"></button>
        </div>
        <ul
            class="[&>li]:p-2 [&>li]:rounded-full [&>li]:hover:bg-gray-200 flex flex-col gap-10 [&>li>a]:flex [&>li>a]:items-center [&>li>a]:gap-4 [&>li>a]:text-lg [&>li>a>img]:w-7 [&>li>a>img]:h-7">
            <li><a href="{{ route('home.index') }}"><img src="{{ asset('images/icons/home-icon.png') }}" alt="">Home</a>
            </li>
            <li><a href="{{ route('loans.index') }}"><img src="{{ asset('images/icons/loan-icon.png') }}"
                        alt="">Loan</a>
            </li>
            <li><a href="{{ route('savings.index') }}"><img src="{{ asset('images/icons/saving-icon.png') }}"
                        alt="">Saving</a>
            </li>
            <li><a href="{{ route('funds.index') }}"><img src="{{ asset('images/icons/fund-icon.png') }}"
                        alt="">Fund</a>
            </li>
        </ul>
        <form action="{{ route('logout') }}" method="POST" class="mt-auto flex items-center">
            @csrf
            <button
                class="cursor-pointer flex items-center gap-5 text-lg p-2 rounded-full hover:bg-gray-200 w-full"><img
                    src="{{ asset('images/icons/logout-icon.png') }}" alt="" class="h-6 w-6">Logout</button>
        </form>
    </nav>

    <nav class="w-[110px] h-screen p-3 opacity-0 fixed inset-0 flex flex-col" id="sidebarToggled">
        <div class="flex items-center justify-between mb-10">
            <h1 onclick="toggleSidebar()" class="cursor-pointer"><img src="{{ asset('images/icons/logo.png') }}" alt=""
                    class="w-12 relative bottom-0.5"></h1>
            <button onclick="toggleSidebar()" class="cursor-pointer p-2 rounded-full hover:bg-gray-200"><img
                    src="{{ asset('images/icons/sidebar-icon.png') }}" alt="" class="h-7 w-7"></button>
        </div>
        <ul
            class="[&>li]:p-2 [&>li]:rounded-full [&>li]:hover:bg-gray-200 flex flex-col items-start gap-10 [&>li>a]:flex [&>li>a]:items-center [&>li>a]:gap-4 [&>li>a]:text-lg [&>li>a>img]:w-7 [&>li>a>img]:h-7">
            <li class="rounded-full hover:bg-gray-100"><a href="{{ route('home.index') }}"><img
                        src="{{ asset('images/icons/home-icon.png') }}" alt=""></a>
            </li>
            <li><a href="{{ route('loans.index') }}"><img src="{{ asset('images/icons/loan-icon.png') }}" alt=""></a>
            </li>
            <li><a href="{{ route('savings.index') }}"><img src="{{ asset('images/icons/saving-icon.png') }}"
                        alt=""></a>
            </li>
            <li><a href="{{ route('funds.index') }}"><img src="{{ asset('images/icons/fund-icon.png') }}" alt=""></a>
            </li>
        </ul>
        <form action="{{ route('logout') }}" method="POST" class="mt-auto flex items-center">
            @csrf
            <button class="cursor-pointer flex items-center gap-5 text-lg p-2 rounded-full hover:bg-gray-200"><img
                    src="{{ asset('images/icons/logout-icon.png') }}" alt="" class="h-6 w-6"></button>
        </form>
    </nav>
    <main class="h-screen w-full py-3 ml-[calc(250px+20px)] overflow-x-hidden" id="main-content">
        {{ $slot }}
    </main>

    <script>
        function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        const main = document.getElementById("main-content");
        const submenu = document.getElementById("menuToggle");
        
        sidebar.classList.toggle("toggled-sidebar");
        main.classList.toggle("toggled-main");
        submenu.classList.toggle("submenu-toggled");
        }
        
        function toggleSubmenu(clickedButton) {
        // Remove active from all buttons
        document.querySelectorAll(".menu-btn").forEach((btn) => {
        btn.classList.remove("active");
        });
        
        // Remove active from all content
        document.querySelectorAll(".content-item").forEach((item) => {
        item.classList.remove("active");
        });
        
        // Add active to clicked button
        clickedButton.classList.add("active");
        
        // Show corresponding content
        const targetId = clickedButton.getAttribute("data-target");
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
        targetElement.classList.add("active");
        }
        }
        
        // Initialize on page load
        document.addEventListener("DOMContentLoaded", function () {
        // Set first button as active by default if none is active
        const menuButtons = document.querySelectorAll(".menu-btn");
        const contentItems = document.querySelectorAll(".content-item");
        
        if (menuButtons.length > 0 && contentItems.length > 0) {
        const activeButton = document.querySelector(".menu-btn.active");
        if (!activeButton && menuButtons[0]) {
        menuButtons[0].classList.add("active");
        }
        
        const activeContent = document.querySelector(".content-item.active");
        if (!activeContent && contentItems[0]) {
        contentItems[0].classList.add("active");
        }
        }
        });
    </script>
</body>

</html>