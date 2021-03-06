<?php

namespace Google\Web_Stories_Dependencies\FasterImage;

use Google\Web_Stories_Dependencies\WillWashburn\Stream\Exception\StreamBufferTooSmallException;
use Google\Web_Stories_Dependencies\WillWashburn\Stream\Stream;
use Google\Web_Stories_Dependencies\WillWashburn\Stream\StreamableInterface;
/**
 * Parses the stream of the image and determines the size and type of the image
 *
 * @package FasterImage
 */
class ImageParser
{
    /**
     * The type of image we've determined this is
     *
     * @var string
     */
    protected $type;
    /**
     * @var StreamableInterface $stream
     */
    private $stream;
    /**
     * ImageParser constructor.
     *
     * @param StreamableInterface $stream
     */
    public function __construct(StreamableInterface &$stream)
    {
        $this->stream = $stream;
    }
    /**
     * @return array|bool|null
     */
    public function parseSize()
    {
        $this->stream->resetPointer();
        switch ($this->type) {
            case 'png':
                return $this->parseSizeForPNG();
            case 'ico':
            case 'cur':
                return $this->parseSizeForIco();
            case 'gif':
                return $this->parseSizeForGIF();
            case 'bmp':
                return $this->parseSizeForBMP();
            case 'jpeg':
                return $this->parseSizeForJPEG();
            case 'tiff':
                return $this->parseSizeForTiff();
            case 'psd':
                return $this->parseSizeForPSD();
            case 'webp':
                return $this->parseSizeForWebp();
            case 'svg':
                return $this->parseSizeForSvg();
        }
        return null;
    }
    /**
     * @return array
     */
    public function parseSizeForIco()
    {
        $this->stream->read(6);
        $b1 = $this->getByte();
        $b2 = $this->getByte();
        return [$b1 == 0 ? 256 : $b1, $b2 == 0 ? 256 : $b2];
    }
    /**
     * @return array
     */
    protected function parseSizeForPSD()
    {
        $this->stream->read(14);
        $sizes = \unpack("N*", $this->stream->read(12));
        return [$sizes[2], $sizes[1]];
    }
    /**
     * Reads and returns the type of the image
     *
     * @return bool|string
     */
    public function parseType()
    {
        if (!$this->type) {
            $this->stream->resetPointer();
            switch ($this->stream->read(2)) {
                case "BM":
                    return $this->type = 'bmp';
                case "GI":
                    return $this->type = 'gif';
                case \chr(0xff) . \chr(0xd8):
                    return $this->type = 'jpeg';
                case "\x00\x00":
                    switch ($this->readByte($this->stream->peek(1))) {
                        case 1:
                            return $this->type = 'ico';
                        case 2:
                            return $this->type = 'cur';
                    }
                    return \false;
                case \chr(0x89) . 'P':
                    return $this->type = 'png';
                case "RI":
                    if (\substr($this->stream->read(10), 6, 4) == 'WEBP') {
                        return $this->type = 'webp';
                    }
                    return \false;
                case '8B':
                    return $this->type = 'psd';
                case "II":
                case "MM":
                    return $this->type = 'tiff';
                default:
                    $this->stream->resetPointer();
                    // Keep reading bytes until we find '<svg'.
                    while (\true) {
                        $byte = $this->stream->read(1);
                        if ('<' === $byte && 'svg' === $this->stream->peek(3)) {
                            $this->type = 'svg';
                            return $this->type;
                        }
                    }
                    return \false;
            }
        }
        return $this->type;
    }
    /**
     * @return array
     */
    protected function parseSizeForBMP()
    {
        $chars = $this->stream->read(29);
        $chars = \substr($chars, 14, 14);
        $type = \unpack('C', $chars);
        $size = \reset($type) == 40 ? \unpack('l*', \substr($chars, 4)) : \unpack('l*', \substr($chars, 4, 8));
        return [\current($size), \abs(\next($size))];
    }
    /**
     * @return array
     */
    protected function parseSizeForGIF()
    {
        $chars = $this->stream->read(11);
        $size = \unpack("S*", \substr($chars, 6, 4));
        return [\current($size), \next($size)];
    }
    /**
     * @return array|bool
     */
    protected function parseSizeForJPEG()
    {
        $state = null;
        while (\true) {
            switch ($state) {
                default:
                    $this->stream->read(2);
                    $state = 'started';
                    break;
                case 'started':
                    $b = $this->getByte();
                    if ($b === \false) {
                        return \false;
                    }
                    $state = $b == 0xff ? 'sof' : 'started';
                    break;
                case 'sof':
                    $b = $this->getByte();
                    if ($b === 0xe1) {
                        $data = $this->stream->read($this->readInt($this->stream->read(2)) - 2);
                        $stream = new Stream();
                        $stream->write($data);
                        if ($stream->read(4) === 'Exif') {
                            $stream->read(2);
                            // Some Exif data is broken/wrong so we'll ignore
                            // any exceptions here
                            try {
                                $exif = new ExifParser($stream);
                            } catch (\Exception $e) {
                            }
                        }
                        break;
                    }
                    if (\in_array($b, \range(0xe0, 0xef))) {
                        $state = 'skipframe';
                        break;
                    }
                    if (\in_array($b, \array_merge(\range(0xc0, 0xc3), \range(0xc5, 0xc7), \range(0xc9, 0xcb), \range(0xcd, 0xcf)))) {
                        $state = 'readsize';
                        break;
                    }
                    if ($b == 0xff) {
                        $state = 'sof';
                        break;
                    }
                    $state = 'skipframe';
                    break;
                case 'skipframe':
                    $skip = $this->readInt($this->stream->read(2)) - 2;
                    $this->stream->read($skip);
                    $state = 'started';
                    break;
                case 'readsize':
                    $c = $this->stream->read(7);
                    $size = array($this->readInt(\substr($c, 5, 2)), $this->readInt(\substr($c, 3, 2)));
                    if (isset($exif) && $exif->isRotated()) {
                        return \array_reverse($size);
                    }
                    return $size;
            }
        }
        return \false;
    }
    /**
     * @return array
     */
    protected function parseSizeForPNG()
    {
        $chars = $this->stream->read(25);
        $size = \unpack("N*", \substr($chars, 16, 8));
        return [\current($size), \next($size)];
    }
    /**
     * @return array|bool
     * @throws \FasterImage\Exception\InvalidImageException
     * @throws StreamBufferTooSmallException
     */
    protected function parseSizeForTiff()
    {
        $exif = new ExifParser($this->stream);
        if ($exif->isRotated()) {
            return [$exif->getHeight(), $exif->getWidth()];
        }
        return [$exif->getWidth(), $exif->getHeight()];
    }
    /**
     * @return null
     * @throws StreamBufferTooSmallException
     */
    protected function parseSizeForWebp()
    {
        $vp8 = \substr($this->stream->read(16), 12, 4);
        $len = \unpack("V", $this->stream->read(4));
        switch (\trim($vp8)) {
            case 'VP8':
                $this->stream->read(6);
                $width = \current(\unpack("v", $this->stream->read(2)));
                $height = \current(\unpack("v", $this->stream->read(2)));
                return [$width & 0x3fff, $height & 0x3fff];
            case 'VP8L':
                $this->stream->read(1);
                $b1 = $this->getByte();
                $b2 = $this->getByte();
                $b3 = $this->getByte();
                $b4 = $this->getByte();
                $width = 1 + (($b2 & 0x3f) << 8 | $b1);
                $height = 1 + (($b4 & 0xf) << 10 | $b3 << 2 | ($b2 & 0xc0) >> 6);
                return [$width, $height];
            case 'VP8X':
                $flags = \current(\unpack("C", $this->stream->read(4)));
                $b1 = $this->getByte();
                $b2 = $this->getByte();
                $b3 = $this->getByte();
                $b4 = $this->getByte();
                $b5 = $this->getByte();
                $b6 = $this->getByte();
                $width = 1 + $b1 + ($b2 << 8) + ($b3 << 16);
                $height = 1 + $b4 + ($b5 << 8) + ($b6 << 16);
                return [$width, $height];
            default:
                return null;
        }
    }
    /**
     * Parse size for SVG.
     *
     * @return array|null Size or null.
     */
    protected function parseSizeForSvg()
    {
        $this->stream->resetPointer();
        // Keep reading bytes until we find the complete <svg> start tag.
        $inside = \false;
        $markup = '';
        while (\true) {
            $byte = $this->stream->read(1);
            // Open a tag if not in a tag and the byte is '<'.
            if (!$inside && '<' === $byte) {
                $inside = \true;
                $markup .= $byte;
            } elseif ($inside && '>' === $byte && '--' !== \substr($markup, -2)) {
                $inside = \false;
                $markup .= $byte;
                // Break the loop if this tag started with '<svg', as we have now found the SVG start tag.
                if ('<svg' === \strtolower(\substr($markup, 0, 4))) {
                    break;
                }
                // Clear out the markup since we consumed the end of the tag/comment.
                $markup = '';
            } elseif ($inside) {
                $markup .= $byte;
            }
        }
        $width = null;
        $height = null;
        if (\preg_match('/\\swidth=([\'"])(\\d+(\\.\\d+)?)(px)?\\1/', $markup, $matches)) {
            $width = \floatval($matches[2]);
        }
        if (\preg_match('/\\sheight=([\'"])(\\d+(\\.\\d+)?)(px)?\\1/', $markup, $matches)) {
            $height = \floatval($matches[2]);
        }
        if ($width && $height) {
            return [$width, $height];
        }
        if (\preg_match('/\\sviewBox=([\'"])[^\\1]*(?:,|\\s)+(?P<width>\\d+(?:\\.\\d+)?)(?:px)?(?:,|\\s)+(?P<height>\\d+(?:\\.\\d+)?)(?:px)?\\s*\\1/', $markup, $matches)) {
            return [\floatval($matches['width']), \floatval($matches['height'])];
        }
        return null;
    }
    /**
     * @return mixed
     */
    private function getByte()
    {
        return $this->readByte($this->stream->read(1));
    }
    /**
     * @param $string
     *
     * @return mixed
     */
    private function readByte($string)
    {
        return \current(\unpack("C", $string));
    }
    /**
     * @param $str
     *
     * @return int
     */
    private function readInt($str)
    {
        $size = \unpack("C*", $str);
        return ($size[1] << 8) + $size[2];
    }
}
