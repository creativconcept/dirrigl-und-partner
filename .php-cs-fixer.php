<?php

/**
 * PHP CS Fixer configuration for WordPress projects
 *
 * This configuration follows WordPress coding standards with some modern PHP practices.
 * Run: composer cs-fix (to fix) or composer cs-check (to check only)
 */

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/wordpress/plugins/creativconcept-dataimport',
        __DIR__ . '/wordpress/plugins/creativconcept-gutenberg',
        __DIR__ . '/wordpress/plugins/creativconcept-newsletter',
        __DIR__ . '/wordpress/plugins/creativconcept-poststatus',
        __DIR__ . '/wordpress/plugins/creativconcept-printarchive',
        __DIR__ . '/wordpress/plugins/creativconcept-registration',
        __DIR__ . '/wordpress/plugins/creativconcept-restapi',
        __DIR__ . '/wordpress/themes/bildungswerke',
    ])
    ->name('*.php')
    ->exclude('vendor')
    ->exclude('node_modules')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();

return $config
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => [
            'default' => 'single_space',
        ],
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => true,
        'blank_line_before_statement' => [
            'statements' => ['return', 'try', 'throw'],
        ],
        'cast_spaces' => ['space' => 'single'],
        'concat_space' => ['spacing' => 'one'],
        'function_typehint_space' => true,
        'no_unused_imports' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'single_quote' => true,
        'trailing_comma_in_multiline' => ['elements' => ['arrays']],
        'trim_array_spaces' => true,
        'whitespace_after_comma_in_array' => true,

        // WordPress specific
        'braces' => [
            'allow_single_line_closure' => true,
            'position_after_functions_and_oop_constructs' => 'same',
        ],
        'indentation_type' => true,
        'line_ending' => true,
        'no_trailing_whitespace' => true,
        'no_trailing_whitespace_in_comment' => true,
    ])
    ->setFinder($finder)
    ->setIndent("\t") // WordPress uses tabs
    ->setLineEnding("\n");