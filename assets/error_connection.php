<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection Lost | CTECH DocuTrack</title>

    <link rel="stylesheet" href="/CTECH%20DocuTrack/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/CTECH%20DocuTrack/node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/CTECH%20DocuTrack/node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            font-family: Arial, sans-serif;
        }

        .connection-card {
            max-width: 460px;
            width: 92%;
            padding: 40px 30px;
            text-align: center;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .connection-icon {
            width: 95px;
            height: 95px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff0f0;
            color: #dc3545;
            border-radius: 50%;
            font-size: 42px;
            animation: pulse 1.8s infinite;
        }

        .connection-line {
            width: 55px;
            height: 4px;
            margin: 20px auto;
            background: #dc3545;
            border-radius: 10px;
            animation: loading 1.5s infinite ease-in-out;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.2);
            }
            50% {
                transform: scale(1.06);
                box-shadow: 0 0 0 12px rgba(220, 53, 69, 0);
            }
        }

        @keyframes loading {
            0% { transform: scaleX(0.4); opacity: 0.5; }
            50% { transform: scaleX(1.2); opacity: 1; }
            100% { transform: scaleX(0.4); opacity: 0.5; }
        }
    </style>
</head>

<body>
    <div class="connection-card">
        <div class="connection-icon">
            <i class="bi bi-wifi-off"></i>
            &#9888;
        </div>

        <h3 class="fw-bold text-danger mb-2">Connection Lost</h3>

        <p class="text-secondary mb-0">
            Unable to connect to the database.
            Your documents may be temporarily unavailable.
        </p>

        <div class="connection-line"></div>

        <p class="small text-secondary mb-4">
            Please check your internet connection and try again.
        </p>

        <button class="btn btn-danger px-4 py-2"
                onclick="location.reload()">
            &#8635; Try Again
        </button>

        <div class="mt-4 small text-secondary">
            CTECH DocuTrack
        </div>
    </div>
</body>
</html>