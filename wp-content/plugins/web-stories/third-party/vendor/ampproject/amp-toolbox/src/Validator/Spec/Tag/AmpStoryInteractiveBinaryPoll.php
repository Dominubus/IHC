<?php

/**
 * DO NOT EDIT!
 * This file was automatically generated via bin/generate-validator-spec.php.
 */
namespace Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Tag;

use Google\Web_Stories_Dependencies\AmpProject\Extension;
use Google\Web_Stories_Dependencies\AmpProject\Format;
use Google\Web_Stories_Dependencies\AmpProject\Html\Attribute;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\AttributeList;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Identifiable;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\SpecRule;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Tag;
/**
 * Tag class AmpStoryInteractiveBinaryPoll.
 *
 * @package ampproject/amp-toolbox.
 *
 * @property-read string $tagName
 * @property-read array $attrs
 * @property-read array<string> $attrLists
 * @property-read string $mandatoryAncestor
 * @property-read array<string> $htmlFormat
 * @property-read array<string> $requiresExtension
 */
final class AmpStoryInteractiveBinaryPoll extends Tag implements Identifiable
{
    /**
     * ID of the tag.
     *
     * @var string
     */
    const ID = 'AMP-STORY-INTERACTIVE-BINARY-POLL';
    /**
     * Array of spec rules.
     *
     * @var array
     */
    const SPEC = [SpecRule::TAG_NAME => Extension::STORY_INTERACTIVE_BINARY_POLL, SpecRule::ATTRS => [Attribute::OPTION_1_TEXT => [SpecRule::MANDATORY => \true], Attribute::OPTION_2_TEXT => [SpecRule::MANDATORY => \true], Attribute::OPTION_1_CONFETTI => [], Attribute::OPTION_2_CONFETTI => []], SpecRule::ATTR_LISTS => [AttributeList\InteractiveSharedConfigsAttrs::ID], SpecRule::MANDATORY_ANCESTOR => Extension::STORY_GRID_LAYER, SpecRule::HTML_FORMAT => [Format::AMP], SpecRule::REQUIRES_EXTENSION => [Extension::STORY_INTERACTIVE]];
}
