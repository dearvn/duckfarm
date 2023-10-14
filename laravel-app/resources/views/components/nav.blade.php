<nav
    x-cloak
    x-data="{}"
    x-ref="nav"
    x-init="
        () => {
            if (reducedMotion) return
            const navTimeline = gsap
                .timeline({
                    paused: true,
                })
                .fromTo(
                    $refs.nav.querySelectorAll('.gsap-fadein'),
                    {
                        autoAlpha: 0,
                        y: -10,
                    },
                    {
                        autoAlpha: 1,
                        y: 0,
                        duration: 0.5,
                        stagger: 0.05,
                    },
                )

            if ($refs.nav.querySelectorAll('.gsap-popout').length) {
                navTimeline.fromTo(
                    $refs.nav.querySelectorAll('.gsap-popout'),
                    {
                        autoAlpha: 0,
                        y: -30,
                        rotate: 360,
                    },
                    {
                        autoAlpha: 1,
                        y: 0,
                        rotate: -45,
                        duration: 0.6,
                        ease: 'back.out(1.5)',
                    },
                    '<0.2',
                )
            }

            navTimeline.play()
        }
    "
    class="relative mx-auto flex max-w-8xl items-center justify-between overflow-x-clip px-8 py-10 sm:overflow-x-visible"
>
    {{-- Background Blob --}}
    <img
        src="{{ Vite::asset('resources/svg/background-blob.svg') }}"
        alt="Blob"
        class="absolute -top-[10rem,clamp(50vw),40rem] right-0 z-[-100] lg:-right-[10rem]"
    />

    {{-- Mobile Menu Button --}}
    <button
        x-data="{}"
        aria-controls="main-menu"
        aria-haspopup="true"
        x-on:click.prevent="$store.sidebar.isOpen = ! $store.sidebar.isOpen"
        x-on:click.away="$store.sidebar.isOpen = false"
        class="transition duration-300 hover:scale-110 lg:hidden"
    >
        <x-heroicon-o-bars-3 class="h-7 w-7" />

        <span class="sr-only">Toggle Menu</span>
    </button>

    {{-- Filament Logo --}}
    <a
        href="/"
        class="group/filament gsap-fadein relative"
    >
        <div class="text-black">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="144" height="29" viewBox="0 0 144 29" xml:space="preserve">
                <desc>Created with Fabric.js 5.2.4</desc>
                <defs>
                </defs>
                <g transform="matrix(1 0 0 1 72 14.5)" id="fe67d88c-780e-496c-80db-3a16d856dbd0"  >
                <rect style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(255,255,255); fill-rule: nonzero; opacity: 1; visibility: hidden;" vector-effect="non-scaling-stroke"  x="-72" y="-14.5" rx="0" ry="0" width="144" height="29" />
                </g>
                </g>
                <g transform="matrix(1 0 0 1 233.72 -8.73)" style="" id="fcd0a262-1023-4323-84df-de6c9c430463"  >
                    <text xml:space="preserve" font-family="Raleway" font-size="63" font-style="normal" font-weight="900" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1; white-space: pre;" ></text>
                </g>
                <g transform="matrix(1 0 0 1 72 14.5)" style="" id="6ac11bf3-0fd3-49c8-a01a-82d1f00c5ac8"  >
                    <text xml:space="preserve" font-family="Alegreya" font-size="37" font-style="normal" font-weight="700" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-dashoffset: 0; stroke-linejoin: miter; stroke-miterlimit: 4; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1; white-space: pre;" ><tspan x="-48.14" y="11.62" >FARM</tspan></text>
                </g>
            </svg>

            {{-- Bulb --}}
            <div
                class="absolute -left-2 -top-3.5 -z-10 transition duration-300 will-change-transform group-hover/filament:opacity-100 motion-reduce:transition-none min-[400px]:-left-1 md:-left-px md:-top-2.5"
            >
                <img
                    x-ref="icon-logo"
                    src="{{ Vite::asset('resources/svg/carot.svg') }}"
                    alt="Shape"
                    class="block w-14"
                />
            </div>
        </div>
    </a>

    {{-- Nav Links --}}
    <div class="flex items-center justify-end gap-8 font-semibold sm:gap-14">
        {{-- <div class="group/packages relative"> --}}
        {{-- <div --}}
        {{-- class="peer hidden text-evening opacity-80 transition delay-75 duration-300 group-hover/packages:opacity-100 motion-reduce:transition-none lg:block" --}}
        {{-- > --}}
        {{-- <div class="gsap-fadein flex items-center gap-2"> --}}
        {{-- <div>Packages</div> --}}
        {{-- <div --}}
        {{-- class="transition duration-200 group-hover/packages:rotate-180 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="24" --}}
        {{-- height="24" --}}
        {{-- class="scale-90" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- fill="none" --}}
        {{-- stroke="currentColor" --}}
        {{-- stroke-linecap="round" --}}
        {{-- stroke-linejoin="round" --}}
        {{-- stroke-width="2" --}}
        {{-- d="m19 9l-7 6l-7-6" --}}
        {{-- /> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </div> --}}

        {{--  --}}
        {{-- Packages Menu --}}
        {{-- <div --}}
        {{-- class="invisible absolute -right-[40rem] top-6 z-[100] w-screen max-w-4xl -translate-y-2 p-5 opacity-0 transition delay-75 duration-300 hover:visible hover:translate-y-0 hover:opacity-100 peer-hover:visible peer-hover:translate-y-0 peer-hover:opacity-100 motion-reduce:transition-none min-[1100px]:-right-[30rem] min-[1400px]:right-1/2 min-[1400px]:translate-x-1/2" --}}
        {{-- > --}}
        {{-- <div --}}
        {{-- class="flex items-start rounded-xl bg-cream px-8 pb-8 pt-7 shadow-xl shadow-black/10 ring-1 ring-merino" --}}
        {{-- > --}}
        {{--  --}}
        {{-- Left Side --}}
        {{-- <div class="space-y-4"> --}}
        {{-- <div class="text-sm font-medium text-hurricane/70"> --}}
        {{-- Essentials --}}
        {{-- </div> --}}
        {{-- <div class="grid gap-7"> --}}
        {{-- <a --}}
        {{-- href="#" --}}
        {{-- class="group/package-link flex items-center gap-5 transition duration-300 will-change-transform hover:translate-x-0.5 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <div --}}
        {{-- class="grid h-[3.25rem] w-[3.25rem] shrink-0 place-items-center rounded-xl bg-merino text-hurricane" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="37" --}}
        {{-- height="37" --}}
        {{-- viewBox="0 0 21 21" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- fill="none" --}}
        {{-- stroke="currentColor" --}}
        {{-- stroke-linecap="round" --}}
        {{-- stroke-linejoin="round" --}}
        {{-- d="m17.498 15.498l-.01-10a2 2 0 0 0-2-1.998h-10a2 2 0 0 0-1.995 1.85l-.006.152l.01 10a2 2 0 0 0 2 1.998h10a2 2 0 0 0 1.995-1.85zM7.5 7.5v9.817m10-9.817h-14" --}}
        {{-- /> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- <div class="space-y-0.5"> --}}
        {{-- <div class="flex items-center gap-2"> --}}
        {{-- <div --}}
        {{-- class="text-base font-bold text-evening" --}}
        {{-- > --}}
        {{-- Panel Builder --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="-translate-x-1 scale-x-90 text-butter opacity-0 transition duration-300 group-hover/package-link:translate-x-0 group-hover/package-link:scale-x-100 group-hover/package-link:opacity-100 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="22" --}}
        {{-- height="22" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- fill="none" --}}
        {{-- stroke="currentColor" --}}
        {{-- stroke-linecap="round" --}}
        {{-- stroke-linejoin="round" --}}
        {{-- stroke-width="2" --}}
        {{-- d="M4 12h16m0 0l-6-6m6 6l-6 6" --}}
        {{-- /> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="max-w-xs text-sm font-medium text-dolphin" --}}
        {{-- > --}}
        {{-- Build a Laravel admin panel, customer-facing --}}
        {{-- app, SaaS, or anything you can imagine! --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </a> --}}
        {{-- <a --}}
        {{-- href="#" --}}
        {{-- class="group/package-link flex items-center gap-5 transition duration-300 will-change-transform hover:translate-x-0.5 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <div --}}
        {{-- class="grid h-[3.25rem] w-[3.25rem] shrink-0 place-items-center rounded-xl bg-merino text-hurricane" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="37" --}}
        {{-- height="37" --}}
        {{-- viewBox="0 0 48 48" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- fill="currentColor" --}}
        {{-- d="M21 21.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0Zm-2.5 0a2 2 0 1 0-4 0a2 2 0 0 0 4 0Zm-2 15.5a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9Zm0-2.5a2 2 0 1 1 0-4a2 2 0 0 1 0 4ZM13.25 12a1.25 1.25 0 1 0 0 2.5h21.5a1.25 1.25 0 1 0 0-2.5h-21.5ZM23 21.75c0-.69.56-1.25 1.25-1.25h10.5a1.25 1.25 0 1 1 0 2.5h-10.5c-.69 0-1.25-.56-1.25-1.25ZM24.25 31a1.25 1.25 0 1 0 0 2.5h10.5a1.25 1.25 0 1 0 0-2.5h-10.5Zm-12-25A6.25 6.25 0 0 0 6 12.25v23.5A6.25 6.25 0 0 0 12.25 42h23.5A6.25 6.25 0 0 0 42 35.75v-23.5A6.25 6.25 0 0 0 35.75 6h-23.5ZM8.5 12.25a3.75 3.75 0 0 1 3.75-3.75h23.5a3.75 3.75 0 0 1 3.75 3.75v23.5a3.75 3.75 0 0 1-3.75 3.75h-23.5a3.75 3.75 0 0 1-3.75-3.75v-23.5Z" --}}
        {{-- /> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- <div class="space-y-0.5"> --}}
        {{-- <div class="flex items-center gap-2"> --}}
        {{-- <div --}}
        {{-- class="text-base font-bold text-evening" --}}
        {{-- > --}}
        {{-- Form Builder --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="-translate-x-1 scale-x-90 text-butter opacity-0 transition duration-300 group-hover/package-link:translate-x-0 group-hover/package-link:scale-x-100 group-hover/package-link:opacity-100 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="22" --}}
        {{-- height="22" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- fill="none" --}}
        {{-- stroke="currentColor" --}}
        {{-- stroke-linecap="round" --}}
        {{-- stroke-linejoin="round" --}}
        {{-- stroke-width="2" --}}
        {{-- d="M4 12h16m0 0l-6-6m6 6l-6 6" --}}
        {{-- /> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="max-w-xs text-sm font-medium text-dolphin" --}}
        {{-- > --}}
        {{-- Easily build stunning Livewire-powered forms --}}
        {{-- with over 25 components out of the box. --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </a> --}}
        {{-- <a --}}
        {{-- href="#" --}}
        {{-- class="group/package-link flex items-center gap-5 transition duration-300 will-change-transform hover:translate-x-0.5 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <div --}}
        {{-- class="grid h-[3.25rem] w-[3.25rem] shrink-0 place-items-center rounded-xl bg-merino text-hurricane" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="37" --}}
        {{-- height="37" --}}
        {{-- viewBox="0 0 28 28" --}}
        {{-- > --}}
        {{-- <path fill="currentColor" d="M3 6.75A3.75 3.75 0 0 1 6.75 3h14.5A3.75 3.75 0 0 1 25 6.75v14.5A3.75 3.75 0 0 1 21.25 25H6.75A3.75 3.75 0 0 1 3 21.25V6.75ZM4.5 18.5v2.75a2.25 2.25 0 0 0 2.25 2.25H9.5v-5h-5Zm5-1.5v-6h-5v6h5Zm1.5 1.5v5h6v-5h-6Zm6-1.5v-6h-6v6h6Zm1.5 1.5v5h2.75a2.25 2.25 0 0 0 2.25-2.25V18.5h-5Zm5-1.5v-6h-5v6h5Zm0-10.25a2.25 2.25 0 0 0-2.25-2.25H18.5v5h5V6.75ZM17 4.5h-6v5h6v-5Zm-7.5 0H6.75A2.25 2.25 0 0 0 4.5 6.75V9.5h5v-5Z"/> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- <div class="space-y-0.5"> --}}
        {{-- <div class="flex items-center gap-2"> --}}
        {{-- <div --}}
        {{-- class="text-base font-bold text-evening" --}}
        {{-- > --}}
        {{-- Table Builder --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="-translate-x-1 scale-x-90 text-butter opacity-0 transition duration-300 group-hover/package-link:translate-x-0 group-hover/package-link:scale-x-100 group-hover/package-link:opacity-100 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="22" --}}
        {{-- height="22" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- fill="none" --}}
        {{-- stroke="currentColor" --}}
        {{-- stroke-linecap="round" --}}
        {{-- stroke-linejoin="round" --}}
        {{-- stroke-width="2" --}}
        {{-- d="M4 12h16m0 0l-6-6m6 6l-6 6" --}}
        {{-- ></path> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="max-w-xs text-sm font-medium text-dolphin" --}}
        {{-- > --}}
        {{-- Craft beautiful, optimized, and interactive --}}
        {{-- Livewire-powered datatables for any situation. --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </a> --}}
        {{-- <a --}}
        {{-- href="#" --}}
        {{-- class="group/package-link flex items-center gap-5 transition duration-300 will-change-transform hover:translate-x-0.5 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <div --}}
        {{-- class="grid h-[3.25rem] w-[3.25rem] shrink-0 place-items-center rounded-xl bg-merino text-hurricane" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="31" --}}
        {{-- height="31" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <g --}}
        {{-- fill="none" --}}
        {{-- stroke="currentColor" --}}
        {{-- stroke-width="1.5" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- d="M18.75 9.71v-.705C18.75 5.136 15.726 2 12 2S5.25 5.136 5.25 9.005v.705a4.4 4.4 0 0 1-.692 2.375L3.45 13.81c-1.011 1.575-.239 3.716 1.52 4.214a25.775 25.775 0 0 0 14.06 0c1.759-.498 2.531-2.639 1.52-4.213l-1.108-1.725a4.4 4.4 0 0 1-.693-2.375Z" --}}
        {{-- /> --}}
        {{-- <path --}}
        {{-- stroke-linecap="round" --}}
        {{-- d="M7.5 19c.655 1.748 2.422 3 4.5 3s3.845-1.252 4.5-3" --}}
        {{-- /> --}}
        {{-- </g> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- <div class="space-y-0.5"> --}}
        {{-- <div class="flex items-center gap-2"> --}}
        {{-- <div --}}
        {{-- class="text-base font-bold text-evening" --}}
        {{-- > --}}
        {{-- Notifications --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="-translate-x-1 scale-x-90 text-butter opacity-0 transition duration-300 group-hover/package-link:translate-x-0 group-hover/package-link:scale-x-100 group-hover/package-link:opacity-100 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="22" --}}
        {{-- height="22" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- fill="none" --}}
        {{-- stroke="currentColor" --}}
        {{-- stroke-linecap="round" --}}
        {{-- stroke-linejoin="round" --}}
        {{-- stroke-width="2" --}}
        {{-- d="M4 12h16m0 0l-6-6m6 6l-6 6" --}}
        {{-- /> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="max-w-xs text-sm font-medium text-dolphin" --}}
        {{-- > --}}
        {{-- Notify your users of important events by --}}
        {{-- delivering real-time messages using Livewire. --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </a> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{--  --}}
        {{-- Seperator --}}
        {{-- <div class="pl-4 pr-6 pt-10"> --}}
        {{-- <div --}}
        {{-- class="h-80 w-px rounded-full bg-hurricane/10" --}}
        {{-- ></div> --}}
        {{-- </div> --}}

        {{--  --}}
        {{-- Right Side --}}
        {{-- <div class="space-y-4"> --}}
        {{-- <div class="text-sm font-medium text-hurricane/70"> --}}
        {{-- New in Version 3 --}}
        {{-- </div> --}}
        {{-- <div class="grid gap-7"> --}}
        {{-- <a --}}
        {{-- href="#" --}}
        {{-- class="group/package-link flex items-center gap-5 transition duration-300 will-change-transform hover:translate-x-0.5 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <div --}}
        {{-- class="grid h-[3.25rem] w-[3.25rem] shrink-0 place-items-center rounded-xl bg-merino text-hurricane" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="32" --}}
        {{-- height="32" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M15.414 10.941c.781.462.781 1.656 0 2.118l-4.72 2.787C9.934 16.294 9 15.71 9 14.786V9.214c0-.924.934-1.507 1.694-1.059l4.72 2.787Z"/></g> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- <div class="space-y-0.5"> --}}
        {{-- <div class="flex items-center gap-2"> --}}
        {{-- <div --}}
        {{-- class="text-base font-bold text-evening" --}}
        {{-- > --}}
        {{-- Actions --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="rounded-full bg-peach-orange px-3 py-0.5 text-xs text-evening" --}}
        {{-- > --}}
        {{-- New --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="-translate-x-1 scale-x-90 text-butter opacity-0 transition duration-300 group-hover/package-link:translate-x-0 group-hover/package-link:scale-x-100 group-hover/package-link:opacity-100 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="22" --}}
        {{-- height="22" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- fill="none" --}}
        {{-- stroke="currentColor" --}}
        {{-- stroke-linecap="round" --}}
        {{-- stroke-linejoin="round" --}}
        {{-- stroke-width="2" --}}
        {{-- d="M4 12h16m0 0l-6-6m6 6l-6 6" --}}
        {{-- ></path> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="max-w-xs text-sm font-medium text-dolphin" --}}
        {{-- > --}}
        {{-- Open interactive modals and slide-overs - a --}}
        {{-- great way to keep the user in the flow of the --}}
        {{-- application. --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </a> --}}
        {{-- <a --}}
        {{-- href="#" --}}
        {{-- class="group/package-link flex items-center gap-5 transition duration-300 will-change-transform hover:translate-x-0.5 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <div --}}
        {{-- class="grid h-[3.25rem] w-[3.25rem] shrink-0 place-items-center rounded-xl bg-merino text-hurricane" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="34" --}}
        {{-- height="34" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <g --}}
        {{-- fill="none" --}}
        {{-- stroke="currentColor" --}}
        {{-- stroke-width="1.5" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- d="M16 4.002c2.175.012 3.353.109 4.121.877C21 5.758 21 7.172 21 10v6c0 2.829 0 4.243-.879 5.122C19.243 22 17.828 22 15 22H9c-2.828 0-4.243 0-5.121-.878C3 20.242 3 18.829 3 16v-6c0-2.828 0-4.242.879-5.121c.768-.768 1.946-.865 4.121-.877" --}}
        {{-- /> --}}
        {{-- <path --}}
        {{-- stroke-linecap="round" --}}
        {{-- d="M10.5 14H17M7 14h.5M7 10.5h.5m-.5 7h.5m3-7H17m-6.5 7H17" --}}
        {{-- /> --}}
        {{-- <path --}}
        {{-- d="M8 3.5A1.5 1.5 0 0 1 9.5 2h5A1.5 1.5 0 0 1 16 3.5v1A1.5 1.5 0 0 1 14.5 6h-5A1.5 1.5 0 0 1 8 4.5v-1Z" --}}
        {{-- /> --}}
        {{-- </g> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- <div class="space-y-0.5"> --}}
        {{-- <div class="flex items-center gap-2"> --}}
        {{-- <div --}}
        {{-- class="text-base font-bold text-evening" --}}
        {{-- > --}}
        {{-- Infolist Builder --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="rounded-full bg-peach-orange px-3 py-0.5 text-xs text-evening" --}}
        {{-- > --}}
        {{-- New --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="-translate-x-1 scale-x-90 text-butter opacity-0 transition duration-300 group-hover/package-link:translate-x-0 group-hover/package-link:scale-x-100 group-hover/package-link:opacity-100 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="22" --}}
        {{-- height="22" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- fill="none" --}}
        {{-- stroke="currentColor" --}}
        {{-- stroke-linecap="round" --}}
        {{-- stroke-linejoin="round" --}}
        {{-- stroke-width="2" --}}
        {{-- d="M4 12h16m0 0l-6-6m6 6l-6 6" --}}
        {{-- /> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="max-w-xs text-sm font-medium text-dolphin" --}}
        {{-- > --}}
        {{-- Display read-only information to users about a --}}
        {{-- particular record, with a fully flexible layout. --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </a> --}}
        {{-- <a --}}
        {{-- href="#" --}}
        {{-- class="group/package-link flex items-center gap-5 transition duration-300 will-change-transform hover:translate-x-0.5 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <div --}}
        {{-- class="grid h-[3.25rem] w-[3.25rem] shrink-0 place-items-center rounded-xl bg-merino text-hurricane" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="32" --}}
        {{-- height="32" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <g fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 22h18"/><path d="M3 11c0-.943 0-1.414.293-1.707C3.586 9 4.057 9 5 9c.943 0 1.414 0 1.707.293C7 9.586 7 10.057 7 11v6c0 .943 0 1.414-.293 1.707C6.414 19 5.943 19 5 19c-.943 0-1.414 0-1.707-.293C3 18.414 3 17.943 3 17v-6Zm7-4c0-.943 0-1.414.293-1.707C10.586 5 11.057 5 12 5c.943 0 1.414 0 1.707.293C14 5.586 14 6.057 14 7v10c0 .943 0 1.414-.293 1.707C13.414 19 12.943 19 12 19c-.943 0-1.414 0-1.707-.293C10 18.414 10 17.943 10 17V7Zm7-3c0-.943 0-1.414.293-1.707C17.586 2 18.057 2 19 2c.943 0 1.414 0 1.707.293C21 2.586 21 3.057 21 4v13c0 .943 0 1.414-.293 1.707C20.414 19 19.943 19 19 19c-.943 0-1.414 0-1.707-.293C17 18.414 17 17.943 17 17V4Z"/></g> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- <div class="space-y-0.5"> --}}
        {{-- <div class="flex items-center gap-2"> --}}
        {{-- <div --}}
        {{-- class="text-base font-bold text-evening" --}}
        {{-- > --}}
        {{-- Widgets --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="rounded-full bg-peach-orange px-3 py-0.5 text-xs text-evening" --}}
        {{-- > --}}
        {{-- New --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="-translate-x-1 scale-x-90 text-butter opacity-0 transition duration-300 group-hover/package-link:translate-x-0 group-hover/package-link:scale-x-100 group-hover/package-link:opacity-100 motion-reduce:transition-none" --}}
        {{-- > --}}
        {{-- <svg --}}
        {{-- xmlns="http://www.w3.org/2000/svg" --}}
        {{-- width="22" --}}
        {{-- height="22" --}}
        {{-- viewBox="0 0 24 24" --}}
        {{-- > --}}
        {{-- <path --}}
        {{-- fill="none" --}}
        {{-- stroke="currentColor" --}}
        {{-- stroke-linecap="round" --}}
        {{-- stroke-linejoin="round" --}}
        {{-- stroke-width="2" --}}
        {{-- d="M4 12h16m0 0l-6-6m6 6l-6 6" --}}
        {{-- /> --}}
        {{-- </svg> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- <div --}}
        {{-- class="max-w-xs text-sm font-medium text-dolphin" --}}
        {{-- > --}}
        {{-- Build a dashboard for your application, complete --}}
        {{-- with real-time charts and stats. --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </a> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </div> --}}
        {{-- </div> --}}

        

        <a
            href="{{ route('features') }}"
            @class([
                'group/nav-link relative hidden text-evening transition duration-300 hover:opacity-100 focus:text-butter motion-reduce:transition-none lg:block',
                'opacity-80' => ! request()->routeIs('features*'),
                'font-bold' => request()->routeIs('features*'),
            ])
        >
            <div class="gsap-fadein">
                {{trans('site.resource.features') }}
            </div>

            @if (request()->routeIs('features*'))
                <div
                    class="gsap-popout absolute -bottom-4 right-1/2 translate-x-1/2"
                >
                    <div
                        class="h-2 w-2 bg-butter transition duration-300 group-hover/nav-link:rotate-90 group-hover/nav-link:bg-purple-400 motion-reduce:transition-none"
                    ></div>
                </div>
            @endif
        </a>

        <a
            href="{{ route('articles') }}"
            @class([
                'group/nav-link relative hidden text-evening transition duration-300 hover:opacity-100 focus:text-butter motion-reduce:transition-none lg:block',
                'opacity-80' => ! request()->routeIs('articles*'),
                'font-bold' => request()->routeIs('articles*'),
            ])
        >
            <div class="gsap-fadein">Community</div>

            @if (request()->routeIs('articles*'))
                <div
                    class="gsap-popout absolute -bottom-4 right-1/2 translate-x-1/2"
                >
                    <div
                        class="h-2 w-2 bg-butter transition duration-300 group-hover/nav-link:rotate-90 group-hover/nav-link:bg-purple-400 motion-reduce:transition-none"
                    ></div>
                </div>
            @endif
        </a>

        <a
            href="{{ route('consulting') }}"
            @class([
                'group/nav-link relative hidden text-evening transition duration-300 hover:opacity-100 focus:text-butter motion-reduce:transition-none lg:block',
                'opacity-80' => ! request()->routeIs('consulting*'),
                'font-bold' => request()->routeIs('consulting*'),
            ])
        >
            <div class="gsap-fadein">Consulting</div>

            @if (request()->routeIs('consulting*'))
                <div
                    class="gsap-popout absolute -bottom-4 right-1/2 translate-x-1/2"
                >
                    <div
                        class="h-2 w-2 bg-butter transition duration-300 group-hover/nav-link:rotate-90 group-hover/nav-link:bg-purple-400 motion-reduce:transition-none"
                    ></div>
                </div>
            @endif
        </a>

        <a
            href="https://shop.filamentphp.com"
            class="group/nav-link relative hidden text-evening opacity-80 transition duration-300 hover:opacity-100 focus:text-butter motion-reduce:transition-none lg:block"
        >
            <div class="gsap-fadein">Shop</div>
        </a>

        {{-- Github --}}
        <div class="group/github relative">
            {{-- Github Icon --}}
            <a
                href="https://github.com/filamentphp/filament"
                target="_blank"
                class="peer text-evening opacity-80 transition delay-75 duration-300 group-hover/github:opacity-100 motion-reduce:transition-none"
            >
                <div class="gsap-fadein">
                    <svg
                        fill="currentColor"
                        viewBox="0 0 29 29"
                        class="h-7 w-7"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M1372.32,16.8097415 C1372.32,23.1517351 1376.33105,28.5314586 1381.89427,30.4295626 C1382.59472,30.5617425 1382.84997,30.1184991 1382.84997,29.7378209 C1382.84997,29.3976778 1382.83794,28.4944483 1382.83107,27.296898 C1378.9369,28.1639984 1378.11527,25.3723581 1378.11527,25.3723581 C1377.47841,23.7139404 1376.56052,23.2724594 1376.56052,23.2724594 C1375.2894,22.3824478 1376.65678,22.4000718 1376.65678,22.4000718 C1378.06198,22.5014098 1378.80111,23.8796059 1378.80111,23.8796059 C1380.04989,26.0729117 1382.07819,25.4393292 1382.87576,25.071869 C1383.00296,24.144847 1383.36478,23.5121457 1383.76443,23.1534975 C1380.6558,22.7913244 1377.38731,21.5594074 1377.38731,16.0589595 C1377.38731,14.4921866 1377.93306,13.2100411 1378.82861,12.207236 C1378.68422,11.8441818 1378.20379,10.384034 1378.96612,8.40838451 C1378.96612,8.40838451 1380.14099,8.02241909 1382.8156,9.87998785 C1383.93202,9.56099359 1385.13009,9.40237767 1386.32043,9.39620927 C1387.50991,9.40237767 1388.70712,9.56099359 1389.82526,9.87998785 C1392.49815,8.02241909 1393.6713,8.40838451 1393.6713,8.40838451 C1394.43535,10.384034 1393.95492,11.8441818 1393.81139,12.207236 C1394.70866,13.2100411 1395.25011,14.4921866 1395.25011,16.0589595 C1395.25011,21.5735066 1391.97647,22.7869184 1388.85838,23.1420419 C1389.3603,23.5852853 1389.80808,24.4611977 1389.80808,25.8006211 C1389.80808,27.7189926 1389.79089,29.2672603 1389.79089,29.7378209 C1389.79089,30.1220239 1390.04356,30.5687921 1390.75347,30.4286814 C1396.31239,28.5261714 1400.32,23.1499727 1400.32,16.8097415 C1400.32,8.8815887 1394.05118,2.455 1386.31871,2.455 C1378.58882,2.455 1372.32,8.8815887 1372.32,16.8097415 Z"
                            transform="translate(-1372 -2)"
                        ></path>
                    </svg>
                </div>
            </a>

            {{-- Star Count --}}
            <div
                class="invisible absolute right-1/2 top-7 -translate-y-2 translate-x-1/3 p-3 opacity-0 transition delay-75 duration-300 hover:visible hover:translate-y-0 hover:opacity-100 peer-hover:visible peer-hover:translate-y-0 peer-hover:opacity-100 motion-reduce:transition-none min-[1400px]:translate-x-1/2"
            >
                <div
                    class="flex items-center justify-center gap-2 whitespace-nowrap rounded-xl bg-cream py-2.5 pl-2.5 pr-4 shadow-xl shadow-black/5"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="scale-90 text-butter"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill="currentColor"
                            d="M9.153 5.408C10.42 3.136 11.053 2 12 2c.947 0 1.58 1.136 2.847 3.408l.328.588c.36.646.54.969.82 1.182c.28.213.63.292 1.33.45l.636.144c2.46.557 3.689.835 3.982 1.776c.292.94-.546 1.921-2.223 3.882l-.434.507c-.476.557-.715.836-.822 1.18c-.107.345-.071.717.001 1.46l.066.677c.253 2.617.38 3.925-.386 4.506c-.766.582-1.918.051-4.22-1.009l-.597-.274c-.654-.302-.981-.452-1.328-.452c-.347 0-.674.15-1.329.452l-.595.274c-2.303 1.06-3.455 1.59-4.22 1.01c-.767-.582-.64-1.89-.387-4.507l.066-.676c.072-.744.108-1.116 0-1.46c-.106-.345-.345-.624-.821-1.18l-.434-.508c-1.677-1.96-2.515-2.941-2.223-3.882c.293-.941 1.523-1.22 3.983-1.776l.636-.144c.699-.158 1.048-.237 1.329-.45c.28-.213.46-.536.82-1.182l.328-.588Z"
                        />
                    </svg>
                    
                </div>
            </div>
        </div>
    </div>
</nav>
