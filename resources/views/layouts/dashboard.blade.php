<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Miyago Naknan Management</title>

        {{-- Styles --}}
        <link
            rel="stylesheet"
            href="{{asset('assets/css/bootstrap/bootstrap.min.css')}}"
        />
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />

        {{-- Scripts --}}
        <script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
        <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    </head>
    <body>
        <main>
            <div class="container dashboard my-5">
                @yield('content')
            </div>
        </main>
        <nav>
            <ul>
                <li>
                    <a href="#" class="active"
                        ><span
                            class="iconify"
                            data-icon="bx:home-alt"
                            data-width="32"
                            data-height="32"
                        ></span
                    ></a>
                </li>
                <li>
                    <a href="#"
                        ><span
                            class="iconify"
                            data-icon="akar-icons:money"
                            data-width="32"
                            data-height="32"
                        ></span
                    ></a>
                </li>
                <li>
                    <a href="#"
                        ><span
                            class="iconify"
                            data-icon="akar-icons:shipping-box-01"
                            data-width="32"
                            data-height="32"
                        ></span
                    ></a>
                </li>
                <li>
                    <a href="#"
                        ><span
                            class="iconify"
                            data-icon="clarity:employee-group-line"
                            data-width="32"
                            data-height="32"
                        ></span
                    ></a>
                </li>
                <li>
                    <a href="#"
                        ><span
                            class="iconify"
                            data-icon="ep:setting"
                            data-width="32"
                            data-height="32"
                        ></span
                    ></a>
                </li>
            </ul>
        </nav>
    </body>
</html>
