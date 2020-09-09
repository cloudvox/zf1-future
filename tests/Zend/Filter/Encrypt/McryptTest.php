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
 * @package    Zend_Filter
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id$
 */

/**
 * @see Zend_Filter_Encrypt_Mcrypt
 */
require_once 'Zend/Filter/Encrypt/Mcrypt.php';

/**
 * @category   Zend
 * @package    Zend_Filter
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @group      Zend_Filter
 */
class Zend_Filter_Encrypt_McryptTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        if (!extension_loaded('mcrypt')) {
            $this->markTestSkipped('This adapter needs the mcrypt extension');
        }
    }

    /**
     * Ensures that the filter follows expected behavior
     *
     * @return void
     */
    public function testBasicMcrypt()
    {
        $filter = new Zend_Filter_Encrypt_Mcrypt(['key' => 'testkey']);
        $valuesExpected = [
            'STRING' => 'STRING',
            'ABC1@3' => 'ABC1@3',
            'A b C'  => 'A B C'
        ];

        $enc = $filter->getEncryption();
        $filter->setVector('testvect');
        $this->assertEquals('testkey', $enc['key']);
        foreach ($valuesExpected as $input => $output) {
            $this->assertNotEquals($output, $filter->encrypt($input));
        }
    }

    /**
     * Ensures that the vector can be set / returned
     *
     * @return void
     */
    public function testGetSetVector()
    {
        $filter = new Zend_Filter_Encrypt_Mcrypt(['key' => 'testkey']);
        $filter->setVector('testvect');
        $this->assertEquals('testvect', $filter->getVector());

        try {
            $filter->setVector('1');
            $this->fail();
        } catch (Zend_Filter_Exception $e) {
            $this->assertContains('wrong size', $e->getMessage());
        }
    }

    /**
     * Ensures that the filter allows default encryption
     *
     * @return void
     */
    public function testDefaultEncryption()
    {
        $filter = new Zend_Filter_Encrypt_Mcrypt(['key' => 'testkey']);
        $filter->setVector('testvect');
        trigger_error("PHP 7.2 Compatibility Alert ERROR: The constant \"MCRYPT_BLOWFISH\" is deprecated since PHP 7.1 and removed since PHP 7.2\n\tERROR: The constant \"MCRYPT_MODE_CBC\" is deprecated since PHP 7.1 and removed since PHP 7.2".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
        $this->assertEquals(
            ['key' => 'testkey',
                  'algorithm' => MCRYPT_BLOWFISH,
                  'algorithm_directory' => '',
                  'mode' => MCRYPT_MODE_CBC,
                  'mode_directory' => '',
                  'vector' => 'testvect',
                  'salt' => false],
            $filter->getEncryption()
        );
    }

    /**
     * Ensures that the filter allows setting options de/encryption
     *
     * @return void
     */
    public function testGetSetEncryption()
    {
        $filter = new Zend_Filter_Encrypt_Mcrypt(['key' => 'testkey']);
        $filter->setVector('testvect');
        trigger_error("PHP 7.2 Compatibility Alert ERROR: The constant \"MCRYPT_MODE_ECB\" is deprecated since PHP 7.1 and removed since PHP 7.2\n\tERROR: The constant \"MCRYPT_3DES\" is deprecated since PHP 7.1 and removed since PHP 7.2".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
        $filter->setEncryption(
            ['mode' => MCRYPT_MODE_ECB,
                  'algorithm' => MCRYPT_3DES]);
        trigger_error("PHP 7.2 Compatibility Alert ERROR: The constant \"MCRYPT_3DES\" is deprecated since PHP 7.1 and removed since PHP 7.2\n\tERROR: The constant \"MCRYPT_MODE_ECB\" is deprecated since PHP 7.1 and removed since PHP 7.2".sprintf(" (%s::%s)", __FILE__, __LINE__) . "\n\t" . implode("\n\t", array_map(function ($item) { return call_user_func_array('sprintf', array_values(array_merge(array('format' => '%s::%s %s%s%s'), array_fill_keys(array('file', 'line', 'class', 'type', 'function'), null), $item))); }, debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS))), E_USER_WARNING);
        $this->assertEquals(
            ['key' => 'testkey',
                  'algorithm' => MCRYPT_3DES,
                  'algorithm_directory' => '',
                  'mode' => MCRYPT_MODE_ECB,
                  'mode_directory' => '',
                  'vector' => 'testvect',
                  'salt' => false],
            $filter->getEncryption()
        );
    }

    /**
     * Ensures that the filter allows de/encryption
     *
     * @return void
     */
    public function testEncryptionWithDecryptionMcrypt()
    {
        $filter = new Zend_Filter_Encrypt_Mcrypt(['key' => 'testkey']);
        $filter->setVector('testvect');
        $output = $filter->encrypt('teststring');

        $this->assertNotEquals('teststring', $output);

        $input = $filter->decrypt($output);
        $this->assertEquals('teststring', trim($input));
    }

    /**
     * @return void
     */
    public function testConstructionWithStringKey()
    {
        $filter = new Zend_Filter_Encrypt_Mcrypt('testkey');
        $data = $filter->getEncryption();
        $this->assertEquals('testkey', $data['key']);
    }

    /**
     * @return void
     */
    public function testConstructionWithInteger()
    {
        try {
            $filter = new Zend_Filter_Encrypt_Mcrypt(1234);
            $this->fail();
        } catch (Zend_Filter_Exception $e) {
            $this->assertContains('Invalid options argument', $e->getMessage());
        }
    }

    /**
     * @return void
     */
    public function testToString()
    {
        $filter = new Zend_Filter_Encrypt_Mcrypt('testkey');
        $this->assertEquals('Mcrypt', $filter->toString());
    }

    /**
     * @return void
     */
    public function testSettingEncryptionOptions()
    {
        $filter = new Zend_Filter_Encrypt_Mcrypt('testkey');
        $filter->setEncryption('newkey');
        $test = $filter->getEncryption();
        $this->assertEquals('newkey', $test['key']);

        try {
            $filter->setEncryption(1234);
            $filter->fail();
        } catch (Zend_Filter_Exception $e) {
            $this->assertContains('Invalid options argument', $e->getMessage());
        }

        try {
            $filter->setEncryption(['algorithm' => 'unknown']);
            $filter->fail();
        } catch (Zend_Filter_Exception $e) {
            $this->assertContains('The algorithm', $e->getMessage());
        }

        try {
            $filter->setEncryption(['mode' => 'unknown']);
            $filter->fail();
        } catch (Zend_Filter_Exception $e) {
            $this->assertContains('The mode', $e->getMessage());
        }
    }

    /**
     * @return void
     */
    public function testSettingEmptyVector()
    {
        $filter = new Zend_Filter_Encrypt_Mcrypt('newkey');
        $filter->setVector();
    }

    /**
     * Ensures that the filter allows de/encryption with compression
     *
     * @return void
     */
    public function testEncryptionWithDecryptionAndCompressionMcrypt()
    {
        if (!extension_loaded('bz2')) {
            $this->markTestSkipped('This adapter needs the bz2 extension');
        }

        $filter = new Zend_Filter_Encrypt_Mcrypt(['key' => 'testkey']);
        $filter->setVector('testvect');
        $filter->setCompression('bz2');
        $output = $filter->encrypt('teststring');

        $this->assertNotEquals('teststring', $output);

        $input = $filter->decrypt($output);
        $this->assertEquals('teststring', trim($input));
    }
}
