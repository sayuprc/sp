<?php

declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__,
    ])
    ->exclude([
        'vendor',
    ]);

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2' => true,
        '@PSR12' => true,

        'array_indentation' => true,
        'array_syntax' => true,

        'binary_operator_spaces' => [
            'operators' => [
                '=>' => 'single_space',
                '||' => 'align_single_space_minimal',
                '&&' => 'align_single_space_minimal',
            ],
        ],
        'blank_line_before_statement' => [
            'statements' => [
                'break',
                'case',
                'continue',
                'declare',
                'default',
                'do',
                'exit',
                'for',
                'foreach',
                'goto',
                'if',
                'include',
                'include_once',
                'phpdoc',
                'require',
                'require_once',
                'return',
                'switch',
                'throw',
                'try',
                'while',
                'yield',
                'yield_from',
            ],
        ],

        'cast_spaces' => [
            'space' => 'none',
        ],
        'class_attributes_separation' => true,
        'concat_space' => [
            'spacing' => 'one',
        ],

        'declare_strict_types' => true,

        'explicit_indirect_variable' => true,
        'explicit_string_variable' => true,

        'global_namespace_import' => true,

        'include' => true,

        'lambda_not_used_import' => true,
        'linebreak_after_opening_tag' => true,

        'magic_constant_casing' => true,
        'magic_method_casing' => true,
        'method_chaining_indentation' => true,
        'multiline_comment_opening_closing' => true,
        'multiline_whitespace_before_semicolons' => true,

        'native_function_casing' => true,
        'native_type_declaration_casing' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_comment' => true,
        'no_empty_phpdoc' => true,
        'no_empty_statement' => true,
        'no_extra_blank_lines' => [
            'tokens' => [
                'attribute',
                'break',
                'case',
                'continue',
                'curly_brace_block',
                'default',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'switch',
                'throw',
                'use',
                'use_trait',
            ],
        ],
        'no_leading_namespace_whitespace' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'no_spaces_around_offset' => true,
        'no_trailing_comma_in_singleline' => true,
        'no_unused_imports' => true,
        'no_useless_concat_operator' => true,
        'no_useless_else' => true,
        'no_whitespace_before_comma_in_array' => true,
        'not_operator_with_successor_space' => true,
        'nullable_type_declaration' => true,
        'nullable_type_declaration_for_default_null_value' => true,

        'object_operator_without_whitespace' => true,
        'operator_linebreak' => true,
        'ordered_interfaces' => true,
        'ordered_traits' => true,
        'ordered_types' => true,

        'php_unit_fqcn_annotation' => true,
        'phpdoc_add_missing_param_annotation' => true,
        'phpdoc_align' => true,
        'phpdoc_indent' => true,
        'phpdoc_inline_tag_normalizer' => true,
        'phpdoc_order' => true,
        'phpdoc_order_by_value' => true,
        'phpdoc_param_order' => true,
        'phpdoc_return_self_reference' => true,
        'phpdoc_scalar' => true,
        'phpdoc_separation' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_tag_casing' => true,
        'phpdoc_trim' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => true,
        'phpdoc_types' => true,
        'phpdoc_types_order' => [
            'null_adjustment' => 'always_last',
            'sort_algorithm' => 'none',
        ],
        'phpdoc_var_annotation_correct_order' => true,

        'return_assignment' => true,

        'semicolon_after_instruction' => true,
        'simple_to_complex_string_variable' => true,
        'simplified_if_return' => true,
        'single_line_comment_spacing' => true,
        'single_line_comment_style' => true,
        'single_quote' => true,
        'single_space_around_construct' => true,
        'strict_comparison' => true,

        'trailing_comma_in_multiline' => true,
        'trim_array_spaces' => true,
        'type_declaration_spaces' => true,
        'types_spaces' => true,

        'whitespace_after_comma_in_array' => [
            'ensure_single_space' => true,
        ],
    ])
    ->setLineEnding("\n")
    ->setfinder($finder);
