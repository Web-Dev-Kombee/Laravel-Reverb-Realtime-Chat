<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            max-width: 500px;
            width: 100%;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .card-header {
            background: linear-gradient(135deg, #6e8efb, #4a6cf7);
            color: white;
            padding: 20px;
            font-weight: 500;
            font-size: 1.25rem;
            text-align: center;
            border-bottom: none;
        }

        .card-body {
            padding: 30px;
            background-color: #ffffff;
        }

        .form-group label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 25px;
            padding: 12px 20px;
            height: auto;
            border: 1px solid #e1e1e1;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4a6cf7;
            box-shadow: 0 0 0 0.2rem rgba(74, 108, 247, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #6e8efb, #4a6cf7);
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 500;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 10px rgba(74, 108, 247, 0.3);
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 108, 247, 0.4);
            background: linear-gradient(135deg, #5d7ff9, #3a5ce6);
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(74, 108, 247, 0.4);
        }

        .chat-icon {
            text-align: center;
            margin-bottom: 20px;
        }

        .chat-icon i {
            font-size: 48px;
            color: #4a6cf7;
            background: #f1f5ff;
            width: 90px;
            height: 90px;
            line-height: 90px;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <div class="card">
                        <div class="card-header">Welcome to Chat</div>
                        <div class="card-body">
                            <div class="chat-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <form action="{{ route('chatroom') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                        placeholder="Enter your name to join" required>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Join Chat Room
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>