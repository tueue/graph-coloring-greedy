<?php

/* 
 *  
 * Graph Coloring with greedy algorithm
 *
 * @author tueue ( balazs.tuu@gmail.com )
 * @version 1.0
 * 
 * 2014.08.20.
 * 
 */

include_once 'graph.inc.php';

$myG = new Graph(17);
$myG->setVertex(0,1);
$myG->setVertex(0,2);
$myG->setVertex(1,2);
$myG->setVertex(1,3);
$myG->setVertex(2,3);
$myG->setVertex(3,4);
$myG->setVertex(2,5);
$myG->setVertex(5,4);
// 16
$myG->setVertex(4,6);
$myG->setVertex(4,7);
$myG->setVertex(4,9);
$myG->setVertex(4,14);
$myG->setVertex(6,7);
$myG->setVertex(6,8);
$myG->setVertex(6,11);
$myG->setVertex(6,13);
$myG->setVertex(6,14);
$myG->setVertex(7,8);
$myG->setVertex(7,9);
$myG->setVertex(7,10);
$myG->setVertex(7,11);
$myG->setVertex(8,10);
$myG->setVertex(11,12);
$myG->setVertex(11,13);
$myG->setVertex(11,14);
$myG->setVertex(11,15);
$myG->setVertex(11,16);
$myG->setVertex(12,13);
$myG->setVertex(12,15);
$myG->setVertex(12,16);
$myG->setVertex(14,15);
$myG->setVertex(15,16);
//

$myG->coloringGraph();
$adjM = $myG->getAdjacencyMatrix();
$colV = $myG->getColorsVector();
$colorsName = array( "#FF0000", "#00FF00", "#0000FF", "FFFF00", "#00FFFF", "#FF00FF", "#C0C0C0");
echo "Chromatic No.: <b>".$myG->getChromaticNo()."</b><br>\n";

// show adjacency table
echo "<table bgcolor=\"silver\" cellspacing=\"1\" cellspadding=\"0\">\n";
echo "<tr>\n";
echo "<th bgcolor=\"white\" width=\"20\" align=\"center\"> # </th>\n";
for($i = 0; $i < count($adjM); $i++) {
    echo "<th bgcolor=\"".$colorsName[$colV[$i]]."\" width=\"20\" align=\"center\"><b>".chr(65+$i)."</b></th>\n";
}
echo "</tr>\n";
echo "<tr>\n";
for($j = 0; $j < count($adjM); $j++) {
    echo "<td bgcolor=\"".$colorsName[$colV[$j]]."\" align=\"center\"><b>".chr(65+$j)."</b></td>\n";
    for($i = 0; $i < count($adjM); $i++) {
        echo "<td bgcolor=\"".(($adjM[$j][$i] == 0)? "white" : "".$colorsName[$colV[$i]]."")."\" align=\"center\">".$adjM[$j][$i]."</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

foreach ($colV as $vertex=>$color) {
    echo "Vertex ".$vertex." is (".$color.") <font color=\"".$colorsName[$color]."\">".$colorsName[$color]."</font><br>\n";
}