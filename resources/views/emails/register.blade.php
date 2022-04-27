
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
</head>
<body>
    <table>
        <tr>
            <td>Dear: {{$name}}</td>
        </tr>
        <tr>
            <td>Welcome in Shopping Mart. Please click on the link given below to activate your account.</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Name: {{ $name }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Mobile: {{$mobile}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Email: {{ $email }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Password: ****** (as choose by you.)</td>
        </tr>
        <tr>
            <td>Thanks & Regard.</td>
        </tr>
        <tr>
            <td>
                Shopping Mart Ecommerce Store.
            </td>
        </tr>
    </table>
</body>
</html>