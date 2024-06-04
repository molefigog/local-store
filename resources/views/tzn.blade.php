<!DOCTYPE html>
<html>
<head>
    <title>Mpesa Payment</title>
</head>
<body>
    <h1>Make a Payment</h1>
    <form action="{{ url('/api/mpesa/payment') }}" method="POST">
        @csrf <!-- Laravel CSRF protection -->
        <div>
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" value="1000" required>
        </div>
        <div>
            <label for="msisdn">MSISDN:</label>
            <input type="text" id="msisdn" name="msisdn" value="000000000001" required>
        </div>
        <div>
            <label for="transactionid">Transaction ID:</label>
            <input type="text" id="transactionid" name="transactionid" value="1234567890" required>
        </div>
        <div>
            <label for="thirdpartyconversationID">Third Party Conversation ID:</label>
            <input type="text" id="thirdpartyconversationID" name="thirdpartyconversationID" value="abc123" required>
        </div>
        <div>
            <label for="transactionDescription">Transaction Description:</label>
            <input type="text" id="transactionDescription" name="transactionDescription" value="Payment for services" required>
        </div>
        <div>
            <button type="submit">Make Payment</button>
        </div>
    </form>
</body>
</html>
