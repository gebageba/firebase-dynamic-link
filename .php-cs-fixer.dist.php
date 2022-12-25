<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

$config = new PhpCsFixer\Config();

return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2' => true,
        'blank_line_after_opening_tag' => true,
        'linebreak_after_opening_tag' => true,
        'no_superfluous_phpdoc_tags' => false,
        'global_namespace_import' => [
            'import_classes' => true,
            'import_constants' => true,
            'import_functions' => true,
        ],
        'ordered_imports' => [
            'sort_algorithm' => 'alpha',
            'imports_order' => [
                'class',
                'function',
                'const',
            ],
        ],
        'no_unused_imports' => true,
        'phpdoc_types_order' => [
            'null_adjustment' => 'always_last',
            'sort_algorithm' => 'none',
        ],
        'php_unit_test_case_static_method_calls' => [
            'call_type' => 'this'
        ],
        'phpdoc_align' => [
            'align' => 'left',
        ],
        'not_operator_with_successor_space' => true,
        'blank_line_after_namespace' => true,
        'date_time_immutable' => true,
        'declare_parentheses' => true,
        'final_public_method_for_abstract_class' => true,
        'mb_str_functions' => true,
        'simplified_if_return' => true,
        'simplified_null_return' => true,
        'header_comment' => [
            'comment_type' => 'comment',
            'header' => <<<HEREDOC
This file is part of line_nft_login.
For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
HEREDOC,
            'location' => 'after_declare_strict',
        ]
    ])
    ->setFinder($finder);
