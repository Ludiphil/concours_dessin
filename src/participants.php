<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants du concours</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coiny&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gradient-to-b from-pink-500 to-blue-500 bg-no-repeat min-h-screen bg-cover coiny-regular">
    <div class="container mx-auto px-4">
        <div id="navbar"></div>
        <script>
            window.onload = function() {
                fetch('navbar.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('navbar').innerHTML = data;
                });
            };

        </script>
        <?php
            include 'db_connect.php';
            $sql = "SELECT numConcours, theme, dateDebut, dateFin FROM Concours";
            $result = $conn->query($sql);

            $concours = array();
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $concours[] = $row;
                }
            }


        ?>
        <div class="container mx-auto px-8 mt-4">
            <div class="bg-white p-10 rounded-lg shadow-lg">
                <h1 class="text-5xl text-white text-center stroke-text">Participants</h1>
                <div class="mb-4">
                    <form method="post" action="participants.php">
                        <label for="contest-select" class="block text-sm font-medium text-gray-700">Sélectionnez un concours :</label>
                        <select id="contest-select" name="contest-select" onchange="this.form.submit()" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($concours as $concour) : ?>
                                <option value="<?php echo $concour['numConcours']; ?>">
                                    <?php echo $concour['theme'] . ', ' . $concour['dateDebut'] . ', ' . $concour['dateFin']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
                <!-- Tableau stylisé -->
                <table class="table-auto w-full mt-4 ">
                    <thead>
                        <tr class="bg-blue-500">
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Prénom</th>
                            <th class="px-4 py-2">Nom club</th>
                            <th class="px-4 py-2">Consulter le profil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Vérifier si le formulaire a été soumis
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                // Récupérer le numéro du concours sélectionné
                                $numConcours = $_POST['contest-select'];

                                // Préparer la requête SQL
                                $sql = "SELECT Utilisateur.nom, Utilisateur.prenom, Competiteur.numCompetiteur
                                FROM ParticipeCompetiteur
                                INNER JOIN Competiteur ON ParticipeCompetiteur.numCompetiteur = Competiteur.numCompetiteur
                                INNER JOIN Utilisateur ON Competiteur.numCompetiteur = Utilisateur.numUtilisateur
                                WHERE ParticipeCompetiteur.numConcours = ?";

                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param('i', $numConcours);
                                $stmt->execute();

                                // Récupérer les résultats
                                $result = $stmt->get_result();
                                $participants = $result->fetch_all(MYSQLI_ASSOC);
                            } else {
                                $participants = array();
                            }

                            // Récupérer les concours pour le select
                            $sql = "SELECT numConcours, theme, dateDebut, dateFin FROM Concours";
                            $result = $conn->query($sql);
                            $concours = $result->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <?php foreach ($participants as $participant) : ?>
                        <tr>
                            <td class="border px-4 py-2"><?php echo $participant['nom']; ?></td>
                            <td class="border px-4 py-2"><?php echo $participant['prenom']; ?></td>
                            <td class="border px-4 py-2">...</td>
                            <td class="border px-4 py-2 flex justify-center">
                                <a href="profil.php?id=<?php echo $participant['numCompetiteur']; ?>" class="text-blue-500 hover:text-blue-800">Consulter le profil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>