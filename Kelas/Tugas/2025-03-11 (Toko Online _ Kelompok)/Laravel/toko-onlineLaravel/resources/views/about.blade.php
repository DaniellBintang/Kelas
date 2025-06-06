{{-- resources/views/about.blade.php --}}

@extends('layouts.app')

@section('title', 'About Us - Guitar Shop')

@section('styles')
    <style>
        .about-header {
            background-color: #f8f9fa;
            padding: 100px 0 50px 0;
            text-align: center;
        }

        .mission-vision {
            padding: 60px 0;
        }

        .value-card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100%;
            transition: transform 0.3s ease;
            background-color: #ffffff;
        }

        .value-card:hover {
            transform: translateY(-5px);
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .icon-circle i {
            font-size: 30px;
            color: var(--primary-color);
        }

        .section-title {
            position: relative;
            margin-bottom: 40px;
            padding-bottom: 20px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .mission-section,
        .vision-section {
            padding: 40px 0;
        }

        .values-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        /* Team Section Styles */
        .team-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-5px);
        }

        .team-card img {
            height: 250px;
            object-fit: cover;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background-color: #f8f9fa;
            border-radius: 50%;
            color: #333;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }

        /* Timeline Styles */
        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 0;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 4px;
            background-color: var(--primary-color);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
        }

        .timeline-item {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            box-sizing: border-box;
        }

        .timeline-item:nth-child(odd) {
            left: 0;
            text-align: right;
        }

        .timeline-item:nth-child(even) {
            left: 50%;
        }

        .timeline-content {
            padding: 20px;
            background-color: white;
            border-radius: 6px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: white;
            border: 4px solid var(--primary-color);
            border-radius: 50%;
            top: 30px;
            right: -13px;
            z-index: 1;
        }

        .timeline-item:nth-child(even)::after {
            left: -13px;
        }

        @media screen and (max-width: 767px) {
            .timeline::after {
                left: 31px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }

            .timeline-item:nth-child(odd) {
                text-align: left;
            }

            .timeline-item:nth-child(even) {
                left: 0%;
            }

            .timeline-item::after {
                left: 18px;
                right: auto;
            }
        }
    </style>
@endsection

@section('content')
    <!-- About Header -->
    <div class="about-header">
        <div class="container">
            <h1 class="display-4 mb-4">About Guitar Shop</h1>
            <p class="lead">Bringing the joy of music to everyone through quality instruments</p>
        </div>
    </div>

    <!-- Mission Section -->
    <section class="mission-section">
        <div class="container">
            <h2 class="section-title text-center">Our Mission</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('images/vision.png') }}" alt="Mission Image" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <p class="lead">To provide musicians of all levels with high-quality instruments and exceptional
                        service, fostering a community where music thrives and creativity knows no bounds.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i> Quality instruments for every budget</li>
                        <li><i class="fas fa-check text-success me-2"></i> Expert guidance and support</li>
                        <li><i class="fas fa-check text-success me-2"></i> Building musical communities</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="vision-section bg-light">
        <div class="container">
            <h2 class="section-title text-center">Our Vision</h2>
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2">
                    <img src="{{ asset('images/mission.png') }}" alt="Vision Image" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <p class="lead">To be the leading guitar shop that inspires and enables musical excellence, making
                        quality instruments accessible to all passionate musicians.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-star text-warning me-2"></i> Industry leadership in quality</li>
                        <li><i class="fas fa-star text-warning me-2"></i> Innovation in musical retail</li>
                        <li><i class="fas fa-star text-warning me-2"></i> Global reach with local touch</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <h2 class="section-title text-center">Our Values</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="value-card text-center">
                        <div class="icon-circle">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Passion</h3>
                        <p>We are passionate about music and committed to sharing that passion with our customers through
                            exceptional service and quality products.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card text-center">
                        <div class="icon-circle">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3>Integrity</h3>
                        <p>We conduct our business with honesty, transparency, and always put our customers' best interests
                            first.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-card text-center">
                        <div class="icon-circle">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Excellence</h3>
                        <p>We strive for excellence in everything we do, from product quality to customer service and
                            beyond.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section (Optional Addition) -->
    <section class="team-section py-5">
        <div class="container">
            <h2 class="section-title text-center">Meet Our Team</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card team-card h-100">
                        <img src="{{ asset('images/team-1.png') }}" class="card-img-top" alt="Team Member">
                        <div class="card-body text-center">
                            <h5 class="card-title">John Doe</h5>
                            <p class="text-muted">Founder & CEO</p>
                            <p class="card-text">Guitar enthusiast with over 20 years of experience in the music industry.
                            </p>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-linkedin"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card team-card h-100">
                        <img src="{{ asset('images/team-2.png') }}" class="card-img-top" alt="Team Member">
                        <div class="card-body text-center">
                            <h5 class="card-title">Jane Smith</h5>
                            <p class="text-muted">Master Luthier</p>
                            <p class="card-text">Crafts and repairs our finest instruments with unparalleled precision and
                                care.</p>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-linkedin"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card team-card h-100">
                        <img src="{{ asset('images/team-3.png') }}" class="card-img-top" alt="Team Member">
                        <div class="card-body text-center">
                            <h5 class="card-title">Mark Johnson</h5>
                            <p class="text-muted">Customer Experience Manager</p>
                            <p class="card-text">Dedicated to ensuring every customer finds their perfect musical match.</p>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-linkedin"></i></a>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- History Timeline (Optional Addition) -->
    <section class="history-section py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center">Our Journey</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>2005</h4>
                        <p>Founded as a small repair shop in a garage with a passion for quality craftsmanship.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>2010</h4>
                        <p>Opened our first retail location and expanded our inventory to include premium brands.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>2015</h4>
                        <p>Launched our online store to reach guitar enthusiasts around the world.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>2020</h4>
                        <p>Established our Guitar Academy to share our knowledge and inspire the next generation of
                            musicians.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-content">
                        <h4>Today</h4>
                        <p>Continuing to grow while maintaining our commitment to quality and customer satisfaction.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        // Add any page-specific JavaScript here
        document.addEventListener('DOMContentLoaded', function() {
            // Animation for value cards
            const valueCards = document.querySelectorAll('.value-card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });

            valueCards.forEach(card => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
@endsection
