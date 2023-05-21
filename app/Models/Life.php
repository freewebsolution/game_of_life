<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Life extends Model
{
    use HasFactory;

    public $grid = [];

    public function createGrid()
    {
        for ($i = 1; $i <= 25; ++$i) {
            $height = [];
            for ($j = 1; $j <= 50; ++$j) {
                $height[$j] = 0;
            }
            $this->grid[$i] = $height;
        }
    }

    public function generateRandomGrid()
    {
        for ($i = 1; $i <= 25; ++$i) {
            $height = [];
            for ($j = 1; $j <= 50; ++$j) {
                $height[$j] = round(rand(0, 1));
            }
            $this->grid[$i] = $height;
        }
    }

    public function runLife()
    {
        $newGrid = [];

        foreach ($this->grid as $widthId => $width) {
            $newGrid[$widthId] = [];
            foreach ($width as $heightId => $height) {
                $count = $this->countAdjacentCells($widthId, $heightId);

                if ($height == 1) {
                    // The cell is alive.
                    if ($count < 2 || $count > 3) {
                        // Any live cell with less than two or more than three neighbours dies.
                        $height = 0;
                    } else {
                        // Any live cell with exactly two or three neighbours lives.
                        $height = 1;
                    }
                } else {
                    if ($count == 3) {
                        // Any dead cell with three neighbours lives.
                        $height = 1;
                    }
                }

                $newGrid[$widthId][$heightId] = $height;
            }
        }
        $this->grid = $newGrid;
        unset($newGrid);
    }

    public function countAdjacentCells($x, $y)
    {
        $coordinatesArray = [
            [-1, -1], [-1, 0], [-1, 1],
            [0, -1], [0, 1],
            [1, -1], [1, 0], [1, 1]
        ];

        $count = 0;

        foreach ($coordinatesArray as $coordinate) {
            if (
                isset($this->grid[$x + $coordinate[0]][$y + $coordinate[1]])
                && $this->grid[$x + $coordinate[0]][$y + $coordinate[1]] == 1
            ) {
                $count++;
            }
        }
        return $count;
    }

    function render(Life $life)
    {
        $output = '';
        foreach ($life->grid as $widthId => $width) {
            foreach ($width as $heightId => $height) {
                if ($height == 1) {
                    $output .= '*';
                } else {
                    $output .= '.';
                }
            }
            $output .= PHP_EOL;
        }

        return $output;
    }
}
