<?php

function dbg_set_conditional_show($status = true)
{
	global $dbg_show_switch;
	
	$dbg_show_switch = $status;
}

function dbg_conditional_show($obj, $label = '')
{
	global $dbg_show_switch;
	
	if ($dbg_show_switch)
		dbg_log($obj, $label);
}

function dbg_assert($condition, $message = 'Assertion failed')
{
	if (!$condition)
		throw new Exception($message);
}

function dbg_printable($obj)
{
	if (is_array($obj))
	{
		$aux = array();
		
		foreach ($obj as $key => $item)
			$aux[$key] = dbg_printable($item);
			
		return $aux;
	}
	else if (is_bool($obj))
		return ($obj) ? 'true (PHP)' : 'false (PHP)';
	else if (is_null($obj))
		return 'null (PHP)';
	else if (is_string($obj) && $obj === '')
		return 'empty string (PHP)';
	
	return $obj;
}

/** Global function to print debug information */
function dbg_log($obj, $label = '')
{
	$obj = dbg_printable($obj);
		
	$trace = debug_backtrace();
	$header = $trace[0]['file'] . ' [' . $trace[0]['line'] . ']: ' . $label;

	error_log($header . "\n" . print_r($obj, true));
}

function dbg_log2($obj0, $obj1, $label = '')
{
	dbg_log(array($obj0, $obj1), $label);
}

function dbg_log3($obj0, $obj1, $obj2, $label = '')
{
	dbg_log(array($obj0, $obj1, $obj2), $label);
}

function dbg_log4($obj0, $obj1, $obj2, $obj3, $label = '')
{
	dbg_log(array($obj0, $obj1, $obj2, $obj3), $label);
}

/** Global function to print stack trace of function calls */
function dbg_trace($label = '')
{
	if (!$label)
		$label = 'Trace of function calls';
	
	$trace = debug_backtrace();
	
	$names = array();
	
	foreach ($trace as $call)
	{
		if ($call['function'] != 'dbg_trace')
		{
			$prefix = (isset($call['class'])) ? $call['class'] . '::' : '';
			
			$names[] = $prefix . $call['function'] . 
				'(' . $call['file'] . ':' . $call['line'] . ')';
		}
	}

	dbg_log($names, $label);
}

?>