<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concours en cours</title>

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

        $sql = "SELECT numConcours, theme, dateDebut, dateFin FROM Concours WHERE etat = 'évalué'";
        $result = $conn->query($sql);

        $concours = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $concours[] = $row;
            }
        }

        $sql = "SELECT numConcours, theme, dateDebut, dateFin FROM Concours WHERE etat = 'en cours' LIMIT 1";
        $result = $conn->query($sql);

        $concoursEnCours = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $concoursEnCours = $row;
            }
        }

        $sql = "SELECT numConcours, theme, dateDebut, dateFin FROM Concours WHERE etat = 'pas commencé' ORDER BY dateDebut ASC LIMIT 1";
        $result = $conn->query($sql);

        $prochainConcours = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $prochainConcours = $row;
            }
        }

        $conn->close();

        ?>


        <div class="container mx-auto px-4 grid grid-cols-2 gap-4">
            <div class="bg-white p-10 rounded-lg shadow-lg m-4">
                <h1 id="concoursEnCours" class="text-5xl text-white text-center stroke-text">Concours en cours</h1>
                <h2 class="text-4xl text-pink-400 mb-4"><?php echo isset($concoursEnCours['theme']) ? $concoursEnCours['theme'] : 'theme'; ?></h2>
                <h3 class="text-3xl text-pink-400 mb-2">Date de début : <?php echo isset($concoursEnCours['dateDebut']) ? $concoursEnCours['dateDebut'] : '...'; ?></h3>
                <h3 class="text-3xl text-pink-400 mb-4">Date de fin : <?php echo isset($concoursEnCours['dateFin']) ? $concoursEnCours['dateFin'] : '...'; ?></h3>
                <a href="dessins.html" class="text-white hover:text-gray-200 border border-blue-400 bg-blue-500 rounded-lg p-2">Voir les dessins</a>
                <a href="participants.html" class="text-white hover:text-gray-200 border border-blue-400 bg-blue-500 rounded-lg p-2 ml-4">Participants</a>
            </div>
            <div class="bg-white p-10 rounded-lg shadow-lg m-4">
                <h1 class="text-5xl text-white text-center stroke-text">Prochain concours</h1>
                <h2 class="text-4xl text-pink-400 mb-4"><?php echo isset($prochainConcours['theme']) ? $prochainConcours['theme'] : 'Thème du concours'; ?></h2>
                <h3 class="text-3xl text-pink-400 mb-2">Date de début : <?php echo isset($prochainConcours['dateDebut']) ? $prochainConcours['dateDebut'] : '...'; ?></h3>
                <h3 class="text-3xl text-pink-400 mb-4">Date de fin : <?php echo isset($prochainConcours['dateFin']) ? $prochainConcours['dateFin'] : '...'; ?></h3>
                <a href="connexion.html" class="text-white hover:text-gray-200 border border-blue-400 bg-blue-500 rounded-lg p-2">Inscription au concours</a>
            
            </div>
        </div>
        <!-- Nouvelle section -->
        <div class="container mx-auto px-8 mt-4">
        <div class="bg-white p-10 rounded-lg shadow-lg">
            <h1 class="text-5xl text-white text-center stroke-text">Précédent concours</h1>
        <!-- Tableau stylisé -->
        <table class="table-auto w-full mt-4 ">
            <thead>
                <tr class="bg-blue-500">
                    <th class="px-4 py-2">Numéro du concours</th>
                    <th class="px-4 py-2">Thème du concours</th>
                    <th class="px-4 py-2">Date de début</th>
                    <th class="px-4 py-2">Date de fin</th>
                    <th class="px-4 py-2">liste des participants</th>
                </tr>
            </thead>

            <tbody >
                <?php foreach ($concours as $concour): ?>
                <tr>
                    <td class="border border-gray-400 px-4 py-2"><?php echo $concour['numConcours']; ?> </td>
                    <td class="border border-gray-400 px-4 py-2"><?php echo $concour['theme']; ?></td>
                    <td class="border border-gray-400 px-4 py-2"><?php echo $concour['dateDebut']; ?></td>
                    <td class="border border-gray-400 px-4 py-2"><?php echo $concour['dateFin']; ?></td>
                    <td class="border border-gray-400 px-4 py-2 flex justify-center">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">
                            <a href="participants.php">Participants</a>
                        </button> 
                    </td>  
                </tr>
                <?php endforeach; ?>
                
                <!-- Autres lignes du tableau -->
            </tbody>
        </table>
        </div>
        
    </div>
    
</body>
</html>