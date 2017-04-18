<?php
function sql_open()
{
  $servername = "mysql.love4learningpreschool.com";
  $username = "love4learning";
  $password = "managedbythebarcodebandits";
  $dbname = "love4learning_student";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error)
  {
      die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
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

/**
 * Sanitize string for html and skipping already sanatized characters
 *
 * @param string $str    // either safe or unsafe string
 * @return string        // html safe string
 */
function html_safe($str)
{
	// encode single quotes and don't double encode
	return htmlspecialchars($str, ENT_QUOTES | ENT_HTML401, ini_get("default_charset"), false);
}


?>
