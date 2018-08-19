<?php

/**
 * Truncates the given string at the specified length.
 *
 * @param string $text
 * @param int $limit
 * @return string
 */
function ala_truncate($text, $limit) {
	$text = str_replace("\n", " ", $text);
	return strtok(wordwrap($text, $limit, "...\n"), "\n");
}
