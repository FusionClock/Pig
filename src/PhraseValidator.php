<?php

namespace FusionClock\Pig;

class PhraseValidator implements PhraseValidatorInterface
{
    /**
     * @param string $phrase
     *
     * @return bool
     */
    public function validate(string $phrase): bool
    {
        $trimmed = trim($phrase);
        $length = strlen($trimmed);

        return $length > 0;
    }
}
