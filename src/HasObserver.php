<?php

namespace Waad\Observer;

use InvalidArgumentException;
use Waad\Observer\Attributes\HasObservers;

trait HasObserver
{
    public static function bootHasObserver(): void
    {
        $callback = static function () {
            static::registerObservers();
        };

        if (method_exists(static::class, 'whenBooted')) {
            static::whenBooted($callback);
        } else {
            $callback();
        }
    }

    private static function registerObservers(): void
    {
        try {
            $observers = static::resolveObservers();

            if ($observers) {
                static::observe($observers);
            }
        } catch (\Throwable $e) {
            throw new InvalidArgumentException(
                'Failed to register observer for '.static::class.': '.$e->getMessage()
            );
        }
    }

    private static function resolveObservers(): array
    {
        if (static::hasObserverAttribute()) {
            return static::getAttributeObservers();
        }

        if (property_exists(static::class, 'observer')) {
            $observer = static::$observer;

            return match (true) {
                is_array($observer) => $observer,
                is_string($observer) => [$observer],
                default => [],
            };
        }

        return static::getConventionalObservers();
    }

    private static function hasObserverAttribute(): bool
    {
        return (new \ReflectionClass(static::class))
            ->getAttributes(HasObservers::class) !== [];
    }

    private static function getAttributeObservers(): array
    {
        $attribute = (new \ReflectionClass(static::class))
            ->getAttributes(HasObservers::class)[0]->newInstance();

        $observer = $attribute->observer;

        return match (true) {
            is_array($observer) => $observer,
            is_string($observer) => [$observer],
            default => [],
        };
    }

    private static function getConventionalObservers(): array
    {
        $parts = explode('\\', static::class);
        $observerClass = sprintf(
            '%s\Observers\%sObserver',
            reset($parts),
            end($parts)
        );

        return class_exists($observerClass) ? [$observerClass] : [];
    }
}
