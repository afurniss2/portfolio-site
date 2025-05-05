<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
  header("Location: login.php");
  exit;
}

$conn = new mysqli("localhost", "root", "root", "assignmentdb");
if ($conn->connect_error) {
  die("DB connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM messages ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin - Messages</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .admin-container {
      max-width: 1000px;
      margin: 2rem auto;
      padding: 2rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 0.75rem;
      text-align: left;
    }

    th {
      background-color: #0077cc;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .logout-button {
      display: inline-block;
      background-color: #333;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      text-decoration: none;
      float: right;
      margin-top: 1rem;
    }

    .logout-button:hover {
      background-color: #555;
    }
  </style>
</head>
<body>
  <div class="admin-container">
    <h1>Submitted Contact Messages</h1>
    <a href="logout.php" class="logout-button">Logout</a>
    <table>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Submitted At</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td>
          <a href="mailto:<?= htmlspecialchars($row['email']) ?>">
            <?= htmlspecialchars($row['email']) ?>
          </a>
          </td>
          <td><?= nl2br(htmlspecialchars($row['content'])) ?></td>
          <td><?= $row['submitted_at'] ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>
</body>
</html>

