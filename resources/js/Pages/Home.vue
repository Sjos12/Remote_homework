<template>
    <NavbarVue />
    <div class="container mx-auto flex flex-col gap-y-8">
        <div class="h-full">
            <div class="h-screen grid grid-flow-row grid-cols-1 md:grid-cols-2">
                <div class="">
                    <div class="positioncontent">
                        <h1 class="title slide-in-left">Remote Homework</h1>
                        <p class="paragraph slide-in-left">
                            site.homepage.intro
                        </p>
                        <div class="wrapper pt-2">
                            <a
                                href="/login"
                                class="
                                    shadow-sm
                                    btn btn-primary btn-lg
                                    border border-info
                                    slide-in-top
                                    widebutton
                                "
                                id="homebtn1"
                                >Get Started</a
                            >
                            <a
                                href="#content2"
                                class="
                                    shadow-sm
                                    btn btn-white btn-lg
                                    border border-info
                                    slide-in-top
                                    widebutton
                                "
                                id="homebtn2"
                                >"Contact us here</a
                            >
                        </div>
                    </div>
                </div>

                <div class="slide-in-right">
                    <img
                        src="/images/homeworkgirl.svg"
                        class=""
                        id="homeworkgirl"
                        alt="Homework girl"
                    />
                </div>
            </div>
        </div>

        <hr class="homehr" />

        <div
            class="
                grid grid-flow-row grid-cols-1
                md:grid-cols-3
                mobilespacingtop
            "
        >
            <div class="desktopimg">
                <img
                    src="/images/collaboration.svg"
                    alt=""
                    id="collaboration"
                    srcset=""
                />
            </div>

            <div class="">
                <h1 class="title slide-in-top">Help each other</h1>
                <p class="paragraph">site.homepage.paragraph2</p>
            </div>

            <!-- <div class="mobileimg">
                <img
                    src="/images/collaboration.svg"
                    alt=""
                    id="collaboration"
                    srcset=""
                />
            </div> -->
        </div>

        <hr class="homehr" />

        <div
            class="
                grid grid-flow-row grid-cols-1
                md:grid-cols-2
                rowspacingtop
                rowspacingbottom
            "
        >
            <div class="">
                <h1 class="title">Also for teachers</h1>
                <p class="paragraph">site.homepage.paragraph3</p>
            </div>

            <div class="">
                <img
                    src="/images/teacher.svg"
                    alt=""
                    id="collaboration"
                    srcset=""
                />
            </div>
        </div>

        <hr class="homehr" />

        <div
            class="
                grid grid-flow-row grid-cols-1
                md:grid-cols-3
                rowspacingtop
                rowspacingbottom
            "
        >
            <div class="col-12 pb-4">
                <h1 class="title text-center">How do I ask a question?</h1>
            </div>
            <div class="flex">
                <div class="phonecontainer">
                    <img
                        src="/images/phone1.svg"
                        alt=""
                        id="phone1"
                        srcset=""
                        class="d-block mt-auto mx-auto"
                    />
                    <p class="paragraph text-center">
                        site.homepage.paragraph4
                    </p>
                </div>
                <div class="phonecontainer">
                    <img
                        src="/images/phone2.svg"
                        alt=""
                        id="phone2"
                        srcset=""
                        class="d-block my-auto mx-auto"
                    />
                    <p class="paragraph text-center">
                        {!! __('site.homepage.paragraph5', ['href' =>
                        route('login')]) !!}
                    </p>
                </div>
                <div class="">
                    <img
                        src="/images/phone3.svg"
                        alt=""
                        id="phone3"
                        srcset=""
                        class="d-block mt-auto mx-auto"
                    />
                    <p class="paragraph text-center">
                        site.homepage.paragraph6
                    </p>
                </div>
            </div>

            <h2 class="w-full title2 d-block mx-auto pt-4">
                {!! __("Easy? Isn't it? <br />
                For more, check out our tutorials here.") !!}
            </h2>
            <a
                href="{{ route('login') }}"
                class="
                    shadow-sm
                    btn btn-primary btn-lg
                    border border-info
                    d-block
                    mx-auto
                    mt-4
                "
                id="homebtn3"
            >
                View tutorials
            </a>
        </div>

        <hr class="homehr" />

        <div
            class="
                grid grid-flow-row grid-cols-1
                md:grid-cols-2
                rowspacingtop
                rowspacingbottom
            "
        >
            <div class="">
                <div class="col-12">
                    <h1 class="title">What does it cost?</h1>
                    <p class="paragraph">site.homepage.paragraph7</p>
                </div>
                <div class="col-12">
                    <a
                        href="{{ route('login') }}"
                        class="
                            shadow-sm
                            btn btn-primary btn-lg
                            border border-info
                            mt-4
                        "
                        id="homebtn4"
                        >Donate</a
                    >
                </div>
            </div>

            <div class="">
                <img
                    src="/images/superman.svg"
                    alt=""
                    id="collaboration"
                    srcset=""
                />
            </div>
        </div>
    </div>
</template>
<script>
import LayoutVue from "./Layouts/Layout.vue";
import NavbarVue from "../components/Navbar.vue";
export default {
    components: {
        NavbarVue,
    },
    // layout: LayoutVue,
    props: ["user"],
};
</script>