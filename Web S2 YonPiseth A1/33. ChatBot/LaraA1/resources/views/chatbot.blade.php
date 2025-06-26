<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gemini Chatbot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        .chat-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .chat-header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            text-align: center;
            font-size: 1.2em;
        }
        .chat-box {
            flex-grow: 1;
            padding: 15px;
            overflow-y: auto;
            max-height: 400px;
            border-bottom: 1px solid #eee;
        }
        .message {
            margin-bottom: 10px;
            padding: 8px 12px;
            border-radius: 5px;
            max-width: 80%;
        }
        .message.user {
            background-color: #dcf8c6;
            align-self: flex-end;
            margin-left: auto;
        }
        .message.bot {
            background-color: #e0e0e0;
            align-self: flex-start;
            margin-right: auto;
        }
        .chat-input {
            display: flex;
            padding: 15px;
            border-top: 1px solid #eee;
        }
        .chat-input input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }
        .chat-input button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            Gemini Chatbot
        </div>
        <div class="chat-box" id="chat-box">
            <!-- Chat messages will appear here -->
        </div>
        <div class="chat-input">
            <input type="text" id="user-message" placeholder="Type your message...">
            <button id="send-button">Send</button>
        </div>
    </div>

    <script>
        document.getElementById('send-button').addEventListener('click', sendMessage);
        document.getElementById('user-message').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        function sendMessage() {
            const userMessage = document.getElementById('user-message').value;
            if (userMessage.trim() === '') return;

            appendMessage(userMessage, 'user');
            document.getElementById('user-message').value = '';

            fetch('/chatbot/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: userMessage })
            })
            .then(response => response.json())
            .then(data => {
                if (data.reply) {
                    appendMessage(data.reply, 'bot');
                } else if (data.error) {
                    appendMessage('Error: ' + data.error, 'bot');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                appendMessage('Error communicating with the server.', 'bot');
            });
        }

        function appendMessage(message, sender) {
            const chatBox = document.getElementById('chat-box');
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', sender);
            messageElement.textContent = message;
            chatBox.appendChild(messageElement);
            chatBox.scrollTop = chatBox.scrollHeight; // Scroll to the bottom
        }
    </script>
</body>
</html>
