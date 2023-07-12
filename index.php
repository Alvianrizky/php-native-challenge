<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .input {
            width: 100%;
            padding: 6px 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .bg {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .button {
            /* width: 100%; */
            background-color: #435EBE;
            color: white;
            padding: 8px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #3a4f99;
        }

        .container {
            margin: 20px 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Balance : 0</h2>
        <div class="bg">
            <form action="/action_page.php">
                <label for="action">Action</label>
                <select name="action" id="action" class="input">
                    <option>--- Select Action ---</option>
                    <option value="Deposit">Deposit</option>
                    <option value="Withdraw">Withdraw</option>
                </select>

                <label for="value">Value</label>
                <input type="text" id="value" name="value" class="input" placeholder="Input value">

                <input type="submit" value="Submit" class="button">
            </form>

        </div>
    </div>
</body>

</html>