<?php
include 'connect.php';
$conn = new connect();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

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

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table td,
        .table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #ddd;
        }

        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #435EBE;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Balance : <?php echo $conn->balance(); ?></h2>
        <div class="bg">
            <form action="action.php" method="post">
                <label for="action">Action</label>
                <select name="action" id="action" class="input" required>
                    <option value="">--- Select Action ---</option>
                    <option value="Deposit">Deposit</option>
                    <option value="Withdraw">Withdraw</option>
                </select>

                <label for="value">Value</label>
                <input type="number" id="value" name="value" class="input" placeholder="Input value" required>

                <input type="submit" value="Submit" class="button">
            </form>

        </div>

        <?php if ($conn->getHistory()) : ?>
            <table class="table">
                <tr>
                    <th>Time</th>
                    <th>Type</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                </tr>
                <?php foreach ($conn->getHistory() as $value) : ?>
                    <tr>
                        <td><?php echo $value['time']; ?></td>
                        <td><?php echo $value['type']; ?></td>
                        <td><?php echo $value['debit'] == 0 ? '' : $value['debit']; ?></td>
                        <td><?php echo $value['credit'] == 0 ? '' : $value['credit']; ?></td>
                        <td><?php echo $value['balance']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>