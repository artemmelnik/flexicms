<?php
namespace Flexi\Session;

interface SessionInterface
{

    /**
     * Initializes the session.
     *
     * @return bool
     */
    public function initialize();

    /**
     * Finalizes the session.
     *
     * @return bool
     */
    public function finalize();

    /**
     * Inserts data into a session.
     *
     * @param  string  $name  The name of the session.
     * @param  mixed   $data  The data to add into the session.
     * @return \Flexi\Session\SessionDriver
     */
    public function put(string $name, $data);

    /**
     * Gets an item from the session.
     *
     * @param  string  $name  The name of the session.
     * @return mixed
     */
    public function get(string $name);

    /**
     * Checks if an item exists in session.
     *
     * @param  string  $name  The name of the session.
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * Deletes an item from session.
     *
     * @param  string  $name  The name of the session.
     * @return \Flexi\Session\SessionDriver
     */
    public function forget(string $name);

    /**
     * Deletes all items from the session.
     *
     * @return \Flexi\Session\SessionDriver
     */
    public function flush();

    /**
     * Returns all items in the session.
     *
     * @return array
     */
    public function all();

    /**
     * Sets flash data that only lives for one request, if no data was passed
     * it will attempt to find the stored data.
     *
     * @param  string  $name  The name of the flash data.
     * @param  array   $data  The data to store in the session.
     * @return mixed
     */
    public function flash(string $name, $data = null);

    /**
     * Keep flash data for another request.
     *
     * @param  string  $name  The name of the data to keep.
     * @return \Flexi\Session\SessionDriver
     */
    public function keep(string $name);

    /**
     * Returns the data kept for the next request.
     *
     * @return array
     */
    public function kept();

}
