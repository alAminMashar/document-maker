    <div>
        <style type="text/css">
            .count-down {
                width: 100%;
                height: 150px;
                margin: auto;
                padding: 20px;
            }

            .count-down .flipdown {
                margin: auto;
                width: 100%;
                margin-top: 15px;
            }

            .count-down h1 {
                text-align: center;
                font-weight: 400;
                font-size: 3em;
                margin-top: 0;
                margin-bottom: 10px;
            }

            @media (max-width: 550px) {
                .count-down {
                    width: 100%;
                    height: 150px;
                }

                .count-down h1 {
                    font-size: 2.5em;
                }
            }

            .bg-imagssssse {
                background-repeat: no-repeat;
                background-size: cover;
                /* scales to cover the element */
                background-position: center;
                /* centers the image */
            }
        </style>
    </div>

    @if ($poll->starting_at > Carbon\Carbon::now())
        <div class="badge badge-warning p-3">
            &nbsp;Poll Starting {{ Carbon\Carbon::parse($poll['starting_at'])->diffForHumans() }}&nbsp;
        </div>
    @elseif($poll->ending_at < Carbon\Carbon::now())
        <div class="badge badge-warning p-3">
            &nbsp;Poll Ended {{ Carbon\Carbon::parse($poll['ending_at'])->diffForHumans() }}&nbsp;
        </div>
    @else
        <div class="count-down">
            <div class="flipdown" id="flipdown"></div>
        </div>
    @endif

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Get ending time as Unix timestamp (in seconds)
                var toDayFromNow = {{ \Carbon\Carbon::parse($poll['ending_at'])->timestamp }};

                // Initialize FlipDown
                new FlipDown(toDayFromNow)
                    .start()
                    .ifEnded(function() {
                        $(".flipdown").html("<h2>This Poll Has Ended</h2>");
                    });
            });

            // Safe replacement for old $(window).load usage
            $(window).on("load", function() {
                // Any plugin logic that expected $(window).load goes here
                // Example: trigger a waypoint refresh if needed
                if ($.waypoints) {
                    $.waypoints("refresh");
                }
            });
        </script>
    @endpush
