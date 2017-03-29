<?php
/**
 * Open an sql connection and submit the query
 * @param  string   $query
 * @return resource $rq
 */
function sql_query($query)
{
  $servername = "mysql.love4learningpreschool.com";
  $username = "love4learning";
  $password = "managedbythebarcodebandits";
  $dbname = "love4learning_student";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $rq = $conn->query($query);
  $conn->close();

  return $rq;
}

/**
 * onion skin
 *
 * The difference between a stock real_escape_string() call and this is that
 * this can be called multiple times and the resulting string will be cleanly
 * escaped in each instance and not double escaped.
 *
 * @param  string $str
 * @param  bool   $decode = true
 * @return string
 */
function sql_safe($str, $decode = SQL_SAFE_DECODE)
{
	$conn = _sql_open('ro_sql');

	if ($decode)
	{
		// reverse the effects of a prior call to real_escape_string()
		$str = str_replace(array("\\\\", "\\'", "\\\"", "\\n"), array("\\", "'", "\"", "\n"), $str);
	}

	// now escape the special chars in prep for use in SQL query
	return $conn->real_escape_string($str);
}

/**
 * onion skin
 *
 * @param object $rq
 * @return array
 */
function sql_array($rq)
{
	if (is_object($rq)) return $rq->fetch_array();	// both associative and numeric entries
	return null;
}

/**
 * onion skin
 *
 * @param object $rq
 * @return array
 */
function sql_assoc($rq)
{
	if (is_object($rq)) return $rq->fetch_assoc();	// just associative entries
	return null;
}

?>
