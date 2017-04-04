<?php

namespace FusionClock\Pig;

class Pig implements PigInterface
{
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var PhraseValidatorInterface
     */
    private $validator;

    /**
     * @param CacheInterface           $cache
     * @param PhraseValidatorInterface $validator
     */
    public function __construct(CacheInterface $cache = null, PhraseValidatorInterface $validator = null)
    {
        if ($cache === null) {
            $cache = new Cache();
        }

        if ($validator === null) {
            $validator = new PhraseValidator();
        }

        $this->cache = $cache;
        $this->validator = $validator;
    }

    /**
     * @param string $phrase
     *
     * @return string
     */
    public function squeel(string $phrase): string
    {
        $valid = $this->validator->validate($phrase);

        if (!$valid) {
            return '';
        }

        if ($this->cache->has($phrase)) {
            return $this->cache->get($phrase);
        }

        $transformation = $this->transform($phrase);

        $this->cache->set($phrase, $transformation);

        return $transformation;
    }

    /**
     * @param string $phrase
     *
     * @return string
     */
    private function transform(string $phrase): string
    {
        $words = explode(' ', $phrase);

        $transformedWords = array_map(function (string $word) {
            return "{$this->getBeginning($word)}{$this->getEnd($word)}";
        }, $words);

        return implode(' ', $transformedWords);
    }

    /**
     * @param string $word
     *
     * @return string
     */
    private function getBeginning(string $word): string
    {
        $beginning = new Transformer();

        return $beginning->transform($word)
            ->extractBeginning()
            ->removeTrailingPunctuation()
            ->capitalizeLeadingLetter()
            ->result();
    }

    /**
     * @param string $word
     *
     * @return string
     */
    private function getEnd(string $word): string
    {
        $end = new Transformer();

        return $end->transform($word)
            ->extractEnd()
            ->addSuffix()
            ->addTrailingPunctuation()
            ->convertToLowercase()
            ->result();
    }
}
