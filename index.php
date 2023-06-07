<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILTRO HOTEL</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>

    <?php
    $hotels = [
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ]
    ];

    // Filtraggio degli hotel in base ai valori del form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $filteredHotels = [];

        foreach ($hotels as $hotel) {
            $voteFilter = $_POST['vote'] ?? '';
            $parkingFilter = isset($_POST['parking']) ? (bool)$_POST['parking'] : false;
            if (
                ($parkingFilter === false || $hotel['parking'] === $parkingFilter) &&
                (empty($voteFilter) || $hotel['vote'] == $voteFilter)
            ) {
                $filteredHotels[] = $hotel;
            }
        }
    } else {
        $filteredHotels = $hotels;
    }
    ?>

    <div class="container jumbo mt-4 p-5">
        <h2 class="mb-5">Filtra Hotel</h2>
        <form method="POST">

            <div class="form-group">
                <label class="mb-1 .text-dark" for="vote">Voto recensione da 0 a 5</label>
                <input type="number" class="form-control" id="vote" name="vote" placeholder="Inserisci il voto recensione da 0 a 5">
            </div>
            <div class="form-group">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="parking" name="parking" value="1">
                    <label clas class="form-check-label" for="parking">Parcheggio disponibile</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Filtra</button>
        </form>
    </div>

    <div class="container table mt-0 p-3">
        <h2>Risultati</h2>
        <table class="table table-bordered table-dark table-hover">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto recensione</th>
                    <th>Distanza dal centro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredHotels as $hotel) { ?>
                    <tr>
                        <td><?php echo $hotel['name']; ?></td>
                        <td><?php echo $hotel['description']; ?></td>
                        <td><?php echo $hotel['parking'] ? 'Disponibile' : 'Non disponibile'; ?></td>
                        <td><?php echo $hotel['vote']; ?></td>
                        <td><?php echo $hotel['distance_to_center']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>

</html>