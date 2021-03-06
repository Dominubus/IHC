<?php

/**
 * DO NOT EDIT!
 * This file was automatically generated via bin/generate-validator-spec.php.
 */
namespace Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Tag;

use Google\Web_Stories_Dependencies\AmpProject\Extension;
use Google\Web_Stories_Dependencies\AmpProject\Format;
use Google\Web_Stories_Dependencies\AmpProject\Html\Attribute;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Identifiable;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\SpecRule;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Tag;
/**
 * Tag class AmpNextPageWithInlineConfig.
 *
 * @package ampproject/amp-toolbox.
 *
 * @property-read string $tagName
 * @property-read string $specName
 * @property-read bool $unique
 * @property-read array<array> $attrs
 * @property-read string $specUrl
 * @property-read array<array> $referencePoints
 * @property-read array<string> $htmlFormat
 * @property-read array<string> $requiresExtension
 */
final class AmpNextPageWithInlineConfig extends Tag implements Identifiable
{
    /**
     * ID of the tag.
     *
     * @var string
     */
    const ID = 'amp-next-page with inline config';
    /**
     * Array of spec rules.
     *
     * @var array
     */
    const SPEC = [SpecRule::TAG_NAME => Extension::NEXT_PAGE, SpecRule::SPEC_NAME => 'amp-next-page with inline config', SpecRule::UNIQUE => \true, SpecRule::ATTRS => [Attribute::DEEP_PARSING => [], Attribute::MAX_PAGES => []], SpecRule::SPEC_URL => 'https://amp.dev/documentation/components/amp-next-page/', SpecRule::REFERENCE_POINTS => [[SpecRule::TAG_SPEC_NAME => 'AMP-NEXT-PAGE > [separator]', SpecRule::UNIQUE => \true], [SpecRule::TAG_SPEC_NAME => 'AMP-NEXT-PAGE > [recommendation-box]', SpecRule::UNIQUE => \true], [SpecRule::TAG_SPEC_NAME => 'AMP-NEXT-PAGE > [footer]', SpecRule::UNIQUE => \true], [SpecRule::TAG_SPEC_NAME => 'AMP-NEXT-PAGE > SCRIPT[type=application/json]', SpecRule::MANDATORY => \true, SpecRule::UNIQUE => \true]], SpecRule::HTML_FORMAT => [Format::AMP], SpecRule::REQUIRES_EXTENSION => [Extension::NEXT_PAGE]];
}
