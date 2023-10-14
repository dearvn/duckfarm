<div
    x-cloak
    x-data="{}"
    class="mx-auto w-full max-w-screen-lg pt-60"
>
    <div
        x-data="{}"
        x-ref="sunset_section"
        x-init="
            () => {
                if (reducedMotion) return
                gsap.timeline({
                    delay: 0.4,
                    scrollTrigger: {
                        trigger: $refs.sunset_section,
                        start: 'top bottom-=100px',
                    },
                })
                    .fromTo(
                        $refs.left_mountain,
                        {
                            autoAlpha: 0,
                        },
                        {
                            autoAlpha: 1,
                            duration: 0.7,
                            ease: 'circ.out',
                        },
                    )
                    .fromTo(
                        $refs.right_mountain,
                        {
                            autoAlpha: 0,
                        },
                        {
                            autoAlpha: 1,
                            duration: 0.7,
                            ease: 'circ.out',
                        },
                        '>-0.5',
                    )
                    .fromTo(
                        $refs.sun,
                        {
                            autoAlpha: 0,
                        },
                        {
                            autoAlpha: 1,
                            duration: 0.7,
                            ease: 'circ.out',
                        },
                        '>-0.5',
                    )
                    .fromTo(
                        $refs.cloud1,
                        {
                            autoAlpha: 0,
                            x: 20,
                        },
                        {
                            autoAlpha: 1,
                            x: 0,
                            duration: 3,
                            ease: 'sine.out',
                        },
                        '>-0.5',
                    )
                    .fromTo(
                        $refs.cloud2,
                        {
                            autoAlpha: 0,
                            x: -20,
                        },
                        {
                            autoAlpha: 1,
                            x: 0,
                            duration: 3,
                            ease: 'sine.out',
                        },
                        '<',
                    )
                    .fromTo(
                        $refs.cloud3,
                        {
                            autoAlpha: 0,
                            x: 20,
                        },
                        {
                            autoAlpha: 1,
                            x: 0,
                            duration: 3,
                            ease: 'sine.out',
                        },
                        '<',
                    )
                    .fromTo(
                        $refs.left_birds,
                        {
                            autoAlpha: 0,
                            y: 20,
                            x: 20,
                            rotate: -5,
                        },
                        {
                            autoAlpha: 1,
                            y: 0,
                            x: 0,
                            rotate: 0,
                            duration: 2,
                            ease: 'back.out',
                        },
                        '<',
                    )
                    .fromTo(
                        $refs.right_birds,
                        {
                            autoAlpha: 0,
                            y: -20,
                            x: -20,
                            rotate: 5,
                        },
                        {
                            autoAlpha: 1,
                            y: 0,
                            x: 0,
                            rotate: 0,
                            duration: 2,
                            ease: 'back.out',
                        },
                        '<',
                    )
                    .fromTo(
                        $refs.giraffes,
                        {
                            autoAlpha: 0,
                        },
                        {
                            autoAlpha: 1,
                            duration: 0.7,
                            ease: 'circ.out',
                        },
                        '<',
                    )
                    .fromTo(
                        $refs.supercar,
                        {
                            autoAlpha: 0,
                            x: -500,
                        },
                        {
                            autoAlpha: 1,
                            x: 0,
                            duration: 1,
                            ease: 'circ.out',
                        },
                        '<',
                    )
                    .fromTo(
                        $refs.take_off,
                        {
                            autoAlpha: 0,
                            y: -30,
                        },
                        {
                            autoAlpha: 1,
                            y: 0,
                            duration: 0.7,
                            ease: 'circ.out',
                        },
                        '<0.2',
                    )
                    .fromTo(
                        $refs.take_off_message,
                        {
                            autoAlpha: 0,
                            y: 30,
                        },
                        {
                            autoAlpha: 1,
                            y: 0,
                            duration: 0.7,
                            ease: 'circ.out',
                        },
                        '>-0.3',
                    )
                    .fromTo(
                        $refs.getstarted,
                        {
                            autoAlpha: 0,
                            y: 30,
                        },
                        {
                            autoAlpha: 1,
                            y: 0,
                            duration: 0.7,
                            ease: 'circ.out',
                        },
                        '>-0.3',
                    )
            }
        "
        class="text-center"
    >
        <div class="mx-auto grid w-full max-w-4xl">
            {{-- Sun --}}
            <div
                class="relative top-10 z-10 self-center justify-self-center [grid-area:1/-1]"
            >
                <div
                    x-ref="sun"
                    class="h-40 w-40 rounded-full bg-gradient-to-t from-[#FFBF85]/40 to-[#FF9385]"
                ></div>
            </div>

            {{-- Sun Blur --}}
            <div
                class="relative top-14 z-20 self-end justify-self-center [grid-area:1/-1]"
            >
                <div
                    class="h-28 w-60 bg-cream/10 backdrop-blur-md sm:h-32"
                ></div>
            </div>

            {{-- Cloud 1 --}}
            <div
                x-ref="cloud1"
                class="relative -top-10 left-10 self-start justify-self-start [grid-area:1/-1] sm:-top-3 sm:left-5"
            >
                <img
                    src="{{ Vite::asset('resources/svg/home/cloud1.svg') }}"
                    alt="Cloud"
                    class="w-[10rem] sm:w-[14rem]"
                />
            </div>

            {{-- Cloud 2 --}}
            <div
                x-ref="cloud2"
                class="relative -right-20 -top-10 self-start justify-self-center [grid-area:1/-1] sm:-right-40 sm:-top-3"
            >
                <img
                    src="{{ Vite::asset('resources/svg/home/cloud2.svg') }}"
                    alt="Cloud"
                    class="w-[8rem] sm:w-[12rem]"
                />
            </div>

            {{-- Cloud 3 --}}
            <div
                x-ref="cloud3"
                class="relative -top-10 right-20 hidden self-center justify-self-end [grid-area:1/-1] sm:block"
            >
                <img
                    src="{{ Vite::asset('resources/svg/home/cloud3.svg') }}"
                    alt="Cloud"
                    class="w-[8rem]"
                />
            </div>

            {{-- Left Birds --}}
            <div
                x-ref="left_birds"
                class="relative right-32 z-20 hidden self-start justify-self-center [grid-area:1/-1] sm:block"
            >
                <div class="flex items-center gap-10">
                    <img
                        src="{{ Vite::asset('resources/svg/home/bird.svg') }}"
                        alt="Bird"
                        class="w-[2rem]"
                    />
                    <img
                        src="{{ Vite::asset('resources/svg/home/bird.svg') }}"
                        alt="Bird"
                        class="w-[2rem]"
                    />
                </div>
                <div class="flex justify-center pt-5">
                    <img
                        src="{{ Vite::asset('resources/svg/home/bird.svg') }}"
                        alt="Bird"
                        class="w-[3rem]"
                    />
                </div>
            </div>

            {{-- Right Birds --}}
            <div
                x-ref="right_birds"
                class="relative z-20 w-32 self-start justify-self-center [grid-area:1/-1] sm:-right-44 sm:top-20"
            >
                <div class="flex justify-center">
                    <img
                        src="{{ Vite::asset('resources/svg/home/bird.svg') }}"
                        alt="Bird"
                        class="w-[3rem]"
                    />
                </div>
                <div class="flex justify-start pt-5">
                    <img
                        src="{{ Vite::asset('resources/svg/home/bird.svg') }}"
                        alt="Bird"
                        class="w-[2rem]"
                    />
                </div>
            </div>

            {{-- Giraffes --}}
            <div
                x-ref="giraffes"
                class="relative -left-[25vw] top-12 z-20 self-center justify-self-center [grid-area:1/-1] sm:-left-60 sm:top-6"
            >
                <div class="flex items-end">
                    <img
                        src="{{ Vite::asset('resources/svg/home/giraffe.svg') }}"
                        alt="Giraffes"
                        class="w-[2rem] -scale-x-100 opacity-80"
                    />
                    <img
                        src="{{ Vite::asset('resources/svg/home/giraffe.svg') }}"
                        alt="Giraffes"
                        class="w-[2.5rem]"
                    />
                    <img
                        src="{{ Vite::asset('resources/svg/home/giraffe.svg') }}"
                        alt="Giraffes"
                        class="w-[1.5rem] opacity-60"
                    />
                </div>
            </div>

            {{-- Left Mountain --}}
            <div
                x-ref="left_mountain"
                class="hidden self-end justify-self-start [grid-area:1/-1] sm:block"
            >
                <img
                    src="{{ Vite::asset('resources/svg/home/mountain1.svg') }}"
                    alt="Mountain"
                    class="w-[30rem]"
                />
            </div>

            {{-- Right Mountain --}}
            <div
                x-ref="right_mountain"
                class="self-end justify-self-end [grid-area:1/-1]"
            >
                <img
                    src="{{ Vite::asset('resources/svg/home/mountain2.svg') }}"
                    alt="Mountain"
                    class="w-[30rem]"
                />
            </div>
        </div>

        {{-- Supercar --}}
        <div class="relative z-50 grid place-items-center pt-10">
            <img
                x-ref="supercar"
                src="{{ Vite::asset('resources/images/home/supercar.webp') }}"
                alt="Car"
                class="w-44"
            />
        </div>

        {{-- Takeoff --}}
        <div
            x-ref="take_off"
            class="px-4 pt-3 text-3xl font-extrabold"
        >
            Ready to take off?
        </div>
        <div
            x-ref="take_off_message"
            class="mx-auto max-w-md px-4 pt-2 text-dolphin"
        >
            Give Filament a try, and we bet that you’ll be amazed in the first
            few minutes.
        </div>

        {{-- Get Started Link --}}
        <div
            x-ref="getstarted"
            class="px-4 pt-10"
        >
            
        </div>
    </div>
</div>
