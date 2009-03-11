<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function _transform2forest($rows, $idName, $pidName)
{
	$children = array(); // children of each ID
    $ids = array();
    foreach ($rows as $i=>$r) 
    {
    	$row =& $rows[$i];
    	$id = $row[$idName];
        $pid = $row[$pidName];
        $children[$pid][$id] =& $row;
        if (!isset($children[$id])) $children[$id] = array();
        $row['childNodes'] =& $children[$id];
        $ids[$row[$idName]] = true;
	}
    // Root elements are elements with non-found PIDs.
    $forest = array();
    foreach ($rows as $i=>$r) 
    {
    	$row =& $rows[$i];
        if (!isset($ids[$row[$pidName]])) 
        {
        	$forest[$row[$idName]] =& $row;
		}
        #unset($row[$idName]); unset($row[$pidName]);
	}
    return $forest;
}

function getNodeParentsById($rows, $id, $idName, $pidName)
{
	return _parents(_stuctured_parents($rows, $idName, $pidName), $id, $idName, $pidName);
}

function _parents($rows, $id, $idName, $pidName)
{
	$result = Array();
	if($id != 0)
	{
		$items = $rows[$id];
		list($pid, $item) = each($items);
		$result[]= $item;
		// Recursion
		foreach(array_reverse(_parents($rows, $pid, $idName, $pidName)) as $k)
			$result[]=$k;
	}
	return array_reverse($result);
}

function _stuctured_parents($rows, $idName, $pidName)
{
	foreach($rows as $row)
	{
		$id  = $row[$idName];
		$pid = $row[$pidName];
		$data[$id][$pid] = $row;
	}
	return $data;	
}

function _getNodeTree($forest, $id)
{
	global $_nodeTree;
	foreach($forest as $tree)
	{
		if($tree['rid']!=$id) _getNodeTree($tree['childNodes'], $id);
		else $_nodeTree = $tree['childNodes'];
	}
	return $_nodeTree;
}
?>