@vite('resources/js/app.js')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
        }

        .chat-container {
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        .chat-header {
            background: linear-gradient(135deg, #6e8efb, #4a6cf7);
            color: white;
            padding: 15px 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            color: #4a6cf7;
            font-weight: bold;
        }

        .chat-box {
            height: 500px;
            overflow-y: auto;
            padding: 20px;
            background-color: #ffffff;
        }

        .chat-message {
            margin-bottom: 15px;
            max-width: 80%;
            position: relative;
            clear: both;
        }

        .chat-message.sender {
            float: right;
            background-color: #4a6cf7;
            color: white;
            border-radius: 18px 18px 0 18px;
            padding: 12px 16px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .chat-message.sender strong {
            display: none;
        }

        .chat-message.receiver {
            float: left;
            background-color: #f1f2f6;
            color: #333;
            border-radius: 18px 18px 18px 0;
            padding: 12px 16px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .chat-message.receiver strong {
            display: block;
            color: #4a6cf7;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 14px;
        }

        .message-time {
            font-size: 11px;
            opacity: 0.7;
            margin-top: 5px;
            text-align: right;
        }

        .input-area {
            background-color: #ffffff;
            padding: 15px;
            border-top: 1px solid #e9e9e9;
        }

        .message-input {
            border-radius: 25px;
            padding: 10px 20px;
            border: 1px solid #e1e1e1;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .message-input:focus {
            border-color: #4a6cf7;
            box-shadow: 0 0 0 0.2rem rgba(74, 108, 247, 0.25);
        }

        .send-btn {
            border-radius: 50%;
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6e8efb, #4a6cf7);
            border: none;
            box-shadow: 0 2px 10px rgba(74, 108, 247, 0.3);
            margin-left: 10px;
        }

        .send-btn:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #5d7ff9, #3a5ce6);
        }

        .send-btn:focus {
            box-shadow: 0 0 0 0.2rem rgba(74, 108, 247, 0.4);
        }

        /* Clear fix for floating messages */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Scrollbar styling */
        .chat-box::-webkit-scrollbar {
            width: 6px;
        }

        .chat-box::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .chat-box::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        .chat-box::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="chat-container">
            <div class="chat-header">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ substr($username, 0, 1) }}
                    </div>
                    <div>Welcome, <b>{{ $username }}</b></div>
                </div>
                <div>
                    <i class="fas fa-ellipsis-v"></i>
                </div>
            </div>
            <div class="chat-box" id="messages">
                <!-- Messages will be appended here -->
            </div>
            <div class="input-area">
                <div class="input-group">
                    <input type="text" class="form-control message-input" placeholder="Type your message here..."
                        id="messageInput">
                    <div class="input-group-append">
                        <button class="btn send-btn" type="button" onclick="SendMsg()">
                            <i class="fas fa-paper-plane text-white"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        function SendMsg() {
            sender = "{{ $username }}"
            csrfToken = "{{ csrf_token() }}"
            message = messageInput.value
            
            if (message.trim() === '') return;
            
            $.ajax({
                url: "{{ route('sent.message') }}",
                type: "POST",
                data: {
                    sender: sender,
                    message: message,
                    _token: csrfToken
                },
                success: function(response) {
                    const time = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    $("#messages").append(`
                        <div class="chat-message sender clearfix">
                            <strong>You:</strong> ${response.message}
                            <div class="message-time">${time}</div>
                        </div>
                    `)
                    messageInput.value = ''
                    scrollToBottom();
                },
                error: function(response) {
                    console.error("Error sending message", response);
                }
            })
        }
        
        // Handle Enter key press
        document.getElementById('messageInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                SendMsg();
            }
        });

        function scrollToBottom() {
            const chatBox = document.getElementById('messages');
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        window.onload = () => {
            window.Echo.channel('user-message').listen('MessagetSent', function(data) {
                if (data.sender != "{{ $username }}") {
                    const time = new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                    $("#messages").append(`
                        <div class="chat-message receiver clearfix">
                            <strong>${data.sender}</strong> ${data.message}
                            <div class="message-time">${time}</div>
                        </div>
                    `)
                    scrollToBottom();
                }
            })
        }
    </script>
</body>

</html>