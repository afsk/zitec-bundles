<?php

namespace Zitec\JSDataBundle\DataCollector;

/**
 * Represents an interface which all JS data collectors must implement.
 *
 * A data collector is nothing more than an object whose role is to collect data from different components and expose
 * the final data set, which will get piped to the application's JS scripts. The data collector will output a single
 * value, as the intention is to have in JavaScript a single point of accessing the data received from the server.
 *
 * The concrete data collectors will decide how to store and manage the collected data but they should expose a simple
 * API for:
 * - adding a value to the data set. Considering that in most of the cases we would like to output to JS a
 *   multi-dimensional data structure, the adding method will also demand a property path for setting the value.
 *   A special exception should be thrown when that path is invalid;
 * - merging a data set to the existing data set. There will be cases when it will be much simpler to do that than
 *   adding the desired values;
 * - getting the collected data. The output of this method should be a value which can be JSON-encoded;
 */
interface DataCollectorInterface
{
    /**
     * Sets a value at the given path in the data set.
     *
     * @param string $path
     * @param mixed $value
     *
     * @return $this
     *
     * @throws InvalidPathException
     * - when the path is invalid;
     */
    public function add($path, $value);

    /**
     * Merges the given data set to the existing set.
     *
     * @param mixed $data
     *
     * @return $this
     */
    public function merge($data);

    /**
     * Fetches the collected data.
     *
     * @return mixed
     * - a value which can be JSON-encoded;
     */
    public function getAll();
}
