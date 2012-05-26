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
    protected static $_args = array
    (
        'help' => array('value' => FALSE, 'description' => 'show help for news2kindle'),
        'grab' => array('value' => FALSE, 'description' => ''),
        'mobi' => array('value' => FALSE, 'description' => ''),
        'send' => array('value' => FALSE, 'description' => ''),
        'login' => array('value' => NULL, 'description' => ''),
        'password' => array('value' => NULL, 'description' => ''),
        'maxitems' => array('value' => 5, 'description' => ''),
        'timeout' => array('value' => FALSE, 'description' => ''),
        'asread' => array('value' => FALSE, 'description' => ''),
        'html' => array('value' => 'std', 'description' => ''),
    );

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
            self::msg( '  - ' . $message );            
        }
    }

    /**
     * Get run args
     * @param string $name key config
     * @return mixed config value
     */
    public static function arg($name)
    {
        return self::$_args[$name]['value'];
    }

    /**
     * Prepare args for script
     * (from http://php.net/manual/en/features.commandline.php)
     * @param array $argv array
     * @return bool success or error
     */
    public static function prepare_args($argv)
    {
        self::command('Parse args');

        array_shift($argv);
        $out = array();

        foreach ( $argv as $arg )
        {
            if ( substr($arg,0,2) == '--' )
            {
                $eqPos = strpos($arg,'=');

                if ( $eqPos === false )
                {
                    $key = substr($arg,2);
                    $out[$key] = isset($out[$key]) ? $out[$key] : true;
                } 
                else 
                {
                    $key = substr($arg,2,$eqPos-2);
                    $out[$key] = substr($arg,$eqPos+1);
                }

            } 
            else if ( substr($arg,0,1) == '-' )
            {
                if ( substr($arg,2,1) == '=' )
                {
                    $key = substr($arg,1,1);
                    $out[$key] = substr($arg,3);
                } 
                else 
                {
                    $chars = str_split(substr($arg,1));

                    foreach ( $chars as $char )
                    {
                        $key = $char;
                        $out[$key] = isset($out[$key]) ? $out[$key] : true;
                    }
                }
            } 
            else 
            {
                $out[] = $arg;
            }
        }

        try
        {
            $args = self::_validate_args($out);

            foreach ( $args as $key => $value )
            {
                self::$_args[$key]['value'] = $value;
            }
        }
        catch(Exception $e)
        {
            self::error($e->getMessage());
            return false;
        }

        self::ok();

        return true;
    }

    /**
     * Validate args for script
     * (from http://php.net/manual/en/features.commandline.php)
     * @param array $argv array
     * @return array args
     */
    private static function _validate_args($args)
    {
        foreach ( $args as $key => $arg ) 
        {
            if ( strlen($key) === 1 )
            {
                foreach ( self::$_args as $keyA => $argA )
                {
                    if($keyA[0] === $key )
                    {
                        unset( $args[$key] );
                        $args[$keyA] = $arg;
                        $key = $keyA;
                    }
                }
            }

            if ( ! array_key_exists($key, self::$_args) )
            {
                throw new Exception('Param "'.$key.'" is invalid!');
            }
        }

        foreach ( self::$_args as $key => $arg )
        {
            if( self::$_args[$key]['value'] === NULL AND !array_key_exists($key, $args) )
            {
                throw new Exception('Param "'.$key.'" must be declared!');
            }
        }

        return $args;
    }

}