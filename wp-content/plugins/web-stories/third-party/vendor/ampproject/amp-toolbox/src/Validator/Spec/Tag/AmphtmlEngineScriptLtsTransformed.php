<?php

/**
 * DO NOT EDIT!
 * This file was automatically generated via bin/generate-validator-spec.php.
 */
namespace Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Tag;

use Google\Web_Stories_Dependencies\AmpProject\Format;
use Google\Web_Stories_Dependencies\AmpProject\Html\Attribute;
use Google\Web_Stories_Dependencies\AmpProject\Html\Tag as Element;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\AttributeList;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Identifiable;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\SpecRule;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Tag;
/**
 * Tag class AmphtmlEngineScriptLtsTransformed.
 *
 * @package ampproject/amp-toolbox.
 *
 * @property-read string $tagName
 * @property-read string $specName
 * @property-read bool $unique
 * @property-read string $mandatoryParent
 * @property-read array<array> $attrs
 * @property-read array<string> $attrLists
 * @property-read string $specUrl
 * @property-read array<array<array<string>>> $cdata
 * @property-read array<string> $htmlFormat
 * @property-read array<string> $satisfies
 * @property-read array<string> $enabledBy
 * @property-read string $descriptiveName
 */
final class AmphtmlEngineScriptLtsTransformed extends Tag implements Identifiable
{
    /**
     * ID of the tag.
     *
     * @var string
     */
    const ID = 'amphtml engine script (LTS) (transformed)';
    /**
     * Array of spec rules.
     *
     * @var array
     */
    const SPEC = [SpecRule::TAG_NAME => Element::SCRIPT, SpecRule::SPEC_NAME => 'amphtml engine script (LTS) (transformed)', SpecRule::UNIQUE => \true, SpecRule::MANDATORY_PARENT => Element::HEAD, SpecRule::ATTRS => [Attribute::SRC => [SpecRule::MANDATORY => \true, SpecRule::VALUE => ['https://cdn.ampproject.org/lts/v0.js'], SpecRule::DISPATCH_KEY => 'NAME_VALUE_DISPATCH']], SpecRule::ATTR_LISTS => [AttributeList\NonceAttr::ID, AttributeList\AmphtmlEngineAttrs::ID], SpecRule::SPEC_URL => 'https://amp.dev/documentation/guides-and-tutorials/learn/spec/amphtml/#required-markup', SpecRule::CDATA => [SpecRule::DISALLOWED_CDATA_REGEX => [[SpecRule::REGEX => '.', SpecRule::ERROR_MESSAGE => 'contents']]], SpecRule::HTML_FORMAT => [Format::AMP], SpecRule::SATISFIES => ['amphtml javascript runtime (v0.js)'], SpecRule::ENABLED_BY => [Attribute::TRANSFORMED], SpecRule::DESCRIPTIVE_NAME => 'amphtml engine script'];
}
