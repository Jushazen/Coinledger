<div class="h-19 flex justify-center items-center bg-[#fdfdfd] w-full" id="menuToggle">
    <div class="p-2 w-[84%] flex gap-5 justify-around items-center bg-gray-200 rounded-full text-gray-400 shadow-[inset_0_0_15px_rgba(0,0,0,0.1)]">
        <button class="menu-btn active" onclick="toggleSubmenu(this)" data-target="content1">
            {{ $submenu1 }}
        </button>
        <button class="menu-btn" onclick="toggleSubmenu(this)" data-target="content2">
            {{ $submenu2 }}
        </button>
    </div>
</div>