<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lix Form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, rgb(218, 174, 231), rgb(121, 107, 126));

            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background: rgba(230, 220, 247, 0.78);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        .center-box {
            margin: auto;
        }

        h2 {
            color: #333333;
        }

        p {
            color: #666666;
            margin-bottom: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
            
            
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333333;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: rgba(117, 42, 122, 0.79);
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgb(153,50,204);
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="center-box">
            <h2>Setting up Lix Account</h2>
            <p>Follow this <a href="https://lix-it.com/register?currency=usd" target='_blank'>link</a> for setting up Lix account and authenticating it with Lix.</p>

            <form action="{{ route('submitLixForm') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="lixApiKey">Lix API Key:</label>
                    <input type="text" name="lixApiKey" id="lixApiKey" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="linkedinViewerId">LinkedIn Viewer ID:</label><text>(extracted from profile url)</text>
                    <input type="text" name="linkedinViewerId" id="linkedinViewerId" class="form-control" required  placeholder="e.g : abc-xyz-12345678">
                </div>

                <button type="submit">Done</button>
            </form>
        </div>
    </div>
</body>
</html>
