<?php

namespace Lioneagle\LeUtils\TestHelpers;

use Illuminate\Database\Eloquent\Model;
use Mockery\Mock;
use Mockery\MockInterface;
use Mockery\VerificationDirector;

/**
 * @mixin MockInterface|Mock
 */
class ActionSpy
{
    private bool $assertExecuted;

    private array $args = [];

    private string $methodName = 'execute';

    public function __construct(public MockInterface|Mock $spy) {}

    public function assert()
    {
        $spy = $this->spy;

        if ($this->assertExecuted) {
            $spy = $spy->shouldHaveReceived($this->methodName);
        }

        if (count($this->args) > 0) {
            $spy = $spy->withArgs(function (...$args) {
                return collect($args)
                    ->map(fn ($arg, $index) => $this->assertArg($arg, $index))
                    ->every(fn ($result) => $result);
            });
        }

        return $spy;
    }

    public function wasExecuted(string $methodName = 'execute'): static
    {
        $this->methodName = $methodName;
        $this->assertExecuted = true;

        return $this;
    }

    public function withArgs(...$args): static
    {
        $this->args = $args;

        return $this;
    }

    public function assertExecuted(): VerificationDirector
    {
        return $this->spy->shouldHaveReceived($this->methodName);
    }

    public function __call(string $name, array $arguments)
    {
        return $this->spy->$name($arguments);
    }

    private function assertArg($arg, $index): bool
    {
        $compare = $this->args[$index];

        if ($compare instanceof Model) {
            return $compare->getKey() === $arg->getKey();
        }

        return $arg == $compare;
    }
}
