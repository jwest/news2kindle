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
    protected static $args = array
    (
        'login' => NULL,        //--login=accountName@gmail.com
        'password' => NULL,     //--password=PaSSw0rd1!
        'maxitems' => 5,        //--maxitems=5
        'timeout' => FALSE,     //--timeout=20 (in sec)
        'setasread' => FALSE,   //--setasread=true
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
     * (from http://php.net/manual/en/features.commandline.php)
     * @param array $argv array
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

        $this->_argv = self::_validate_args($out);
    }

    /**
     * Validate args for script
     * (from http://php.net/manual/en/features.commandline.php)
     * @param array $argv array
     * @return array args
     */
    private static function _validate_args($args)
    {
        foreach ($out as $key => $arg ) {
            if(!isset(self::_argv[$key])){
                self::error('Param "'.$key.'" is invalid!');
                throw new Exception();
            }
        }

        foreach()

        self::ok();
    }

}