<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Go life</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mt-4">
                    <h2>Conway's game of life</h2>
                    <p>
                        <small>
                            <i>
                                Qualsiasi cella viva con meno di due vicini vivi muore, come per sottopopolazione.
                                Qualsiasi cella viva con due o tre vicini vivi sopravvive alla generazione successiva.
                                Qualsiasi cella viva con più di tre vicini vivi muore, come per sovrappopolazione.
                                Qualsiasi cella morta con esattamente tre vicini vivi diventa una cellula viva, come
                                per
                                riproduzione.
                            </i>
                        </small>
                    </p>
                    {{-- <p class="mb-4">Per giocare premi su start</p> --}}
                    {{-- <button class="btn btn-success btn-sm mb-3" id="start-btn" class="btn btn-primary">Start</button> --}}
                    {{-- <div id="game-grid" class="col-md-12">
                        <!-- Il tuo grid sarà generato qui tramite JavaScript -->
                    </div> --}}

                    @php
                        echo $life->render($life);
                        $life->runLife();
                    @endphp
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        var life = JSON.parse('@json($life)');
        var grid;
        var gameInterval;
        var startTime;

        function createGrid() {
            var grid = [];

            for (var i = 1; i <= 25; i++) {
                var height = [];
                for (var j = 1; j <= 50; j++) {
                    height[j] = 0;
                }
                grid[i] = height;
            }

            return grid;
        }

        function generateRandomGrid(grid) {
            for (var i = 1; i <= 25; i++) {
                var height = [];
                for (var j = 1; j <= 50; j++) {
                    height[j] = Math.round(Math.random());
                }
                grid[i] = height;
            }

            return grid;
        }

        function runLife(grid) {
            var newGrid = [];

            for (var widthId in grid) {
                newGrid[widthId] = [];
                for (var heightId in grid[widthId]) {
                    var count = countAdjacentCells(parseInt(widthId), parseInt(heightId), grid);

                    if (grid[widthId][heightId] == 1) {
                        // The cell is alive.
                        if (count < 2 || count > 3) {
                            // Any live cell with less than two or more than three neighbours dies.
                            grid[widthId][heightId] = 0;
                        } else {
                            // Any live cell with exactly two or three neighbours lives.
                            grid[widthId][heightId] = 1;
                        }
                    } else {
                        if (count == 3) {
                            // Any dead cell with three neighbours lives.
                            grid[widthId][heightId] = 1;
                        }
                    }

                    newGrid[widthId][heightId] = grid[widthId][heightId];
                }
            }

            return newGrid;
        }

        function countAdjacentCells(x, y, grid) {
            var coordinatesArray = [
                [-1, -1],
                [-1, 0],
                [-1, 1],
                [0, -1],
                [0, 1],
                [1, -1],
                [1, 0],
                [1, 1]
            ];

            var count = 0;

            for (var i = 0; i < coordinatesArray.length; i++) {
                var coordinate = coordinatesArray[i];
                var adjacentX = x + coordinate[0];
                var adjacentY = y + coordinate[1];

                if (
                    grid[adjacentX] && grid[adjacentX][adjacentY] &&
                    grid[adjacentX][adjacentY] == 1
                ) {
                    count++;
                }
            }

            return count;
        }

        function renderGrid(grid) {
            var gridElement = document.getElementById('game-grid');
            var output = '';

            for (var i = 1; i <= 25; i++) {
                for (var j = 1; j <= 50; j++) {
                    if (grid[i][j] == 1) {
                        output += '<span class="alive-cell">*</span>';
                    } else {
                        output += '<span class="dead-cell">.</span>';
                    }
                }
                output += '<br>';
            }

            gridElement.innerHTML = output;
        }

        var grid = createGrid();
        generateRandomGrid(grid);
        renderGrid(grid);

        function updateGame() {
            grid = runLife(grid);
            renderGrid(grid);

            // Controlla se il gioco è finito
            if (isGameFinished()) {
                stopGame();
                var elapsedTime = new Date() - startTime;
                alert('Il gioco è finito! Tempo trascorso: ' + elapsedTime + 'ms');
            }
        }

        function isGameFinished() {
            for (var widthId in grid) {
                for (var heightId in grid[widthId]) {
                    if (grid[widthId][heightId] === 1) {
                        return false; // Ci sono ancora celle vive, il gioco non è finito
                    }
                }
            }

            return true; // Tutte le celle sono morte, il gioco è finito
        }
        // Controlla se il gioco è finito
        if (isGameFinished()) {
            stopGame();
            var elapsedTime = new Date() - startTime;
            alert('Il gioco è finito! Tempo trascorso: ' + elapsedTime + 'ms');
        }

        function startGame() {
            if (!gameInterval) {
                grid = createGrid();
                generateRandomGrid(grid);
                renderGrid(grid);

                gameInterval = setInterval(updateGame, 1500);
                startTime = new Date(); // Registra l'ora di inizio del gioco
            }
        }

        function stopGame() {
            if (gameInterval) {
                clearInterval(gameInterval);
                gameInterval = null;
            }
        }

        // Aggiungi l'elemento del pulsante di avvio
        var startButton = document.getElementById('start-btn');
        startButton.addEventListener('click', startGame);
    </script> --}}
</body>

</html>
