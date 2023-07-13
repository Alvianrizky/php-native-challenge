<?php
include 'connect.php';
$conn = new connect();

// unset($_SESSION['account'][0]['history']);
// $_SESSION['account'][0]['balance'] = 0;
// echo "<pre>";
// print_r($conn->listAcoount());
// print_r($_SESSION);

if (!$conn->checkToken()) {
    $conn->redirectLogin();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">

        <div class="float-right">
            <form action="action.php?aksi=logout" method="post">
                <input type="submit" value="Logout" class="button">
            </form>
        </div>
        <h1>Hi, <?php echo $conn->getNameAccount(); ?></h1>
        <h2>Balance : <?php echo $conn->balance(); ?></h2>
        <div class="bg">
            <div>
                <button class="button" onclick="openTab('debit_credit')">Deposit / Withdraw</button>
                <button class="button" onclick="openTab('transfer')">Transfer</button>
            </div>
            <div id="debit_credit" class="tab">
                <form action="action.php?aksi=transaction" method="post">
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

            <div id="transfer" class="tab" style="display:none">
                <form action="action.php?aksi=transfer" method="post">
                    <label for="action">Transfer To</label>
                    <select name="action" id="action" class="input" required>
                        <option value="">--- Select Action ---</option>
                        <?php foreach ($conn->listAcoount() as $key => $value) : ?>
                            <option value="<?php echo $key; ?>"><?php echo $value['username']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="value">Value</label>
                    <input type="number" id="value" name="value" class="input" placeholder="Input value" required>

                    <input type="submit" value="Submit" class="button">
                </form>
            </div>

        </div>

        <?php if ($conn->getHistory()) : ?>
            <table class="table">
                <tr>
                    <th>Time</th>
                    <th>Type</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                    <th>Desc</th>
                </tr>
                <?php foreach ($conn->getHistory() as $value) : ?>
                    <tr>
                        <td><?php echo $value['time']; ?></td>
                        <td><?php echo $value['type']; ?></td>
                        <td><?php echo $value['debit'] == 0 ? '' : $value['debit']; ?></td>
                        <td><?php echo $value['credit'] == 0 ? '' : $value['credit']; ?></td>
                        <td><?php echo $value['balance']; ?></td>
                        <td><?php echo $value['desc']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>

    <script>
        function openTab(cityName) {
            var i;
            var x = document.getElementsByClassName("tab");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(cityName).style.display = "block";
        }
    </script>
</body>

</html>