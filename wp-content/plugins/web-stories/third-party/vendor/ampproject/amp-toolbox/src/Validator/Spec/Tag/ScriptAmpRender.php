<?php

/**
 * DO NOT EDIT!
 * This file was automatically generated via bin/generate-validator-spec.php.
 */
namespace Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Tag;

use Google\Web_Stories_Dependencies\AmpProject\Format;
use Google\Web_Stories_Dependencies\AmpProject\Html\Tag as Element;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\AttributeList;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Identifiable;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\SpecRule;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\Tag;
use Google\Web_Stories_Dependencies\AmpProject\Validator\Spec\TagWithExtensionSpec;
/**
 * Tag class ScriptAmpRender.
 *
 * @package ampproject/amp-toolbox.
 *
 * @property-read string $tagName
 * @property-read array<string> $attrLists
 * @property-read array<string> $htmlFormat
 * @property-read string $extensionSpec
 */
final class ScriptAmpRender extends TagWithExtensionSpec implements Identifiable
{
    /**
     * ID of the tag.
     *
     * @var string
     */
    const ID = 'SCRIPT [amp-render]';
    /**
     * Array of extension spec rules.
     *
     * @var array
     */
    const EXTENSION_SPEC = [SpecRule::NAME => 'amp-render', SpecRule::VERSION => ['1.0', 'latest']];
    /**
     * Latest version of the extension.
     *
     * @var string
     */
    const LATEST_VERSION = '1.0';
    /**
     * Meta data about the specific versions.
     *
     * @var array
     */
    const VERSIONS_META = ['1.0' => ['hasCss' => \false, 'hasBento' => \false]];
    /**
     * Array of spec rules.
     *
     * @var array
     */
    const SPEC = [SpecRule::TAG_NAME => Element::SCRIPT, SpecRule::ATTR_LISTS => [AttributeList\CommonExtensionAttrs::ID], SpecRule::HTML_FORMAT => [Format::AMP], SpecRule::EXTENSION_SPEC => self::EXTENSION_SPEC];
}
