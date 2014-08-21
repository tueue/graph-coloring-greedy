<?php

/*
 * 
 * Graph Coloring with greedy algorithm
 *
 * @author tueue ( balazs.tuu@gmail.com )
 * @version 1.0 * 
 * 
 */
class Graph {
    
    private $adjacencyMatrix;       // connection/adjacency table
    private $colorsVector;          // list of colors
    private $coloredVertices;       // lost of colored vertices
    private $matrixSize = 0;        // size of $adjacencyMatrix
    private $chromaticNo = 0;       // finale chormatic number after coloring
    
    public function __construct($sizeMatrix) {
        // init adjacency table
        $this->matrixSize = $sizeMatrix;
        for($i = 0; $i < $this->matrixSize; $i++) {
            for ($y = 0; $y < $this->matrixSize; $y++) {
                $this->adjacencyMatrix[$i][$y] = 0;
            }
        }
        // init colors vector = result of coloring
        $this->colorsVector[0] = 0;
        for($i=1;$i < $this->matrixSize; $i++) { $this->colorsVector[$i] = -1; }
        // init colored vertices
        for($i=0;$i < $this->matrixSize; $i++) { $this->coloredVertices[$i] = false; }
    }
    
    public function listElements() {
        echo "__ |";
        for ($y = 0; $y < $this->matrixSize; $y++) {
            echo $y . " | ";
        }
        echo "<br>\n";
        for($i = 0; $i < $this->matrixSize; $i++) {
            echo $i." | ";
            for ($y = 0; $y < $this->matrixSize; $y++) {
                echo $this->adjacencyMatrix[$i][$y]." | ";
            }
            echo "<br>\n";
        }        
    }
    
    public function getColors() {
        echo "<p>\n";
        for ($i = 0; $i < $this->matrixSize; $i++)
            echo "Vertex " .$i. " --->  Color " .$this->colorsVector[$i]."<br>\n";
        echo "</p>\n";
    }

    public function getAdjacencyMatrix() {
        return $this->adjacencyMatrix;
    }
    
    public function getColorsVector() {
        return $this->colorsVector;
    }
    
    public function getChromaticNo() {
        for($i = 0; $i < count($this->colorsVector); $i++) {
            if ($this->colorsVector[$i] > $this->chromaticNo) { $this->chromaticNo = $this->colorsVector[$i]; }          
        }        
        return ++$this->chromaticNo;
    }

    public function setVertex($row,$column) {
        if($row > $this->matrixSize || $column > $this->matrixSize) { return false; }
        $this->adjacencyMatrix[$row][$column] = $this->adjacencyMatrix[$column][$row] = 1;
        return true;
    }
    
    public function coloringGraph() {
        for ($j = 1; $j < $this->matrixSize; $j++) {
            // Color adjacent vertices with different colors
            for ($i = 0; $i < $this->matrixSize; $i++) {
                if ( ($this->colorsVector[$i] != -1) && ($this->adjacencyMatrix[$j][$i] > 0) ) {
                    $this->coloredVertices[$this->colorsVector[$i]] = true;
                }
            }
            // Search the 1st free color
            for ($cr = 0;$cr < $this->matrixSize; $cr++) 
                if ($this->coloredVertices[$cr] == false)
                    break;
            $this->colorsVector[$j] = $cr;
            // Reset for next iteration         
            for ($i = 0; $i < $this->matrixSize; $i++) {
                if ( ($this->colorsVector[$i] != -1) && ($this->adjacencyMatrix[$j][$i] > 0) ) {
                    $this->coloredVertices[$this->colorsVector[$i]] = false;
                }
            }
        }
    }

    public function __destruct() {
        reset($this->adjacencyMatrix);
        reset($this->coloredVertices);
        reset($this->colorsVector);        
        $this->matrixSize = 0;
        $this->chromaticNo = 0;
    }
};