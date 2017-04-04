<?php

namespace FusionClock\Pig;

interface PigInterface
{
    /**
     * @param string $phrase
     *
     * @return string
     */
    public function squeel(string $phrase): string;
}
