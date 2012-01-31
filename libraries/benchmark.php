<?php
/* 
 * simple benchmark
 * uses PEAR benchmark class
 * @todo implement accordingly
 */

require('Benchmark/Iterate.php');

$benchmark = new Benchmark_Iterate;
$benchmark->run(1000, "foo");
$result = $benchmark->get();
print "fOO Mean execution time is: " . $result['mean'] . "\n";

function foo() {
    $arr = array("1", "2", "3", "4", "5", "6");
    foreach($arr as $ars) {
        $t[] = $ars;
    }
}
$benchmark->run(1000, "foo2");
$result = $benchmark->get();
print "fOO2 Mean execution time is: " . $result['mean'] . "\n";

function foo2() {
    $arr = array('1', '2', '3', '4', '5', '6', '7');
    $l = count($arr);
    for($x = 0; $x < $l; $x++) {
        $t[] = $arr[$x];
    }
}