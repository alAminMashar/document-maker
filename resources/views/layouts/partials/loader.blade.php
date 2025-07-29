@push('scripts')
    <script>
        //when the webpage is loaded
        jQuery(document).ready(function($) {
            $(".loading-zone").addClass("d-none");
        });

        document.addEventListener("DOMContentLoaded", () => {
            //Ajax message sent to the backend
            Livewire.hook('message.sent', (message, component) => {
                $(".loading-zone").removeClass("d-none");
            });
            //Ajax response received from the backend
            Livewire.hook('message.received', (message, component) => {
                $(".loading-zone").addClass("d-none");
            });
        });
    </script>
@endpush

<div class="loading-zone">

    <style>
        .loading-screen {
            position: fixed;
            top: 0px;
            left: 0px;
            right: 0px;
            width: 100%;
            height: 100vh;
            z-index: 50;
            overflow: hidden;
            background-color: grey;
            opacity: 70%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loader {
            width: 12vh;
            height: 12vh;
            /* position: absolute; */
            border-radius: 50%;
            border: 5px solid rgba(128, 128, 128, .2);
            border-top-color: #3498db;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
            transition-timing-function: linear;
            margin-bottom: 4vh;
        }

        .hidden{
            display:none;
            opacity: 0%;
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


    <div class="loading-screen">
        <div class="loader"></div>
        <h2 class="text-center text-white dark:text-fuchsia-600 text-xl font-semibold">Loading....</h2>
    </div>

</div>
