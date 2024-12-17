<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Sistem Informasi Kedai Kopi</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-box {
            width: 400px;
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 1.8em;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .inputbox {
            position: relative;
            margin-bottom: 20px;
        }

        .inputbox label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            font-size: 1em;
            color: #777;
            pointer-events: none;
            transition: 0.5s;
        }

        .inputbox input:focus~label,
        .inputbox input:valid~label {
            top: -10px;
            font-size: 0.8em;
            color: #2575fc;
        }

        .inputbox input {
            width: 100%;
            height: 50px;
            background: #f7f7f7;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            padding: 0 15px;
            font-size: 1em;
            transition: 0.3s;
        }

        .inputbox input:focus {
            border-color: #2575fc;
        }

        .inputbox ion-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
        }

        .dropdownbox {
            margin-bottom: 20px;
        }

        .dropdownbox select {
            width: 100%;
            height: 50px;
            background: #f7f7f7;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 0 15px;
            font-size: 1em;
            color: #333;
            outline: none;
            transition: 0.3s;
        }

        .dropdownbox select:focus {
            border-color: #2575fc;
        }

        button {
            width: 100%;
            height: 50px;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
        }

        .register {
            font-size: 0.9em;
            color: #666;
            text-align: center;
            margin-top: 20px;
        }

        .register p a {
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
        }

        .register p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="form-box">
        <form>
            <h2>Login</h2>
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="email" required>
                <label>Email</label>
            </div>
            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" required>
                <label>Password</label>
            </div>
            <div class="dropdownbox">
                <select required>
                    <option value="" disabled selected>Pilih Level Pengguna</option>
                    <option value="admin">Admin</option>
                    <option value="karyawan">Karyawan</option>
                </select>
            </div>
            <button type="submit">Log In</button>
            <div class="register">
                <p>Belum punya akun? <a href="#">Daftar di sini</a></p>
            </div>
        </form>
    </div>
</body>

</html>
