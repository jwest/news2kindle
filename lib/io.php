<?php
/**
 * Simple output message and args prepared
 *
 * @author Jakub Westfalewski <jwest@jwest.pl>
 */
class IO {

	/**
	 * Max line height
	 */
	const COMMAND_LENGTH = 50;

	/**
	 * args for run screen
	 * @var array
	 */
	protected static $args = array();

	/**
	 * Write on screen text line
	 * @param string $message
	 * @param bool   $broken_line
	 */
	public static function msg($message, $broken_line = TRUE)
	{
		echo ( $broken_line ? "\n" : "" ) . $message;
	}

	/**
	 * Write command for status
	 * @param string $message
	 */
	public static function command($message)
	{
		$output_whitespaces = '';

		for ($i = strlen($message); $i <= self::COMMAND_LENGTH; ++$i )
		{
			$output_whitespaces .= '-';
		}

		self::msg( $message . ' ' . $output_whitespaces.' ' );
	}

	/**
	 * Status - OK
	 */
	public static function ok()
	{
		$colored_string = "\033[1;37m" . "\033[42m" . ' OK ' . "\033[0m";
		self::msg( $colored_string, FALSE );
	}

	/**
	 * Status - Error
	 */
	public static function error($message = NULL)
	{
		$colored_string = "\033[1;37m" . "\033[41m" . ' ERROR ' . "\033[0m";
		self::msg( $colored_string, FALSE );

		if ( $message !== NULL )
		{
			self::msg( $message );			
		}
	}

	/**
	 * Get run args
	 * @param string $name key config
	 * @return mixed config value
	 */
	public static function arg($name)
	{
		//@TODO
	}

	/**
	 * Prepare args for script
	 * @param array $args array
	 */
	public static function prepare_args($args)
	{
		//@TODO
	}

}