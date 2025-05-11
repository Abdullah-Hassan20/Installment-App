<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Insaaf Traders</title>
  <style>
    body {
      background-color: black;
      color: white;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #e74c3c;
      border-bottom-left-radius: 20px;
      border-bottom-right-radius: 20px;
      padding: 20px;
      text-align: center;
    }

    header h1 {
      margin: 0;
      font-size: 36px;
    }

    header small {
      display: block;
      margin-top: 5px;
      font-size: 14px;
      color: #f9f9f9;
    }

    .nav {
        text-align: center;
        background-color: #111;
        padding: 15px 0;
    }

    .nav a {
        margin: 0 20px;
        text-decoration: none;
        color: #e74c3c;
        font-weight: bold;
        font-size: 16px;
    }

    .nav a:hover {
        text-decoration: underline;
    }

    .container2 {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 100px;
      flex-wrap: wrap;
      margin-top: 40px;
    }

    .card {
      background-color: #e74c3c;
      border-radius: 20px;
      width: 170px;
      height: 230px;
      text-align: center;
      padding: 10px;
      box-shadow: 0 0 10px #000;
    }

    .card img {
      width: 100px;
      height: 110px;
      border-radius: 20px;
      margin-bottom: 10px;
    }

    .card h3 {
      margin: 5px 0;
      font-size: 18px;
    }

    .card p {
      margin: 0;
      font-size: 14px;
    }

    footer {
      margin-top: 60px;
      padding-bottom: 30px;
    }

    .footer-links {
      text-align: center;
      margin-top: 20px;
    }

    .footer-links a {
      text-decoration: none;
      color: white;
      font-size: 18px;
      font-weight: bold;
      margin: 0 20px;
      padding: 10px;
      background-color: #e74c3c;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .footer-links a:hover {
      background-color: #c0392b;
    }

    @media (max-width: 600px) {
      .container2 {
        flex-direction: column;
        gap: 30px;
      }

      .footer-links {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>
</head>
<body>

  <header>
    <h1>Insaaf Traders</h1>
    <small>Where you get everything on easy installment plans</small>
  </header>

  <div class="nav">
    <a href="add.php">Add Record</a>
    <a href="record.php">Search Record</a>
    <a href="all.php">All Records</a>
  </div>

  <main>
    <div class="container2">
      <div class="card">
        <img src="WhatsApp Image 2025-05-11 at 03.57.19_31701b08.jpg" alt="">
        <h3>Hafiz Abdul Rauf</h3>
        <p>03216037020</p>
      </div>
      <div class="card">
        <img src="WhatsApp Image 2025-05-11 at 03.45.40_066ca4a9.jpg" alt="">
        <h3>Abdullah Hassan</h3>
        <p>03020663387</p>
      </div>
      <div class="card">
        <img src="WhatsApp Image 2025-05-11 at 03.45.40_f0e95beb.jpg" alt="">
        <h3>Ahmad Hassan</h3>
        <p>09876543212</p>
      </div>
    </div>
  </main>

</body>
</html>

