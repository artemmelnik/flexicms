<?php
namespace Flexi\Http;

/**
 * Class Header
 * @package Flexi\Http
 */
class Header
{
    /**
     * Check to see if the headers have been sent to the browser.
     *
     * @param  string  $header  Check to see if a particular header has been sent.
     * @return bool
     */
    public static function sent(string $header = ''): bool
    {
        // Are we just checking if headers have been sent?
        if ($header === '') {
            return headers_sent();
        } else {
            // Normalize the header.
            $header = strtolower($header);

            // Check headers.
            foreach (static::get() as $sent) {
                // Get the header name.
                $name = explode(':', $sent);
                $name = strtolower($name[0]);

                // If it matches, return true.
                if ($name === $header) {
                    return true;
                }
            }
        }

        // Nothing found.
        return false;
    }

    /**
     * Get the headers that have been sent to the browser.
     *
     * @return array
     */
    public static function get(): array
    {
        return headers_list();
    }

    /**
     * Sends a raw HTTP header.
     *
     * @param  string  $header   The header to send.
     * @param  string  $data     The data to send to the header.
     * @param  bool    $replace  Replace similar headers that have been sent.
     * @return void
     */
    public static function send(string $header, string $data = '', bool $replace = true)
    {
        header($header . ($data !== '' ? ':' . $data : ''), $replace);
    }

    /**
     * Remove a previously set header.
     *
     * @param  string  $header  The header to remove.
     * @return void
     */
    public static function remove(string $header)
    {
        header_remove($header);
    }
}
