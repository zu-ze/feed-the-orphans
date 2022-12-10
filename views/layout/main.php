<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/tailwind.output.css">
    <style>
        .lame {
            background-image: url('/images/background_dot.png');
            background-repeat: repeat;
            width: 100%;
            height: 96vh;
        }
        .container {
            margin: 2rem auto;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class="lame">
        {{content}}
    </div>
</body>
</html>