@extends('layouts.app1')

@section('head_extras')
    <style>
        .contact-section {
            padding: 60px 0;
        }

        .contact-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
        }

        .contact-info {
            text-align: center;
            margin-bottom: 40px;
        }

        .contact-info p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .contact-form .form-control {
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .contact-form .btn-submit {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .contact-form .btn-submit:hover {
            background-color: #45b7aa;
        }

        .map-container {
            margin-top: 40px;
            text-align: center;
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 10px;
        }

        .social-icons {
            margin-top: 40px;
            text-align: center;
        }

        .social-icons a {
            color: var(--secondary-color);
            margin: 0 10px;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            color: #45b7aa;
        }
    </style>
@endsection

@section('content')
    <div class="contact-section">
        <h1>Contact Us</h1>

        <!-- Contact Info -->
        <div class="contact-info">
            <p><strong>Email:</strong> info@ayamgorengjos.com</p>
            <p><strong>Telepon:</strong> (021) 123-4567</p>
            <p><strong>Alamat:</strong> Jl. Ayam Goreng No. 123, Jakarta</p>
        </div>

        <!-- Contact Form -->
        <div class="contact-form">
            <form action="{{ url('/send-message') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn btn-submit">Send Message</button>
            </form>
        </div>

        <!-- Google Maps -->
        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.920123456789!2d106.827153!3d-6.175110!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e4b5b5b5b5%3A0x123456789abcdef!2sJl.%20Ayam%20Goreng%20No.%20123%2C%20Jakarta!5e0!3m2!1sen!2sid!4v1612345678901!5m2!1sen!2sid"
                allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
@endsection
