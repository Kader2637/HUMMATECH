@extends('landing.layouts.layouts.app')

@section('style')
    <style>
        .subtitle {
            text-transform: uppercase;
            font-weight: 600;
            color: #1273eb;
            margin-top: -5px;
            display: inline-block;
            background: linear-gradient(90deg, rgba(18, 115, 235, 1) 30%, rgba(4, 215, 242, 1) 100%);
            -webkit-background-clip: text;
            -moz-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .about-us-area .thumb {
            padding-left: unset;
            padding-right: 50px;
        }

        .about-us-area .thumb::after {
            right: 0;
            top: 5rem !important;
            left: unset !important;
        }

        .about-us-area .container {
            position: relative;
        }

        .about-us-area .about-triangle {
            position: absolute;
            z-index: -1;
            top: -7.5rem;
            right: -7.5rem;
        }

        @media screen and (max-width: 992px) {
            .about-us-area .about-triangle {
                right: 0;
            }

            .about-us-area .thumb {
                padding-top: 50px;
                padding-right: unset;
            }
        }
    </style>
    <style>
        #owl-carousel-mitra::before,
        #owl-carousel-mitra::after {
            position: absolute;
            height: 100%;
            z-index: 2;
            content: '';
            width: 150px;
        }

        #owl-carousel-mitra::before {
            left: 0;
            top: 0;
            bottom: 0;
            background: linear-gradient(to right, rgba(var(--bs-white-rgb), 1), 65%, transparent);
        }

        #owl-carousel-mitra::after {
            right: 0;
            top: 0;
            bottom: 0;
            background: linear-gradient(to left, rgba(var(--bs-white-rgb), 1), 65%, transparent);
        }

        /* Custom styles for the timeline */
        .timeline {
            position: relative;
            padding: 40px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            width: 4px;
            height: 100%;
            background: #ced4da;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
        }

        .timeline-item {
            margin-bottom: 50px;
            position: relative;
        }

        .timeline-item::after {
            content: '';
            display: table;
            clear: both;
        }

        .timeline-item-content {
            position: relative;
            width: 45%;
            border-radius: 5px;
            float: left;
            padding-right: 3rem;
        }

        .timeline-item-content h2 {
            margin-top: 0;
        }

        .timeline-item-date {
            font-size: 14px;
            color: #6c757d;
        }

        .timeline-number {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 5rem;
            height: 5rem;
            background-color: #007bff;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.5rem;
            font-family: 'Poppins', Arial, Helvetica, sans-serif;
        }

        /* Alternate the position of the timeline items */
        .timeline .timeline-item:nth-child(even) .timeline-item-content {
            float: right;
            text-align: right;
            padding-left: 3rem;
            padding-right: 0;
        }

        .timeline .timeline-item:nth-child(even) .timeline-item-content::before {
            right: 100%;
            border-right: 8px solid #f8f9fa;
            border-left: none;
        }

        .timeline .timeline-item:nth-child(odd) .timeline-item-content::before {
            left: 100%;
            border-left: 8px solid #f8f9fa;
            border-right: none;
        }

        .timeline .timeline-item:nth-child(even) .timeline-item-content::after,
        .timeline .timeline-item:nth-child(odd) .timeline-item-content::after {
            display: none;
        }
    </style>
@endsection

@section('seo')
    <!-- ========== Breadcrumb Markup (JSON-LD) ========== -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@type": "ListItem",
          "position": 1,
          "name": "Beranda",
          "item": "{{ url('/') }}"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "Tentang Kami",
          "item": "{{ url('/about-us') }}"
        },
        {
          "@type": "ListItem",
          "position": 4,
          "name": "Produk",
          "item": "{{ url('/produk') }}"
        },
      ]
    }
    </script>
@endsection

@section('content')
    <div class="breadcrumb-area text-center shadow dark text-light bg-cover"
        style="background-image: url({{ $background == null ? asset('assets-home/img/default-bg.png') : asset('storage/' . $background->image) }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>{{ $slugs->name }}</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Beranda</a></li>
                        <li class="active">Layanan</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="services-details-area default-padding">
        <div class="container">
            <div class="services-details-items">
                <div class="row">

                    <div class="col-lg-8 services-single-content">
                        <img src="{{ asset('storage/' . $slugs->image) }}" alt="Thumb">
                        <h2 class="wow fadeInLeft">{{ $slugs->name }}</h2>
                        <p class="wow fadeInLeft">
                            {!! Str::limit($slugs->description, 800) !!}
                        </p>
                        @if ($slugs->link)
                            <a href="{{ $slugs->link }}" target="_blank" class="btn btn-gradient effect btn-md"
                                href="">Kunjungi website</a>
                        @endif

                        <div class="mt-5">
                            <div class="title-service">
                                <h4 class="m-0">Produk Yang Dihasilkan</h4>
                                <div class="dash"></div>
                            </div>
                            @forelse ($products as $index => $product)
                                <div class="about-content-area pb-5 mb-5">
                                    <div class="row @if ($index % 2 === 1) flex-row-reverse @endif">
                                        <div class="col-lg-5 thumb wow fadeInUp">
                                            <div class="img-box">
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="Thumb">
                                                <div class="shape" style="background-image: url(assets/img/shape/1.png);">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 wow fadeInDown">
                                            <h2>{{ $product->name }}</h2>
                                            <p>{{ $product->description }}</p>
                                            <a class="btn btn-stroke-gradient text-gradient effect btn-md"
                                                href="/detail/{{ $product->slug }}">Lihat detail</a>
                                            <a class="btn btn-gradient effect btn-md" href="{{ $product->link }}">Kunjungi
                                                website</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset('nodata-gif.gif') }}" alt="" width="800px">
                                    </div>
                                    <h4 class="text-center text-dark" style="font-weight:600">
                                        Belum ada produk
                                    </h4>
                                </div>
                            @endforelse
                        </div>

                        <div class="my-5 py-3">
                            <div class="title-service">
                                <h4 class="m-0">Testimoni Layanan</h4>
                                <div class="dash"></div>
                            </div>
                            <div class="testimonials-area">
                                <div class="container">
                                    <div class="testimonial-items bg-gradient-gray">
                                        <div class="row align-center bg-gradient-gray">
                                            <div class="col-lg-7 testimonials-content">
                                                <div class="testimonials-carousel owl-carousel owl-theme">
                                                    @forelse ($testimonials as $testimonial)
                                                        <div class="item">
                                                            <div class="info">
                                                                <p>
                                                                    {{ $testimonial->description }}
                                                                </p>
                                                                <div class="provider">
                                                                    <div class="thumb">
                                                                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                                                            style="background-image: url('{{ asset('storage/' . $testimonial->image) }}'); background-size: cover; background-position: center;"
                                                                            alt="Author" class="object-fit-cover">
                                                                    </div>
                                                                    <div class="content">
                                                                        <h4 class="text-primary">{{ $testimonial->name }}
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="col-12">
                                                            <div class="d-flex justify-content-center">
                                                                <img src="{{ asset('nodata-gif.gif') }}" alt=""
                                                                    width="800px">
                                                            </div>
                                                            <h4 class="text-center text-dark" style="font-weight:600">
                                                                Belum ada Testimoni
                                                            </h4>
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="col-lg-5 info">
                                                <h4>Testimoni</h4>
                                                <h3>Testimoni Membuktikan Kualitas produk Kami</h3>
                                                <p>
                                                    Tingkatkan Kepercayaan Anda: Dengarlah Suara Pelanggan Kami Melalui
                                                    Testimoni Mereka
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($faqs->count() > 0)
                            <div class="py-3 mb-5">
                                <div class="title-service">
                                    <h4 class="m-0">FAQ</h4>
                                    <div class="dash"></div>
                                </div>

                                <!-- Star Faq -->
                                <div class="faq-content-area">
                                    <div class="faq-items">
                                        <div class="row align-center">
                                            <div class="col-lg-12 ">
                                                <div class="faq-content wow fadeInUp">
                                                    <div class="accordion" id="accordionExample">
                                                        <div class="card">
                                                            @forelse ($faqs as $faq)
                                                                <div class="card-header" id="headingTwo">
                                                                    <h4 class="mb-0 collapsed" data-toggle="collapse"
                                                                        data-target="#collapseTwo" aria-expanded="false"
                                                                        aria-controls="collapseTwo">
                                                                        {{ $faq->question }}
                                                                    </h4>
                                                                </div>
                                                                <div id="collapseTwo" class="collapse"
                                                                    aria-labelledby="headingTwo"
                                                                    data-parent="#accordionExample">
                                                                    <div class="card-body">
                                                                        <p>
                                                                            {{ $faq->answer }}
                                                                        </p>
                                                                        <div class="ask-question">
                                                                            <span>Still no luck?</span> <a
                                                                                href="#">Ask a
                                                                                question</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <div class="col-12">
                                                                    <div class="d-flex justify-content-center">
                                                                        <img src="{{ asset('nodata-gif.gif') }}"
                                                                            alt="" width="500px">
                                                                    </div>
                                                                    <h4 class="text-center text-dark"
                                                                        style="font-weight:600">
                                                                        Belum ada FAQ
                                                                    </h4>
                                                                </div>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- End Faq -->
                            </div>
                        @endif
                        @if ($servicemitras->count() > 0)
                            <div class="py-2 mb-5">
                                <div class="title-service">
                                    <h4 class="m-0">Mitra Kami</h4>
                                    <div class="dash"></div>
                                    <div class="devider"></div>
                                    <div class="team-slider owl-carousel d-flex justify-content-center">
                                        @forelse ($servicemitras as $mitra)
                                            <div class="team-item mx-1 ">
                                                <img src="{{ asset('storage/' . $mitra->mitra->image) }}" alt="Mitra Image"
                                                    class="img-fluid">
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <div class="d-flex justify-content-center">
                                                    <img src="{{ asset('nodata-gif.gif') }}" alt=""
                                                        width="800px">
                                                </div>
                                                <h4 class="text-center text-dark" style="font-weight:600">
                                                    Belum ada Mitra
                                                </h4>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($procedures->count() > 0)
                            <div class="py-2 mb-5">
                                <div class="title-service">
                                    <h4 class="m-0">Prosedur</h4>
                                    <div class="dash"></div>

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="timeline-container">
                                                    <div class="timeline">
                                                        @foreach ($procedures as $procedure)
                                                            <div class="timeline-item">
                                                                <div class="timeline-number">
                                                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                                                </div>
                                                                <div class="timeline-item-content">
                                                                    <h2>{{ $procedure->title }} </h2>
                                                                    <p>{{ $procedure->description }}</p>
                                                                    <span
                                                                        class="timeline-item-date">{{ \carbon\Carbon::parse(now())->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                        <!-- Tambahkan lebih banyak event di sini -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
                                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


                                </div>

                            </div>
                        @endif

                        {{-- <div class="py-2 mb-5">
                            <div class="title-service">
                                <h4 class="m-0">Galeri Alumni</h4>
                                <div class="dash"></div>
                            </div>
                            <div class="galeri-alumni">
                                <div class="row">
                                    <div class="wow fadeInRight col-md-12 d-flex flex-wrap mb-4">
                                        <div class="col-md-6">
                                            <img src="{{ asset('assets-home/img/projects/1.jpg') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Angkatan 1903 - 1922</h3>
                                            <p>Lorem ipsum dolor sit amet consectetur. Tincidunt pellentesque pellentesque
                                                sed in. Sit nunc velit aliquam quis faucibus nibh nisl pellentesque. Massa
                                            </p>
                                            <a href="{{ url('alumni-detail') }}"
                                                class="btn btn-gradient effect btn-sm">Lihat Detail Alumni</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="galeri-alumni">
                                <div class="row">
                                    <div class="wow fadeInRight col-md-12 d-flex flex-wrap mb-4">
                                        <div class="col-md-6">
                                            <img src="{{ asset('assets-home/img/projects/1.jpg') }}">
                                        </div>
                                        <div class="col-md-6">
                                            <h3>Angkatan 1907 - 1978</h3>
                                            <p>Lorem ipsum dolor sit amet consectetur. Tincidunt pellentesque pellentesque
                                                sed in. Sit nunc velit aliquam quis faucibus nibh nisl pellentesque. Massa
                                            </p>
                                            <a href="{{ url('alumni-detail') }}"
                                                class="btn btn-gradient effect btn-sm">Lihat Detail Alumni</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        @if ($galeries)
                            <div class="py-2 mb-5">
                                <div class="title-service">
                                    <h4 class="m-0">Galeri</h4>
                                    <div class="dash"></div>
                                </div>
                                <div class="galeri">
                                    <div class="d-flex flex-wrap col-12">
                                        @forelse ($galeries as $galery)
                                            <img src="{{ asset('storage/'.$galery->image) }}"
                                                style="object-fit: cover; width: 18vw; height: 12vw" class="m-2">
                                        @empty
                                            <div class="col-12">
                                                <div class="d-flex justify-content-center">
                                                    <img src="{{ asset('nodata-gif.gif') }}" alt=""
                                                        width="800px">
                                                </div>
                                                <h4 class="text-center text-dark" style="font-weight:600">
                                                    Belum ada Galeri
                                                </h4>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-lg-4 services-sidebar">
                        <!-- Single Widget -->
                        <div class="single-widget services-list">
                            <h4 class="widget-title">Daftar Layanan</h4>
                            <div class="content">
                                <ul>
                                    @foreach ($services as $service)
                                        <li class=""><a
                                                class="{{ $service->slug == $slugs->slug ? 'active bg-primary text-light' : '' }}"href="/layanan/{{ $service->slug }}">{{ $service->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Widget -->
                        <div class="single-widget quick-contact text-light"
                            style="background-image: url({{ $service->image }});">
                            <div class="content">
                                <i class="fas fa-phone"></i>
                                <h4>Perlu bantuan?</h4>
                                <p>
                                    Kami di sini untuk membantu pelanggan kapan saja. Anda dapat menghubungi kami 24/7 untuk
                                    menjawab pertanyaan Anda. </p>
                                @if ($profile)
                                    <h2>{{ $profile->phone }}</h2>
                                @endif
                            </div>
                        </div>
                        @foreach ($services->where('slug', $slugs->slug) as $service)
                            @if ($service->proposal)
                                <div class="single-widget brochure">
                                    <h4 class="widget-title">Proposal</h4>
                                    <ul>
                                        <li><a href="{{ asset('storage/' . $service->proposal) }}"
                                                download="{{ asset('storage/' . $service->proposal) }}"><i
                                                    class="fas fa-file-pdf"></i>Unduh Proposal</a></li>
                                    </ul>
                                </div>
                            @endif
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(".team-slider").owlCarousel({
                items: 1,
                loop: $(".team-slider .owl-item").length > 1,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 5
                    }
                }
            });
        });
    </script>
@endsection
