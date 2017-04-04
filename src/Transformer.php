<?php

namespace FusionClock\Pig;

class Transformer
{
    /**
     * @var string
     */
    private $original;

    /**
     * @var string
     */
    private $current;

    /**
     * This is used as a mask to identify where to split words.
     *
     * @var string
     */
    private $vowels = 'AEIOU';

    /**
     * @param string $word
     *
     * @return Transformer
     */
    public function transform(string $word): Transformer
    {
        $this->original = $word;
        $this->current = $this->original;

        return $this;
    }

    /**
     * @return Transformer
     */
    public function addSuffix(): Transformer
    {
        $suffix = 'ay';

        if ($this->current === '') {
            $suffix = 'way';
        }

        $this->current = "{$this->current}{$suffix}";

        return $this;
    }

    /**
     * @return Transformer
     */
    public function addTrailingPunctuation(): Transformer
    {
        $originalWordLength = strlen($this->original) - 1;
        $lastCharacter = $this->original[$originalWordLength];

        if (preg_match('/[0-9.!?,;:]$/', $lastCharacter)) {
            $this->current = "{$this->current}{$lastCharacter}";
        }

        return $this;
    }

    /**
     * @return Transformer
     */
    public function convertToLowercase(): Transformer
    {
        $this->current = strtolower($this->current);

        return $this;
    }

    /**
     * @return Transformer
     */
    public function extractBeginning(): Transformer
    {
        $letters = str_split($this->current);
        $beginning = array_slice($letters, $this->getSliceLength());
        $this->current = implode('', $beginning);

        return $this;
    }

    /**
     * @return Transformer
     */
    public function extractEnd(): Transformer
    {
        $letters = str_split($this->current);
        $end = array_slice($letters, 0, $this->getSliceLength());
        $this->current = implode('', $end);

        return $this;
    }

    /**
     * @return Transformer
     */
    public function removeTrailingPunctuation(): Transformer
    {
        $wordLength = strlen($this->current) - 1;
        $lastCharacter = $this->current[$wordLength];

        if (preg_match('/[0-9.!?,;:]$/', $lastCharacter)) {
            $this->current = substr($this->current, 0, $wordLength);
        }

        return $this;
    }

    /**
     * @return Transformer
     */
    public function capitalizeLeadingLetter(): Transformer
    {
        if (ctype_upper($this->original[0])) {
            $this->current = ucfirst($this->current);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function result(): string
    {
        return $this->current;
    }

    /**
     * @return int
     */
    private function getSliceLength(): int
    {
        return strcspn(strtoupper($this->original), $this->vowels);
    }
}
