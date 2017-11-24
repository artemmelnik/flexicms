<?php
namespace Flexi\Encryption;

use Exception;

/**
 * Class Hash
 * @package Flexi\Encryption
 */
class Hash
{

    /**
     * Checks that the algorithm is valid.
     *
     * @param  string  $algo  The algorithm to check.
     * @return bool
     */
    public static function validAlgo(string $algo): bool
    {
        return in_array($algo, hash_algos());
    }

    /**
     * Generates a hash.
     *
     * @param  string  $data  Data to hash.
     * @param  string  $algo  Algorithm method to encrypt with.
     * @return string
     */
    public static function make(string $data, string $algo = 'md5'): string
    {
        // Check that we are using a valid algorithm.
        if (!self::validAlgo($algo)) {
            throw new Exception(
                sprintf('Invalid hashing algorithm: %s.', $algo)
            );
        }

        return hash($algo, $data);
    }

}
