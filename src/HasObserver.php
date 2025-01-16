<?php

namespace Waad\Observer;

use InvalidArgumentException;

/**
 * Trait HasObserver
 * 
 * This trait provides dynamic observer functionality for Laravel models.
 * It allows models to automatically register observers either through explicit configuration
 * or through convention-based naming.
 * 
 * @package Waad\Observer
 */
trait HasObserver
{
    /**
     * Boot the HasObserver trait.
     *
     * @throws InvalidArgumentException When an invalid observer class is provided
     * @return void
     */
    public static function bootHasObserver(): void
    {
        try {
            property_exists(static::class, 'observer')
                ? static::registerExplicitObservers()
                : static::registerConventionalObserver();
        } catch (\Throwable $e) {
            throw new InvalidArgumentException(
                "Failed to register observer for " . static::class . ": " . $e->getMessage()
            );
        }
    }

    /**
     * Register explicitly defined observers from the $observer property.
     *
     * @return void
     */
    private static function registerExplicitObservers(): void
    {
        $observers = is_array(static::$observer) ? static::$observer : [static::$observer];
        
        $validObservers = array_filter($observers, fn($observer) => 
            !empty($observer) && class_exists($observer)
        );

        if ($validObservers) {
            static::observe($validObservers);
        }
    }

    /**
     * Register observer based on conventional naming.
     *
     * @return void
     */
    private static function registerConventionalObserver(): void
    {
        $parts = explode("\\", static::class);
        $observerClass = sprintf(
            '%s\Observers\%sObserver',
            reset($parts),
            end($parts)
        );

        if (class_exists($observerClass)) {
            static::observe($observerClass);
        }
    }
}
