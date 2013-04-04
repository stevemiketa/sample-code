<?php
namespace Asciishop;


class Canvas implements ICanvas {
    private static $DEFAULT_COLOR = 'O';
    private static $MAX_DIMENSION = 250;
    
    private $columns;
    private $rows;

    private $grid = array();

    /**
     * Create a new image with the given dimensions and default color
     *
     * @param int $columns
     * @param int $rows
     * @param string $color
     */
    public function create($columns, $rows, $color=null) {
        if ($rows < 1 
                || $columns < 1 
                || $rows > self::$MAX_DIMENSION 
                || $columns > self::$MAX_DIMENSION) {
            throw new CanvasException(vsprintf('Invalid canvas dimensions (%d,%d)', array($columns, $rows)));
        }

        if (!is_null($color) && strlen($color) !== 1) {
            throw new CanvasException(vsprintf('Illegal color: %s', array($color)));
        }

        $this->columns = $columns;
        $this->rows = $rows;

        $init_color = (!is_null($color)) ? $color : self::$DEFAULT_COLOR; 
        $this->_clear($init_color);
    }


    /** 
     * Public clear method that sets the canvas the class default color
     */
    public function clear() {
        $this->_clear(self::$DEFAULT_COLOR);
    }


    /**
     * Clear method that sets all canvas color values to the given color
     *
     * @param string color
     */
    protected function _clear($color) {
        $this->grid = array();
        for ($i=1; $i <= $this->columns; $i++) {
            for ($j=1; $j <= $this->rows; $j++) {
                $this->grid[$j][$i] = $color;
            } 
        }
    }

    /**
     * Wrapper function Fill in the color at a given location
     *
     * @param int $x
     * @param int $y
     * @param string $color
     */
    public function color($x, $y, $color) {
        if (!$this->fitsOnGrid($x)
            || !$this->fitsOnGrid($y)) {
           
            throw new CanvasException('Invalid pixel coordinates');
        } else if (!$this->isValidColor($color)) {
            throw new CanvasException('Invalid color specification');
        }
        $this->_color($x, $y, $color);
    }

    /**
     * Fill in the color at a given location
     *
     * @param int $x
     * @param int $y
     * @param string $color
     */
    protected function _color($x, $y, $color) {
        $this->grid[$y][$x] = $color;
    }


    /**
     * Determine if the supplied "color" is valid 
     *
     * @param string $color
     */
    protected function isValidColor($color) {
       return strlen($color) === 1 && preg_match('#[A-Z]{1}#', $color); 
    }

    /**
     * Determine if the supplied dimension is within grid limits
     *
     * @param int $dim
     */
    protected function isValidDimension($dim) {
        return $dim > 0 && $dim <= self::$MAX_DIMENSION;
    }

    /**
     * Determine if the given coordinate fits on the current grid
     *
     * @param int $coord       - The X or Y coordinate of a pixel
     * @param string $axis   - x,y
     * @return boolean
     * @throws CanvasException
     */
    protected function fitsOnGrid($coord, $axis='x') {
        if ($axis == 'x') {
            return $coord >0 && $coord <= $this->columns;
        } else if ($axis == 'y') {
            return $coord >0 && $coord <= $this->rows;
        } else {
            throw new CanvasException('Invalid coordinate axis: ' . $axis);
        }
    }

    /**
     * Draw a line of given color(horizontal, vertical) on the grid
     *
     * @param int $x1 
     * @param int $x2 
     * @param int $y1 
     * @param int $y2 
     * @param string $color 
     */
    public function drawLine($x1, $x2, $y1, $y2, $color) {
        if (!$this->isValidColor($color)) {
            throw new CanvasException('Invalid color specification: '. $color);
        }

        // Draw Horizontal Line
        if ($x1 && $x2 && $y1) {
            if ($this->fitsOnGrid($x1) 
                && $this->fitsOnGrid($x2) 
                && $this->fitsOnGrid($y1, 'y')) {

                // Swap values if order reversed
                if ($x1 > $x2) list($x1, $x2) = array($x2, $x1);

                for ($xVal = $x1; $xVal <= $x2; $xVal +=1) { 
                    $this->_color($xVal, $y1, $color);
                }
            } else {
                throw new CanvasException('Parameters not within grid space: ' . join(',', func_get_args()));
            }
        // Draw Vertical line
        } else if ($x1 && $y1 && $y2) {
            if ($this->fitsOnGrid($x1) 
                && $this->fitsOnGrid($y1, 'y') 
                && $this->fitsOnGrid($y2, 'y')) {

                // Swap values if order reversed 
                if ($y1 > $y2) list($y1, $y2) = array($y2, $y1);

                for ($yVal = $y1; $yVal <= $y2; $yVal +=1) { 
                    $this->_color($x1, $yVal, $color);
                }
            } else {
                throw new CanvasException('Parameters not within grid space: ' . join(',', func_get_args()));
            }
        } else { 
            throw new CanvasException('Invalid line parameters: ' . join(',', func_get_args()));
        }
    }

    /**
     * Fill a given area starting at the given pixel
     *
     * @param int $x
     * @param int $y
     * @param string $color
     */
    public function fill($x, $y, $color) {
        if (!$this->fitsOnGrid($x)
            || !$this->fitsOnGrid($y, 'y')) {
        
            throw new CanvasException(vsprintf('Invalid fill pixel: (%d,%d)', array($x,$y)));
        } else if (!$this->isValidColor($color)) {
            throw new CanvasException(sprintf('Invalid color specification: %s', $color));
        }


        $this->floodFill($x, $y, $this->grid[$y][$x], $color);
    }

    /**
     * Recursively fill each pixel, checking west, east, north, south for 
     * pixels that match the color of the initial pixel
     *
     * @param int $x
     * @param int $y
     * @param string $color
     * @param stirng $fillColor
     */
    protected function floodFill($x, $y, $color, $fillColor) {
        // Stop at grid border
        if (!$this->fitsOnGrid($x) || !$this->fitsOnGrid($y, 'y')) return;

        // Stop at border colors
        if ($this->grid[$y][$x] !== $color) return;

        // Fill in the root pixel
        $this->_color($x, $y, $fillColor);

        // Recursively attack pixels in W,E,N,S order
        $this->floodFill($x-1, $y, $color, $fillColor);
        $this->floodFill($x+1, $y, $color, $fillColor);
        $this->floodFill($x, $y+1, $color, $fillColor);
        $this->floodFill($x, $y-1, $color, $fillColor);
    }

    
    /**
     * Wrapper for returning grid (wasn't sure where to go with this)
     *
     * @return $grid
     */
    public function show() {
        return $this->grid;
    }


    /**
     * Return the curent grid
     *
     * @return $grid
     */
    public function getGrid() {
        return $this->grid;
    }


    /**
     * Get origin pixel coordinates
     *
     * @return array
     */
    public function getOrigin() {
        return array(1,1);
    }

    /**
     * Set the number of columns
     *
     * @param int $cols
     */
    public function setColumns($cols) {
        $this->columns = $cols;
    }

    /**
     * Set the number of rows
     *
     * @param int $rows
     */
    public function setRows($rows) {
        $this->rows = $rows;
    }

    /**
     * Return the default color
     *
     * @return string
     */
    public function getDefaultColor() {
        return self::$DEFAULT_COLOR;
    }

    /**
     * Helper for remembering that it's actually 
     * y,x for the grid not x,y
     *
     * @param int $x
     * @param int $y
     * @return string  - color
     */
    protected function getGridLocation($x, $y)  {
        return $this->grid[$y][$x];
    }
}
