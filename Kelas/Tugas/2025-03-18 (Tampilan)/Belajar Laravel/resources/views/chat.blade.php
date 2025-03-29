@extends('layouts.app1')

@section('head_extras')
    <style>
        .chat-section {
            padding: 60px 0;
        }

        .chat-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .chat-header {
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }

        .chat-messages {
            height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background-color: #fff;
            margin-bottom: 20px;
        }

        .chat-message {
            margin-bottom: 10px;
        }

        .chat-message.user {
            text-align: right;
        }

        .chat-message .message-content {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 70%;
        }

        .chat-message.user .message-content {
            background-color: var(--secondary-color);
            color: white;
        }

        .chat-message.bot .message-content {
            background-color: #e9ecef;
            color: #333;
        }

        .chat-input {
            display: flex;
            gap: 10px;
        }

        .chat-input textarea {
            flex: 1;
            border-radius: 5px;
            resize: none;
        }

        .chat-input button {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            border-radius: 5px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .chat-input button:hover {
            background-color: #45b7aa;
        }
    </style>
@endsection

@section('content')
    <div class="chat-section">
        <div class="chat-container">
            <div class="chat-header">Live Chat</div>

            <!-- Chat Messages -->
            <div class="chat-messages">
                <!-- Example Messages -->
                <div class="chat-message bot">
                    <div class="message-content">Selamat datang! Ada yang bisa saya bantu?</div>
                </div>
                <div class="chat-message user">
                    <div class="message-content">Halo, saya ingin bertanya tentang menu ayam goreng.</div>
                </div>
                <div class="chat-message bot">
                    <div class="message-content">Tentu! Kami memiliki berbagai pilihan ayam goreng. Apa yang ingin Anda
                        ketahui?</div>
                </div>
            </div>

            <!-- Chat Input -->
            <div class="chat-input">
                <textarea class="form-control" rows="1" placeholder="Ketik pesan..."></textarea>
                <button class="btn">Kirim</button>
            </div>
        </div>
    </div>
@endsection
