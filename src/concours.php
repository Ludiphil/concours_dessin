<?php
// start the session
session_start();

// Include the database connection file
include 'db_connect.php';

// Test the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the SQL query for current contest
$sql_current = "SELECT * FROM Concours WHERE dateDebut <= CURDATE() AND dateFin >= CURDATE() LIMIT 1";
$result_current = $conn->query($sql_current);

// Create the SQL query for upcoming contest
$sql_upcoming = "SELECT * FROM Concours WHERE dateDebut > CURDATE() ORDER BY dateDebut ASC LIMIT 1";
$result_upcoming = $conn->query($sql_upcoming);

// Create the SQL query for finished contests
$sql_finished = "SELECT * FROM Concours WHERE dateFin < CURDATE()";
$result_finished = $conn->query($sql_finished);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head elements here -->
</head>
<body>
    <!-- Other HTML elements here -->

    <!-- Start of the table for current contest -->
    <div class="bg-white p-10 rounded-lg shadow-lg m-4">
        <h1 class="text-5xl text-white text-center stroke-text">Concours en cours</h1>
        <?php
        if ($result_current->num_rows > 0) {
            // Output data of each row
            while($row = $result_current->fetch_assoc()) {
                echo "<h2 class='text-4xl text-pink-400 mb-4'>" . $row["theme"] . "</h2>";
                // ...
                echo "<h3 class='text-3xl text-pink-400 mb-2'>Date de début : " . $row["dateDebut"] . "</h3>";
                echo "<h3 class='text-3xl text-pink-400 mb-4'>Date de fin : " . $row["dateFin"] . "</h3>";
                // ...
            }
        } else {
            echo "<p>No current contest</p>";
        }
        ?>
    </div>
        <!-- Start of the table for upcoming contest -->
        <div class="bg-white p-10 rounded-lg shadow-lg m-4">
        <h1 class="text-5xl text-white text-center stroke-text">Prochain concours</h1>
        <?php
        if ($result_upcoming->num_rows > 0) {
            // Output data of each row
            while($row = $result_upcoming->fetch_assoc()) {
                echo "<h2 class='text-4xl text-pink-400 mb-4'>" . $row["theme"] . "</h2>";
                // ...
                echo "<h3 class='text-3xl text-pink-400 mb-2'>Date de début : " . $row["dateDebut"] . "</h3>";
                echo "<h3 class='text-3xl text-pink-400 mb-4'>Date de fin : " . $row["dateFin"] . "</h3>";
                // ...
            }
        } else {
            echo "<p>No upcoming contest</p>";
        }
        ?>
    </div>

    <!-- Start of the table for finished contests -->
    <div class="bg-white p-10 rounded-lg shadow-lg m-4">
        <h1 class="text-5xl text-white text-center stroke-text">Concours terminés</h1>
        <?php
        if ($result_finished->num_rows > 0) {
            // Output data of each row
            while($row = $result_finished->fetch_assoc()) {
                echo "<h2 class='text-4xl text-pink-400 mb-4'>" . $row["theme"] . "</h2>";
                // ...
                echo "<h3 class='text-3xl text-pink-400 mb-2'>Date de début : " . $row["dateDebut"] . "</h3>";
                echo "<h3 class='text-3xl text-pink-400 mb-4'>Date de fin : " . $row["dateFin"] . "</h3>";
                // ...
            }
        } else {
            echo "<p>No finished contests</p>";
        }
        ?>
    </div>

    <!-- Rest of your HTML code -->
</body>
</html>
<?php
$conn->close();
?>