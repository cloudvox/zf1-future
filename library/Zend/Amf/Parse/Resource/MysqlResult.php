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
 * @package    Zend_Amf
 * @subpackage Parse
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * This class will convert mysql result resource to array suitable for passing
 * to the external entities.
 *
 * @package    Zend_Amf
 * @subpackage Parse
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Amf_Parse_Resource_MysqlResult
{
    /**
     * @var array List of Mysql types with PHP counterparts
     *
     * Key => Value is Mysql type (exact string) => PHP type
     */
    static public $fieldTypes = array(
        "int" => "int",
        "timestamp" => "int",
        "year" => "int",
        "real" => "float",
    );
    /**
     * Parse resource into array
     *
     * @param resource $resource
     * @return array
     */
    public function parse($resource) {
        $result = array();
        trigger_error("PHP 7.2 Compatibility Alert:\n\tERROR: Extension 'mysql_' is deprecated since PHP 5.5 and removed since PHP 7.0; Use mysqli instead\n\t".implode("\n\t", array_map(function ($item) { return sprintf("%s::%s", $item['file'], $item['line']); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
        $fieldcnt = mysql_num_fields($resource);
        $fields_transform = array();
        for($i=0;$i<$fieldcnt;$i++) {
            trigger_error("PHP 7.2 Compatibility Alert:\n\tERROR: Extension 'mysql_' is deprecated since PHP 5.5 and removed since PHP 7.0; Use mysqli instead\n\t".implode("\n\t", array_map(function ($item) { return sprintf("%s::%s", $item['file'], $item['line']); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
            $type = mysql_field_type($resource, $i);
            if(isset(self::$fieldTypes[$type])) {
                trigger_error("PHP 7.2 Compatibility Alert:\n\tERROR: Extension 'mysql_' is deprecated since PHP 5.5 and removed since PHP 7.0; Use mysqli instead\n\t".implode("\n\t", array_map(function ($item) { return sprintf("%s::%s", $item['file'], $item['line']); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
                $fields_transform[mysql_field_name($resource, $i)] = self::$fieldTypes[$type];
            }
        }

        trigger_error("PHP 7.2 Compatibility Alert:\n\tERROR: Extension 'mysql_' is deprecated since PHP 5.5 and removed since PHP 7.0; Use mysqli instead\n\t".implode("\n\t", array_map(function ($item) { return sprintf("%s::%s", $item['file'], $item['line']); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
        while($row = mysql_fetch_object($resource)) {
            foreach($fields_transform as $fieldname => $fieldtype) {
               settype($row->$fieldname, $fieldtype);
            }
            $result[] = $row;
        }
        return $result;
    }
}
