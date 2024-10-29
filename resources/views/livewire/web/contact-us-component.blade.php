<div>
    <main>
        <!-- Hero Section  -->
        <section class="hero_wrapper hero_wrapper_others"
            style="background-image: url(assets/app/images/landing/BackgroundHero.png)">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero_content_area text-center">
                            <h1>Let’s Get in Touch with Us</h1>
                            <h4>
                                We are here to help you succeed with your SMS marketing .
                                Whether you need a demo, have questions, or just want to lean
                                more, reach out to us!
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Section  -->
        <section class="contact_wrapper">
            <div class="container container-custom">
                <div class="row">
                    <div class="col-12">
                        <h2 class="pricing_title text-center">Reach Out to Our Team</h2>
                        <div class="contact_grid">
                            <div class="contact_info_area"
                                style="
                    background-image: url(assets/app/images/landing/contact-background.png);
                  ">
                                <h3>Contact Information</h3>
                                <h5>Say something to start a live chat!</h5>
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/bxs_phone-call.svg') }}"
                                                alt="phone icon" />
                                        </div>
                                        <a href="tel:+17867467133">786-746-7133</a>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/ic_sharp-email.svg') }}"
                                                alt="email icon" />
                                        </div>
                                        <a href="mailto:Info@texttorrent.com">Info@texttorrent.com</a>
                                    </li>
                                    {{-- <li>
                                        <div class="icon">
                                            <img src="{{ asset('assets/app/icons/carbon_location-filled.svg') }}"
                                                alt="location icon" />
                                        </div>
                                        <h6>
                                            132 Dartmouth Street Boston, Massachusetts 02156 United
                                            States
                                        </h6>
                                    </li> --}}
                                </ul>
                            </div>
                            <div class="contact_form_area">
                                @if (session()->has('success'))
                                    <div class="alert alert-success mb-5">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form wire:submit.prevent='storeData' class="form_area">
                                    <div class="input_grid">
                                        <div class="input_row">
                                            <input type="text" wire:model="first_name" class="input_filed"
                                                required />
                                            <label for="first_name" class="form_label"> Fast Name </label>
                                            @error('first_name')
                                                <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="input_row">
                                            <input type="text" wire:model="last_name" class="input_filed" />
                                            <label for="last_name" class="form_label"> Last Name </label>
                                            @error('last_name')
                                                <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="input_grid">
                                        <div class="input_row">
                                            <input type="email" wire:model="email" class="input_filed" />
                                            <label for="email" class="form_label"> Email </label>
                                            @error('email')
                                                <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="input_row">
                                            <input type="number" wire:model="phone" class="input_filed" />
                                            <label for="phone" class="form_label"> Phone Number </label>
                                            @error('phone')
                                                <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="input_row">
                                        <textarea wire:model="descriptions" class="input_filed"></textarea>
                                        <label for="descriptions" class="form_label"> Message </label>
                                        @error('descriptions')
                                            <p class="text-danger" style="font-size: 11.5px;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="submit_btn ms-auto">
                                            {!! loadingStateWithText('storeData', 'Send Message') !!}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- How Works Section  -->
        <section class="how_works_wrapper">
            <div class="container container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="how_works_area">
                            <div class="works_content_area">
                                <h3>Want To See How it Works?</h3>
                                <h5>
                                    Schedule a personalized demo with our team to see how our
                                    platform can benefit your business.
                                </h5>
                                <button type="button" class="submit_btn">
                                    Request a Demo
                                </button>
                            </div>
                            <div class="works_image_area">
                                <img src="{{ asset('assets/app/images/landing/how-work-preview.png') }}"
                                    alt="preview video image" class="image_preview" />
                                <img src="{{ asset('assets/app/images/landing/letter_send_1.png') }}" alt="send icon"
                                    class="send_shape" />
                                <div class="video_btn_area">
                                    <button class="video_play_button modal_video_btn" data-channel="custom"
                                        data-video-url="{{ asset('assets/app/videos/featues_video.mp4') }}">
                                        <svg width="37" height="40" viewBox="0 0 37 40" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M33.9297 15.683C37.263 17.6075 37.263 22.4187 33.9297 24.3432L8.23276 39.1794C4.89942 41.1039 0.732767 38.6982 0.732767 34.8492L0.732768 5.17698C0.732769 1.32798 4.89944 -1.07764 8.23277 0.846864L33.9297 15.683Z"
                                                fill="white" />
                                        </svg>
                                        <span style="--i: 1"></span>
                                        <span style="--i: 2"></span>
                                        <span style="--i: 3"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Visit Map Section  -->
        {{-- <section class="how_works_wrapper visit_map_wrapper">
            <div class="container container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="how_works_area">
                            <div class="map_area">
                                <div class="chart_map" id="locationMap"></div>
                                <div class="hide_logo"></div>
                            </div>
                            <div class="works_content_area">
                                <h3>Visit Us</h3>
                                <h5>
                                    Our office timing is located in[City,State]. We’d love to
                                    meet you in personal.
                                </h5>
                                <h5 class="mt-4"><b>Address</b></h5>
                                <h5>[Full office address]</h5>
                                <button type="button" class="submit_btn">
                                    Request a Demo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Ready To Start Section  -->
        <section class="ready_start_wrapper">
            <div class="container container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="ready_content_area">
                            <h2 class="pricing_title">Ready to Get Started?</h2>
                            <h4>
                                Our sales team is here to guide you through the process. Let’s
                                discuss how are platform can meet your needs
                            </h4>
                            <div class="ready_btn_grid d-block text-center">
                                <button type="button" class="contact_sale_btn">
                                    Contact Sales
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="{{ asset('assets/app/images/landing/Background-Integrations.png') }}" alt="ready start curve"
                class="ready_start_curve" />
        </section>
    </main>
</div>
@push('scripts')
    <!-- JS Here -->
    <script src="{{ asset('assets/app/plugins/js/jquery-modal-video.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/46f35fbc02.js" crossorigin="anonymous"></script>
    <!-- Map Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        am5.ready(function() {
            // Create root element
            var root = am5.Root.new("locationMap");

            // Set themes
            root.setThemes([am5themes_Animated.new(root)]);

            // Create the map chart
            var chart = root.container.children.push(
                am5map.MapChart.new(root, {
                    panX: "rotateX",
                    panY: "translateY",
                    projection: am5map.geoMercator(),
                })
            );

            var zoomControl = chart.set(
                "zoomControl",
                am5map.ZoomControl.new(root, {})
            );
            zoomControl.homeButton.set("visible", true);

            // Create main polygon series for countries
            var polygonSeries = chart.series.push(
                am5map.MapPolygonSeries.new(root, {
                    geoJSON: am5geodata_worldLow,
                    exclude: ["AQ"],
                })
            );

            polygonSeries.mapPolygons.template.setAll({
                fill: am5.color("#0097FE"),
            });

            // Create point series for markers
            var pointSeries = chart.series.push(
                am5map.ClusteredPointSeries.new(root, {})
            );

            // Set clustered bullet
            pointSeries.set("clusteredBullet", function(root) {
                var container = am5.Container.new(root, {
                    cursorOverStyle: "pointer",
                });

                var circle1 = container.children.push(
                    am5.Circle.new(root, {
                        radius: 8,
                        tooltipY: 0,
                        fill: am5.color(0xff8c00),
                    })
                );

                var circle2 = container.children.push(
                    am5.Circle.new(root, {
                        radius: 12,
                        fillOpacity: 0.3,
                        tooltipY: 0,
                        fill: am5.color(0xff8c00),
                    })
                );

                var circle3 = container.children.push(
                    am5.Circle.new(root, {
                        radius: 16,
                        fillOpacity: 0.3,
                        tooltipY: 0,
                        fill: am5.color(0xff8c00),
                    })
                );

                var label = container.children.push(
                    am5.Label.new(root, {
                        centerX: am5.p50,
                        centerY: am5.p50,
                        fill: am5.color(0xffffff),
                        populateText: true,
                        fontSize: "8",
                        fontWeight: 600,
                        text: "{value}",
                    })
                );

                container.events.on("click", function(e) {
                    pointSeries.zoomToCluster(e.target.dataItem);
                });

                return am5.Bullet.new(root, {
                    sprite: container,
                });
            });

            // Create regular bullets
            pointSeries.bullets.push(function() {
                var circle = am5.Circle.new(root, {
                    radius: 6,
                    tooltipY: 0,
                    fill: am5.color(0xff8c00),
                    tooltipText: "{title}",
                });

                return am5.Bullet.new(root, {
                    sprite: circle,
                });
            });

            // Set data
            var cities = [{
                    title: "Vienna",
                    latitude: 48.2092,
                    longitude: 16.3728
                },
                {
                    title: "Minsk",
                    latitude: 53.9678,
                    longitude: 27.5766
                },
                {
                    title: "Nairobi",
                    latitude: -1.2762,
                    longitude: 36.7965
                },
                {
                    title: "Dodoma",
                    latitude: -6.167,
                    longitude: 35.7497
                },
                {
                    title: "Lome",
                    latitude: 6.1228,
                    longitude: 1.2255
                },
                {
                    title: "Tunis",
                    latitude: 36.8117,
                    longitude: 10.1761
                },
            ];

            for (var i = 0; i < cities.length; i++) {
                var city = cities[i];
                addCity(city.longitude, city.latitude, city.title);
            }

            function addCity(longitude, latitude, title) {
                pointSeries.data.push({
                    geometry: {
                        type: "Point",
                        coordinates: [longitude, latitude]
                    },
                    title: title,
                });
            }

            // Make stuff animate on load
            chart.appear(1000, 100);
        });
    </script>
@endpush
