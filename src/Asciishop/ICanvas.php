<?php 
namespace Asciishop;

interface ICanvas {

    public function create($columns, $rows, $color);

    public function clear();

    public function color($x, $y, $color);

    public function drawLine($x1, $x2, $y1, $y2, $color);

    public function fill($x, $y, $color);
    
    public function show();
}
