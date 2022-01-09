<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Serializer\Encoder;

/**
 * Encodes JSON data.
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
class JsonEncoder implements EncoderInterface, DecoderInterface
{
    public const FORMAT = 'json';

    protected $encodingImpl;
    protected $decodingImpl;

    public function __construct(JsonEncode $encodingImpl = null, JsonDecode $decodingImpl = null)
    {
        $this->encodingImpl = $encodingImpl ?? new JsonEncode();
        $this->decodingImpl = $decodingImpl ?? new JsonDecode([JsonDecode::ASSOCIATIVE => true]);
    }

    /**
     * {@inheritdoc}
     */
    public function encode(mixed $data, string $format, array $context = []): string
    {
        return $this->encodingImpl->encode($data, self::FORMAT, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function decode(string $data, string $format, array $context = []): mixed
    {
        return $this->decodingImpl->decode($data, self::FORMAT, $context);
    }

    /**
     * {@inheritdoc}
     *
     * @param array $context
     */
    public function supportsEncoding(string $format /*, array $context = [] */): bool
    {
        return self::FORMAT === $format;
    }

    /**
     * {@inheritdoc}
     *
     * @param array $context
     */
    public function supportsDecoding(string $format /*, array $context = [] */): bool
    {
        return self::FORMAT === $format;
    }
}
