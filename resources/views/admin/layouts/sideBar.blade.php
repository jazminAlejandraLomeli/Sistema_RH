{{-- Menu de navegacion del sistema, donde se muestran solo las opciones necesarias segun el tipo de usuario  --}}
<header id="header" class="movil-collapse d-flex flex-column ">
    <section class="d-flex justify-content-center px-2 py-3" id="headerTop">
        <section class="flex-grow-1 hidden">
            <img class="logo-custom" src="{{ asset('images/SIP-CUAltos.webp') }}" />
        </section>
        <section class="d-flex justify-content-center align-items-center">
            <div class="btn-header" id="compressSidebar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="collapseIcon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </div>

            <div class="btn-header" id="closeSidebar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="collapseIcon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
        </section>
    </section>

    {{-- Links content --}}
    <nav class="flex-grow-1 mt-3 px-3 py-3">
        <h4 class="title-custom-header hidden">Menu</h4>
        <ul class="nav-options">
            <li>
                <a href="{{ route('home.index') }}" class="text-white" title="Inicio">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="icons-navbar">
                        <path
                            d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                        <path
                            d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                    </svg>
                    <span class="hidden">Inicio</span>
                </a>
            </li>

            @role('Lectura')
                <li>
                    <a href="{{ route('directory.index') }}" class="text-white" title="Directorio">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <g fill="none" fill-rule="evenodd">
                                <path
                                    d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                                <path fill="currentColor"
                                    d="M16 2a1 1 0 0 1 1 1h2a2 2 0 0 1 2 2v15a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h2a1 1 0 0 1 2 0h6a1 1 0 0 1 1-1M7 5a1 1 0 0 0 2 0h6a1 1 0 1 0 2 0h2v15H5V5zm5 4a1 1 0 1 0 0 2a1 1 0 0 0 0-2m-3 1a3 3 0 1 1 6 0a3 3 0 0 1-6 0m-.051 7.316c.152-.457.44-.758.902-.968C10.353 16.12 11.065 16 12 16s1.647.12 2.149.348c.463.21.75.51.902.968a1 1 0 0 0 1.898-.632c-.348-1.043-1.06-1.742-1.973-2.157C14.103 14.13 13.065 14 12 14s-2.103.13-2.976.527c-.912.415-1.625 1.114-1.973 2.157a1 1 0 0 0 1.898.632" />
                            </g>
                        </svg>
                        <span class="hidden">Directorio</span>
                    </a>
                </li>
            @endrole

            @hasanyrole('Lectura|Administrador')
                <li>
                    <a data-bs-toggle="collapse" href="#collapsePersonal" role="button" aria-expanded="false"
                        title="Personal" aria-controls="collapsePersonal" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="icons-navbar">
                            <path
                                d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
                        </svg>
                        <span class=" flex-grow-1 hidden">Personal</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="icons-navbar hidden">
                            <path fill-rule="evenodd"
                                d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <div class="collapse navbar-submenu" id="collapsePersonal">
                        <ul class="nav-options">
                            <li>
                                <a href="{{ route('personal.index') }}" class="text-white" title="Lista de personal">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="icons-navbar">
                                        <path fill-rule="evenodd"
                                            d="M2.625 6.75a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0A.75.75 0 0 1 8.25 6h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.625 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0ZM7.5 12a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12A.75.75 0 0 1 7.5 12Zm-4.875 5.25a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="hidden">Lista de personal</span>
                                </a>
                            </li>
                            @role('Administrador')
                                <li>
                                    <a href="{{ route('personal.agregar_personal') }}" class="text-white"
                                        title="Agregar persona">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="icons-navbar">
                                            <path
                                                d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                                        </svg>

                                        <span class="hidden">Agregar persona</span>
                                    </a>
                                </li>
                            @endrole
                        </ul>
                    </div>
                </li>

                <li>
                    <a data-bs-toggle="collapse" href="#collapseHonorarios" role="button" aria-expanded="false"
                        title="Contratos honorarios" aria-controls="collapseHonorarios" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36" class="icons-navbar">
                            <path fill="currentColor"
                                d="m34.486 13.86l-.432-.432a3.17 3.17 0 0 0-.563-3.563a3 3 0 0 0-2.326-.87A3.4 3.4 0 0 0 30 9.272V2H2v32h28V17.82l3.09-3.09l.264.263a.37.37 0 0 1 0 .525l-2.353 2.354a.8.8 0 0 0 1.131 1.132l2.354-2.354a1.975 1.975 0 0 0 0-2.79M8 8.2h16.002v1.6H8Zm0 4h16.002v1.6H8Zm0 4h10.5v1.6H8Zm14.792 13.696h-7.804c-.902 0-1.746-.085-2.194-.824c-.459-.755-.003-1.632.33-2.274c.059-.113-.072-.253-.222-.098c-.44.452-1.14 1.266-1.703 1.92c-.595.692-.831.963-.957 1.077a.92.92 0 0 1-1.106.224a.87.87 0 0 1-.407-.969c.042-.25.756-3.032 1.403-5.533c-.86 1.527-3.59 6.1-3.718 6.315a.7.7 0 0 1-1.203-.718c.035-.057 3.455-5.788 3.886-6.62a1.425 1.425 0 0 1 1.776-.793a1.315 1.315 0 0 1 .755 1.626c-.36 1.388-.727 2.812-1.01 3.92c.457-.528.935-1.07 1.28-1.425a1.9 1.9 0 0 1 2.24-.517a1.18 1.18 0 0 1 .616 1.32a4.6 4.6 0 0 1-.388.916c-.267.555-.14 1.052.622 1.052h7.803a.7.7 0 0 1 0 1.4Zm-2.081-5.05l-2.604.687a.22.22 0 0 1-.216-.058a.22.22 0 0 1-.059-.216l.664-2.599l6.59-6.59l2.2 2.2Zm11.466-11.467l-3.76 3.76l-2.2-2.2l3.76-3.76a1.95 1.95 0 0 1 1.27-.586l.09-.003a1.42 1.42 0 0 1 1.022.407a1.7 1.7 0 0 1-.182 2.382" />
                        </svg>
                        <span class=" flex-grow-1 hidden">Honorarios</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="icons-navbar hidden">
                            <path fill-rule="evenodd"
                                d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <div class="collapse navbar-submenu" id="collapseHonorarios">
                        <ul class="nav-options">
                            <li>
                                <a href="{{ route('honorario.index') }}" class="text-white" title="Lista de personal">

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="icons-navbar">
                                        <path fill-rule="evenodd"
                                            d="M2.625 6.75a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0A.75.75 0 0 1 8.25 6h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.625 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0ZM7.5 12a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12A.75.75 0 0 1 7.5 12Zm-4.875 5.25a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="hidden">Lista de honorarios</span>
                                </a>
                            </li>
                            @role('Administrador')
                                <li>
                                    <a href="{{ route('honorarios.create') }}" class="text-white" title="Agregar persona">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="icons-navbar">
                                        <path
                                            d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                                    </svg> --}}

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" class="icons-navbar">
                                            <path fill="currentColor"
                                                d="M512 0C229.232 0 0 229.232 0 512c0 282.784 229.232 512 512 512c282.784 0 512-229.216 512-512C1024 229.232 794.784 0 512 0m0 961.008c-247.024 0-448-201.984-448-449.01c0-247.024 200.976-448 448-448s448 200.977 448 448s-200.976 449.01-448 449.01M736 480H544V288c0-17.664-14.336-32-32-32s-32 14.336-32 32v192H288c-17.664 0-32 14.336-32 32s14.336 32 32 32h192v192c0 17.664 14.336 32 32 32s32-14.336 32-32V544h192c17.664 0 32-14.336 32-32s-14.336-32-32-32" />
                                        </svg>

                                        <span class="hidden">Agregar contrato</span>
                                    </a>
                                </li>
                            @endrole
                        </ul>
                    </div>
                </li>
            @endhasanyrole



            @role('Administrador')
                <li>
                    <a data-bs-toggle="collapse" href="#collapseUsers" role="button" aria-expanded="false"
                        title="Usuarios" aria-controls="collapseUsers" class="text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="icons-navbar">
                            <path fill-rule="evenodd"
                                d="M2.25 6a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V6Zm3.97.97a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06l-2.25 2.25a.75.75 0 0 1-1.06-1.06l1.72-1.72-1.72-1.72a.75.75 0 0 1 0-1.06Zm4.28 4.28a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class=" flex-grow-1 hidden">Usuarios</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="icons-navbar hidden">
                            <path fill-rule="evenodd"
                                d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <div class="collapse navbar-submenu" id="collapseUsers">
                        <ul class="nav-options">
                            <li>
                                <a href="{{ route('users.index') }}" class="text-white" title="Lista de usuarios">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="icons-navbar">
                                        <path fill-rule="evenodd"
                                            d="M2.625 6.75a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0A.75.75 0 0 1 8.25 6h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75ZM2.625 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0ZM7.5 12a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12A.75.75 0 0 1 7.5 12Zm-4.875 5.25a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875 0a.75.75 0 0 1 .75-.75h12a.75.75 0 0 1 0 1.5h-12a.75.75 0 0 1-.75-.75Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="hidden">Lista de usuarios</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            @endrole

            @role('Designer')
                <li>
                    <a href="{{ route('designer.index') }}" class="text-white" title="Diseñador">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10s10-4.486 10-10S17.514 2 12 2m0 18c-4.411 0-8-3.589-8-8c0-1.168.258-2.275.709-3.276q.232.135.456.276c.396.25.791.5 1.286.688c.494.187 1.088.312 1.879.312c.792 0 1.386-.125 1.881-.313s.891-.437 1.287-.687s.792-.5 1.287-.688S13.873 8 14.665 8s1.386.125 1.88.313c.495.187.891.437 1.287.687s.792.5 1.287.688q.269.099.581.171c.191.682.3 1.398.3 2.141c0 4.411-3.589 8-8 8" />
                            <circle cx="8.5" cy="12.5" r="1.5" fill="currentColor" />
                            <circle cx="15.5" cy="12.5" r="1.5" fill="currentColor" />
                        </svg>
                        <span class="hidden">Diseñador</span>
                    </a>
                </li>
            @endrole
        </ul>
    </nav>

    {{-- Footer Sidebar --}}
    <section id="footer-sidebar">
        <p class="m-0 hidden">{{ $userName }}</p>
        <div class="dropdown">
            <button class="btn-header-custom" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="collapseIcon">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>
            <ul class="dropdown-menu">
                {{-- <li><a class="dropdown-item modal-hover py-2" href="#" data-bs-toggle="modal"
                        data-bs-target="#changePass">Cambiar contraseña</a></li>
                <li> --}}
                <li>
                    <a class="dropdown-item modal-hover py-2" href="{{ route('profile.index') }}">Mi perfil</a>
                </li>
                <li>
                    <form action=" {{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item modal-hover py-2" type="submit">Cerrar sesión</button>
                    </form>
                </li>
            </ul>

        </div>
    </section>
</header>
