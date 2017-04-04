<?php

namespace FusionClock\Pig;

interface PhraseValidatorInterface
{
    /**
     * @param string $phrase
     *
     * @return bool
     */
    public function validate(string $phrase): bool;
}
