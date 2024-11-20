<div>
    <main>
        <section class="hero_wrapper overflow-x-hidden"
            style="background-image: url({{ asset('assets/app/images/landing/BackgroundHero.png') }})">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero_content_area text-center">
                            <h1 data-aos="fade-up">
                                Empower Your Business With Seamless SMS Marketing
                            </h1>
                            <h4 data-aos="fade-up" data-aos-delay="50">
                                Effortlessly connect with your audience through our powerful
                                and intuitive SMS platform.
                            </h4>
                            <div class="hero_btn_area d-flex justify-content-center align-items-center flex-wrap"
                                data-aos="fade-up" data-aos-delay="100">
                                <a href="{{ route('register') }}" class="hero_btn bg_btn">
                                    <span>Start Now</span>
                                </a>
                                <a href="#" class="hero_btn border_btn">
                                    <span>Trial</span>
                                    <img src="{{ asset('assets/app/images/landing/arrow-right.svg') }}"
                                        alt="arrow icon" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Image Section  -->
        <section class="hero_image_wrapper overflow-x-hidden" data-aos="fade-up">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="position-relative">
                            <div class="text-center">
                                <img src="{{ asset('assets/app/images/landing/hero_image.png') }}" alt="hero image"
                                    class="hero_image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Campaign Section  -->
        <section class="campaign_wrapper overflow-x-hidden">
            <div class="container container-custom">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <h1>Unleash the Full Potential of Your SMS Campaigns</h1>
                        </div>
                        <div class="campaign_grid dynamic_item">
                            <div class="content" data-aos="fade-left">
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/custom_message.svg') }}"
                                        alt="campaigns icon" />
                                </div>
                                <h3>Custom Message Templates</h3>
                                <h5>
                                    Choose from industry-specific templates that are designed to engage your audience
                                    effectively. Whether you’re in retail, finance, or healthcare, we’ve got you
                                    covered.
                                </h5>
                            </div>
                            <div class="campaign_image" data-aos="fade-right">
                                <img src="{{ asset('assets/app/images/landing/custom_templates.png') }}"
                                    alt="custom template image" />
                            </div>
                        </div>
                        <div class="campaign_grid campaign_left_grid compliance_item">
                            <div class="content" data-aos="slide-up">
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/real_time.svg') }}" alt="campaigns icon" />
                                </div>
                                <h3>Real-Time Delivery Insights</h3>
                                <h5>
                                    Monitor the delivery status of your SMS campaigns in real time. Instantly see who
                                    has received, opened, and engaged with your messages.
                                </h5>
                            </div>
                            <div class="campaign_image" data-aos="fade-right">
                                <img src="{{ asset('assets/app/images/landing/real_time.png') }}"
                                    alt="real time image" />
                            </div>
                        </div>
                        <div class="campaign_grid  message_item">
                            <div class="content" data-aos="fade-down-right">
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/dynamic_personalization.svg') }}"
                                        alt="custom template icon" />
                                </div>
                                <h3>Dynamic Personalization</h3>
                                <h5>
                                    Deliver messages that resonate by using dynamic fields to personalize content for
                                    each recipient, from names to purchase history.
                                </h5>
                            </div>
                            <div class="campaign_image" data-aos="fade-up-right">
                                <img src="{{ asset('assets/app/images/landing/dynamic_personalization.png') }}"
                                    alt="dynamic image" />
                            </div>
                        </div>
                        <div class="campaign_grid campaign_left_grid real_time_item">
                            <div class="content" data-aos="fade-left">
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/compliance.svg') }}"
                                        alt="custom template icon" />
                                </div>
                                <h3>Compliance & Security Built-In</h3>
                                <h5>
                                    Stay compliant with industry regulations and protect your customer data with our
                                    built-in security features. Our platform ensures every message meets regulatory
                                    standards."
                                </h5>
                            </div>
                            <div class="campaign_image" data-aos="zoom-in-up">
                                <img src="{{ asset('assets/app/images/landing/compliance_new.png') }}"
                                    alt="compliance image" />
                            </div>
                        </div>
                        <div class="campaign_grid automated_item">
                            <div class="content" data-aos="fade-down-left">
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/automated_follow.svg') }}"
                                        alt="automatic follow icon" />
                                </div>
                                <h3>Automated Follow-Ups</h3>
                                <h5>
                                    Set up automated follow-up messages based on customer interactions. Keep the
                                    conversation going without lifting a finger.
                                </h5>
                            </div>
                            <div class="campaign_image" data-aos="fade-up">
                                <img src="{{ asset('assets/app/images/landing/message.png') }}" alt="message image" />
                            </div>
                        </div>
                        <div class="campaign_grid campaign_left_grid api_time_item">
                            <div class="content" data-aos="fade-up-left">
                                <div class="icon">
                                    <img src="{{ asset('assets/app/icons/scalable_api.svg') }}" alt="api icon" />
                                </div>
                                <h3>Scalable API Integration</h3>
                                <h5>
                                    Easily connect your preferred SMS gateway, whether it’s Twilio, Telnyx, Trumpia,
                                    Plivo, or another provider. Our platform is designed to seamlessly integrate with
                                    your existing API setup, allowing you to send thousands or millions of messages
                                    without missing a beat."
                                </h5>
                            </div>
                            <div class="campaign_image" data-aos="fade-down">
                                <img src="{{ asset('assets/app/images/landing/api_integration.png') }}"
                                    alt="api image" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="{{ asset('assets/app/images/landing/campaign_react_shape.svg') }}" alt="campaign shape"
                class="campaign_shape" />
        </section>
        <!-- Testimonial  Section  -->
        <section class="testimonial_wrapper overflow-x-hidden">
            <img src="{{ asset('assets/app/images/landing/testimonial_curve.png') }}" alt="testimonial curve"
                class="testimonial_curve" />
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="testimonial_slider_area">
                            <h2 class="landing_inner_title">
                                Success Stories from Our Clients
                            </h2>

                            <!-- Swiper -->
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="testimonial_item">
                                            <div class="content">
                                                <h3>Mike Johnson</h3>
                                                <h6>Founder at Flowserve</h6>
                                                <p>
                                                    The real-time analytics and easy-to-use interface
                                                    have revolutionized how we connect with our clients.
                                                    I can’t recommend Text Torrent enough!
                                                </p>
                                            </div>
                                            <img src="{{ asset('assets/app/images/landing/testimonial_react_shape.svg') }}"
                                                alt="testimonial react shape" class="testimonial_react_shape" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial_item">
                                            <div class="content">
                                                <h3>Jane Smith</h3>
                                                <h6>CEO at HealthPro Services</h6>
                                                <p>
                                                    We’ve tried multiple SMS platforms, But none offered
                                                    the flexibility to use our own gateways like Text
                                                    Torrent. It’s a game-changer for our business.
                                                </p>
                                            </div>
                                            <img src="{{ asset('assets/app/images/landing/testimonial_react_shape.svg') }}"
                                                alt="testimonial react shape" class="testimonial_react_shape" />
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="testimonial_item">
                                            <div class="content">
                                                <h3>John Doe</h3>
                                                <h6>Marketing Director at RetailCo</h6>
                                                <p>
                                                    Using Text Torrent, we saw a 30% increase in
                                                    customer engagement within the first month. The
                                                    ability to integrate our existing API made the
                                                    transition seamless!
                                                </p>
                                            </div>
                                            <img src="{{ asset('assets/app/images/landing/testimonial_react_shape.svg') }}"
                                                alt="testimonial react shape" class="testimonial_react_shape" />
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Business Section  -->
        <section class="business_wrapper overflow-x-hidden"
            style="background-image: url({{ asset('assets/app/images/landing/BackgroundCTA.png') }})">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <h2 class="landing_inner_title">
                                Let's start growing your business
                            </h2>
                            <h4 data-aos="fade-up">
                                Ready to grow your business? Text Torrent helps you reach your audience instantly and
                                boost sales with powerful SMS marketing.
                            </h4>
                            <div class="business_btn_area d-flex align-items-center justify-content-center flex-wrap"
                                data-aos="fade-right">
                                <a href="{{ route('register') }}" class="business_btn">Register Now</a>
                                <a href="{{ route('app.contact-us') }}" class="business_btn">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
