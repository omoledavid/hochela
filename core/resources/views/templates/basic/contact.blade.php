@extends($activeTemplate.'layouts.frontend')

@section('content')
    <?php
    $socials = getContent('social_icon.element');
    ?>
        <!-- contact section start -->
    <section id="about" class="pt-100 pb-100 section--bg">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-6">
                    <div class="about-thumb rounded-3">
                        <img
                            src="https://img.freepik.com/free-photo/business-concept-with-team-close-up_23-2149151159.jpg?t=st=1721375123~exp=1721378723~hmac=fe302dfcd76e2d09f82d5b097474ff394fe2fc4dc98cff60a949bd09f6be24c0&w=2000"
                            alt="image">
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <div class="section-header">
                        <div class="section-top-title border-left text--base">About us</div>
                        <h2 class="section-title">We care about your comfort</h2>
                    </div>
                    <div class="row gy-4">
                        <div class="col-xxl-10 col-xl-10 wow fadeInRight" data-wow-duration="0.5s"
                             data-wow-delay="0.3s">
                            <div class="about-card">
                                <div class="about-card__icon rounded-3 bg--base">
                                    <i class="las la-hourglass-start"></i>
                                </div>
                                <div class="about-card__content">
                                    <h4 class="title">Our Mission</h4>
                                    <p>At <b>Hochela</b> Limited, our mission is to provide university students with an
                                        all-in-one platform to find comfortable accommodations, reliable roommates, and
                                        information about campus events, news, and parties, enabling them to make the
                                        most of their university experience.</p>
                                </div>
                            </div>
                            <div style="margin-top: 10px" class="about-card">
                                <div class="about-card__icon rounded-3 bg--base">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="about-card__content">
                                    <h4 class="title">Our Vision</h4>
                                    <p>We aspire to become the go-to platform for students seeking housing, community,
                                        and engagements, fostering connections between students and the university
                                        community.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-100 pb-100 dot--bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="section-header">
                        <h2 style="font-size: 2rem" class="section-title">{{ __($contact->data_values->title) }}</h2>
                    </div>
                </div>
            </div><!-- row end -->
            <div class="row gy-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-card__header">
                            <div class="icon">
                                <i class="las la-map-marked-alt"></i>
                            </div>
                            <h3 class="title">@lang('Location')</h3>
                        </div>
                        <p>{{ __($contact->data_values->contact_address) }}</p>
                    </div><!-- contact-card end -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-card__header">
                            <div class="icon">
                                <i class="las la-address-card"></i>
                            </div>
                            <h3 class="title">@lang('Email & Phone')</h3>
                        </div>
                        <p><a href="mailto:demo@email.com">{{ $contact->data_values->email_address }}</a></p>
                        <p><a href="tel:15455545445">{{ $contact->data_values->contact_number }}</a></p>
                    </div><!-- contact-card end -->
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-card__header">
                            <div class="icon">
                                <i class="las la-map-marked-alt"></i>
                            </div>
                            <h3 class="title">@lang('Socail Media')</h3>
                        </div>
                        <ul class="social-media-list d-flex align-items-center">
                            @foreach ($socials as $social)
                                <li><a href="{{ $social->data_values->url }}"
                                       target="_blank">@php echo $social->data_values->social_icon @endphp</a></li>
                            @endforeach
                        </ul>
                    </div><!-- contact-card end -->
                </div>
            </div><!-- row end -->
        </div>
    </section>
    <!-- contact section end -->
    <!-- map section start -->

    <!-- map section end -->

    <!-- contact form section start -->
    <section class="pt-100 pb-100 dot--bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-header">
                        <h2 style="font-size: 2rem" class="section-title">@lang('Do you have any question?')</h2>
                    </div>
                </div>
            </div><!-- row end -->
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('about') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>@lang('Name')</label>
                                <input type="text" name="name" placeholder="Enter your name" class="form--control"
                                       value="{{ auth()->user() ? auth()->user()->fullname : old('name') }}"
                                       @if(auth()->user()) readonly @endif required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>@lang('Email')</label>
                                <input type="email" name="email" placeholder="Enter email address" class="form--control"
                                       value="{{ auth()->user() ? auth()->user()->email : old('email')}}"
                                       @if(auth()->user()) readonly @endif required>
                            </div>

                            <div class="col-md-12 form-group">
                                <label>@lang('Subject')</label>
                                <input type="text" name="subject" placeholder="@lang('Enter subject')"
                                       class="form--control" value="{{old('subject')}}" required>
                            </div>
                            <div class="col-lg-12 form-group">
                                <label>@lang('Message')</label>
                                <textarea placeholder="Your message" name="message"
                                          class="form--control">{{old('message')}}</textarea>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn--base">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- contact form section end -->

    @if($sections != null)
        @foreach(json_decode($sections) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif

@endsection
