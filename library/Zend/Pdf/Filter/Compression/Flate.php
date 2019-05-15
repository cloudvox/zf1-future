<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Pdf
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */


/** Zend_Pdf_Filter_Compression */
require_once 'Zend/Pdf/Filter/Compression.php';

/**
 * Flate stream filter
 *
 * @package    Zend_Pdf
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Pdf_Filter_Compression_Flate extends Zend_Pdf_Filter_Compression
{
    /**
     * Encode data
     *
     * @param string $data
     * @param array $params
     * @return string
     * @throws Zend_Pdf_Exception
     */
    public static function encode($data, $params = null)
    {
        if ($params != null) {
            $data = self::_applyEncodeParams($data, $params);
        }

        if (extension_loaded('zlib')) {
            trigger_error("PHP 7.2 Compatibility Alert WARNING: INI directive 'track_errors' is deprecated since PHP 7.2".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
            $trackErrors = ini_get( "track_errors");
            trigger_error("PHP 7.2 Compatibility Alert WARNING: INI directive 'track_errors' is deprecated since PHP 7.2".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
            ini_set('track_errors', '1');

            if (($output = @gzcompress($data)) === false) {
                trigger_error("PHP 7.2 Compatibility Alert WARNING: INI directive 'track_errors' is deprecated since PHP 7.2".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
                ini_set('track_errors', $trackErrors);
                require_once 'Zend/Pdf/Exception.php';
                trigger_error("PHP 7.2 Compatibility Alert WARNING: The variable '\$php_errormsg' is deprecated since PHP 7.2; Use error_get_last() instead".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
                throw new Zend_Pdf_Exception($php_errormsg);
            }

            trigger_error("PHP 7.2 Compatibility Alert WARNING: INI directive 'track_errors' is deprecated since PHP 7.2".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
            ini_set('track_errors', $trackErrors);
        } else {
            require_once 'Zend/Pdf/Exception.php';
            throw new Zend_Pdf_Exception('Not implemented yet. You have to use zlib extension.');
        }

        return $output;
    }

    /**
     * Decode data
     *
     * @param string $data
     * @param array $params
     * @return string
     * @throws Zend_Pdf_Exception
     */
    public static function decode($data, $params = null)
    {
        trigger_error("PHP 7.2 Compatibility Alert WARNING: The variable '\$php_errormsg' is deprecated since PHP 7.2; Use error_get_last() instead".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
        global $php_errormsg;

        if (extension_loaded('zlib')) {
            trigger_error("PHP 7.2 Compatibility Alert WARNING: INI directive 'track_errors' is deprecated since PHP 7.2".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
            $trackErrors = ini_get( "track_errors");
            trigger_error("PHP 7.2 Compatibility Alert WARNING: INI directive 'track_errors' is deprecated since PHP 7.2".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
            ini_set('track_errors', '1');

            if (($output = @gzuncompress($data)) === false) {
                trigger_error("PHP 7.2 Compatibility Alert WARNING: INI directive 'track_errors' is deprecated since PHP 7.2".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
                ini_set('track_errors', $trackErrors);
                require_once 'Zend/Pdf/Exception.php';
                trigger_error("PHP 7.2 Compatibility Alert WARNING: The variable '\$php_errormsg' is deprecated since PHP 7.2; Use error_get_last() instead".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
                throw new Zend_Pdf_Exception($php_errormsg);
            }

            trigger_error("PHP 7.2 Compatibility Alert WARNING: INI directive 'track_errors' is deprecated since PHP 7.2".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
            ini_set('track_errors', $trackErrors);
        } else {
            require_once 'Zend/Pdf/Exception.php';
            throw new Zend_Pdf_Exception('Not implemented yet');
        }

        if ($params !== null) {
            return self::_applyDecodeParams($output, $params);
        } else {
            return $output;
        }
    }
}
