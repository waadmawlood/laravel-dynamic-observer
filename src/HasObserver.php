<?php

namespace Waad\Observer;

trait HasObserver
{

    /**
     * Event , This function will boot the observer for the current model.
     */
    public static function bootHasObserver()
    {
        // Check if the 'observer' property exists in the current class
        if (property_exists(static::class, 'observer')) {

            // Check if 'observer' property is an array, otherwise convert it into an array
            $observers = is_array(static::$observer) ? static::$observer : [static::$observer];

            // Create an empty array to store the valid observers
            $observersTarget = array();

            // Iterate over the observers and check if they are not empty and the class exists
            foreach ($observers as $observer) {

                if (!empty($observer) && class_exists($observer)) {

                    $observersTarget[] = $observer; // Add the valid observer to the target array
                }
            }
            static::observe($observersTarget); // Assign the observer to the model

        } else {

            // Split the fully qualified class name into an array based on the backslash separator
            $pathModel = explode("\\", static::class);

            // Create the observer class name by combining the namespace and the observer naming convention
            $observerClass = sprintf('%s\Observers\%sObserver', reset($pathModel), end($pathModel));

            // Check if the observer class exists
            if (class_exists($observerClass)) {

                static::observe($observerClass); // Assign the observer to the model
            }
        }
    }
}
