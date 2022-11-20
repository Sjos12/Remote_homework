<template>
    <nav class="bg-darkmodecolor-300">
        <div class="container">
            <a href="https://samenhuiswerken.nl" class="navbar-brand"
                ><img
                    id="logo"
                    src="https://samenhuiswerken.nl/images/remote_homework_logo.png"
                    alt="Logo"
                    style="width: 105px"
            /></a>
            <button
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
                class="navbar-toggler"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="27"
                    height="19"
                    viewBox="0 0 27 19"
                >
                    <g
                        id="Group_13"
                        data-name="Group 13"
                        transform="translate(-311 -21)"
                    >
                        <rect
                            id="Rectangle_41"
                            data-name="Rectangle 41"
                            width="27"
                            height="2"
                            rx="1"
                            transform="translate(311 21)"
                            fill="#5bb9fd"
                        ></rect>
                        <rect
                            id="Rectangle_42"
                            data-name="Rectangle 42"
                            width="27"
                            height="2"
                            rx="1"
                            transform="translate(311 29)"
                            fill="#5bb9fd"
                        ></rect>
                        <rect
                            id="Rectangle_43"
                            data-name="Rectangle 43"
                            width="27"
                            height="2"
                            rx="1"
                            transform="translate(311 37)"
                            fill="#5bb9fd"
                        ></rect>
                    </g>
                </svg>
            </button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a
                            href="https://samenhuiswerken.nl#content1"
                            id="nav-link"
                            class="nav-link hvr-underline-from-center"
                            >Home</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            href="https://samenhuiswerken.nl#content2"
                            id="nav-link"
                            class="nav-link hvr-underline-from-center"
                            >Tutorials</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            href="https://samenhuiswerken.nl#content3"
                            id="nav-link"
                            class="nav-link hvr-underline-from-center"
                            >Rules</a
                        >
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a
                            href="https://samenhuiswerken.nl/feed"
                            id="nav-link"
                            class="nav-link"
                            >Dashboard</a
                        >
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            id="navbarDropdown"
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            Hello, Sjos <span class="caret"></span
                        ></a>
                        <div
                            aria-labelledby="navbarDropdown"
                            id="dropdownmenunav"
                            class="dropdown-menu dropdown-menu-right"
                        >
                            <a
                                href="https://samenhuiswerken.nl/user/questions"
                                class="dropdown-item"
                                >My questions</a
                            >
                            <a
                                href="https://samenhuiswerken.nl/user/questions/new"
                                class="dropdown-item"
                                >Ask a question</a
                            >
                            <a
                                href="https://samenhuiswerken.nl/marketplace"
                                class="dropdown-item"
                                >Marketplace</a
                            >
                            <hr class="dropdownmenu-hr" />
                            <a
                                href="https://samenhuiswerken.nl/logout"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="dropdown-item"
                            >
                                Logout
                            </a>
                            <form
                                id="logout-form"
                                action="https://samenhuiswerken.nl/logout"
                                method="POST"
                                style="display: none"
                            >
                                <input
                                    type="hidden"
                                    name="_token"
                                    value="XO9zAPm26OcVZjAVjjR2wR6Y63dA77Rdcdtw3LrJ"
                                />
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>