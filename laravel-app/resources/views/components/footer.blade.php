<footer
    x-cloak
    x-data="{}"
    class="mx-auto w-full max-w-screen-lg px-5 pt-10"
>
    <div
        x-data="{}"
        x-ref="footer"
        x-init="
            () => {
                if (reducedMotion) return
                gsap.timeline({
                    scrollTrigger: {
                        trigger: $refs.footer,
                        start: 'top bottom',
                    },
                }).fromTo(
                    $refs.footer,
                    {
                        autoAlpha: 0,
                        y: 20,
                    },
                    {
                        autoAlpha: 1,
                        y: 0,
                        duration: 0.7,
                        ease: 'circ.out',
                    },
                )
            }
        "
        class="py-10"
    >
        <div
            class="flex flex-wrap items-start justify-between gap-x-40 gap-y-10"
        >
            <a
                href="/"
                class="block p-2 transition duration-300 will-change-transform hover:scale-105 motion-reduce:transition-none"
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
            <div class="flex flex-1 flex-wrap justify-start gap-x-40 gap-y-3">
                <div
                    class="flex flex-col items-start gap-3 text-sm font-medium"
                >
                    <a
                        href="{{ route('home') }}"
                        class="p-2 transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none"
                    >
                        Home
                    </a>
                    
                    <a
                        href="{{ route('features') }}"
                        class="p-2 transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none"
                    >
                        {{trans('site.resource.features') }}
                    </a>
                    <a
                        href="{{ route('articles') }}"
                        class="p-2 transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none"
                    >
                        Community
                    </a>
                    <a
                        href="{{ route('consulting') }}"
                        class="p-2 transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none"
                    >
                        Consulting
                    </a>
                    <a
                        href="https://shop.filamentphp.com"
                        class="p-2 transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none"
                    >
                        Shop
                    </a>
                </div>
                <div
                    class="flex flex-col items-start gap-3 text-sm font-medium"
                >
                    <a
                        href="{{ route('team') }}"
                        class="p-2 transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none"
                    >
                        Meet Our Team
                    </a>
                    <a
                        target="_blank"
                        href="https://status.filamentphp.com"
                        class="p-2 transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none"
                    >
                        Status
                    </a>
                    <a
                        target="_blank"
                        href="https://github.com/filamentphp/filament/discussions/new"
                        class="p-2 transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none"
                    >
                        Help
                    </a>
                    <a
                        target="_blank"
                        href="https://github.com/filamentphp/filament?sponsor=1"
                        class="p-2 transition duration-300 will-change-transform hover:translate-x-1 hover:text-black motion-reduce:transition-none motion-reduce:hover:transform-none"
                    >
                        Sponsor
                    </a>
                </div>
            </div>
        </div>
        <div
            class="mt-7 flex flex-wrap items-start justify-between gap-10 border-t border-slate-200 pt-5"
        >
            <div class="text-sm font-medium text-hurricane/50">
                &copy; {{ date('Y') }} Filament. All rights reserved.
            </div>
            <div class="flexx-wrap flex items-center gap-3.5 text-hurricane">
                <a
                    target="_blank"
                    href="https://twitter.com/filamentphp"
                    class="group/twitter-link relative grid h-[2.6rem] w-[2.6rem] place-items-center rounded-xl bg-merino hover:text-black motion-reduce:transition-none"
                >
                    <svg
                        width="40"
                        height="40"
                        class="scale-[.6] transition duration-300 group-hover/twitter-link:scale-0 group-hover/twitter-link:opacity-0"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M37.02 9.427c-1.272.562-2.62.932-4.002 1.096a6.991 6.991 0 0 0 3.064-3.856 13.935 13.935 0 0 1-4.425 1.691 6.97 6.97 0 0 0-11.877 6.357A19.79 19.79 0 0 1 5.412 7.432a6.947 6.947 0 0 0-.944 3.505 6.973 6.973 0 0 0 3.1 5.801 6.947 6.947 0 0 1-3.156-.871v.084a6.975 6.975 0 0 0 5.591 6.837 7.008 7.008 0 0 1-3.15.12 6.975 6.975 0 0 0 6.514 4.842 13.99 13.99 0 0 1-10.32 2.887A19.719 19.719 0 0 0 13.73 33.77c12.823 0 19.833-10.622 19.833-19.834 0-.3-.006-.603-.02-.901a14.17 14.17 0 0 0 3.477-3.608Z"
                            fill="currentColor"
                        />
                    </svg>

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        viewBox="0 0 16 16"
                        class="absolute right-1/2 top-1/2 -translate-y-1/2 translate-x-1/2 scale-0 opacity-0 transition duration-300 group-hover/twitter-link:scale-100 group-hover/twitter-link:opacity-100"
                        fill="none"
                    >
                        <path
                            d="M12.6182 0.80542H15.0592L9.72628 6.90056L16 15.1947H11.0877L7.24026 10.1643L2.83789 15.1947H0.395405L6.09945 8.67524L0.0810547 0.80542H5.11803L8.5958 5.40334L12.6182 0.80542ZM11.7614 13.7336H13.114L4.38307 2.18974H2.9316L11.7614 13.7336Z"
                            fill="currentColor"
                        />
                    </svg>
                </a>
                <a
                    target="_blank"
                    href="https://filamentphp.com/discord"
                    class="grid h-[2.6rem] w-[2.6rem] place-items-center rounded-xl bg-merino transition duration-300 hover:text-black motion-reduce:transition-none"
                >
                    <svg
                        class="w-[1.3rem]"
                        fill="none"
                        viewBox="0 0 71 55"
                        aria-hidden="true"
                    >
                        <g clip-path="url(#clip0)">
                            <path
                                d="M60.1045 4.8978C55.5792 2.8214 50.7265 1.2916 45.6527 0.41542C45.5603 0.39851 45.468 0.440769 45.4204 0.525289C44.7963 1.6353 44.105 3.0834 43.6209 4.2216C38.1637 3.4046 32.7345 3.4046 27.3892 4.2216C26.905 3.0581 26.1886 1.6353 25.5617 0.525289C25.5141 0.443589 25.4218 0.40133 25.3294 0.41542C20.2584 1.2888 15.4057 2.8186 10.8776 4.8978C10.8384 4.9147 10.8048 4.9429 10.7825 4.9795C1.57795 18.7309 -0.943561 32.1443 0.293408 45.3914C0.299005 45.4562 0.335386 45.5182 0.385761 45.5576C6.45866 50.0174 12.3413 52.7249 18.1147 54.5195C18.2071 54.5477 18.305 54.5139 18.3638 54.4378C19.7295 52.5728 20.9469 50.6063 21.9907 48.5383C22.0523 48.4172 21.9935 48.2735 21.8676 48.2256C19.9366 47.4931 18.0979 46.6 16.3292 45.5858C16.1893 45.5041 16.1781 45.304 16.3068 45.2082C16.679 44.9293 17.0513 44.6391 17.4067 44.3461C17.471 44.2926 17.5606 44.2813 17.6362 44.3151C29.2558 49.6202 41.8354 49.6202 53.3179 44.3151C53.3935 44.2785 53.4831 44.2898 53.5502 44.3433C53.9057 44.6363 54.2779 44.9293 54.6529 45.2082C54.7816 45.304 54.7732 45.5041 54.6333 45.5858C52.8646 46.6197 51.0259 47.4931 49.0921 48.2228C48.9662 48.2707 48.9102 48.4172 48.9718 48.5383C50.038 50.6034 51.2554 52.5699 52.5959 54.435C52.6519 54.5139 52.7526 54.5477 52.845 54.5195C58.6464 52.7249 64.529 50.0174 70.6019 45.5576C70.6551 45.5182 70.6887 45.459 70.6943 45.3942C72.1747 30.0791 68.2147 16.7757 60.1968 4.9823C60.1772 4.9429 60.1437 4.9147 60.1045 4.8978ZM23.7259 37.3253C20.2276 37.3253 17.3451 34.1136 17.3451 30.1693C17.3451 26.225 20.1717 23.0133 23.7259 23.0133C27.308 23.0133 30.1626 26.2532 30.1066 30.1693C30.1066 34.1136 27.28 37.3253 23.7259 37.3253ZM47.3178 37.3253C43.8196 37.3253 40.9371 34.1136 40.9371 30.1693C40.9371 26.225 43.7636 23.0133 47.3178 23.0133C50.9 23.0133 53.7545 26.2532 53.6986 30.1693C53.6986 34.1136 50.9 37.3253 47.3178 37.3253Z"
                                fill="currentColor"
                            />
                        </g>
                    </svg>
                </a>
                <a
                    target="_blank"
                    href="https://github.com/filamentphp/filament"
                    class="grid h-[2.6rem] w-[2.6rem] place-items-center rounded-xl bg-merino transition duration-300 hover:text-black motion-reduce:transition-none"
                >
                    <svg
                        class="w-[1.6rem]"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd"
                        />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>
