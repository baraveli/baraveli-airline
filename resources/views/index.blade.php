<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Baraveli Airline</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
    @livewireScripts

    <style>
        .loader {
            border-top-color: #4FD1C5;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
        }

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body class="antialiased font-sans bg-gray-200" onload="startTime()">
    <div class="container mx-auto px-4 sm:px-8">
        <div class="text-center mt-10 flex justify-center">
            <div class="flex justify-center items-center">
                <svg class="h-10" id="Capa_1" enable-background="new 0 0 501.619 501.619" viewBox="0 0 501.619 501.619"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <linearGradient id="SVGID_1_" gradientTransform="matrix(.707 .707 -.707 .707 279.949 -92.938)"
                        gradientUnits="userSpaceOnUse" x1="222.462" x2="222.462" y1="522.162" y2="-77.838">
                        <stop offset="0" stop-color="#00b59c" />
                        <stop offset="1" stop-color="#9cffac" />
                    </linearGradient>
                    <g>
                        <g>
                            <path
                                d="m432.612 344.779 16.083-16.083c5.863-5.863 5.863-15.351 0-21.213-5.863-5.863-15.351-5.863-21.213 0l-6.993 6.993-12.123-30.304 16.091-16.091c5.863-5.863 5.863-15.351 0-21.213-5.863-5.863-15.351-5.863-21.213 0l-7 6.999-18.243-45.604c154.978-158.25 124.432-188.796 114.292-198.936-10.141-10.14-40.686-40.686-198.936 114.29l-45.604-18.243 7-6.999c5.863-5.863 5.863-15.351 0-21.213-5.863-5.863-15.351-5.863-21.213 0l-16.091 16.091-30.305-12.123 6.993-6.993c5.863-5.863 5.863-15.351 0-21.213-5.863-5.863-15.351-5.863-21.213 0l-16.083 16.083-51.42-20.568c-5.573-2.237-11.932-.932-16.179 3.315l-42.427 42.426c-3.325 3.325-4.899 8.027-4.257 12.689.673 4.672 3.48 8.721 7.572 11.031l162.113 90.063c-37.092 40.717-70.973 80.937-97.023 115.17h-79.011c-3.977 0-7.789 1.574-10.607 4.392l-21.213 21.213c-3.677 3.677-5.179 8.991-3.988 14.056s4.93 9.115 9.851 10.783l58.844 19.608c-7.302 15.112-11.135 30.339-1.067 40.407s25.294 6.236 40.406-1.067l19.608 58.844c1.686 5.012 5.805 8.69 10.783 9.85 5.065 1.191 10.379-.311 14.056-3.988l21.213-21.213c2.817-2.817 4.392-6.629 4.392-10.607v-79.011c34.233-26.05 74.454-59.931 115.171-97.023l90.063 162.113c2.3 4.081 6.37 6.909 11.031 7.572 4.661.642 9.364-.932 12.689-4.257l42.426-42.426c4.247-4.247 5.552-10.607 3.315-16.179zm-32.319 74.746-89.649-161.367c-2.206-3.967-6.194-6.774-10.752-7.52-4.547-.735-9.177.684-12.554 3.812-47.139 43.659-94.31 83.599-132.852 112.467-3.77 2.838-5.997 7.282-5.997 12.005v78.907l-13.196-39.588c-.735-2.206-1.978-4.216-3.625-5.863l-9.219-9.219c-4.765-4.765-12.129-5.769-17.992-2.455-2.89 1.647-5.417 2.973-7.613 4.071 1.098-2.196 2.424-4.723 4.071-7.613 3.315-5.863 2.31-13.227-2.455-17.992l-9.219-9.219c-1.647-1.647-3.656-2.89-5.863-3.625l-39.587-13.196h78.907c4.723 0 9.167-2.227 12.005-5.997 28.868-38.542 68.808-85.713 112.467-132.852 3.128-3.377 4.547-8.007 3.812-12.554-.736-4.547-3.511-8.525-7.52-10.752l-161.367-89.648 21.369-21.369 187.863 75.147c5.542 2.227 11.881.943 16.127-3.263 131.049-129.785 163.429-121.25 163.387-121.623.187.518 8.721 32.897-121.064 163.947-4.205 4.247-5.49 10.586-3.263 16.127l75.147 187.863z"
                                fill="url(#SVGID_1_)" />
                        </g>
                    </g>
                </svg>
                <h1 class="text-3xl font-bold text-teal-400">Baraveli Airlines</h1>
            </div>

        </div>

        <div class="flex justify-center mb-5">
            <div class="mt-2 p-5 w-40 bg-white rounded shadow">
                <div class="flex justify-between items-center">
                    <img class="h-10" src="https://image.flaticon.com/icons/svg/875/875216.svg">
                  <h3 id="clock" class="bg-transparent text-xl text-center"></h3>
                  
                </div>
              </div>
        </div>
       

       

        <div class="max-w-xl px-4 py-4 mx-auto">
            <div class="sm:grid sm:h-32 sm:grid-flow-row sm:gap-4 sm:grid-cols-3">
                <div class="flex flex-col justify-center px-4 py-4 bg-white rounded shadow">
                    <div>

                        <p class="text-3xl font-semibold text-center text-gray-800">{{$arrivals->count()}}</p>
                        <p class="text-lg text-center text-gray-500">Arrivals</p>
                    </div>
                </div>

                <div class="flex flex-col justify-center px-4 py-4 mt-4 bg-white rounded shadow sm:mt-0">
                    <div>

                        <p class="text-3xl font-semibold text-center text-gray-800">{{$depatures->count()}}</p>
                        <p class="text-lg text-center text-gray-500">Depature</p>
                    </div>
                </div>

                <div class="flex flex-col justify-center px-4 py-4 mt-4 bg-white shadow rounded sm:mt-0">
                    <div>

                        <p class="text-3xl font-semibold text-center text-gray-800">
                            {{$depatures->count() + $arrivals->count()}}</p>
                        <p class="text-lg text-center text-gray-500">Total</p>
                    </div>
                </div>
            </div>
        </div>

        @livewire('arrival-table')

        @livewire('depature-table')



        <footer class="p-2 text-center font-normal text-gray-600">
            <p>Baraveli Airlines © 2020. Made with ❤️ in Maldives.</p>
        </footer>
    </div>
<script src="/js/script.js"></script>
</body>

</html>