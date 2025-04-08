{{-- filepath: e:\xampp\htdocs\AyamGoreng\resources\views\chat.blade.php --}}
@extends('layouts.app')

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
            <div class="chat-messages" id="chatMessages">
                <div class="chat-message bot">
                    <div class="message-content">Selamat datang! Ada yang bisa saya bantu?</div>
                </div>
            </div>

            <!-- Chat Input -->
            <div class="chat-input">
                <textarea id="chatInput" class="form-control" rows="1" placeholder="Ketik pesan..."></textarea>
                <button id="sendButton" class="btn">Kirim</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatMessages = document.getElementById('chatMessages');
            const chatInput = document.getElementById('chatInput');
            const sendButton = document.getElementById('sendButton');

            // Predefined responses
            const responses = {
                "hai": "Hai! Selamat datang di restoran kami. Ada yang bisa saya bantu?",
                "menu ayam goreng": "Kami memiliki berbagai pilihan ayam goreng seperti Ayam Goreng Klasik, Ayam Pop Corn, dan Ayam Katsu.",
                "menu": "Kami memiliki berbagai pilihan ayam goreng seperti Ayam Goreng Klasik, Ayam Pop Corn, dan Ayam Katsu.",
                "harga ayam goreng": "Harga ayam goreng kami mulai dari Rp20.000 hingga Rp25.000.",
                "harga": "Harga ayam goreng kami mulai dari Rp20.000 hingga Rp25.000.",
                "alamat restoran": "Restoran kami berlokasi di Jl. Ayam Goreng No. 123, Jakarta.",
                "jam buka": "Kami buka setiap hari dari pukul 10:00 hingga 22:00.",
                "terima kasih": "Sama-sama! Jika ada pertanyaan lain, jangan ragu untuk bertanya.",
                "terimakasih": "Sama-sama! Jika ada pertanyaan lain, jangan ragu untuk bertanya."
            };

            // Function to add a message to the chat
            function addMessage(content, sender = 'user') {
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('chat-message', sender);

                const messageContent = document.createElement('div');
                messageContent.classList.add('message-content');
                messageContent.textContent = content;

                messageDiv.appendChild(messageContent);
                chatMessages.appendChild(messageDiv);

                // Scroll to the bottom of the chat
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // Handle sending a message
            sendButton.addEventListener('click', function() {
                const userMessage = chatInput.value.trim();
                if (userMessage === '') return;

                // Add user message to chat
                addMessage(userMessage, 'user');

                // Clear input
                chatInput.value = '';

                // Check for predefined response
                const botResponse = responses[userMessage.toLowerCase()] ||
                    "Maaf, saya tidak mengerti pertanyaan Anda.";
                setTimeout(() => addMessage(botResponse, 'bot'), 500);
            });

            // Allow pressing Enter to send a message
            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    sendButton.click();
                }
            });
        });
    </script>
@endsection
